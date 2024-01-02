<div class="modal fade" id="edit-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-doctor-form">
                @method('put')
                @csrf
                <input type="hidden" name="doctor_id" id="edit-doctor-id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-image">Foto</label>
                        <img class="edit-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image" name="foto"
                                onchange="editPreviewImage()">
                            <label class="custom-file-label" for="edit-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">Nama Beserta Gelar</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-name"
                            name="name" placeholder="Nama Beserta Gelar">
                    </div>
                    <div class="form-group">
                        <label for="edit-jabatan">Jabatan</label>
                        <input type="text" value="" class="form-control" id="edit-jabatan" name="jabatan"
                            placeholder="Jabatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="fal fa-edit mr-1"></span>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
