<div class="breadcrumb-box pt-2 pb-1">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol id="w3" class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= route('index') ?>">BERANDA</a></li>
                <?php foreach ($breadcrumbs as $menu => $link) { ?>
                    <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $menu ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $page ?></li>
            </ol>
        </nav>
    </div>
</div>