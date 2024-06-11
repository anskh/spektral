<div class="container my-3 mb-5">
    <h3 class="text-primary pt-3 mb-3">DAFTAR MODUL PEMBINAAN</h3>
    <div class="mb-3">
        <ul class="nav nav-tabs">
            <?php foreach ($categories as $cat) { ?>
                <li class="nav-item">
                    <?php if ($kategori == $cat['id']) { ?>
                        <a class="nav-link active" aria-current="page"><?= $cat['nama'] ?></a>
                    <?php } else { ?>
                        <a class="nav-link" href="<?= route('admin_modul', "/{$cat['id']}") ?>"><?= $cat['nama'] ?></a>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="card">
        <div class="card-header">
            <?php

            if ($q) { ?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <strong>Filter Pencarian</strong><br />

                    <div class="filter-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                        </svg> Nama atau Deskripsi Modul mengandung kata '<?= $q ?>'<br />
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div>
                <a class="btn btn-success btn-sm" href="<?= route('admin_modul_entri', "/$kategori") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M14,0L18,0 18,14 32,14 32,18 18,18 18,32 14,32 14,18 0,18 0,14 14,14z" />
                    </svg>
                </a>
                <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M0,0L29.2,0 17.399981,15 17.399981,26.800049 11.800019,32 11.800019,15z" />
                    </svg>
                </a>
                <a class="btn btn-success btn-sm" href="<?= route('admin_modul', "/$kategori") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M18.400024,0C25.900024,-2.0281277E-07 32,6.4000198 32,14.400015 32,22.300004 25.900024,28.799998 18.400024,28.799998 15.599976,28.799998 13.099976,27.900006 10.900024,26.400006L13.200012,22.699996C14.700012,23.699996 16.5,24.400008 18.400024,24.400008 23.599976,24.400008 27.799988,19.90001 27.799988,14.400015 27.799988,8.9000179 23.599976,4.4000213 18.400024,4.4000213 14.299988,4.4000213 10.799988,7.3000133 9.5,11.200005L14.299988,11.300011 7.0999756,23.09999 0,11.099999 5.2000122,11.200005C6.5999756,4.8000152,12,-2.0281277E-07,18.400024,0z" />
                    </svg>
                </a>
                <!-- Filter Modal -->
                <form action="" method="get">
                    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filterModalLabel">Filter Pencarian</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="id_q">Nama atau Deskripsi</label>
                                        <input type="text" id="id_q" class="form-control" name="q" value="<?= $q ?>">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button> <button type="submit" class="btn btn-primary">Terapkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead class="table-light">
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center" width="120">Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                        // variabel untuk nomor urut tabel
                        $no = 1;
                        foreach ($data->getRows() as $row) {
                        ?>
                            <tr>
                                <td width="auto" class="text-center"><?= $no++ ?></td>
                                <td width="auto">
                                    <div><?= $row['nama'] ?></div>
                                    <div>File: <a class="link-primary" href="<?= site_url('/uploads/modul/' . $row['link']) ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M15.199951,5.7999878L21.5,5.7999878 21.5,32 3.5,32C8.3999634,30.100006,14.599976,27,15,24.100006L15,23.899994 15.199951,23.899994z M0,5.7999878L0.099975586,5.7999878 4.5999756,5.7999878 4.6999512,19.399994C4.6999512,19.399994 10.599976,21 11,23.799988 11.399963,26.299988 4.5999756,29 0,30.100006z M6.8999634,0C10.5,0.70001221,12.699951,3.6000061,13.099976,4.2000122L13.099976,22.5C12,18.100006,7,17.899994,7,17.899994z" />
                                            </svg></a></div>
                                </td>
                                <td width="auto"><?= $row['deskripsi'] ?></td>
                                <td class="text-center">
                                    <div>
                                        <!-- button ubah data -->
                                        <a href="<?= route('admin_modul_edit', strval($row['id'])) ?>" class="btn btn-warning btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M14.221988,30.222944L31.999001,30.222944 31.999001,31.999946 14.221988,31.999946z M28.436571,10.48223L28.442999,10.488657C28.440233,10.488657,28.438292,10.487832,28.437151,10.48621z M19.554997,5.5115979L26.31098,12.267675 6.7559831,32.000983 0,32.000983 0,25.422889 0,25.421851C-2.7426722E-08,25.421851,19.733006,5.6886022,19.554997,5.5115979z M26.132246,0C26.576742,0,27.020987,0.17750798,27.375983,0.53252377L31.465981,4.6226084C32.176003,5.3345935 32.176003,6.4005873 31.465981,7.1115959 31.465981,7.1115959 28.462872,10.280889 28.436098,10.47897L28.436571,10.48223 21.686987,3.7325809 24.886999,0.53252377C25.243002,0.17750798,25.68775,0,26.132246,0z" />
                                            </svg>
                                        </a>
                                        <!-- button modal hapus data -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M19.277999,7.0630187L19.277999,27.739014 23.644004,27.739014 23.644004,7.0630187z M8.3530013,7.0630187L8.3530013,27.739014 12.720999,27.739014 12.720999,7.0630187z M8.6700027,0L23.329001,0 23.329001,3.4360048 32.000001,3.4360048 32.000001,7.0630187 29.330001,7.0630187 29.330001,32 2.6699982,32 2.6699982,7.0630187 0,7.0630187 0,3.4360048 8.6700027,3.4360048z" />
                                            </svg>
                                        </button>
                                        <!-- Modal hapus data -->
                                        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Modul</h1>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p class="mb-2">Yakin akan menghapus modul ini?</p>
                                                        <!-- informasi data yang akan dihapus -->
                                                        <p class="fw-bold mb-2"><?= $no ?> - <?= $row['nama'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm me-2" data-bs-dismiss="modal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M9.9000245,6.000003L6.0000001,9.8999988 12.100037,16.000007 6.0000001,22.100002 9.9000245,25.999997 16,19.900018 22.100037,25.999997 26,22.100002 19.900024,16.000007 26,9.8999988 22.100037,6.000003 16,12.099997z M16,0C24.799988,0 32,7.2000005 32,16.000007 32,24.800016 24.799988,32.000001 16,32.000001 7.2000123,32.000001 8.3946347E-08,24.800016 0,16.000007 8.3946347E-08,7.2000005 7.2000123,0 16,0z" />
                                                            </svg><span class="ms-1">Batal</span>
                                                        </button>
                                                        <!-- button proses hapus data -->
                                                        <a href="<?= route('admin_modul_delete', $row['id']) ?>" class="btn btn-success btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M28.166016,0L32,3.8740238 11.496002,19.745 0,7.9879777 4.4200134,4.6370251 12.070007,12.476016z" />
                                                            </svg><span class="ms-1">Ya</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted d-flex">
            <span>Menampilkan <?= $no > 1 ? 1 : 0 ?> sampai <?= $no - 1 ?> dari <?= $data->getPagination()->recordCount() ?></span>
            <div class="ms-auto"><?= $data->getPagination() ?></div>
        </div>
    </div>
</div>