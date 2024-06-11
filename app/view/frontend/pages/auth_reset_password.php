<?= $this->render('frontend' . DS . 'components' . DS . 'titlebox') ?>
<div class="container mb-5">
    <h3 class="mb-3 text-primary font-weight-bold">Reset Password</h3>
    <?php $form = create_form($model); ?>
    <?= $form->begin(route('reset_password', $token), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
    <div class="row mb-3">
        <div class="col-lg-3 form-group">
            <label for="id_password" class="form-label text-muted"><?= $model->getLabel('password') ?><span class="text-danger">*</span></label>
            <?= $form->field('password', ['class' => 'form-control', 'required',  'id' => 'id_password'])->passField() ?>
        </div>
        <div class="col-lg-3 form-group">
            <label for="id_repassword" class="form-label text-muted"><?= $model->getLabel('repassword') ?><span class="text-danger">*</span></label>
            <?= $form->field('repassword', ['class' => 'form-control', 'required',  'id' => 'id_repassword'])->passField() ?>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-3 form-group">
            <label for="id_captcha" class="form-label text-muted"><?= $model->getLabel('captcha') ?><span class="text-danger">*</span></label>
            <?= $form->captcha() ?>
            <?= $form->field('captcha', ['class' => 'form-control', 'required', 'id' => 'id_captcha']) ?>
        </div>
    </div>
    <div class="form-text mb-5">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
    <div class="row mb-5">
        <div>
            <input class="btn btn-primary rounded-pill py-2 px-5" type="submit" name="submit" value="Simpan" />
        </div>
    </div>
    <?= $form->end() ?>
</div>