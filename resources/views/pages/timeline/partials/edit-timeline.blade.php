<div class="modal fade" id="edit-timeline" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-timeline-form">
                @method('put')
                @csrf
                <input type="hidden" name="timeline_id" id="edit-timeline-id" value="">
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Timeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-flag">Flag</label>
                        <input type="text" autofocus value="{{ old('flag') }} class="form-control" id="edit-flag"
                            name="flag" placeholder="Flag">
                        @error('flag')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-time">Time</label>
                        <input type="text" autofocus value="{{ old('time') }} class="form-control" id="edit-time"
                            name="time" placeholder="Time">
                        @error('time')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit-desc-text" class="form-label">Deskripsi</label>
                        <input id="edit-desc" type="hidden" name="desc" value="{{ old('desc') }}">
                        <trix-editor input="edit-desc" id="edit-desc-text"></trix-editor>
                        @error('desc')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-image">Image</label>
                        <img class="edit-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image" name="image"
                                onchange="editPreviewImage()">
                            <label class="custom-file-label" for="edit-image">Pilih gambar</label>
                        </div>
                        @error('image')
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
