<div class="modal fade" id="edit-jadwal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-jadwal-form"
                data-id="">
                @method('put')
                @csrf
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <input type="hidden" id="oldThumbnail" name="oldThumbnail" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-thumbnail">Thumbnail</label>
                        <img class="edit-thumbnail-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-thumbnail" name="thumbnail"
                                onchange="editPreviewThumbnail()">
                            <label class="custom-file-label" for="edit-thumbnail">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-image">Image</label>
                        <img class="edit-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image" name="image"
                                onchange="editPreviewImage()">
                            <label class="custom-file-label" for="edit-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-caption" class="form-label">
                            Caption
                        </label>
                        <input id="edit-caption" type="hidden" name="caption" value="{{ old('caption') }}">
                        <trix-editor input="edit-caption" id="edit-caption-text"></trix-editor>
                        @error('caption')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
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
