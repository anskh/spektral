<nav class="navbar navbar-expand-lg navbar-meta fixed-top">
    <div class="container">
        <span class="pt-1 me-5"><img src="<?= base_path('/img/spektral.png') ?>" width="50px" alt=""> <span class="bps-brand">SPEKTRAL</span></span>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div id="w0-collapse" class="collapse navbar-collapse">
            <ul id="w1" class="navbar-nav me-auto mb-2 mb-lg-0 nav">
                <li class="nav-item"><a class="nav-link<?= is_route('index') ? ' active' : '' ?>" href="<?= route('index') ?>">BERANDA</a></li>
                <li class="dropdown nav-item"><a class="dropdown-toggle nav-link<?= is_route(['modul_pembinaan', 'probis']) ? ' active' : '' ?>" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">MODUL</a>
                    <div id="w2" class="dropdown-menu">
                        <a class="dropdown-item<?= is_route('probis') ? ' active' : '' ?>" href="<?= route('probis') ?>">PROBIS STATISTIK</a>
                        <a class="dropdown-item<?= is_route('modul_pembinaan') ? ' active' : '' ?>" href="<?= route('modul_pembinaan') ?>">PEMBINAAN STATISTIK</a>
                    </div>
                </li>
                <li class="dropdown nav-item"><a class="dropdown-toggle nav-link<?= is_route(['pembinaan', 'romantik', 'metadata']) ? ' active' : '' ?>" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">LAYANAN INSTANSI</a>
                    <div id="w2" class="dropdown-menu">
                        <a class="dropdown-item<?= is_route('pembinaan') ? ' active' : '' ?>" href="<?= route('pembinaan') ?>">PERMINTAAN PEMBINAAN STATISTIK</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item<?= is_route('romantik') ? ' active' : '' ?>" href="<?= route('romantik') ?>">PENGAJUAN REKOMENDASI STATISTIK</a>
                        <a class="dropdown-item<?= is_route('metadata') ? ' active' : '' ?>" href="<?= route('metadata') ?>">PELAPORAN METADATA STATISTIK</a>
                    </div>
                </li>
                <li class="dropdown nav-item"><a class="dropdown-toggle nav-link<?= is_route(['dokumentasi','testimoni']) ? ' active' : '' ?>" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">DOKUMENTASI</a>
                    <div id="w2" class="dropdown-menu">
                        <a class="dropdown-item<?= is_route('dokumentasi') ? ' active' : '' ?>" href="<?= route('dokumentasi') ?>">PEMBINAAN STATISTIK</a>
                        <a class="dropdown-item<?= is_route('testimoni') ? ' active' : '' ?>" href="<?= route('testimoni') ?>">TESTIMONI</a>
                    </div>
                </li>
                <?php if (auth()->getIdentity()->isAuthenticated()) { ?>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link<?= is_route(['admin_index', 'user_info', 'user_update']) ? ' active' : '' ?>" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">AKUN</a>
                        <div id="w2" class="dropdown-menu">
                            <?php if (auth()->getIdentity()->getData()['is_internal']) { ?>
                                <a class="dropdown-item" href="<?= route('admin_index') ?>">HALAMAN BACKEND</a>
                            <?php } else { ?>
                                <a class="dropdown-item<?= is_route('user_info') ? ' active' : '' ?>" href="<?= route('user_info') ?>">INFORMASI</a>
                                <a class="dropdown-item<?= is_route('user_update') ? ' active' : '' ?>" href="<?= route('user_update') ?>">UBAH DATA</a>
                            <?php } ?>
                            <hr class="dropdown-divider">
                            </hr>
                            <a class="dropdown-item" href="<?= auth()->getProvider()->getLogoutUri() ?>">LOGOUT</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="btn btn-outline-success rounded-pill px-3 ms-2" href="<?= auth()->getProvider()->getLoginUri() ?>">LOGIN</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>