<!-- template from sirusa.web.bps.go.id -->
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="SPEKTRAL - Sistem Pembinaan Statistik Sektoral">
    <meta name="description" content="Sistem yang bertujuan untuk mewujudkan kolaborasi pembinaan statistik sektoral kepada Sumber Daya Manusia (SDM) yang ada di masing-masing Organisasi Perangkat Daerah (OPD)">

    <title><?= esc($title) ?></title>

    <link rel="icon" type="image/x-icon" href="<?= base_path('/img/bps.ico') ?>">
    <link href="<?= base_path('/css/bootstrap.css') ?>" rel="stylesheet">
    <link href="<?= base_path('/css/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_path('/css/site.css') ?>" rel="stylesheet">
    <?php if (!empty($cssAssets)) {
        foreach ($cssAssets as $css) { ?>
            <link href="<?= base_path($css) ?>" rel="stylesheet">
    <?php }
    } ?>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?= $this->render('frontend' . DS . 'components' . DS . 'header') ?>
    </header>
    <?php if (isset($breadcrumbs)) { ?>
        <?= $this->render('frontend' . DS . 'components' . DS . 'breadcrumb') ?>
    <?php
    } ?>
    <main role="main" class="flex-shrink-0">
        <?= $this->render('frontend' . DS . 'pages' . DS . $content) ?>
    </main>
    <footer class="footer mt-auto py-3 text-muted bg-footer">
        <?= $this->render('frontend' . DS . 'components' . DS . 'footer') ?>
    </footer>
    <button onclick="topFunction()" id="topBtn" title="Kembali ke atas">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
        </svg>
    </button>
    <script src="<?= base_path('/js/bootstrap.bundle.js') ?>"></script>
    <script src="<?= base_path('/js/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_path('/js/site.js') ?>"></script>
    <?php if (!empty($jsAssets)) {
        foreach ($jsAssets as $js) { ?>
            <script src="<?= base_path($js) ?>"></script>
    <?php }
    } ?>
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