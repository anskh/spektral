<div class="container my-3">
    <h3 class="text-primary py-3 mb-3">INFORMASI PENGGUNA</h3>
    <div class="row mb-3">
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">Nama</span>
            <div><?= $row['nama'] ?></div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">NIP</span>
            <div><?= $row['nip'] ?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">Email</span>
            <div><?= $row['email'] ?></div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">Nomor HP</span>
            <div><?= $row['nomor_wa'] ?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">Instansi</span>
            <div><?= $row['instansi'] ?></div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">Tingkat</span>
            <div><?= $row['tingkat'] ?></div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-4 col-sm-6">
            <span class="text-muted">Jabatan</span>
            <div><?= $row['jabatan'] ?></div>
        </div>
    </div>
</div>