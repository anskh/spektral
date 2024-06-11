<!DOCTYPE html>
<html lang="en-US" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="SPEKTRAL - Sistem Pembinaan Statistik Sektoral">
    <meta name="description" content="Sistem yang bertujuan untuk mewujudkan kolaborasi pembinaan statistik sektoral kepada Sumber Daya Manusia (SDM) yang ada di masing-masing Organisasi Perangkat Daerah (OPD)">

    <title><?= esc($title) ?></title>

    <link rel="icon" type="image/x-icon" href="<?= base_path('/img/bps.ico') ?>">

    <link href="<?= base_path('/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= base_path('/css/site.css') ?>" rel="stylesheet">
    <link href="<?= base_path('/css/sweetalert2.min.css') ?>" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?= $this->render('components/admin_header') ?>
    <?= $this->render('components/admin_breadcrumb', compact('page')) ?>

    <main role="main" class="flex-shrink-0">
        <?= $this->render('components/titlebox', compact('page', 'page_desc')) ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="d-flex flex-column flex-shrink-0 p-3 pb-2 bg-light">
                        <a href="/" class="d-flex align-items-center text-decoration-none">
                            <span class="fs-4">MENU</span>
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item">
                                <a href="#" class="nav-link active" aria-current="page">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    Orders
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    Products
                                </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link">
                                    Customers
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-white border-bottom">
                            <div class="mb-3">
                                <h5 class="card-title mb-0">Daftar Pengguna</h5>
                            </div>
                            <div class="mb-3">
                                <form method="GET" action="<?= current_url() ?>" class="row">
                                    <div class="col-auto">
                                        <select name="limit" onchange="this.form.submit()" class="form-select py-2">
                                            <option value="10" <?= ($data['pagination']->per_page === 10 ? 'selected' : '') ?>>10</option>
                                            <option value="25" <?= ($data['pagination']->per_page === 25 ? 'selected' : '') ?>>25</option>
                                            <option value="50" <?= ($data['pagination']->per_page === 50 ? 'selected' : '') ?>>50</option>
                                            <option value="100" <?= ($data['pagination']->per_page === 100 ? 'selected' : '') ?>>100</option>
                                        </select>
                                    </div>
                                    <input name="page" value="<?= $data['pagination']->current_page ?>" type="hidden">
                                    <div class="col-auto"><input name="q" onchange="this.form.submit()" class="form-control" placeholder="Nama atau email" value="<?= (empty($_GET['q']) ? '' : $_GET['q'])  ?>"></div>
                                </form>
                            </div>
                            <div>
                                <a href="" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead class="table-light">
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Jenis Akun</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Aktif</th>
                                    <th class="text-center">Aksi</th>
                                </thead>
                                <tbody>
                                    <?php
                                    // variabel untuk nomor urut tabel
                                    $no = 1;
                                    foreach ($data['rows'] as $row) {
                                    ?>
                                        <tr>
                                            <td width="auto" class="text-center"><?= $no++ ?></td>
                                            <td width="auto" class="text-center"><?= $row['nama'] ?></td>
                                            <td width="auto" class="text-center"><?= $row['email'] ?></td>
                                            <td width="auto" class="text-center"><?= str_contains($row['email'], '@bps.go.id') ? 'Internal' : 'Eksternal' ?></td>
                                            <td width="auto"><?= str_replace(',', ', ' , $row['role']) ?></td>
                                            <td width="auto" class="text-center"><?= $row['is_active'] === 1 ? 'Ya' : 'Tidak' ?></td>
                                            <td width="auto" class="text-center">
                                                <div>
                                                    <!-- button form ubah data -->
                                                    <a href="" class="btn btn-success btn-xs"> <i class="fa-solid fa-pencil me-1"></i> Ubah </a>
                                                    <!-- button modal hapus data -->
                                                    <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>"> <i class="fa-solid fa-trash-can me-1"></i> Hapus </button>
                                                    <!-- Modal hapus data -->
                                                    <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        <i class="fa-regular fa-trash-can me-2"></i> Hapus Memorandum Keluar
                                                                    </h1>
                                                                </div>
                                                                <div class="modal-body text-start">
                                                                    <p class="mb-2">Anda yakin ingin menghapus memorandum keluar ini?</p>
                                                                    <!-- informasi data yang akan dihapus -->
                                                                    <p class="fw-bold mb-2"><?= $row['nomor_naskah'] ?> <span class="fw-normal">-</span> <?= $row['perihal'] ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary rounded-pill px-3 me-2" data-bs-dismiss="modal">Batal</button>
                                                                    <!-- button proses hapus data -->
                                                                    <a href="" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
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
                        <div class="card-footer bg-white d-md-flex align-items-center">
                            <div class="me-auto">
                                <span class="text-secondary">Showing <?= $no > 1 ? 1 : 0 ?> to <?= $no - 1 ?> of <?= $data['pagination']->total_records ?> entries</span>
                            </div>
                            <?= $data['pagination'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <button onclick="topFunction()" id="topBtn" title="Kembali ke atas">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
        </svg>
    </button>

    <?= $this->render('components/admin_footer') ?>

    <script src="<?= base_path('/js/jquery.js') ?>"></script>
    <script src="<?= base_path('/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= base_path('/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_path('/js/site.js') ?>"></script>
    <script>
        // when has flash message
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                <?php if (session()->hasFlash()) {
                    foreach (session()->flash() as $flash) {
                        echo sweet_alert($flash);
                    }
                }
                ?>
            }
        }
    </script>
</body>

</html>