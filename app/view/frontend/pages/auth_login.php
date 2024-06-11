<?= $this->render('frontend' . DS . 'components' . DS . 'titlebox') ?>
<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-6">
                        <?php $form = create_form($model); ?>
                        <?= $form->begin(auth()->getProvider()->getLoginUri(), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
                        <div class="form-group mb-3">
                            <label for="id_email" class="form-label text-muted"><?= $model->getLabel('email') ?><span class="text-danger">*</span></label>
                            <?= $form->field('email', ['class' => 'form-control', 'required', 'autofocus', 'id' => 'id_email'])->emailField() ?>
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_password" class="form-label text-muted"><?= $model->getLabel('password') ?><span class="text-danger">*</span></label>
                            <?= $form->field('password', ['class' => 'form-control', 'required', 'id' => 'id_password'])->passField() ?>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_captcha" class="form-label text-muted"><?= $model->getLabel('captcha') ?><span class="text-danger">*</span></label>
                            <?= $form->captcha() ?>
                            <?= $form->field('captcha', ['class' => 'form-control', 'required', 'id' => 'id_captcha']) ?>
                        </div>

                        <div class="form-text mb-5">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>

                        <div class="mb-5">
                            <input class="btn btn-primary rounded-pill py-2 px-5" type="submit" name="submit" value="Login" />
                        </div>                        

                        <?= $form->end() ?>
                    </div>
                </div>
                <div class="row">
                    <span class="text-muted">Lupa password? <a class="link-success ms-2" href="<?= route('reset') ?>">Reset</a></span>
                </div>
                <div class="row">
                    <span class="text-muted">Belum punya akun?<a class="link-success ms-2" href="<?= route('register') ?>">Daftar</a></span>
                </div>
                <div class="row mb-3">
                    <span class="text-muted">Pengguna internal? <a class="link-success ms-2" href="<?= route('login_sso') ?>">Login SSO</a></span>
                </div>
            </div>
        </div>
    </div>
</div>