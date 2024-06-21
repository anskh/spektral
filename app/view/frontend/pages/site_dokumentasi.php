<?= $this->render('frontend/components/titlebox') ?>
<div class="container mb-5">
    <div class="row">
        <div class="col">
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#filterModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M0,0L29.2,0 17.399981,15 17.399981,26.800049 11.800019,32 11.800019,15z" />
                </svg> Filter
            </a>
            <a class="btn btn-success" href="<?= route('dokumentasi') ?>">
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
                                <label class="form-label" for="id_q">Judul atau isi berita</label>
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
                </svg> Judul atau isi berita mengandung kata '<?= $q ?>'<br />
            </div>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <div class="row mb-3">
        <div class="col">
            <?php
            $no = 1;
            foreach ($data->getRows() as $row) { ?>
                <h3 class="text-primary"><?= esc($row['judul']) ?></h3>
                <p style="text-align: justify;" class="text-dark mb-2"><?= substr($row['berita'], 0, 200) . '... ' ?><a href="<?= route('dokumentasi_view', strval($row['id'])) ?>" class="link-primary">selengkapnya <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M20.564032,0L32.000033,12.461994 20.679032,24.798988 19.205031,23.446989 28.371085,13.457998 0,13.457998 0,11.457997 28.363814,11.457997 19.091031,1.3519993z" />
                        </svg></a></p>
                <p class="text-muted">
                    <?= $row['nama'] ?>, <?= $row['tanggal'] ?>
                </p>
                <hr class="my-2" />
            <?php
                $no++;
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-center"><span class="text-muted me-3">Menampilkan <?= $no > 1 ? 1 : 0 ?> sampai <?= $no - 1 ?> dari <?= $data->getPagination()->recordCount() ?></span>
                <?= $data->getPagination() ?></div>
        </div>
    </div>
</div>