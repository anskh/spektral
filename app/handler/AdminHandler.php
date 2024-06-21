<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Db\DokumentasiPembinaanModel;
use App\Model\Db\DokumentasiPembinaanViewModel;
use App\Model\Db\ModulCategoryModel;
use App\Model\Db\ModulModel;
use App\Model\Db\PembinaanMessageModel;
use App\Model\Db\PembinaanMessageViewModel;
use App\Model\Db\PembinaanModel;
use App\Model\Db\PembinaanViewModel;
use App\Model\Db\StatusPermintaanModel;
use App\Model\Db\TestimoniModel;
use App\Model\Db\TestimoniViewModel;
use App\Model\Db\UserModel;
use App\Model\Forms\DokumentasiForm;
use App\Model\Forms\EditTestimoniForm;
use App\Model\Forms\EditUserForm;
use App\Model\Forms\ModulForm;
use App\Model\Forms\EmailForm;
use App\Model\Forms\PembinaanMessageForm;
use App\Helper\Service;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use PHPMailer\PHPMailer\PHPMailer;

class AdminHandler extends ActionHandler
{
    /**
     * Handle route 'admin_index' or path '/internal'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }
        $params = ['title' => 'Beranda | SPEKTRAL BACKEND'];

        return view('admin_index', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_user' or path '/internal/user'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function user(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('admin')) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'USER | SPEKTRAL BACKEND'];
        $params['page'] = 'DAFTAR PENGGUNA';
        $params['breadcrumbs'] = [];
        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "(`nama` LIKE '%{$q}%' OR `email` LIKE '%{$q}%')";
        } else {
            $q = null;
            $where = null;
        }
        $params['q'] = $q;
        $params['data'] = UserModel::paginate($where, '*');

        return view('admin_user', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_user_delete' or path '/internal/user/delete/{param}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('admin')) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        try {
            $id = $request->getAttribute('id');
            ModulModel::update(['create_by' => null],['create_by=' => $id]);
            ModulModel::update(['update_by' => null],['update_by=' => $id]);
            TestimoniModel::delete(['userid=' => $id]);
            PembinaanModel::update(['create_by' => null],['create_by=' => $id]);
            PembinaanModel::update(['update_by' => null],['update_by=' => $id]);
            DokumentasiPembinaanModel::update(['create_by' => null],['create_by=' => $id]);
            DokumentasiPembinaanModel::update(['update_by' => null],['update_by=' => $id]);
            UserModel::delete(['id=' => $id]);
            session()->addFlashSuccess('Hapus data pengguna berhasil.');
        } catch (Exception $e) {
            session()->addFlashError('Gagal hapus data pengguna.Error:' . $e->getMessage());
        }

        return redirect_to('admin_user');
    }
    /**
     * Handle route 'admin_user_view' or path '/internal/user/view/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function viewUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('admin')) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'USER | SPEKTRAL BACKEND'];
        $params['breadcrumbs'] = [
            'DAFTAR PENGGUNA' => route('admin_user')
        ];
        $params['page'] = 'INFORMASI PENGGUNA';
        $id = $request->getAttribute('id');
        $params['row'] = UserModel::row('*', ['id=' => $id]);
        return view('admin_user_view', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_user_edit' or path '/internal/user/edit/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function editUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('admin')) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'Pengguna | SPEKTRAL BACKEND'];
        $params['page'] = 'UBAH DATA PENGGUNA';
        $params['breadcrumbs'] = [
            'DAFTAR PENGGUNA' => route('admin_user')
        ];
        $id = $request->getAttribute('id');
        $row = UserModel::row('*', ['id=' => $id]);
        if (!$row) {
            session()->addFlashWarning('Data pengguna tidak ditemukan');
            return redirect_to('admin_user');
        }
        $model = new EditUserForm();
        $model->fill($row);
        if ($request->getMethod() == 'POST') {
            $post = Service::sanitize($request);
            $post['is_active'] = isset($post['is_active']) ? 1 : 0;
            $post['role'] = is_array($post['roles'] ?? '') ? implode(',', $post['roles']) : '';

            if ($model->fillAndValidate($post)) {
                try {
                    UserModel::update([
                        'is_active' => $model->is_active,
                        'role' => $model->role,
                        'update_at' => time()
                    ], ['id=' => $id]);
                    session()->addFlashSuccess('Data berhasil disimpan');
                } catch (Exception $e) {
                    session()->addFlashError('Data gagal disimpan. Error:' . $e->getMessage());
                }
                return redirect_to('admin_user');
            }
        }
        $params['row'] = $row;
        $params['model'] = $model;

        return view('admin_user_edit', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_user_info' or path '/internal/account/info'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function infoUser(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'USER | SPEKTRAL BACKEND'];
        $params['breadcrumbs'] = [];
        $params['page'] = 'INFORMASI PENGGUNA';
        $params['row'] = UserModel::row('*', ['id=' => auth()->getIdentity()->getId()]);

        return view('admin_user_info', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_modul' or path '/internal/modul[/{cat:\d+}]'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function modul(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'MODUL PEMBINAAN | SPEKTRAL BACKEND'];
        $params['page'] = 'DAFTAR MODUL PEMBINAAN';
        $params['breadcrumbs'] = [];
        $k = $request->getAttribute('cat') ?? 1;
        if (!ModulCategoryModel::exists(['id=' => $k])) {
            return redirect_to('admin_modul');
        }
        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "(`nama` LIKE '%{$q}%' OR `deskripsi` LIKE '%{$q}%') and `kategori`='{$k}'";
        } else {
            $q = null;
            $where = ['kategori=' => $k];
        }
        $params['kategori'] = $k;
        $params['q'] = $q;
        $params['data'] = ModulModel::paginate($where, '*');
        $params['categories'] = ModulCategoryModel::all();

        return view('admin_modul', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_modul_entri' or path '/internal/modul/entri'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function entriModul(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'TAMBAH MODUL BARU | SPEKTRAL BACKEND'];
        $params['page'] = 'TAMBAH MODUL BARU';
        $params['breadcrumbs'] = [
            'DAFTAR MODUL' => route('admin_modul')
        ];
        $k = $request->getAttribute('cat') ?? 1;
        if (!ModulCategoryModel::exists(['id=' => $k])) {
            return redirect_to('admin_modul_entri');
        }

        $model = new ModulForm();
        $model->kategori = $k;
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                foreach ($request->getUploadedFiles() as $file) {
                    if ($file instanceof UploadedFileInterface) {
                        if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                            $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                            $allowd_file_ext = 'pdf';
                            if ($file->getSize() > 8000000) { // 8 MB
                                $model->addError("Ukuran file lebih dari 8MB.", 'link');
                            } elseif ($fileExt !== $allowd_file_ext) {
                                $model->addError("Tipe file harus pdf.", 'link');
                            } else {
                                try {
                                    $model->link = sprintf('%d.pdf', time());
                                    $path = ROOT . '/uploads/modul/';
                                    $file->moveTo($path . $model->link);
                                } catch (Exception $e) {
                                    $model->addError('Upload file modul gagal. Error:' . $e->getMessage(),  'link');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError() && $model->link) {
                    try {
                        ModulModel::create(
                            [
                                'nama' => $model->nama,
                                'deskripsi' => $model->deskripsi,
                                'kategori' => $model->kategori,
                                'link' => $model->link,
                                'create_by' => auth()->getIdentity()->getId(),
                                'create_at' => time()
                            ]
                        );
                        session()->addFlashSuccess('Simpan modul berhasil');
                    } catch (Exception $e) {
                        session()->addFlashError('Simpan modul gagal. Error:' . $e->getMessage());
                    }
                    return redirect_to('admin_modul', $model->kategori ? "/{$model->kategori}" : "/{$k}");
                }
            }
        }
        $params['kategori'] = $k;
        $params['model'] = $model;
        $values = [];
        $labels = [];
        foreach (ModulCategoryModel::all('id,nama', 0, -1, 'id ASC') as $cat) {
            array_push($values, $cat['id']);
            array_push($labels, $cat['nama']);
        }
        $params['values'] = $values;
        $params['labels'] = $labels;

        return view('admin_modul_form', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_modul_edit' or path '/internal/modul/edit/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function editModul(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'UBAH DATA MODUL | SPEKTRAL BACKEND'];
        $params['page'] = 'UBAH DATA MODUL';
        $params['breadcrumbs'] = [
            'DAFTAR MODUL' => route('admin_modul')
        ];
        $id = $request->getAttribute('id');
        $row = ModulModel::row('*', ['id=' => $id]);
        if (!$row) {
            session()->addFlashWarning('Data modul tidak ditemukan');
            return redirect_to('admin_modul');
        }
        $model = new ModulForm(true);
        $model->fill($row);
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                foreach ($request->getUploadedFiles() as $file) {
                    if ($file instanceof UploadedFileInterface) {
                        if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                            $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                            $allowd_file_ext = 'pdf';
                            if ($file->getSize() > 8000000) { // 8 MB
                                $model->addError("Ukuran file lebih dari 8MB.");
                            } elseif ($fileExt !== $allowd_file_ext) {
                                $model->addError("Tipe file harus pdf.");
                            } else {
                                try {
                                    $path = ROOT . '/uploads/modul/';
                                    if ($row['link'] && is_file($path . $row['link'])) {
                                        unlink($path . $row['link']);
                                    }
                                    $filename = sprintf('%d.pdf', time());
                                    $file->moveTo($path . $filename);
                                    $model->link = $filename;
                                } catch (Exception $e) {
                                    $model->addError('Upload file modul gagal. Error:' . $e->getMessage(), 'link');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    try {
                        ModulModel::update(
                            [
                                'nama' => $model->nama,
                                'deskripsi' => $model->deskripsi,
                                'kategori' => $model->kategori,
                                'link' => $model->link,
                                'update_by' => auth()->getIdentity()->getId(),
                                'update_at' => time()
                            ],
                            ['id=' => $id]
                        );
                        session()->addFlashSuccess('Simpan modul berhasil');
                    } catch (Exception $e) {
                        session()->addFlashError('Simpan modul gagal. Error:' . $e->getMessage());
                    }
                    return redirect_to('admin_modul', $model->kategori ? "/{$model->kategori}" : "/{$row['kategori']}");
                }
            }
        }
        $params['row'] = $row;
        $params['model'] = $model;
        $values = [];
        $labels = [];
        foreach (ModulCategoryModel::all('id,nama', 0, -1, 'id ASC') as $cat) {
            array_push($values, $cat['id']);
            array_push($labels, $cat['nama']);
        }
        $params['values'] = $values;
        $params['labels'] = $labels;

        return view('admin_modul_form', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_modul_delete' or path '/internal/modul/delete/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteModul(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $data = ModulModel::row('*', ['id=' => $id]);
        if ($data) {
            try {
                $path = ROOT . '/uploads/modul/';
                $filename = $data['link'] ?? null;
                if ($filename && is_file($path . $filename)) {
                    unlink($path . $filename);
                }
                ModulModel::delete(['id=' => $id]);
                session()->addFlashSuccess('Hapus modul berhasil.');
            } catch (Exception $e) {
                session()->addFlashError('Hapus modul gagal. Error:' . $e->getMessage());
            }
        } else {
            session()->addFlashWarning('Data modul tidak ditemukan');
        }

        return redirect_to('admin_modul', empty($data) ? '' : "/{$data['kategori']}");
    }
    /**
     * Handle route 'admin_pembinaan' or path '/internal/pembinaan'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function pembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'DAFTAR PERMINTAAN PEMBINAAN | SPEKTRAL BACKEND'];
        $params['page'] = 'DAFTAR PERMINTAAN PEMBINAAN';
        $params['breadcrumbs'] = [];
        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "`deskripsi` LIKE '%{$q}%'";
        } else {
            $q = null;
            $where = null;
        }
        $params['q'] = $q;
        $params['data'] = PembinaanViewModel::paginate($where, '*', null, 'create_at DESC');

        return view('admin_pembinaan', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_pembinaan_view' or path '/internal/pembinaan/view/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function viewPembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = PembinaanViewModel::row('*', ['a.id=' => $id]);
        if (!$row) {
            session()->addFlashWarning('Data tidak ditemukan.');
            return redirect_to('pembinaan');
        }

        $params = ['title' => 'DETAIL PERMINTAAN PEMBINAAN | SPEKTRAL BACKEND'];
        $params['page'] = 'DETAIL PERMINTAAN PEMBINAAN';
        $params['breadcrumbs'] = [
            'PERMINTAAN PEMBINAAN STATISTIK' => route('admin_pembinaan')
        ];
        $model = new PembinaanMessageForm();
        if ($request->getMethod() === 'POST') {
            $post = Service::sanitize($request);
            if (isset($post['simpan'])) {
                try {
                    if (StatusPermintaanModel::exists(['id=' => $post['status']])) {
                    }
                    PembinaanModel::update(
                        ['status' => $post['status']],
                        ['id=' => $id]
                    );
                    session()->addFlashSuccess('Ubah status permintaan berhasil');
                } catch (Exception $e) {
                    session()->addFlashError('Ubah status permintaan gagal. Error:' . $e->getMessage());
                }
                return redirect_to('admin_pembinaan_view', strval($id));
            } elseif (isset($post['kirim'])) {
                if ($model->fillAndValidate($post)) {
                    try {
                        PembinaanMessageModel::create(
                            [
                                'pembinaan_id' => $id,
                                'message_date' => time(),
                                'user_id' => auth()->getIdentity()->getId(),
                                'message' => $model->message
                            ]
                        );
                        session()->addFlashSuccess('Kirim pesan berhasil');
                    } catch (Exception $e) {
                        session()->addFlashError('Kirim pesan gagal. Error:' . $e->getMessage());
                    }
                    return redirect_to('admin_pembinaan_view', strval($id));
                }
            }
        }
        $params['id'] = $id;
        $params['row'] = $row;
        $params['model'] = $model;
        $params['messages'] = PembinaanMessageViewModel::find(['pembinaan_id=' => $id]);
        $params['listStatus'] = StatusPermintaanModel::all();
        $params['dokumentasi'] = DokumentasiPembinaanModel::row('*', ['pembinaan_id=' => $id]);

        return view('admin_pembinaan_view', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_pembinaan_delete' or path '/internal/pembinaan/delete/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deletePembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = PembinaanModel::row('*', ['id=' => $id]);
        if ($row) {
            try {
                $filename = $row['surat'] ?? null;
                $path = ROOT . '/uploads/pembinaan/';
                if ($filename && is_file($path . $filename)) {
                    unlink($path . $filename);
                }
                PembinaanMessageModel::delete(['pembinaan_id=' => $id]);
                DokumentasiPembinaanModel::update(['pembinaan_id' => NULL], ['pembinaan_id=' => $id]);
                PembinaanModel::delete(['id=' => $id]);
                session()->addFlashSuccess('Hapus permintaan pembinaan berhasil.');
            } catch (Exception $e) {
                session()->addFlashError('Hapus permintaan pembinaan gagal. Error:' . $e->getMessage());
            }
        } else {
            session()->addFlashWarning('Data permintaan pembinaan tidak ditemukan');
        }

        return redirect_to('admin_pembinaan');
    }
    /**
     * Handle route 'admin_dokumentasi' or path '/internal/dokumentasi'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function dokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'DAFTAR DOKUMENTASI PEMBINAAN | SPEKTRAL BACKEND'];
        $params['page'] = 'DAFTAR DOKUMENTASI PEMBINAAN';
        $params['breadcrumbs'] = [];
        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "`judul` LIKE '%{$q}%' or `berita` LIKE '%{$q}%'";
        } else {
            $q = null;
            $where = null;
        }
        $params['q'] = $q;
        $params['data'] = DokumentasiPembinaanModel::paginate($where, '*', 9, 'tanggal DESC');

        return view('admin_dokumentasi', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_dokumentasi_view' or path '/internal/dokumentasi/view/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function viewDokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'DETAIL DOKUMENTASI PEMBINAAN | SPEKTRAL BACKEND'];
        $params['page'] = 'DETAIL DOKUMENTASI PEMBINAAN';
        $params['breadcrumbs'] = [
            'DAFTAR DOKUMENTASI PEMBINAAN' => route('admin_dokumentasi')
        ];
        $id = $request->getAttribute('id');
        $params['id'] = $id;
        $params['row'] = DokumentasiPembinaanViewModel::row('*', ['a.id=' => $id]);

        return view('admin_dokumentasi_view', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_dokumentasi_entri' or path '/internal/dokumentasi/entri[/{id:\d+}]'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function entriDokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'TAMBAH DOKUMENTASI PEMBINAAN BARU | SPEKTRAL BACKEND'];
        $params['page'] = 'TAMBAH DOKUMENTASI PEMBINAAN BARU';
        $params['breadcrumbs'] = [
            'DAFTAR DOKUMENTASI PEMBINAAN' => route('admin_dokumentasi')
        ];

        $model = new DokumentasiForm();
        $pembinaan_id = $request->getAttribute('id');
        if ($pembinaan_id) {
            $approved = StatusPermintaanModel::STATUS_APPROVED;
            $closed = StatusPermintaanModel::STATUS_CLOSED;
            $row = PembinaanModel::row('*', "id=$pembinaan_id AND status IN ($approved,$closed)");
            if (!$row) {
                session()->addFlashWarning('Data permintaan pembinaan tidak ditemukan');
                return redirect_to('admin_pembinaan');
            }
            $model->pembinaan_id = $pembinaan_id;
            $model->tanggal = $row['tanggal'];
        }

        if ($request->getMethod() === 'POST') {
            $post = Service::sanitize($request, 'berita');
            if ($model->fillAndValidate($post)) {
                foreach ($request->getUploadedFiles() as $file) {
                    if ($file instanceof UploadedFileInterface) {
                        if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                            $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                            $allowd_file_ext = ['png', 'jpg', 'jpeg', 'gif'];
                            if ($file->getSize() > 1000000) { // 1 MB
                                $model->addError("Ukuran file lebih dari 1MB.", 'link');
                            } elseif (!in_array($fileExt, $allowd_file_ext)) {
                                $model->addError("Tipe file harus png,jpg, atau gif.", 'gambar');
                            } else {
                                try {
                                    $model->gambar = sprintf("%d.{$fileExt}", time());
                                    $path = ROOT . '/uploads/dokumentasi/img/';
                                    $file->moveTo($path . $model->gambar);
                                } catch (Exception $e) {
                                    $model->addError('Upload file gambar gagal. Error:' . $e->getMessage(),  'gambar');
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    try {
                        DokumentasiPembinaanModel::create(
                            [
                                'judul' => $model->judul,
                                'berita' => $model->berita,
                                'is_active' => 1,
                                'pembinaan_id' => $model->pembinaan_id,
                                'gambar' => $model->gambar,
                                'tanggal' => $model->tanggal,
                                'create_by' => auth()->getIdentity()->getId(),
                                'create_at' => time()
                            ]
                        );
                        session()->addFlashSuccess('Simpan dokumentasi berhasil');
                    } catch (Exception $e) {
                        session()->addFlashError('Simpan dokumentasi gagal. Error:' . $e->getMessage());
                    }
                    return redirect_to('admin_dokumentasi');
                }
            }
        }
        $params['model'] = $model;

        return view('admin_dokumentasi_form', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_dokumentasi_edit' or path '/internal/dokumentasi/edit/{id:\id+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function editDokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'UBAH DOKUMENTASI PEMBINAAN BARU | SPEKTRAL BACKEND'];
        $params['page'] = 'UBAH DOKUMENTASI PEMBINAAN BARU';
        $params['breadcrumbs'] = [
            'DAFTAR DOKUMENTASI PEMBINAAN' => route('admin_dokumentasi')
        ];

        $id = $request->getAttribute('id');
        $row = DokumentasiPembinaanModel::row('*', ['id=' => $id]);
        $model = new DokumentasiForm(true);
        if ($row) {
            $model->fill($row);
            if ($request->getMethod() === 'POST') {
                $post = Service::sanitize($request, 'berita');
                $post['is_active'] = isset($post['is_active']) ? 1 : 0;
                if ($model->fillAndValidate($post)) {
                    foreach ($request->getUploadedFiles() as $file) {
                        if ($file instanceof UploadedFileInterface) {
                            if ($file->getError() === UPLOAD_ERR_OK && $file->getSize() > 0) {
                                $fileExt = strtolower(pathinfo($file->getClientFileName(), PATHINFO_EXTENSION));
                                $allowd_file_ext = ['png', 'jpg', 'jpeg', 'gif'];
                                if ($file->getSize() > 1000000) { // 1 MB
                                    $model->addError("Ukuran file lebih dari 1MB.", 'link');
                                } elseif (!in_array($fileExt, $allowd_file_ext)) {
                                    $model->addError("Tipe file harus png,jpg, atau gif.", 'gambar');
                                } else {
                                    try {
                                        $path = ROOT . '/uploads/dokumentasi/img/';
                                        if ($model->gambar && is_file($path . $model->gambar)) {
                                            unlink($path . $model->gambar);
                                        }
                                        $model->gambar = sprintf("%d.{$fileExt}", time());
                                        $file->moveTo($path . $model->gambar);
                                    } catch (Exception $e) {
                                        $model->addError('Upload file gambar gagal. Error:' . $e->getMessage(),  'gambar');
                                    }
                                }
                            }
                        }
                    }
                    if (!$model->hasError()) {
                        try {
                            DokumentasiPembinaanModel::update(
                                [
                                    'judul' => $model->judul,
                                    'berita' => $model->berita,
                                    'is_active' => $model->is_active,
                                    'gambar' => $model->gambar,
                                    'tanggal' => $model->tanggal,
                                    'update_by' => auth()->getIdentity()->getId(),
                                    'update_at' => time()
                                ],
                                ['id=' => $id]
                            );
                            session()->addFlashSuccess('Simpan dokumentasi berhasil');
                        } catch (Exception $e) {
                            session()->addFlashError('Simpan dokumentasi gagal. Error:' . $e->getMessage());
                        }
                        return redirect_to('admin_dokumentasi');
                    }
                }
            }
        } else {
            session()->addFlashWarning('Data dokumentasi tidak ditemukan');
            return redirect_to('admin_dokumentasi');
        }
        $params['id'] = $id;
        $params['model'] = $model;

        return view('admin_dokumentasi_form', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_dokumentasi_delete' or path '/internal/dokumentasi/delete/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteDokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = DokumentasiPembinaanModel::row('*', ['id=' => $id]);
        if ($row) {
            try {
                $filename = $row['gambar'] ?? null;
                $path = ROOT . '/uploads/dokumentasi/img/';
                if ($filename && is_file($path . $filename)) {
                    unlink($path . $filename);
                }
                DokumentasiPembinaanModel::delete(['id=' => $id]);
                session()->addFlashSuccess('Hapus dokumentasi pembinaan berhasil.');
            } catch (Exception $e) {
                session()->addFlashError('Hapus dokumentasi pembinaan gagal. Error:' . $e->getMessage());
            }
        } else {
            session()->addFlashWarning('Data dokumentasi tidak ditemukan');
        }

        return redirect_to('admin_dokumentasi');
    }
    /**
     * Handle route 'admin_testimoni' or path '/internal/testimoni'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function testimoni(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'DAFTAR TESTIMONI PENGGUNA | SPEKTRAL BACKEND'];
        $params['page'] = 'DAFTAR TESTIMONI PENGGUNA';
        $params['breadcrumbs'] = [];
        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "`nama` LIKE '%{$q}%' or `pesan` LIKE '%{$q}%'";
        } else {
            $q = null;
            $where = null;
        }
        $params['q'] = $q;
        $params['data'] = TestimoniViewModel::paginate($where, '*', null, 'create_at DESC');

        return view('admin_testimoni', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_testimoni_edit' or path '/internal/testimoni/edit/{id:\id+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function editTestimoni(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'UBAH TESTIMONI PENGGUNA | SPEKTRAL BACKEND'];
        $params['page'] = 'UBAH TESTIMONI PENGGUNA';
        $params['breadcrumbs'] = [
            'DAFTAR TESTIMONI PENGGUNA' => route('admin_testimoni')
        ];
        $id = $request->getAttribute('id');
        $row = TestimoniViewModel::row('*', ['a.id=' => $id]);
        $model = new EditTestimoniForm(true);
        if (!$row) {
            session()->addFlashWarning('Data testimoni tidak ditemukan');
            return redirect_to('admin_testimoni');
        }
        $model->is_active = $row['is_active'];
        if ($request->getMethod() === 'POST') {
            $post = Service::sanitize($request);
            $post['is_active'] = isset($post['is_active']) ? 1 : 0;
            if ($model->fillAndValidate($post)) {
                try {
                    TestimoniModel::update(
                        [
                            'is_active' => $model->is_active,
                            'update_at' => time()
                        ],
                        ['id=' => $id]
                    );
                    session()->addFlashSuccess('Simpan testimoni berhasil');
                } catch (Exception $e) {
                    session()->addFlashError('Simpan testimoni gagal. Error:' . $e->getMessage());
                }
                return redirect_to('admin_testimoni');
            }
        }

        $params['id'] = $id;
        $params['model'] = $model;
        $params['row'] = $row;

        return view('admin_testimoni_form', $params, $response, 'backend');
    }
    /**
     * Handle route 'admin_testimoni_delete' or path '/internal/testimoni/delete/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deleteTestimoni(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['viewer', 'supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = TestimoniModel::row('*', ['id=' => $id]);
        if ($row) {
            try {
                TestimoniModel::delete(['id=' => $id]);
                session()->addFlashSuccess('Hapus testimoni berhasil.');
            } catch (Exception $e) {
                session()->addFlashError('Hapus testimoni gagal. Error:' . $e->getMessage());
            }
        }

        return redirect_to('admin_testimoni');
    }
    /**
     * Handle route 'admin_email' or path '/internal/email
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function email(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole(['supervisor', 'admin'])) {
                return redirect_to('index');
            }
        } else {
            return redirect_to('login');
        }

        $params = ['title' => 'KIRIM EMAIL | SPEKTRAL BACKEND'];
        $params['page'] = 'KIRIM EMAIL';
        $params['breadcrumbs'] = [];
        $model = new EmailForm();
        $model->server = config('smtp.host');
        $model->user = config('smtp.user');
        $model->password = config('smtp.pass');
        $model->port = config('smtp.port');
        
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                //Instantiation and passing `true` enables exceptions
                $mail = Service::mailer(true);
                try{
                    $mail->setFrom('ipds1400@bps.go.id', 'Noreply SPEKTRAL BPS Provinsi Riau');
                    $mail->addAddress($model->email);
                    $mail->addReplyTo('bps1400@bps.go.id', 'Noreply SPEKTRAL BPS Provinsi Riau');

                    //Set email format to HTML
                    $mail->isHTML(true);
                    $mail->Subject = 'SPEKTRAL BPS';
                    $mail->Body    = '<p>Pesannya adalah: <b style="font-size: 30px;">' . $model->pesan . '</b></p>';
         
                    $mail->send();
                    session()->addFlashSuccess('Kirim email sukses.');
                }catch(Exception $e)
                {
                    session()->addFlashError("Kirim email gagal. Error: {$mail->ErrorInfo}");
                }
                
                return redirect_to('admin_email');
            }
        }
        $params['model'] = $model;

        return view('admin_email', $params, $response, 'backend');
    }
}