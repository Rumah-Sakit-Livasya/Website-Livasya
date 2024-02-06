<div class="modal fade" id="tambah-image" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-image-form">
                @method('post')
                @csrf
                <input type="hidden" name="pelayanan_id" value="{{ $pelayanan->id }}">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="create-image">Galeri</label>
                        <img class="create-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-image" name="image"
                                onchange="createPreviewImage()">
                            <label class="custom-file-label" for="create-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-thumb">Thumbnail</label>
                        <img class="create-thumb-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-thumb" name="thumbnail"
                                onchange="createPreviewThumb()">
                            <label class="custom-file-label" for="create-thumb">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create-caption">Caption</label>
                        <input type="text" autofocus value="" class="form-control" id="create-caption"
                            name="caption" placeholder="Caption">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="create-button">
                        <span class="fal fa-plus-circle mr-1"></span>
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
