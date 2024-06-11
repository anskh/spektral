<div class="container my-3 mb-5">
    <h3 class="text-primary pt-3 mb-3">DAFTAR DOKUMENTASI PEMBINAAN</h3>
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
                        </svg> Judul atau isi berita mengandung kata '<?= $q ?>'<br />
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div>
                <a class="btn btn-success btn-sm" href="<?= route('admin_dokumentasi_entri') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M14,0L18,0 18,14 32,14 32,18 18,18 18,32 14,32 14,18 0,18 0,14 14,14z" />
                    </svg>
                </a>
                <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M0,0L29.2,0 17.399981,15 17.399981,26.800049 11.800019,32 11.800019,15z" />
                    </svg>
                </a>
                <a class="btn btn-success btn-sm" href="<?= route('admin_dokumentasi') ?>">
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
                                        <label class="form-label" for="id_q">Judul atau isi berita</label>
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
                        <th class="text-center">Judul</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Aktif</th>
                        <th class="text-center" width="120">Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                        // variabel untuk nomor urut tabel
                        $no = 1;
                        foreach ($data->getRows() as $row) {
                        ?>
                            <tr>
                                <td width="60" class="text-center"><?= $no++ ?></td>
                                <td width="auto"><div><?= $row['judul'] ?></div></td>
                                <td width="auto"><?= $row['tanggal'] ?></td>
                                <td width="auto" class="text-center"><?= $row['is_active'] === 1 ? 'Ya' : 'Tidak' ?></td>
                                <td class="text-center" width="160">
                                    <div>
                                        <!-- button view data -->
                                        <a href="<?= route('admin_dokumentasi_view', $row['id']) ?>" class="btn btn-info btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M9.8010254,4.7550061C7.5220032,5.9089983 5.5870056,7.4539969 4.2440186,8.692004 6.6970215,10.949008 11.129028,14.271 15.996033,14.271 20.863037,14.271 25.30304,10.949008 27.747986,8.692004 26.413025,7.4539969 24.470032,5.9089983 22.197998,4.7550061 22.377991,5.2720044 22.475037,5.8119982 22.475037,6.3820055 22.475037,9.5010097 19.572998,12.02901 15.996033,12.02901 12.419006,12.02901 9.5240173,9.5010097 9.5240173,6.3820055 9.5240173,5.8119982 9.6220093,5.2720044 9.8010254,4.7550061z M15.996033,0C24.830017,1.9660001E-07 32,8.692004 32,8.692004 32,8.692004 24.830017,17.383 15.996033,17.383 7.1620178,17.383 0,8.692004 0,8.692004 0,8.692004 7.1620178,1.9660001E-07 15.996033,0z" />
                                            </svg>
                                        </a>
                                        <!-- button ubah data -->
                                        <a href="<?= route('admin_dokumentasi_edit', $row['id']) ?>" class="btn btn-warning btn-sm">
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
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus dokumentasi</h1>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p class="mb-2">Yakin akan menghapus dokumentasi ini?</p>
                                                        <!-- informasi data yang akan dihapus -->
                                                        <p class="fw-bold mb-2"><?= $no ?> - <?= $row['judul'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm me-2" data-bs-dismiss="modal">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                                <path transform="rotate(0,8,8) translate(2.38418749631819E-06,0) scale(0.500000357628124,0.500000357628124)" d="M9.9000245,6.000003L6.0000001,9.8999988 12.100037,16.000007 6.0000001,22.100002 9.9000245,25.999997 16,19.900018 22.100037,25.999997 26,22.100002 19.900024,16.000007 26,9.8999988 22.100037,6.000003 16,12.099997z M16,0C24.799988,0 32,7.2000005 32,16.000007 32,24.800016 24.799988,32.000001 16,32.000001 7.2000123,32.000001 8.3946347E-08,24.800016 0,16.000007 8.3946347E-08,7.2000005 7.2000123,0 16,0z" />
                                                            </svg><span class="ms-1">Batal</span>
                                                        </button>
                                                        <!-- button proses hapus data -->
                                                        <a href="<?= route('admin_dokumentasi_delete', $row['id']) ?>" class="btn btn-success btn-sm">
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