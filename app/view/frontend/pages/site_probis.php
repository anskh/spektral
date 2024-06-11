<?= $this->render('frontend/components/titlebox') ?>
<div class="container mb-5">
    <div class="mb-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <?php if ($step == 0) { ?>
                    <a class="nav-link active" aria-current="page">0-Proses Bisnis Statistik</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/0') ?>">0-Proses Bisnis Statistik</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 1) { ?>
                    <a class="nav-link active" aria-current="page">1-Specify Needs</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/1') ?>">1-Specify Needs</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 2) { ?>
                    <a class="nav-link active" aria-current="page">2-Design</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/2') ?>">2-Design</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 3) { ?>
                    <a class="nav-link active" aria-current="page">3-Build</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/3') ?>">3-Build</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 4) { ?>
                    <a class="nav-link active" aria-current="page">4-Collect</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/4') ?>">4-Collect</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 5) { ?>
                    <a class="nav-link active" aria-current="page">5-Process</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/5') ?>">5-Process</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 6) { ?>
                    <a class="nav-link active" aria-current="page">6-Analyse</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/6') ?>">6-Analyse</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 7) { ?>
                    <a class="nav-link active" aria-current="page">7-Disseminate</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/7') ?>">7-Disseminate</a>
                <?php } ?>
            </li>
            <li class="nav-item">
                <?php if ($step == 8) { ?>
                    <a class="nav-link active" aria-current="page">8-Evaluate</a>
                <?php } else { ?>
                    <a class="nav-link" href="<?= route('probis', '/8') ?>">8-Evaluate</a>
                <?php } ?>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <?php if ($step == 0) { ?>
                <p style="text-align: justify;"><i>Generic Statistical Business Process Model (GSBPM)</i> merupakan kumpulan aktivitas berkaitan dan terstruktur untuk mengubah data input
                    menjadi informasi statistik yang disajikan melalui produk fisik maupun digital. GSBPM pertama kali dikembangkan oleh
                    UNECE/Eurostat/OECD Group on Statistics Metadata (METIS) berdasarkan pada model yang biasa digunakan oleh Statistics Selandia Baru.
                    GSBPM diadopsi secara luas dan menjadi rujukan komunitas statistik di dunia, salah satunya oleh Badan Pusat Statistik selaku National Statistics Office (NSO)
                    di Indonesia dalam bentuk Satu Data Indonesia sesuai dengan Perpres No. 39 Tahun 2019. Dengan penerapan rangkaian tahapan dan aktivitas
                    dalam penyelenggaran kegiatan statistik sesuai tahapan SDI maupun GSBPM dapat mewujudkan cita-cita Sistem Statistik Nasional (SSN)
                    dalam mendukung pembangunan nasional. Terdapat 8 (delapan) tingkatan dalam model proses bisnis kegiatan statistik ini : 1) <i>Specify Needs</i>,
                    2) <i>Design</i>, 3) <i>Build</i>, 4) <i>Collect</i>, 5) <i>Process</i>, 6) <i>Analyse</i>, 7) <i>Disseminate</i>, dan 8) <i>Evaluate</i>.
                </p>
        </div>
        <div class="col-lg-12">
            <img class="w-100" src="<?= site_url('/img/gsbpm.gif') ?>" alt="GSBPM" />
        <?php } elseif ($step == 1) { ?>
            <p style="text-align: justify;">Fase <i>Specify Needs</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Mengidentifikasi Kebutuhan Dapat ditentukan berdasarkan perumusan masalah yang dikembangkan.</li>
                <li>Konsultasi & Konfirmasi Kebutuhan Tersedia informasi kebutuhan data hasil konfirmasi dengan pihak terkait.</li>
                <li>Menentukan Tujuan Dapat berupa output dalam bentuk data atau indikator statistik yang diperlukan.</li>
                <li>Identifikasi Konsep & Definisi: Rincian definisi variabel, manfaat, dan darimana diperoleh. Dapat merujuk pada Glosarium yang terdapat pada Website indah.bps.go.id</li>
                <li>Memeriksa ketersediaan data Info ketersediaan data (misalnya pada instansi lain), dapat diperiksa pada website maupun publikasi terkait.</li>
                <li>Membuat TOR atau proposal kegiatan Periksa apakah anggaran tersedia.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/1. Specified Need.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 2) { ?>
            <p style="text-align: justify;">Fase <i>Design</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Merancang output Tentukan output yang akan dihasilkan seperti tabel, grafik, dan analisis mengenai data.</li>
                <li>Merancang deskripsi variabel Pastikan tersedia konsep, defiisi, ukuran, satuan, dan klasifikasi.</li>
                <li>Merancang pengumpulan data Tentukan metode pengumpulan data yang akan digunakan.</li>
                <li>Merancang kerangka sampel Tentukan kerangka sampel, jumlah sampel, alokasi sampel unit analisis.</li>
                <li>Merancang metode pengambilan sampel Metode pengambilan sampel terdiri dari dua jenis, yaitu <i>probability sampling</i> dan <i>non-probability sampling</i>.</li>
                <li>Merancang pengolahan dan analisis Meliputi rancangan pengkodean (coding), editing, imputasi, estimasi, pengintegrasian, validasi, dan finalisasi data.</li>
                <li>Merancang sistem dan alur kerja Merancang alur kerja mulai dari pengumpulan data sampai dengan diseminasi beserta penjelasan rinci pada setiap proses.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/2. Design and Build.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 3) { ?>
            <p style="text-align: justify;">Fase <i>Build</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Membuat instrumen pengumpulan data (kuesioner): Menentukan jenis serta urutan pertanyaan.</li>
                <li>Membangun komponen proses dan diseminasi: Membangun alat yang akan digunakan untuk proses data, juga komponen penyusun diseminasi.</li>
                <li>Menguji sistem, instrumen, dan proses bisnis statistik: Melakukan uji validitas dan uji reliabilitas kuesioner.</li>
                <li>Memastikan alur kerja berjalan dengan baik.</li>
                <li>Finalisasi sistem.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/2. Design and Build.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 4) { ?>
            <p style="text-align: justify;">Fase <i>Collect</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Membangun kerangka sampel dan pemilihan sampel: Memilih sampel (jika menggunakan sampel).</li>
                <li>Mempersiapkan pengumpulan data melalui pelatihan petugas: Mempersiapkan petugas yang andal sesuai SOP dan memahami konsep dan definisi.</li>
                <li>Melakukan pengumpulan data Pelaksanaan pengumpulan data.</li>
                <li>Finalisasi pengumpulan data: Dilakukan pengecekan untuk menghindari kesalahan.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/3. Collect.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 5) { ?>
            <p style="text-align: justify;">Fase <i>Process</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Integrasi data: Melakukan entri data dan mengintegrasikan data yang telah dikumpulkan.</li>
                <li>Penyuntingan (editing), penyahihan (validation), dan imputasi: Melakukan cleaning data, imputasi (jika perlu).</li>
                <li>Menghitung penimbang (weight): Supaya karakteristik populasi dapat terukur secara baik, maka digunakanlah penimbang/bobot (weight). Penimbang (weight) adalah suatu nilai yang menyatakan seberapa besar unit sampel mewakili karakteristik populasinya.</li>
                <li>Melakukan estimasi dan agregasi: Finalisasi dataset/data mikro yang dihasilkan.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/4. Process.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 6) { ?>
            <p style="text-align: justify;">Fase <i>Analyse</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Menyiapkan naskah output (tabulasi): Data mentah <i>(raw data)</i> telah ditransformasi sesuai dengan output ataupun indikator yang akan ditampilkan.</li>
                <li>Penyahihan output (pemeriksaan konsistensi antartabel): Validasi dilakukan dengan cara membandingkan antara hasil yang diharapkan dengan output yang dihasilkan.</li>
                <li>Interpretasi output: Menafsir dan menjelaskan output dengan menggunakan analisis statistik yang telah direncanakan pada tahap sebelumnya.</li>
                <li>Penerapan Disclosure Control: Memastikan bahwa data dan metadata yang akan dipublikasikan tidak melanggar kerahasiaan.</li>
                <li>Finalisasi output.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/5. Analyze.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 7) { ?>
            <p style="text-align: justify;">Fase <i>Disseminate</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Sinkronisasi antara data dengan metadata: Keseluruhan informasi akan kegiatan statistik dikumpulkan menjadi metadata kegiatan statistik.</li>
                <li>Menghasilkan produk diseminasi proses pengemasan dan penyajian agar dapat dimanfaatkan oleh pengguna data.</li>
                <li>Manajemen rilis produk diseminasi: Pengelolaan rilis produk statistik meliputi penyiapan jadwal dan sarana penyebaran informasi akan produk statistik yang dirilis organisasi, penyediaan produk ke pengguna data, termasuk juga pengaturan mekanisme pembagian akses data yang bersifat rahasia kepada pemangku kepentingan tertentu.</li>
                <li>Mempromosikan produk diseminasi: Langkah aktif untuk memperkenalkan ke khalayak seluas mungkin tentang produk-produk statistik yang telah dihasilkan.</li>
                <li>Manajemen user support: Menyediakan layanan pendukung tambahan untuk memenuhi kebutuhan pengguna data.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/6. Disseminate _ Evaluate.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } elseif ($step == 8) { ?>
            <p style="text-align: justify;">Fase <i>Evaluate</i> terdiri dari beberapa sub-process sebagai berikut :</p>
            <ol style="list-style: decimal;">
                <li>Mengumpulkan masukan evaluasi: Materi atau bahan evaluasi dapat dikumpulkan pada tiap tahapan, mulai dari perencanaan hingga penyebarluasan. Masukan dapat berupa saran dari pengguna data, umpan balik kepuasan pengguna data, saran dari petugas, dsb..</li>
                <li>Evaluasi hasil: Laporan Evaluasi berisi berbagai kendala yang ditemui beserta rekomendasi solusi perbaikan yang diperlukan.</li>
            </ol>
            <p class="mt-4 ms-3"><a href="<?= site_url('/uploads/gsbpm/6. Disseminate _ Evaluate.pdf') ?>" class="btn btn-success text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg> Unduh</a>
            </p>
        <?php } ?>
        </div>
    </div>
</div>