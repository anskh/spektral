<div class="container my-3">
    <h3 class="text-primary py-3"><?= $row['judul'] ?></h3>
    <p class="text-muted mb-2"><?= $row['nama'] ?>, <?= $row['tanggal'] ?></p>
    <div class="row">
        <div class="col justify-content-between">
            <?= $row['gambar'] ? '<img style="width:40%" class="img-thumbnail float-start mb-3 me-3" src="' .site_url('/uploads/dokumentasi/img/' . $row['gambar']) . '">' : '' ?>
            <p style="text-align: justify;"> <?= $row['berita'] ?></p>
        </div>
    </div>
    <hr>
    <div class="row mb-5">
        <div class="d-flex justify-content-center">
            <a href="<?= route('dokumentasi') ?>" class="btn btn-secondary rounded-pill py-2 px-5 me-2">Kembali</a>
        </div>
    </div>
</div>