<div class="modal fade" id="edit-departement-tab" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content shadow-lg" style="border-radius: 12px; border: none;">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-departement-tab-form">
                @method('put')
                @csrf
                <input type="hidden" name="departement_id" id="edit-departement-tab-id" value="">
                <div class="modal-header bg-faded">
                    <h5 class="modal-title font-weight-bold text-dark">
                        <i class="fal fa-edit text-primary mr-2" style="font-size: 1.1rem;"></i> Ubah Departemen
                    </h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="form-label font-weight-bold text-dark" for="edit-departement-tab-name">Nama Departemen</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-building"></i></span>
                            </div>
                            <input type="text" autofocus class="form-control" id="edit-departement-tab-name"
                                name="name" placeholder="Nama Departemen" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label font-weight-bold text-dark" for="edit-departement-tab-urutan">Urutan Tampil</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-sort-numeric-up"></i></span>
                            </div>
                            <input type="number" class="form-control" id="edit-departement-tab-urutan"
                                name="urutan" placeholder="Urutan" min="1" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <span class="fal fa-save mr-1"></span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
