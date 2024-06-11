<?= $this->render('frontend/components/titlebox') ?>
<div class="container mb-5">
    <div class="row">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#filterModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M0,0L29.2,0 17.399981,15 17.399981,26.800049 11.800019,32 11.800019,15z" />
                </svg> Filter
            </a>
            <a class="btn btn-success" href="<?= route('testimoni') ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M18.400024,0C25.900024,-2.0281277E-07 32,6.4000198 32,14.400015 32,22.300004 25.900024,28.799998 18.400024,28.799998 15.599976,28.799998 13.099976,27.900006 10.900024,26.400006L13.200012,22.699996C14.700012,23.699996 16.5,24.400008 18.400024,24.400008 23.599976,24.400008 27.799988,19.90001 27.799988,14.400015 27.799988,8.9000179 23.599976,4.4000213 18.400024,4.4000213 14.299988,4.4000213 10.799988,7.3000133 9.5,11.200005L14.299988,11.300011 7.0999756,23.09999 0,11.099999 5.2000122,11.200005C6.5999756,4.8000152,12,-2.0281277E-07,18.400024,0z" />
                </svg> Refresh
            </a>
            <hr>
        </div>
        <!-- Filter Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="" method="GET">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">Filter Pencarian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="id_q">Nama atau pesan</label>
                                <input type="text" id="id_q" class="form-control" name="q" value="<?= $q ?>">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button> <button type="submit" class="btn btn-primary">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if ($q) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Filter Pencarian</strong><br />

            <div class="filter-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                </svg> Nama atau pesan mengandung kata '<?= $q ?>'<br />
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row mb-3">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <?php
            $no = 1;
            foreach ($data->getRows() as $row) {
                $rating = $row['rating'];
            ?>
                <div class="mb-2">
                    <?php for ($i = 0; $i < 5; $i++) {
                        if ($i < $rating) {
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
                <p style="text-align: justify;" class="text-dark mb-2"><?= $row['pesan'] ?></p>
                <p class="text-muted">
                    Oleh <?= $row['nama'] ?>, pada <?= date('Y-m-d', $row['create_at']) ?><br>
                    <?= $row['jabatan'] ?> - <?= $row['instansi'] ?>
                </p>
                <hr class="my-2" />
            <?php
                $no++;
            }
            ?>
        </div>
        <?php if (auth()->hasRole('user')) {
            $form = create_form($model); ?>
            <?= $form->begin("", 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <label for="id_pesan" class="form-label text-muted"><?= $model->getLabel('pesan') ?><span class="text-danger">*</span></label>
                    <?= $form->textArea('pesan', ['class' => 'form-control', 'required', 'id' => 'id_pesan', 'style' => 'height:80px;']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <label for="id_rating" class="form-label text-muted"><?= $model->getLabel('rating') ?><span class="text-danger">*</span></label><br>
                    <?php
                    for ($i = 1; $i <= 5; $i++) { ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="rating" id="rating<?= $i ?>" value="<?= $i ?>" <?= $i == $model->rating ? ' checked' : '' ?>>
                            <label class="form-check-label" for="rating<?= $i ?>">
                                <?php for ($j = 0; $j < 5; $j++) {
                                    if ($j < $i) {
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
                            </label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3 form-group">
                    <label for="id_captcha" class="form-label text-muted"><?= $model->getLabel('captcha') ?><span class="text-danger">*</span></label>
                    <?= $form->captcha() ?>
                    <?= $form->field('captcha', ['class' => 'form-control', 'required', 'id' => 'id_captcha']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="d-flex justify-content-start">
                    <button class="btn btn-primary rounded-pill py-1 px-3" type="submit" name="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M25.501859,5.7330076L32.000912,11.951012 25.534818,18.724008 24.087912,17.342968 28.250595,12.983028 9.999999,12.983028 9.999999,10.983028 28.096159,10.983028 24.118796,7.1780118z M0,0L21.999999,0 21.999999,8 20,8 20,1.9999998 2,1.9999998 2,21 20,21 20,15 21.999999,15 21.999999,23 0,23z" />
                        </svg> Kirim</button>
                </div>
            </div>
            <div class="form-text">Keterangan: <span class="text-danger">*</span> Wajib diisi.</div>
            <?= $form->end()  ?>
        <?php } else { ?>
            <div class="row">
                <div class="col-md-12 col-lg-10 col-xl-8 text-center">
                    <div class="badge bg-light text-dark mt-3 fs-5">Silahkan login terlebih dahulu untuk dapat menyampaikan testimoni</div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-10 col-xl-8">
            <hr>
            <div class="d-flex justify-content-center"><span class="text-muted me-3">Menampilkan <?= $no > 1 ? 1 : 0 ?> sampai <?= $no - 1 ?> dari <?= $data->getPagination()->recordCount() ?></span>
                <?= $data->getPagination() ?></div>
        </div>
    </div>
</div>