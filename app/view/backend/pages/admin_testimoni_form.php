<div class="container my-3">
    <h3 class="text-primary pt-3 mb-3">UBAH TESTIMONI PENGGUNA</h3>
    <div class="card col-lg-8 col-sm-12 mb-5">
        <?php
        $form = create_form($model); ?>
        <?= $form->begin(route('admin_testimoni_edit', strval($id)), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
        <div class="card-header bg-white text-center">
            <span class="text-dark fs-4">FORMULIR</span>
        </div>
        <div class="card-body bg-white">
            <div class="row mb-2">
                <div class="col">
                    <span class="text-muted">Nama</span>
                    <div><?= $row['nama'] ?></div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="text-muted">Instansi</span>
                    <div><?= $row['instansi'] ?></div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="text-muted">Jabatan</span>
                    <div><?= $row['jabatan'] ?></div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="text-muted">Pesan</span>
                    <div><?= $row['pesan'] ?></div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <span class="text-muted">Rating</span>
                    <div>
                        <?php for ($j = 0; $j < 5; $j++) {
                            if ($j < $row['rating']) {
                        ?>
                                <span class="text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M16.001007,0L20.944,10.533997 32,12.223022 23.998993,20.421997 25.889008,32 16.001007,26.533997 6.1109924,32 8,20.421997 0,12.223022 11.057007,10.533997z" />
                                    </svg></span>
                            <?php } else { ?>
                                <span class="text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M16.001007,0L20.944,10.533997 32,12.223022 23.998993,20.421997 25.889008,32 16.001007,26.533997 6.1109924,32 8,20.421997 0,12.223022 11.057007,10.533997z" />
                                    </svg></span>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <span class="text-muted"><?= $model->getLabel('is_active') ?><span class="text-danger">*</span></span>
                <div class="col-12">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="id_is_active" name="is_active" <?= $model->is_active == 1 ? 'value="1" checked' : '' ?>>
                        <label class="form-check-label" for="id_is_active">Aktif</label>
                    </div>
                </div>
            </div>
            <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                <a href="<?= route('admin_testimoni') ?>" class="btn btn-sm btn-secondary me-2">Kembali</a>
                <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Simpan" />
            </div>
        </div>
        <?= $form->end() ?>
    </div>
</div>