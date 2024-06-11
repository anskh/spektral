<div class="container">
    <div id="carouselSlides" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_path('/img/slide-1.png') ?>" class="d-block w-100" alt="slide-1">
            </div>
            <div class="carousel-item">
                <img src="<?= base_path('/img/slide-2.png') ?>" class="d-block w-100" alt="slide-2">
            </div>
            <div class="carousel-item">
                <img src="<?= base_path('/img/slide-3.png') ?>" class="d-block w-100" alt="slide-3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselSlides" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselSlides" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row mb-3">
        <h2 class="text-primary fw-bold">SPEKTRAL</h2>
        <p>Sistem Pembinaan Statistik Sektoral (SPEKTRAL) merupakan suatu alat bantu yang bertujuan untuk mewujudkan kolaborasi pembinaan statistik sektoral kepada Sumber Daya Manusia (SDM) yang ada di masing-masing Organisasi Perangkat Daerah (OPD)</p>
        <p>SPEKTRAL mempermudah Instansi atau OPD di pemerintahan daerah untuk mengakses layanan statistik baik berupa Permintaan Pembinaan Statistik, Pelaporan Metadata Statistik, maupun Pengajuan Rekomendasi Statistik.</p>
    </div>
    <h2 class="text-primary fw-bold">Modul Pembinaan Statistik</h2>

    <p>Badan Pusat Statistik (BPS) sebagai Pembina Data Statistik berupaya untuk menyediakan instrumen guna mengakselerasi tingkat kematangan penyelenggaraan statistik sektoral di pemerintahan daerah salah satunya dengan menyediakan modul-modul pembinaan statistik yang dikelompokkan dalam kategori Umum dan Peraturan, Sosial dan Kependudukan, Pertanian dan Pertambangan, dan Ekonomi dan Perdagangan.
    </p>
    <div class="row mb-5">
        <?php foreach ($data as $cat) { ?>
            <div class="col-lg-6 col-md-12 mb-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <img class="img-fluid" src="<?= site_url('/img/list.png') ?>" alt="" style="padding:10px; margin-right:10px;background-color:#567189;">
                        <div>
                            <div class="d-flex flex-column"><a class="link-primary" href="<?= route('modul_pembinaan', "/{$cat['id']}") ?>"><span class="fs-4 fw-bold"><?= $cat['nama'] ?></span></a></div>
                            <span><?= $cat['deskripsi'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>