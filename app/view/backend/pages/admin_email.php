<div class="container my-3">
    <h3 class="text-primary pt-3 mb-3">KIRIM EMAIL</h3>
    <div class="card col-lg-8 col-sm-12 mb-5">
        <?php
        $form = create_form($model); ?>
        <?= $form->begin(route('admin_email'), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
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
                    <label for="id_email" class="form-label text-muted"><?= $model->getLabel('email') ?><span class="text-danger">*</span></label>
                    <?= $form->field('email', ['class' => 'form-control', 'required', 'id' => 'id_email']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_pesan" class="form-label text-muted"><?= $model->getLabel('pesan') ?><span class="text-danger">*</span></label>
                    <?= $form->textArea('pesan', ['class' => 'form-control', 'required', 'id' => 'id_pesan','style'=>'height:100px;']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_server" class="form-label text-muted"><?= $model->getLabel('server') ?><span class="text-danger">*</span></label>
                    <?= $form->field('server', ['class' => 'form-control', 'readonly', 'id' => 'id_server']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_user" class="form-label text-muted"><?= $model->getLabel('user') ?><span class="text-danger">*</span></label>
                    <?= $form->field('user', ['class' => 'form-control', 'readonly', 'id' => 'id_user']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_password" class="form-label text-muted"><?= $model->getLabel('password') ?><span class="text-danger">*</span></label>
                    <?= $form->field('password', ['class' => 'form-control', 'readonly', 'id' => 'id_password'])->passField() ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_port" class="form-label text-muted"><?= $model->getLabel('port') ?><span class="text-danger">*</span></label>
                    <?= $form->field('port', ['class' => 'form-control', 'readonly', 'id' => 'id_port']) ?>
                </div>
            </div>
            <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-end">
                <input class="btn btn-sm btn-primary" type="submit" name="submit" value="Simpan" />
            </div>
        </div>
        <?= $form->end() ?>
    </div>
</div>