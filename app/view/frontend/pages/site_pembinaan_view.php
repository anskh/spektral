<div class="container my-3">
    <h3 class="text-primary pt-3 mb-5">DETAIL PERMINTAAN PEMBINAAN</h3>
    <div class="row">
        <div class="col-lg-8 col-sm-12 mb-5">
            <nav>
                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                    <button class="nav-link" id="nav-pendaftar-tab" data-bs-toggle="tab" data-bs-target="#nav-pendaftar" type="button" role="tab" aria-controls="nav-pendaftar" aria-selected="false">Informasi Pendaftar</button>
                    <button class="nav-link active" id="nav-pembinaan-tab" data-bs-toggle="tab" data-bs-target="#nav-pembinaan" type="button" role="tab" aria-controls="nav-pembinaan" aria-selected="true">Informasi Pembinaan</button>
                    <button class="nav-link" id="nav-percakapan-tab" data-bs-toggle="tab" data-bs-target="#nav-percakapan" type="button" role="tab" aria-controls="nav-percakapan" aria-selected="false">Percakapan</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-pendaftar" role="tabpanel" aria-labelledby="nav-pendaftar-tab" tabindex="0">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <span class="text-muted">Nama</span>
                                <div><?= $row['nama_pendaftar'] ?></div>
                            </div>
                            <div class="col-lg-6">
                                <span class="text-muted">NIP</span>
                                <div><?= $row['nip'] ?></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <span class="text-muted">Asal Instansi</span>
                                <div><?= $row['instansi'] ?></div>
                            </div>
                            <div class="col-lg-6">
                                <span class="text-muted">Tingkat Satuan Kerja:</span>
                                <div><?= $row['tingkat'] ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="text-muted">Status Instansi:</span>
                                <div>
                                    <?= $row['produsen_data'] == 1 ? '' : 'Bukan ' ?>Produsen Data
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="nav-pembinaan" role="tabpanel" aria-labelledby="nav-pembinaan-tab" tabindex="0">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-12">
                                <span class="text-muted">Deskripsi:</span>
                                <div><?= $row['deskripsi'] ?></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <span class="text-muted">Jenis Media/Model Pembinaan:</span>
                                <div><?= $row['jenis_pembinaan'] ?></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <span class="text-muted">Tanggal:</span>
                                <div><?= $row['tanggal'] ?></div>
                            </div>
                            <div class="col-lg-6">
                                <span class="text-muted">Waktu:</span>
                                <div><?= $row['waktu'] ?></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <span class="text-muted">Tempat:</span>
                                <div><?= $row['lokasi'] ?></div>
                            </div>
                            <div class="col-lg-6">
                                <span class="text-muted">Nama PIC:</span>
                                <div><?= $row['nama_pic'] ?></div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <span class="text-muted">Nomor HP PIC:</span>
                                <div><?= $row['nomor_hp_pic'] ?></div>
                            </div>
                            <div class="col-lg-6">
                                <span class="text-muted">Email PIC:</span>
                                <div><?= $row['email_pic'] ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <span class="text-muted">Surat pengantar:</span>
                                <div class="text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M15.199951,5.7999878L21.5,5.7999878 21.5,32 3.5,32C8.3999634,30.100006,14.599976,27,15,24.100006L15,23.899994 15.199951,23.899994z M0,5.7999878L0.099975586,5.7999878 4.5999756,5.7999878 4.6999512,19.399994C4.6999512,19.399994 10.599976,21 11,23.799988 11.399963,26.299988 4.5999756,29 0,30.100006z M6.8999634,0C10.5,0.70001221,12.699951,3.6000061,13.099976,4.2000122L13.099976,22.5C12,18.100006,7,17.899994,7,17.899994z" />
                                    </svg>
                                    <a class="link-primary" href="<?= site_url('/uploads/pembinaan/' . $row['surat']) ?>" target="_blank"><?= $row['surat'] ?></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <span class="text-muted">Status Permintaan:</span>
                                <div><?= status_permintaan($row['status'], $row['status_permintaan']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-percakapan" role="tabpanel" aria-labelledby="nav-percakapan-tab" tabindex="0">
                    <div class="container">
                        <div class="row mb-3">
                            <?php foreach ($messages as $message) {
                                if ($message['user_id'] == auth()->getIdentity()->getId()) { ?>
                                    <div class="col-8">
                                        <span class="fw-light"><?= $message['nama'] ?> : <?= date("d F Y H:i:s", $message['message_date']) ?></span>
                                        <div class="card p-3 bg-success-subtle">
                                            <?= $message['message'] ?>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-8 ms-auto">
                                        <span class="fw-light"><?= $message['nama'] ?> : <?= date("d F Y H:i:s", $message['message_date']) ?></span>
                                        <div class="card p-3 bg-info-subtle">
                                            <?= $message['message'] ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php if (!ticket_readonly($row['status'])) { ?>
                            <?php $form = create_form($model); ?>
                            <?= $form->begin(route('pembinaan_view', strval($id)), 'POST', ['class' => 'needs-validation', 'autocomplete' => 'off']) ?>
                            <div class="row mb-3">
                                <div class="col-8">
                                    <span class="fw-light"><?= auth()->getIdentity()->getData()['nama'] ?></span>
                                    <?= $form->textArea('message', ['class' => 'form-control', 'required', 'autofocus']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-start">
                                    <button class="btn btn-primary rounded-pill py-1 px-3" type="submit" name="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M25.501859,5.7330076L32.000912,11.951012 25.534818,18.724008 24.087912,17.342968 28.250595,12.983028 9.999999,12.983028 9.999999,10.983028 28.096159,10.983028 24.118796,7.1780118z M0,0L21.999999,0 21.999999,8 20,8 20,1.9999998 2,1.9999998 2,21 20,21 20,15 21.999999,15 21.999999,23 0,23z" />
                                        </svg> Kirim</button>
                                </div>
                            </div>
                            <?= $form->end() ?>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <hr />
            <div class="row">
                <div class="d-flex justify-content-end">
                    <a href="<?= route('pembinaan') ?>" class="btn btn-secondary rounded-pill py-2 px-5 me-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>