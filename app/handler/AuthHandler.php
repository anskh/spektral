<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Forms\LoginForm;
use App\Model\Forms\RegisterForm;
use App\Model\Forms\ResetForm;
use App\Model\Forms\ResetPasswordForm;
use App\Model\Db\UserModel;
use App\Model\Forms\UserForm;
use Corephp\Helper\Service;
use Corephp\Helper\Token;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use JKD\SSO\Client\Provider\Keycloak;

class AuthHandler extends ActionHandler
{
    /**
     * Handle route 'login' or url '/auth/login'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (auth()->getIdentity()->getData()['is_internal']) {
                return redirect_to('admin_index');
            } else {
                return redirect_to('index');
            }
        }

        $model = new LoginForm();
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                if (str_contains($model->email, '@bps.go.id')) {
                    $model->addError('Akun internal login menggunakan SSO.');
                    session()->addFlashError("Akun BPS login menggunakan SSO BPS.");
                } else {
                    $row = UserModel::row('*', ['email=' => $model->email]);
                    if ($row) {
                        if ($row['is_active'] == 0) {
                            $model->addError('Akun belum aktif, silahkan lakukan aktivasi sesuai dengan petunjuk yang dikirimkan via email.');
                        } elseif (password_verify($model->password, $row['password'])) {
                            session()->setUserId(strval($row['id']));
                            session()->setUserHash(sha1($row['email'] . $request->getServerParams()['HTTP_USER_AGENT']));
                            session()->addFlashSuccess("Selamat datang '" . ucfirst($row['nama'] . "'"));
                            return redirect_to('index');
                        } else {
                            $model->addError('Email atau password tidak match.');
                        }
                    } else {
                        $model->addError('Email belum terdaftar.');
                    }
                }
            }
        }

        $params = ['title' => 'LOGIN | SPEKTRAL'];
        $params['page'] = 'LOGIN';
        $params['model'] = $model;
        $params['breadcrumbs'] = [];

        return view('auth_login', $params, $response, 'frontend');
    }
    /**
     * handle route 'logout' or url '/auth/logout'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function logout(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            session()->unsetUserId();
            session()->unsetUserHash();
            if (auth()->getIdentity()->getData()['is_internal']) {
                session()->unset('oauth2state');
                $provider = $this->getSSOProvider();
                $url_logout = $provider->getLogoutUrl();

                return redirect_url($url_logout);
            } else {
                session()->addFlashSuccess('Logout berhasil');
                return redirect_url(auth()->getProvider()->getLoginUri());
            }
        }
        return redirect_to('index');
    }
    /**
     * handle route 'reset_password' or url '/auth/reset/{token}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function resetPassword(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params['title'] = 'RESET PASSWORD | SPEKTRAL';

        $model = new ResetPasswordForm();
        $token = $request->getAttribute('token');
        $row = UserModel::row('*', ['reset_token=' => $token]);
        if ($row) {
            $params['token'] = $token;
            if ($request->getMethod() === 'POST') {
                if ($model->fillAndValidateWith($request)) {
                    try {
                        UserModel::update(
                            [
                                'password' => password_hash($model->password, PASSWORD_BCRYPT),
                                'is_active' => 1,
                                'reset_token' => NULL,
                                'update_at' => time()
                            ],
                            ['reset_token=' => $token]
                        );
                        session()->addFlashSuccess('Ubah password berhasil');
                    } catch (Exception $e) {
                        session()->addFlashSuccess('Ubah password gagal. Error:' . $e->getMessage());
                    }

                    return redirect_url(auth()->getProvider()->getLoginUri());
                }
            }
            $params['page'] = 'RESET PASSWORD';

            $params['model'] = $model;

            return view('auth_reset_password', $params, $response, 'frontend');
        } else {
            return redirect_url(auth()->getProvider()->getLoginUri());
        }
    }
    /**
     * handle route 'reset' or url '/auth/reset'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function reset(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            return redirect_to('index');
        }

        $params['title'] = 'RESET PASSWORD | SPEKTRAL';

        $model = new ResetForm();
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                if (str_contains($model->email, '@bps.go.id')) {
                    $model->addError('Akun internal tidak dapat melakukan reset password.');
                    session()->addFlashError("Akun internal tidak dapat melakukan reset password.");
                } else {
                    $row = UserModel::row('*', ['email=' => $model->email]);
                    if ($row) {
                        try {
                            $token = Token::generateMD5Token();
                            UserModel::update(
                                [
                                    'reset_token' => $token,
                                    'update_at' => time()
                                ],
                                ['email=' => $model->email]
                            );

                            $mail = Service::mail();
                            $from = config('mail.from');
                            $url = base_url(route('reset_password') . $token);
                            $message = "From: \"Spektral\" <{$from}> " . PHP_EOL;
                            $message .= "To: \"{$row['nama']}\" <{$model->email}>" . PHP_EOL;
                            $message .= "Subject: Spektral - Reset Password" . PHP_EOL;
                            $message .= "Date: " . rfc822_date() . PHP_EOL;
                            $message .= "MIME-Version: 1.0" . PHP_EOL;
                            $message .= "Content-Type: text/html; charset=utf-8" . PHP_EOL . PHP_EOL;
                            $message .= "<html>" . PHP_EOL;
                            $message .= "<body>" . PHP_EOL;
                            $message .= "<p>Halo, <strong>{$row['nama']}</strong><p>";
                            $message .= "<p>Terima kasih telah melakukan permintaan reset password di SPEKTRAL BPS Provinsi Riau.<br>";
                            $message .= "Klik tautan di bawah ini untuk memasukkan password yang baru.<br>";
                            $message .= "<a href=\"{$url}\" target=\"_blank\">Ubah Sekarang</a></p>";
                            $message .= "<p>Badan Pusat Statistik Provinsi Riau<br>";
                            $message .= "Jl. Pattimura No. 12, Pekanbaru.  Telp (62761) 23042<br>";
                            $message .= "Email: <a href=\"mailto:bps1400@bps.go.id\">bps1400@bps.go.id</a></p>";
                            $message .= "</body>" . PHP_EOL;
                            $message .= "</html>";

                            if ($mail->send($from, $model->email, $message)) {
                                session()->addFlashSuccess('Reset password berhasil. Link reset berhasil dikirimkan ke email.');
                            } else {
                                session()->addFlashError('Link reset password gagal dikirimkan ke email.');
                            }
                        } catch (Exception $e) {
                            session()->addFlashError('Terjadi kesalahan kirim email : ' . $e->getMessage());
                        }
                        return redirect_url(auth()->getProvider()->getLoginUri());
                    } else {
                        $model->addError('Alamat email tidak ditemukan. Silahkan perbaiki isian alamat email.', 'email');
                    }
                }
            }
        }
        $params['page'] = 'RESET PASSWORD';
        $params['model'] = $model;
        $params['breadcrumbs'] = [];

        return view('auth_reset', $params, $response, 'frontend');
    }


    /**
     * handle route 'register' or url '/auth/register'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            return redirect_to('index');
        }

        $params['title'] = 'DAFTAR AKUN | SPEKTRAL';

        $model = new RegisterForm();
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                if (str_contains($model->email, '@bps.go.id')) {
                    $model->addError('Akun internal tidak dapat melakukan register.');
                    session()->addFlashError("Akun internal tidak dapat melakukan register.");
                } else {
                    $row = UserModel::row('*', ['email=' => $model->email]);
                    if ($row) {
                        $model->addError('Alamat email sudah digunakan, silahkan menggunakan alamat email lain.', 'email');
                    } else {
                        try {
                            $token = Token::generateMD5Token();
                            UserModel::create(
                                [
                                    'email' => $model->email,
                                    'password' => password_hash($model->password, PASSWORD_BCRYPT),
                                    'nama' => $model->nama,
                                    'nip' => $model->nip,
                                    'jabatan' => $model->jabatan,
                                    'instansi' => $model->instansi,
                                    'tingkat' => $model->tingkat,
                                    'nomor_wa' => $model->nomor_wa,
                                    'role' => 'user',
                                    'token' => $token,
                                    'is_active' => 0,
                                    'create_at' => time()
                                ]
                            );

                            $mail = Service::mail();
                            $from = config('mail.from');
                            $url = base_url(route('activation') . $token);
                            $message = "From: \"Spektral\" <{$from}> " . PHP_EOL;
                            $message .= "To: \"{$model->nama}\" <{$model->email}>" . PHP_EOL;
                            $message .= "Subject: Spektral - Aktivasi Akun" . PHP_EOL;
                            $message .= "Date: " . rfc822_date() . PHP_EOL;
                            $message .= "MIME-Version: 1.0" . PHP_EOL;
                            $message .= "Content-Type: text/html; charset=utf-8" . PHP_EOL . PHP_EOL;
                            $message .= "<html>" . PHP_EOL;
                            $message .= "<body>" . PHP_EOL;
                            $message .= "<p>Halo, <strong>{$model->nama}</strong><br>";
                            $message .= "Selamat datang di SPEKTRAL BPS Provinsi Riau. Terima kasih telah melakukan registrasi akun di SPEKTRAL BPS Provinsi Riau.<br>";
                            $message .= "Klik tautan di bawah ini untuk memverifikasi akun email Anda untuk mendapatkan akses penuh pada SPEKTRAL BPS Provinsi Riau.<br>";
                            $message .= "<a href=\"{$url}\" target=\"_blank\">Aktifkan Sekarang</a></p>";
                            $message .= "<p>Terima kasih,<br>Badan Pusat Statistik Provinsi Riau<br>";
                            $message .= "Jl. Pattimura No. 12, Pekanbaru.  Telp (62761) 23042<br>";
                            $message .= "Email: <a href=\"mailto:bps1400@bps.go.id\">bps1400@bps.go.id</a></p>";
                            $message .= "</body>" . PHP_EOL;
                            $message .= "</html>";

                            if ($mail->send($from, $model->email, $message)) {
                                session()->addFlashSuccess('Daftar akun berhasil. Link aktivasi akun berhasil dikirimkan ke email.');
                            } else {
                                session()->addFlashError('Link aktivasi akun gagal dikirimkan ke email.');
                            }
                        } catch (Exception $e) {
                            session()->addFlashError('Terjadi kesalahan kirim email : ' . $e->getMessage());
                        }
                        return redirect_url(auth()->getProvider()->getLoginUri());
                    }
                }
            }
        }
        $params['page'] = 'DAFTAR AKUN';
        $params['model'] = $model;
        $params['breadcrumbs'] = [];

        return view('auth_register', $params, $response, 'frontend');
    }
    /**
     * handle route 'login_sso' or url '/auth/login-sso'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function sso(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (auth()->hasRole(['supervisor', 'viewer', 'admin'])) {
                $is_internal = auth()->getIdentity()->getData()['is_internal'] ?? false;
                if (!$is_internal) {
                    session()->unset('oauth2state');
                    $provider = $this->getSSOProvider();
                    $url_logout = $provider->getLogoutUrl();
                    return redirect_url($url_logout);
                } else {
                    return redirect_to('admin_index');
                }
            } else {
                return redirect_to('index');
            }
        }

        $query = $request->getQueryParams();
        $provider = $this->getSSOProvider();
        if (!isset($query['code'])) {
            // Untuk mendapatkan authorization code
            $authUrl = $provider->getAuthorizationUrl();
            session()->set('oauth2state', $provider->getState());
            return redirect_url($authUrl);
            // Mengecek state yang disimpan saat ini untuk memitigasi serangan CSRF
        } elseif (empty($query['state']) || ($query['state'] !== session()->get('oauth2state'))) {
            session()->unset('oauth2state');
            return redirect_to('login');
        } else {

            try {
                $token = $provider->getAccessToken('authorization_code', [
                    'code' => $query['code']
                ]);
            } catch (Exception $e) {
                throw new Exception('Gagal mendapatkan akses token : ' . $e->getMessage());
            }

            try {
                $user = $provider->getResourceOwner($token);
                if ($user) {
                    if ($user->getKodeProvinsi() === '14' && $user->getKodeKabupaten() === '00') {
                        $row = UserModel::row('*', ['email=' => $user->getEmail()]);
                        if (!$row) {
                            try {
                                UserModel::create(
                                    [
                                        'email' => $user->getEmail(),
                                        'nama' => $user->getName(),
                                        'nip' => $user->getNipBaru(),
                                        'jabatan' => $user->getJabatan(),
                                        'instansi' => 'BPS Provinsi Riau',
                                        'tingkat' => 'Provinsi',
                                        'nomor_wa' => '12345678910',
                                        'role' => 'user,viewer',
                                        'is_active' => 1,
                                        'create_at' => time()
                                    ]
                                );
                            } catch (Exception $e) {
                                session()->addFlashError('Gagal menambahkan akun internal secara otomatis. Error:' . $e->getMessage());
                            }
                        } else {
                            $row = UserModel::row('*', ['email=' => $user->getEmail()]);
                        }
                        if($row['is_active'] == 0){
                            session()->addFlashWarning('Status pengguna tidak aktif. Silahkan menghubungi admin untuk aktivasi.');
                            return redirect_url(auth()->getProvider()->getLoginUri());
                        }
                        session()->setUserId(strval($row['id']));
                        session()->setUserHash(sha1($row['email'] . $request->getServerParams()['HTTP_USER_AGENT']));
                        session()->addFlashSuccess("Selamat datang '" . ucfirst($row['nama'] . "'"));

                        return redirect_to('admin_index');
                    } else {
                        session()->unset('oauth2state');
                        $provider = $this->getSSOProvider();
                        $url_logout = $provider->getLogoutUrl();

                        return redirect_url($url_logout);
                    }
                }
                // echo "Nama : ".$user->getName();
                // echo "E-Mail : ". $user->getEmail();
                // echo "Username : ". $user->getUsername();
                // echo "NIP : ". $user->getNip();
                // echo "NIP Baru : ". $user->getNipBaru();
                // echo "Kode Organisasi : ". $user->getKodeOrganisasi();
                // echo "Kode Provinsi : ". $user->getKodeProvinsi();
                // echo "Kode Kabupaten : ". $user->getKodeKabupaten();
                // echo "Alamat Kantor : ". $user->getAlamatKantor();
                // echo "Provinsi : ". $user->getProvinsi();
                // echo "Kabupaten : ". $user->getKabupaten();
                // echo "Golongan : ". $user->getGolongan();
                // echo "Jabatan : ". $user->getJabatan();
                // echo "Foto : ". $user->getUrlFoto();
                // echo "Eselon : ". $user->getEselon();
                // Gunakan token ini untuk berinteraksi dengan API di sisi pengguna
                //echo $token->getToken();        
            } catch (Exception $e) {
                throw new Exception('Gagal Mendapatkan Data Pengguna: ' . $e->getMessage());
            }
            return redirect_url(auth()->getProvider()->getLoginUri());
        }
    }
    /**
     * getSSOProvider
     *
     * @return Keycloak
     */
    private function getSSOProvider(): Keycloak
    {
        return new Keycloak([
            'authServerUrl'         => 'https://sso.bps.go.id',
            'realm'                 => 'pegawai-bps',
            'clientId'              => '11400-spektral-p0s',
            'clientSecret'          => 'f03f924e-9f3e-4ab8-b3a3-f8ac906f2e80',
            'redirectUri'           => base_url(route('login_sso'))
        ]);
    }
    /**
     * handle route 'activation' or url '/auth/activation/{$token}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function activation(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $token = $request->getAttribute('token');
        $row = UserModel::row('*', ['token=' => $token]);
        if ($row) {
            try {
                UserModel::update(['is_active' => 1, 'token' => NULL, 'update_at' => time()], ['token=' => $token]);
                session()->addFlashSuccess('Activasi akun berhasil.');
            } catch (Exception $e) {
                session()->addFlashError('Activasi akun gagal. Error:' . $e->getMessage());
            }
        } else {
            session()->addFlashError('Activasi akun gagal.');
        }

        return redirect_url(auth()->getProvider()->getLoginUri());
    }
    /**
     * Handle route 'user_info' or path '/auth/info'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function info(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!auth()->getIdentity()->isAuthenticated()) {
            return redirect_to('index');
        }

        $params = ['title' => 'INFORMASI PENGGUNA | SPEKTRAL'];
        $params['breadcrumbs'] = [];
        $params['page'] = 'INFORMASI PENGGUNA';
        $params['row'] = UserModel::row('*', ['id=' => auth()->getIdentity()->getId()]);

        return view('auth_user_info', $params, $response, 'frontend');
    }
    /**
     * Handle route 'user_update' or path '/auth/update'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (!auth()->getIdentity()->isAuthenticated()) {
            return redirect_to('index');
        }

        $params = ['title' => 'UBAH DATA PENGGUNA | SPEKTRAL BACKEND'];
        $params['breadcrumbs'] = [];
        $params['page'] = 'UBAH DATA PENGGUNA';
        $row = UserModel::row('*', ['id=' => auth()->getIdentity()->getId()]);
        unset($row['password']);
        $model = new UserForm(true);
        $model->fill($row);
        $params['row'] = $row;
        $params['model'] = $model;
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                $data = [
                    'nama' => $model->nama,
                    'nip' => $model->nip,
                    'nomor_wa' => $model->nomor_wa,
                    'instansi' => $model->instansi,
                    'tingkat' => $model->tingkat,
                    'jabatan' => $model->jabatan,
                    'update_at' => time()
                ];
                if($model->password){
                    $data['password'] = password_hash($model->password, PASSWORD_BCRYPT);
                }
                try {
                    UserModel::update($data, ['id=' => auth()->getIdentity()->getId()]);
                    session()->addFlashSuccess('Ubah data berhasil disimpan.');
                } catch (Exception $e) {
                    session()->addFlashError('Ubah data gagal. Error:' . $e->getMessage());
                }

                return redirect_to('user_info');
            }
        }

        return view('auth_user_update', $params, $response, 'frontend');
    }
}
