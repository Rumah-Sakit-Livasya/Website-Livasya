<div class="modal fade" id="tambah-departement" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content shadow-lg" style="border-radius: 12px; border: none;">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-departement-form">
                @method('post')
                @csrf
                <div class="modal-header bg-faded">
                    <h5 class="modal-title font-weight-bold text-dark">
                        <i class="fal fa-plus-circle text-primary mr-2" style="font-size: 1.1rem;"></i> Tambah Departemen Baru
                    </h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="form-label font-weight-bold text-dark" for="create-departement-name">Nama Departemen</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-building"></i></span>
                            </div>
                            <input type="text" autofocus class="form-control" id="create-departement-name"
                                name="name" placeholder="Contoh: Spesialis Obstetri dan Ginekologi" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label font-weight-bold text-dark" for="create-departement-urutan">Urutan Tampil</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-sort-numeric-up"></i></span>
                            </div>
                            <input type="number" class="form-control" id="create-departement-urutan"
                                name="urutan" placeholder="Contoh: 1" min="1" required>
                        </div>
                        <small class="form-text text-muted mt-1">Angka urutan menentukan posisi tampil departemen di halaman publik.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-purple font-weight-bold" id="create-departement-button"
                        style="background-color: #7c3aed; color: #fff; border-color: #7c3aed;">
                        <span class="fal fa-plus-circle mr-1"></span>
                        Simpan Departemen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
