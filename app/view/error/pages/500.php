<div class="container my-5 pt-5">
    <div class="row">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h3 class="text-danger">System Error (#500)</h3><br />
            <p>Terjadi kesalahan sistem.</p>
            <p>Pesan: <?= $error->getMessage() ?>.<br /></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>