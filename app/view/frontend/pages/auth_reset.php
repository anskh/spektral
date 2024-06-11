<?= $this->render('frontend/components/titlebox') ?>
<div class="container my-3 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <?php $form = create_form($model); ?>
                        <?= $form->begin(route('reset'), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
                        <div class="form-group mb-3">
                            <label for="id_email" class="form-label text-muted"><?= $model->getLabel('email') ?><span class="text-danger">*</span></label>
                            <?= $form->field('email', ['class' => 'form-control', 'required', 'autofocus', 'id' => 'id_email'])->emailField() ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_captcha" class="form-label text-muted"><?= $model->getLabel('captcha') ?><span class="text-danger">*</span></label>
                            <?= $form->captcha() ?>
                            <?= $form->field('captcha', ['class' => 'form-control', 'required', 'id' => 'id_captcha']) ?>
                        </div>
                        <div class="form-text mb-5">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
                        <div class="mb-5">
                            <input class="btn btn-primary rounded-pill py-2 px-5" type="submit" name="submit" value="Reset" />
                        </div>

                        <?= $form->end() ?>
                    </div>
                </div>
                <div class="row">
                    <span class="text-muted">Sudah ingat password?<a class="link-success ms-2" href="<?= route('login') ?>">Login</a></span>
                </div>
            </div>
        </div>
    </div>
</div>