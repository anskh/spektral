<nav class="navbar navbar-expand-lg navbar-meta fixed-top">
    <div class="container">
        <span class="pt-1 me-5"><img src="<?= base_path('/img/spektral.png') ?>" width="50px" alt=""> <span class="bps-brand">SPEKTRAL</span></span>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div id="w0-collapse" class="collapse navbar-collapse">
            <ul id="w1" class="navbar-nav me-auto mb-2 mb-lg-0 nav">
                <li class="nav-item"><a class="nav-link<?= is_route('index') ? ' active' : '' ?>" href="<?= route('index') ?>">BERANDA</a></li>
            </ul>
        </div>
    </div>
</nav>