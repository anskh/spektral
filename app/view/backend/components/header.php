<header>
    <nav id="w0" class="navbar navbar-expand-md navbar-meta fixed-top">
        <div class="container">
            <span class="pt-1 me-5"><img src="<?= base_path('/img/bps.png') ?>" width="50px" alt=""> <span class="bps-brand">SPEKTRAL BACKEND</span></span>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav me-auto mb-2 mb-md-0 nav">
                    <li class="nav-item"><a class="nav-link<?= is_route('admin_index') ? ' active' : '' ?>" href="<?= route('admin_index') ?>">BERANDA</a></li>
                    <li class="nav-item"><a class="nav-link<?= is_route('admin_modul') ? ' active' : '' ?>" href="<?= route('admin_modul') ?>">MODUL</a></li>
                    <li class="nav-item"><a class="nav-link<?= is_route(['admin_pembinaan','admin_pembinaan_view']) ? ' active' : '' ?>" href="<?= route('admin_pembinaan') ?>">PEMBINAAN</a></li>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link<?= is_route(['admin_dokumentasi','admin_testimoni','admin_dokumentasi_view','admin_dokumentasi_edit','admin_testimoni_edit']) ? ' active' : '' ?>" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">DOKUMENTASI</a>
                        <div id="w2" class="dropdown-menu">
                            <a class="dropdown-item<?= is_route(['admin_dokumentasi','admin_dokumentasi_view','admin_dokumentasi_edit']) ? ' active' : '' ?>" href="<?= route('admin_dokumentasi') ?>">PEMBINAAN STATISTIK</a>
                            <a class="dropdown-item<?= is_route(['admin_testimoni','admin_testimoni_edit']) ? ' active' : '' ?>" href="<?= route('admin_testimoni') ?>">TESTIMONI</a>
                        </div>
                    </li>
                    <?php if (auth()->hasRole('admin')) { ?>
                        <li class="nav-item"><a class="nav-link<?= is_route(['admin_user', 'admin_user_view', 'admin_user_edit']) ? ' active' : '' ?>" href="<?= route('admin_user') ?>">USER</a></li>
                    <?php } ?>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link<?= is_route('admin_user_info') ? ' active' : '' ?>" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">AKUN</a>
                        <div id="w2" class="dropdown-menu">
                            <a class="dropdown-item" href="<?= route('admin_user_info') ?>">INFORMASI</a>
                            <a class="dropdown-item" href="<?= route('index') ?>">HALAMAN FRONTEND</a>
                            <hr class="dropdown-divider">
                            </hr>
                            <a class="dropdown-item" href="<?= auth()->getProvider()->getLogoutUri() ?>">LOGOUT</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>