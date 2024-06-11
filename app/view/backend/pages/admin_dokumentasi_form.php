<div class="container my-3">
    <h3 class="text-primary pt-3 mb-3"><?= $model->isEdit() ? 'UBAH DATA DOKUMENTASI PEMBINAAN' : 'TAMBAH DOKUMENTASI PEMBINAAN BARU' ?></h3>
    <div class="card col-lg-8 col-sm-12 mb-5">
        <?php
        $form = create_form($model); ?>
        <?= $form->begin($model->isEdit() ? route('admin_dokumentasi_edit', strval($id)) : route('admin_dokumentasi_entri'), 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'autocomplete' => 'off']) ?>
        <div class="card-header bg-white text-center">
            <span class="text-dark fs-4">FORMULIR</span>
        </div>
        <div class="card-body bg-white">
            <?php if ($model->pembinaan_id) { ?>
                <div class="row mb-3">
                    <div class="col">
                        <label for="id_pembinaan_id" class="form-label text-muted"><?= $model->getLabel('pembinaan_id') ?></label>
                        <?= $form->field('pembinaan_id', ['class' => 'form-control', 'readonly', 'autofocus', 'id' => 'id_pembinaan_id']) ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_judul" class="form-label text-muted"><?= $model->getLabel('judul') ?><span class="text-danger">*</span></label>
                    <?= $form->field('judul', ['class' => 'form-control', 'required', 'autofocus', 'id' => 'id_judul']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_berita" class="form-label text-muted"><?= $model->getLabel('berita') ?><span class="text-danger">*</span></label>
                    <?= $form->textArea('berita', ['class' => 'form-control', 'required', 'id' => 'id_berita', 'style' => 'height: 300px;']) ?>
                </div>
            </div>
            <div class="form-text mb-3">Silahkan gunakan atribute html untuk pengaturan baris dan/atau huruf. Contoh <?= esc('<br>, <b>, <em>, dll.') ?></div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label for="id_tanggal" class="form-label text-muted"><?= $model->getLabel('tanggal') ?><span class="text-danger">*</span></label>
                    <?= $form->field('tanggal', ['class' => 'form-control', 'required', 'id' => 'id_tanggal'])->dateField() ?>
                </div>
                <?php if ($model->isEdit()) { ?>
                    <div class="col-lg-6">
                        <span class="text-muted"><?= $model->getLabel('is_active') ?><span class="text-danger">*</span></span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="id_is_active" name="is_active" <?= $model->is_active == 1 ? 'value="1" checked' : '' ?>>
                            <label class="form-check-label" for="id_is_active">Aktif</label>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label text-muted" for="Gambar"><?= $model->getLabel('Gambar') ?></label>
                    <?= $form->file('Gambar', ['class' => 'form-control', 'accept' => ['image/png,', 'image/gif,', 'image/jpeg']]) ?>
                    <div class="form-text">File gambar yang diperkenankan adalah format png, jpg, dan gif.</div>
                </div>
            </div>
            <?php if ($model->isEdit() && $model->gambar) { ?>
                <div class="row mb-3">
                    <div class="col col-lg-8">
                        <img style="width: 100%;" class="img-thumbnail" src="<?= site_url('/uploads/dokumentasi/img/' . $model->gambar) ?>">
                    </div>
                </div>
            <?php } ?>
            <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                <a href="<?= route('admin_dokumentasi') ?>" class="btn btn-sm btn-secondary me-2">Kembali</a>
                <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Simpan" />
            </div>
        </div>
        <?= $form->end() ?>
    </div>
</div>