<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Db\DokumentasiPembinaanModel;
use App\Model\Db\DokumentasiPembinaanViewModel;
use App\Model\Db\ModulCategoryModel;
use App\Model\Db\ModulModel;
use App\Model\Db\PembinaanCategoryModel;
use App\Model\Db\PembinaanMessageModel;
use App\Model\Db\PembinaanMessageViewModel;
use App\Model\Db\PembinaanModel;
use App\Model\Db\PembinaanViewModel;
use App\Model\Db\StatusPermintaanModel;
use App\Model\Db\TestimoniModel;
use App\Model\Db\TestimoniViewModel;
use App\Model\Db\UserModel;
use App\Model\Forms\PembinaanForm;
use App\Model\Forms\PembinaanMessageForm;
use App\Model\Forms\TestimoniForm;
use App\Helper\Service;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

class SiteHandler extends ActionHandler
{
    /**
     * Handle route 'index' or path '/'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $params = ['title' => 'Beranda | SPEKTRAL'];
        $params['data'] = ModulCategoryModel::all();

        return view('site_index', $params, $response, 'frontend');
    }
    /**
     * Handle route 'modul_pembinaan' or path '/modul[/{cat}]'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function modul(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'MODUL PEMBINAAN | SPEKTRAL'];
        $params['page'] = 'MODUL PEMBINAAN';

        $k = $request->getAttribute('cat') ?? 1;
        if (!ModulCategoryModel::exists(['id=' => $k])) {
            return redirect_to('modul_pembinaan');
        }
        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "(`nama` LIKE '%{$q}%' OR `deskripsi` LIKE '%{$q}%') AND `kategori`={$k}";
        } else {
            $q = '';
            $where = ['kategori=' => $k];
        }

        $params['kategori'] = $k;
        $params['q'] = $q;
        $params['breadcrumbs'] = [];
        $params['data'] = ModulModel::paginate($where, '*', 9);
        $params['categories'] = ModulCategoryModel::all();

        return view('site_modul_pembinaan', $params, $response, 'frontend');
    }
    /**
     * Handle route 'probis' or path '/probis[/{step}]'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function probis(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'PROSES BISNIS STATISTIK | SPEKTRAL'];
        $params['page'] = 'PROSES BISNIS STATISTIK';

        $step = $request->getAttribute('step') ?? 0;
        if ($step < 0 || $step > 8) {
            return redirect_to('probis');
        }

        $params['breadcrumbs'] = [];
        $params['step'] = $step;

        return view('site_probis', $params, $response, 'frontend');
    }
    /**
     * Handle route 'metadata' or path '/metadata'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function metadata(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'PELAPORAN METADATA STATISTIK | SPEKTRAL'];
        $params['page'] = 'PELAPORAN METADATA STATISTIK';
        $params['breadcrumbs'] = [];

        return view('site_metadata', $params, $response, 'frontend');
    }
    /**
     * Handle route 'romantik' or path '/romantik'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function romantik(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'PENGAJUAN REKOMENDASI STATISTIK | SPEKTRAL'];
        $params['page'] = 'PENGAJUAN REKOMENDASI STATISTIK';
        $params['breadcrumbs'] = [];

        return view('site_romantik', $params, $response, 'frontend');
    }
    /**
     * Handle route 'pembinaan' or path '/pembinaan'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function pembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('user')) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses halaman tersebut.');
                return redirect_to('index');
            }
        } else {
            session()->addFlashWarning('Silahkan login terlebih dahulu untuk mengakses permintaan pembinaan.');
            return redirect_to('login');
        }

        $params = ['title' => 'PERMINTAAN PEMBINAAN STATISTIK | SPEKTRAL'];
        $params['page'] = 'PERMINTAAN PEMBINAAN STATISTIK';
        $params['breadcrumbs'] = [];
        $query = $request->getQueryParams();
        $id = auth()->getIdentity()->getId();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "`deskripsi` LIKE '%{$q}%' and `create_by`='{$id}'";
        } else {
            $q = null;
            $where = ['create_by=' => "$id"];
        }
        $params['q'] = $q;
        $params['data'] = PembinaanViewModel::paginate($where, '*');

        return view('site_pembinaan', $params, $response, 'frontend');
    }
    /**
     * Handle route 'pembinaan_entri' or path '/pembinaan/entri'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function entriPembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('user')) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses halaman tersebut.');
                return redirect_to('index');
            }
        } else {
            session()->addFlashWarning('Silahkan login terlebih dahulu untuk mengakses permintaan pembinaan.');
            return redirect_to('login');
        }

        $params = ['title' => 'PERMINTAAN BARU | SPEKTRAL'];
        $params['page'] = 'PERMINTAAN BARU';
        $params['breadcrumbs'] = [
            'PERMINTAAN PEMBINAAN STATISTIK' => route('pembinaan')
        ];
        $model = new PembinaanForm();
        $model->produsen_data = 1; // set default as instansi produsen data
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                if($model->tanggal <= date("Y-m-d")){
                    $model->addError("Tanggal harus lebih dari sekarang.", 'tanggal');
                }else{
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
                                        $model->surat = sprintf('%d.pdf', time());
                                        $path = ROOT . '/uploads/pembinaan/';
                                        $file->moveTo($path . $model->surat);
                                    } catch (Exception $e) {
                                        $model->addError('Upload file surat pengantar gagal. Error:' . $e->getMessage(),  'link');
                                    }
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError() && $model->surat) {
                    $mail = Service::mailer(true);
                    try {
                        $mail->setFrom('ipds1400@bps.go.id', 'Noreply SPEKTRAL BPS Provinsi Riau');
                        $mail->addAddress(auth()->getIdentity()->getData()['email']);
                        $mail->addReplyTo('bps1400@bps.go.id', 'BPS Provinsi Riau');
                        
                        $mail->isHTML(true);
                        $template = config('template.new_ticket');
                        $mail->Subject = $template['subject'];
                        $message = str_replace('%client_name%', auth()->getIdentity()->getData()['nama'] ?? 'Pengguna', $template['html_message']);
                        $message = str_replace('%client_url%', base_url(route('pembinaan')), $message);
                        $mail->Body    = $message;
     
                        $mail->send();
                        
                        PembinaanModel::create(
                            [
                                'produsen_data' => $model->produsen_data,
                                'deskripsi' => $model->deskripsi,
                                'jenis' => $model->jenis,
                                'tanggal' => $model->tanggal,
                                'waktu' => $model->waktu,
                                'lokasi' => $model->lokasi,
                                'surat' => $model->surat,
                                'nama_pic' => $model->nama_pic,
                                'nomor_hp_pic' => $model->nomor_hp_pic,
                                'email_pic' => $model->email_pic,
                                'status' => StatusPermintaanModel::STATUS_OPEN,
                                'create_by' => auth()->getIdentity()->getId(),
                                'create_at' => time()
                            ]
                        );
                        session()->addFlashSuccess('Simpan permintaan pembinaan berhasil');
                        
                        $mail->clearAddresses();
                        $super = UserModel::whereRole('supervisor');
                        
                        if($super){
                         foreach($super as $address){
                            $mail->addAddress($address);
                         }
                         $template = config('template.new_ticket_notification');
                         $mail->Subject = $template['subject'];
                         $message = str_replace('%client_url%', base_url(route('admin_pembinaan')), $template['html_message']);
                         $mail->Body = $message;
                        
                         $mail->send();
                        }
                    } catch (Exception $e) {
                        if($mail->ErrorInfo){
                            session()->addFlashError("Terdapat kesalahan dalam pengiriman email. Error: {$mail->ErrorInfo}");
                        }
                        session()->addFlashError("Simpan permintaan pembinaan gagal");
                    }
                    return redirect_to('pembinaan');
                }
            }
        }
        $params['model'] = $model;
        $params['listJenis'] = PembinaanCategoryModel::all();

        return view('site_pembinaan_form', $params, $response, 'frontend');
    }
    /**
     * Handle route 'pembinaan_edit' or path '/pembinaan/edit/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function editPembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('user')) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses halaman tersebut.');
                return redirect_to('index');
            }
        } else {
            session()->addFlashWarning('Silahkan login terlebih dahulu untuk mengakses permintaan pembinaan.');
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = PembinaanModel::row('*', ['id=' => $id]);
        if ($row) {
            if ($row['create_by'] != auth()->getIdentity()->getId()) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses data tersebut.');
                return redirect_to('pembinaan');
            }
            if (ticket_readonly($row['status'])) {
                session()->addFlashWarning('Data sudah tidak dapat diubah.');
                return redirect_to('pembinaan');
            }
        } else {
            session()->addFlashWarning('Data tidak ditemukan.');
            return redirect_to('pembinaan');
        }

        $params = ['title' => 'UBAH PERMINTAAN PEMBINAAN | SPEKTRAL'];
        $params['page'] = 'UBAH PERMINTAAN PEMBINAAN';
        $params['breadcrumbs'] = [
            'PERMINTAAN PEMBINAAN STATISTIK' => route('pembinaan')
        ];
        $model = new PembinaanForm(true);
        $model->fill($row);
        if ($request->getMethod() === 'POST') {
            $data = Service::sanitize($request);
            $data['produsen_data'] = isset($data['produsen_data']) ? 1 : 0;
            if ($model->fillAndValidate($data)) {
                if($model->tanggal <= date("Y-m-d")){
                    $model->addError("Tanggal harus lebih dari sekarang.", 'tanggal');
                }else{
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
                                        $path = ROOT . '/uploads/pembinaan/';
                                        if ($model->surat && is_file($path . $model->surat)) {
                                            unlink($path . $model->surat);
                                        }
                                        $model->surat = sprintf('%d.pdf', time());
                                        $file->moveTo($path . $model->surat);
                                    } catch (Exception $e) {
                                        $model->addError('Upload file surat pengantar gagal. Error:' . $e->getMessage(),  'link');
                                    }
                                }
                            }
                        }
                    }
                }
                if (!$model->hasError()) {
                    try {
                        PembinaanModel::update(
                            [
                                'produsen_data' => $model->produsen_data,
                                'deskripsi' => $model->deskripsi,
                                'jenis' => $model->jenis,
                                'tanggal' => $model->tanggal,
                                'waktu' => $model->waktu,
                                'lokasi' => $model->lokasi,
                                'surat' => $model->surat,
                                'nama_pic' => $model->nama_pic,
                                'nomor_hp_pic' => $model->nomor_hp_pic,
                                'email_pic' => $model->email_pic,
                                'update_at' => time()
                            ],
                            [
                                'id=' => $id
                            ]
                        );
                        session()->addFlashSuccess('Simpan permintaan pembinaan berhasil');
                    } catch (Exception $e) {
                        session()->addFlashError('Simpan permintaan pembinaan gagal. Error:' . $e->getMessage());
                    }
                    return redirect_to('pembinaan');
                }
            }
        }
        $params['id'] = $id;
        $params['model'] = $model;
        $params['listJenis'] = PembinaanCategoryModel::all();

        return view('site_pembinaan_form', $params, $response, 'frontend');
    }
    /**
     * Handle route 'pembinaan_view' or path '/pembinaan/view/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function viewPembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('user')) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses halaman tersebut.');
                return redirect_to('index');
            }
        } else {
            session()->addFlashWarning('Silahkan login terlebih dahulu untuk mengakses permintaan pembinaan.');
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = PembinaanViewModel::row('*', ['a.id=' => $id]);
        if ($row) {
            if ($row['create_by'] != auth()->getIdentity()->getId()) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses data tersebut.');
                return redirect_to('pembinaan');
            }
        } else {
            session()->addFlashWarning('Data tidak ditemukan.');
            return redirect_to('pembinaan');
        }

        $params = ['title' => 'DETAIL PERMINTAAN PEMBINAAN | SPEKTRAL'];
        $params['page'] = 'DETAIL PERMINTAAN PEMBINAAN';
        $params['breadcrumbs'] = [
            'PERMINTAAN PEMBINAAN STATISTIK' => route('pembinaan')
        ];
        $model = new PembinaanMessageForm();
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
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
                return redirect_to('pembinaan_view', strval($id));
            }
        }
        $params['id'] = $id;
        $params['row'] = $row;
        $params['model'] = $model;
        $params['messages'] = PembinaanMessageViewModel::find(['pembinaan_id=' => $id]);

        return view('site_pembinaan_view', $params, $response, 'frontend');
    }
    /**
     * Handle route 'pembinaan_delete' or path '/pembinaan/delete/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ResponseInterface
     */
    public function deletePembinaan(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if (auth()->getIdentity()->isAuthenticated()) {
            if (!auth()->hasRole('user')) {
                session()->addFlashWarning('Anda tidak berhak untuk mengakses halaman tersebut.');
                return redirect_to('index');
            }
        } else {
            session()->addFlashWarning('Silahkan login terlebih dahulu untuk mengakses permintaan pembinaan.');
            return redirect_to('login');
        }

        $id = $request->getAttribute('id');
        $row = PembinaanModel::row('*', ['id=' => $id]);
        if ($row) {
            $filename = $row['surat'] ?? null;
            try {
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
        }

        return redirect_to('pembinaan');
    }
    /**
     * Handle route 'dokumentasi' or path '/dokumentasi'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function dokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'DOKUMENTASI PEMBINAAN | SPEKTRAL'];
        $params['page'] = 'DOKUMENTASI PEMBINAAN';

        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "(`judul` LIKE '%{$q}%' OR `berita` LIKE '%{$q}%') AND a.is_active=1";
        } else {
            $q = '';
            $where = 'a.is_active=1';
        }

        $params['q'] = $q;
        $params['breadcrumbs'] = [];
        $params['data'] = DokumentasiPembinaanViewModel::paginate($where, '*', null, 'a.tanggal DESC');

        return view('site_dokumentasi', $params, $response, 'frontend');
    }
    /**
     * Handle route 'dokumentasi_view' or path '/dokumentasi/view/{id:\d+}'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function viewDokumentasi(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'DETAIL DOKUMENTASI PEMBINAAN | SPEKTRAL'];
        $params['page'] = 'DETAIL DOKUMENTASI PEMBINAAN';
        $params['breadcrumbs'] = [
            'DOKUMENTASI PEMBINAAN' => route('dokumentasi')
        ];
        $id = $request->getAttribute('id');
        $params['id'] = $id;
        $params['row'] = DokumentasiPembinaanViewModel::row('*', ['a.id=' => $id, 'a.is_active=' => 1, 'AND']);

        return view('site_dokumentasi_view', $params, $response, 'frontend');
    }
    /**
     * Handle route 'testimoni' or path '/testimoni'
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return ServerRequestInterface
     */
    public function testimoni(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = ['title' => 'TESTIMONI PENGGUNA | SPEKTRAL'];
        $params['page'] = 'TESTIMONI PENGGUNA';

        $query = $request->getQueryParams();
        if (isset($query['q']) && $query['q']) {
            $q = esc($query['q']);
            $where = "(`nama` LIKE '%{$q}%' OR `pesan` LIKE '%{$q}%') AND a.is_active=1";
        } else {
            $q = '';
            $where = 'a.is_active=1';
        }
        $model = new TestimoniForm();
        $model->rating = 5; // set default rating
        if ($request->getMethod() === 'POST') {
            if ($model->fillAndValidateWith($request)) {
                try {
                    TestimoniModel::create(
                        [
                            'pesan' => $model->pesan,
                            'rating' => $model->rating,
                            'is_active' => 1,
                            'userid' => auth()->getIdentity()->getId(),
                            'create_at' => time()
                        ]
                    );
                    session()->addFlashSuccess('Simpan testimoni berhasil');
                } catch (Exception $e) {
                    session()->addFlashError('Simpan testimoni gagal. Error:' . $e->getMessage());
                }
                return redirect_to('testimoni');
            }
        }
        $params['q'] = $q;
        $params['model'] = $model;
        $params['breadcrumbs'] = [];
        $params['data'] = TestimoniViewModel::paginate($where, '*', null, 'a.create_at DESC');

        return view('site_testimoni', $params, $response, 'frontend');
    }
}
