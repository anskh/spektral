<div class="breadcrumb-box mt-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= route('admin_index') ?>">BERANDA</a></li>
                <?php foreach($breadcrumbs as $menu => $link) { ?>
                    <li class="breadcrumb-item"><a href="<?= $link ?>"><?= $menu ?></a></li>
                <?php } ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $page ?></li>
            </ol>
        </nav>
    </div>
</div> 