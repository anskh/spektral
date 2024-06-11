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
</head>

<body class="d-flex flex-column h-100">
    <?= $this->render('components/header') ?>

    <main role="main" class="flex-shrink-0 mt-3">
        <div class="container">
            <div class="row mb-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h3 class="text-danger">Page not Found (#404)</h3><br />
                    <p>Halaman tidak ditemukan.<br /></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </main>

    <button onclick="topFunction()" id="topBtn" title="Kembali ke atas">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
        </svg>
    </button>

    <?= $this->render('components/footer') ?>

    <script src="<?= base_path('/js/jquery.js') ?>"></script>
    <script src="<?= base_path('/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= base_path('/js/site.js') ?>"></script>
</body>

</html>