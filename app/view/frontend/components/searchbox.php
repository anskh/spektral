<div class="search-box">
    <div class="container-fluid py-5 text-center">
        <h1 class="display-4">Metadata Statistik</h1>
        <p class="fs-5 fw-light">Temukan Metadata Statistik instansi penyelenggara kegiatan statistik di seluruh Indonesia!</p>

        <form method="get" action="/metadata/site/search">
            <div class="row justify-content-md-center">
                <div class="col-md-auto mb-2">
                    <select name="SearchForm[kategori]" class="form-select form-select-lg" id="kategori">
                        <option value="" selected>Semua Kategori</option>
                        <option value="kegiatan">Metadata Kegiatan</option>
                        <option value="variabel">Metadata Variabel</option>
                        <option value="indikator">Metadata Indikator</option>
                    </select>
                </div>
                <div class="col col-lg-6">
                    <div class="input-group mb-3">
                        <input name="SearchForm[keyword]" type="text" class="form-control form-control-lg" required>
                        <button class="btn btn-lg btn-success" type="submit" value="Submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg> Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>