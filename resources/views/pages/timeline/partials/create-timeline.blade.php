<div class="modal fade" id="tambah-timeline" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-timeline-form">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Timeline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-flag">Flag</label>
                        <input type="text" autofocus value="{{ old('flag') }}" class="form-control"
                            id="create-flag" name="flag" placeholder="Flag">
                        @error('flag')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="create-time">Time</label>
                        <input type="text" autofocus value="{{ old('time') }}" class="form-control"
                            id="create-time" name="time" placeholder="Time">
                        @error('time')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="create-desc" class="form-label">Deskripsi</label>
                        <input id="create-desc" type="hidden" name="desc" value="{{ old('desc') }}">
                        <trix-editor input="create-desc"></trix-editor>
                        @error('desc')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-image">Image</label>
                        <img class="create-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-image" name="image"
                                onchange="createPreviewImage()">
                            <label class="custom-file-label" for="create-image">Pilih gambar</label>
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
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
