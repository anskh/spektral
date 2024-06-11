<div class="container my-3">
    <h3 class="text-primary pt-3 mb-5"><?= $model->isEdit() ? 'UBAH PERMINTAAN PEMBINAAN' : 'PERMINTAAN PEMBINAAN BARU' ?></h3>
    <div class="col-lg-8 col-sm-12 mb-5">
        <?php
        $form = create_form($model); ?>
        <?= $form->begin($model->isEdit() ? route('pembinaan_edit', strval($id)) : route('pembinaan_entri'), 'POST', ['class' => 'needs-validation', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) ?>
        <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link" id="nav-pendaftar-tab" data-bs-toggle="tab" data-bs-target="#nav-pendaftar" type="button" role="tab" aria-controls="nav-pendaftar" aria-selected="false">Identitas Pendaftar</button>
                <button class="nav-link active" id="nav-pembinaan-tab" data-bs-toggle="tab" data-bs-target="#nav-pembinaan" type="button" role="tab" aria-controls="nav-pembinaan" aria-selected="true">Informasi Pembinaan</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-pendaftar" role="tabpanel" aria-labelledby="nav-pendaftar-tab" tabindex="0">
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <span class="text-muted">Nama</span>
                        <div><?= auth()->getIdentity()->getData()['nama'] ?></div>
                    </div>
                    <div class="col-lg-6">
                        <span class="text-muted">NIP</span>
                        <div><?= auth()->getIdentity()->getData()['nip'] ?></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <span class="text-muted">Asal Instansi</span>
                        <div><?= auth()->getIdentity()->getData()['instansi'] ?></div>
                    </div>
                    <div class="col-lg-6">
                        <span class="text-muted">Tingkat Satuan Kerja</span>
                        <div><?= auth()->getIdentity()->getData()['tingkat'] ?></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <span class="text-muted">Status instansi<span class="text-danger">*</span></span>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="id_produsen_data" name="produsen_data" <?= $model->produsen_data == 1 ? 'value="1" checked' : '' ?>>
                            <label class="form-check-label" for="id_produsen_data">Instansi selaku produsen data</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="nav-pembinaan" role="tabpanel" aria-labelledby="nav-pembinaan-tab" tabindex="1">
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="id_deskripsi" class="form-label text-muted"><?= $model->getLabel('deskripsi') ?><span class="text-danger">*</span></label>
                        <?= $form->textArea('deskripsi', ['class' => 'form-control', 'required', 'autofocus', 'id' => 'id_deskripsi', 'style'=>'height:100px;']) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="id_jenis" class="form-label text-muted"><?= $model->getLabel('jenis') ?><span class="text-danger">*</span></label>
                        <?php foreach ($listJenis as $jenis) { ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis" id="jenis<?= $jenis['id'] ?>" value="<?= $jenis['id'] ?>" <?= $jenis['id'] == $model->jenis ? ' checked' : '' ?>>
                                <label class="form-check-label" for="jenis<?= $jenis['id'] ?>">
                                    <?= $jenis['nama'] ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="id_tanggal" class="form-label text-muted"><?= $model->getLabel('tanggal') ?><span class="text-danger">*</span></label>
                        <?= $form->field('tanggal', ['class' => 'form-control', 'required', 'id' => 'id_tanggal'])->dateField() ?>
                    </div>
                    <div class="col-lg-6">
                        <label for="id_waktu" class="form-label text-muted"><?= $model->getLabel('waktu') ?><span class="text-danger">*</span></label>
                        <?= $form->field('waktu', ['class' => 'form-control', 'required', 'id' => 'id_waktu'])->timeField() ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="id_lokasi" class="form-label text-muted"><?= $model->getLabel('lokasi') ?><span class="text-danger">*</span></label>
                        <?= $form->field('lokasi', ['class' => 'form-control', 'required', 'id' => 'id_lokasi']) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="id_nama_pic" class="form-label text-muted"><?= $model->getLabel('nama_pic') ?><span class="text-danger">*</span></label>
                        <?= $form->field('nama_pic', ['class' => 'form-control', 'required', 'id' => 'id_nama_pic']) ?>
                    </div>
                    <div class="col-lg-6">
                        <label for="id_nomor_hp_pic" class="form-label text-muted"><?= $model->getLabel('nomor_hp_pic') ?><span class="text-danger">*</span></label>
                        <?= $form->field('nomor_hp_pic', ['class' => 'form-control', 'required', 'id' => 'id_nomor_hp_pic'])->telField() ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="id_email_pic" class="form-label text-muted"><?= $model->getLabel('email_pic') ?><span class="text-danger">*</span></label>
                        <?= $form->field('email_pic', ['class' => 'form-control', 'required', 'id' => 'id_email_pic']) ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label text-muted" for="id_surat"><?= $model->getLabel('surat') ?><?= $model->isEdit() ? '' : '<span class="text-danger">*</span>' ?></label>
                        <?php if ($model->isEdit()) { ?>
                            <?= $form->file('surat', ['class' => 'form-control', 'id' => 'id_surat', 'accept' => 'application/pdf']) ?>
                        <?php } else { ?>
                            <?= $form->file('surat', ['class' => 'form-control', 'required', 'id' => 'id_surat', 'accept' => 'application/pdf']) ?>
                        <?php } ?>
                        <div class="form-text">File surat yang diperkenankan adalah format pdf.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
        </div>
        <hr/>
        <div class="row">
            <div class="d-flex justify-content-end">
                <a href="<?= route('pembinaan') ?>" class="btn btn-secondary rounded-pill py-2 px-5 me-2">Kembali</a>
                <input class="btn btn-primary rounded-pill py-2 px-5" type="submit" name="submit" value="Simpan">
            </div>
        </div>
        <?= $form->end() ?>
    </div>
</div>