<div class="container my-3 mb-5">
    <h3 class="mb-3 text-primary font-weight-bold py-3">UBAH DATA PENGGUNA</h3>
    <?php $form = create_form($model); ?>
    <?= $form->begin(route('user_update'), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
    <div class="row mb-3">
        <div class="col-lg-4 form-group">
            <label for="id_nama" class="form-label text-muted"><?= $model->getLabel('nama') ?><span class="text-danger">*</span></label>
            <?= $form->field('nama', ['class' => 'form-control', 'required', 'autofocus', 'id' => 'id_nama']) ?>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="id_nip" class="form-label text-muted"><?= $model->getLabel('nip') ?><span class="text-danger">*</span></label>
                <?= $form->field('nip', ['class' => 'form-control', 'required', 'id' => 'id_nip']) ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="id_email" class="form-label text-muted"><?= $model->getLabel('email') ?><span class="text-danger">*</span></label>
                <div><?= $row['email'] ?></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="id_nomor_wa" class="form-label text-muted"><?= $model->getLabel('nomor_wa') ?><span class="text-danger">*</span></label>
                <?= $form->field('nomor_wa', ['class' => 'form-control', 'required', 'id' => 'id_nomor_wa'])->telField() ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="form-group">
                <label for="id_instansi" class="form-label text-muted"><?= $model->getLabel('instansi') ?><span class="text-danger">*</span></label>
                <?= $form->field('instansi', ['class' => 'form-control', 'required',  'id' => 'id_instansi']) ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="form-group">
                <label for="id_tingkat" class="form-label text-muted"><?= $model->getLabel('tingkat') ?><span class="text-danger">*</span></label>
                <?= $form->select('tingkat', ['Kementerian/Lembaga', 'Pemerintahan Daerah Provinsi', 'Pemerintahan Daerah Kabupaten/Kota'], null, ['class' => 'form-select', 'required', 'id' => 'id_tingkat']) ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="form-group">
                <label for="id_jabatan" class="form-label text-muted"><?= $model->getLabel('jabatan') ?><span class="text-danger">*</span></label>
                <?= $form->field('jabatan', ['class' => 'form-control', 'required',  'id' => 'id_jabatan']) ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="id_password" class="form-label text-muted"><?= $model->getLabel('password') ?></label>
                <?= $form->field('password', ['class' => 'form-control',  'id' => 'id_password'])->passField() ?>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="id_repassword" class="form-label text-muted"><?= $model->getLabel('repassword') ?></label>
                <?= $form->field('repassword', ['class' => 'form-control',  'id' => 'id_repassword'])->passField() ?>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4 form-group">
            <label for="id_captcha" class="form-label text-muted"><?= $model->getLabel('captcha') ?><span class="text-danger">*</span></label>
            <?= $form->captcha() ?>
            <?= $form->field('captcha', ['class' => 'form-control', 'required', 'id' => 'id_captcha']) ?>
        </div>
    </div>
    <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
    <hr class="col-lg-8" />
    <div class="row mb-5">
        <div class="col-lg-8">
            <div class="d-flex justify-content-end">
                <input class="btn btn-primary rounded-pill py-2 px-5" type="submit" name="submit" value="Simpan" />
            </div>
        </div>
    </div>
    <?= $form->end() ?>
</div>