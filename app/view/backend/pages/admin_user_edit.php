<div class="container my-3">
    <h3 class="text-primary pt-3 mb-3">UBAH DATA PENGGUNA</h3>
    <div class="card col-lg-8 col-sm-12 mb-5">
        <?php
        $form = create_form($model); ?>
        <?= $form->begin(route('admin_user_edit', $row['id']), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
        <div class="card-header bg-white text-center">
            <span class="text-dark fs-4">FORMULIR</span>
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
                <span class="text-muted"><?= $model->getLabel('is_active') ?><span class="text-danger">*</span></span>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="id_is_active" name="is_active"<?= $model->is_active == 1 ? 'value="1" checked' : '' ?>>
                        <label class="form-check-label" for="id_is_active">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <span class="text-muted">Role<span class="text-danger">*</span></span>
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="id_role_user" value="user" name="roles[]" <?= str_contains($model->role, 'user') ? ' checked' : '' ?>>
                        <label class="form-check-label" for="id_role_user">User</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="id_role_viewer" value="viewer" name="roles[]" <?= str_contains($model->role, 'viewer') ? ' checked' : '' ?>>
                        <label class="form-check-label" for="id_role_viewer">Viewer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="id_role_supervisor" value="supervisor" name="roles[]" <?= str_contains($model->role, 'supervisor') ? ' checked' : '' ?>>
                        <label class="form-check-label" for="id_role_supervisor">Supervisor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="id_role_admin" value="admin" name="roles[]" <?= str_contains($model->role, 'admin') ? ' checked' : '' ?>>
                        <label class="form-check-label" for="id_role_admin">Admin</label>
                    </div>
                    <?php if ($model->hasError('role')) { ?>
                        <div class="alert alert-danger mt-2" role="alert">
                            <?= $model->firstError('role') ?><br />
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-text mb-3">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                <a href="<?= route('admin_user') ?>" class="btn btn-sm btn-secondary me-2">Kembali</a>
                <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Simpan" />
            </div>
        </div>
        <?= $form->end() ?>
    </div>
</div>