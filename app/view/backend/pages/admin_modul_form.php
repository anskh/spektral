<div class="container my-3">
    <h3 class="text-primary pt-3 mb-3"><?= $model->isEdit() ? 'UBAH DATA MODUL' : 'TAMBAH MODUL BARU' ?></h3>
    <div class="card col-lg-8 col-sm-12 mb-5">
        <?php
        $form = create_form($model); ?>
        <?= $form->begin($model->isEdit() ? route('admin_modul_edit', $row['id']) : route('admin_modul_entri'), 'POST', ['enctype' => 'multipart/form-data','class' => 'needs-validation', 'autocomplete' => 'off']) ?>
        <div class="card-header bg-white text-center">
            <span class="text-dark fs-4">FORMULIR</span>
        </div>
        <div class="card-body bg-white">
            <div class="row mb-3">
                <div class="col">
                    <label for="id_nama" class="form-label text-muted"><?= $model->getLabel('nama') ?><span class="text-danger">*</span></label>
                    <?= $form->field('nama', ['class' => 'form-control', 'required', 'autofocus', 'id' => 'id_nama']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_deskripsi" class="form-label text-muted"><?= $model->getLabel('deskripsi') ?><span class="text-danger">*</span></label>
                    <?= $form->textArea('deskripsi', ['class' => 'form-control', 'required', 'id' => 'id_deskripsi','style'=>'height:100px;']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_kategori" class="form-label text-muted"><?= $model->getLabel('kategori') ?><span class="text-danger">*</span></label>
                    <?= $form->select('kategori', $labels, $values,  ['class' => 'form-select', 'required', 'id' => 'id_kategori']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <?php if ($model->isEdit()) { ?>
                        <label class="form-label text-muted" for="link"><?= $model->getLabel('link') ?>:
                            <a class="ms-2" target="_blank" href="<?= site_url('/uploads/modul/' . $model->link) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M15.199951,5.7999878L21.5,5.7999878 21.5,32 3.5,32C8.3999634,30.100006,14.599976,27,15,24.100006L15,23.899994 15.199951,23.899994z M0,5.7999878L0.099975586,5.7999878 4.5999756,5.7999878 4.6999512,19.399994C4.6999512,19.399994 10.599976,21 11,23.799988 11.399963,26.299988 4.5999756,29 0,30.100006z M6.8999634,0C10.5,0.70001221,12.699951,3.6000061,13.099976,4.2000122L13.099976,22.5C12,18.100006,7,17.899994,7,17.899994z" />
                                </svg></a></label>
                        <?= $form->file('link', ['class' => 'form-control', 'accept' => 'application/pdf']) ?>
                    <?php } else { ?>
                        <label class="form-label text-muted" for="link"><?= $model->getLabel('link') ?><span class="text-danger">*</span></label>
                        <?= $form->file('link', ['class' => 'form-control', 'required', 'accept' => 'application/pdf']) ?>
                    <?php } ?>
                    <div class="form-text">File modul yang diperkenankan adalah format pdf.</div>
                </div>
            </div>

            <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                <a href="<?= route('admin_modul') ?>" class="btn btn-sm btn-secondary me-2">Kembali</a>
                <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Simpan" />
            </div>
        </div>
        <?= $form->end() ?>
    </div>
</div>