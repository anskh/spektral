<div class="container my-3">
    <h3 class="text-primary pt-3 mb-3">INFORMASI PENGGUNA</h3>
    <div class="card col-lg-8 col-sm-12 mb-5">
        <div class="card-header bg-white text-center">
            <span class="text-dark fs-4">DATA</span>
        </div>
        <div class="card-body bg-white">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <span class="text-muted">Nama</span>
                    <div><?= $row['nama'] ?></div>
                </div>
                <div class="col-lg-6">
                    <span class="text-muted">NIP</span>
                    <div><?= $row['nip'] ?></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <span class="text-muted">Email</span>
                    <div><?= $row['email'] ?></div>
                </div>
                <div class="col-lg-6">
                    <span class="text-muted">Nomor HP</span>
                    <div><?= $row['nomor_wa'] ?></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <span class="text-muted">Instansi</span>
                    <div><?= $row['instansi'] ?></div>
                </div>
                <div class="col-lg-6">
                    <span class="text-muted">Tingkat</span>
                    <div><?= $row['tingkat'] ?></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <span class="text-muted">Jabatan</span>
                    <div><?= $row['jabatan'] ?></div>
                </div>
                <div class="col-lg-6">
                    <span class="text-muted">Jenis Akun</span>
                    <div><?= str_contains($row['tingkat'], '@bps.go.id') ? 'Internal' : 'Eksternal' ?></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <span class="text-muted">Status</span>
                    <div><?= $row['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></div>
                </div>
                <?php

                use Corephp\Helper\Html;

                $roles = explode(',', $row['role']);
                $roleText = '';
                foreach ($roles as $role) {
                    $roleText .= Html::tag('span', $role, ['class' => 'badge bg-secondary']);
                } ?>
                <div class="col-lg-6">
                    <span class="text-muted">Role</span>
                    <div><?= $roleText ?></div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                <a href="<?= route('admin_user') ?>" class="btn btn-sm btn-secondary me-2">Kembali</a>
            </div>
        </div>
    </div>
</div>