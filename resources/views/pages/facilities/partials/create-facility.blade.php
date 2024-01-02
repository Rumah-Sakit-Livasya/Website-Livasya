<div class="modal fade" id="tambah-fasilitas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-facility-form">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Fasilitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="create-unggulan">
                            Unggulan
                        </label>
                        <select class="form-control w-100" id="create-unggulan" name="unggulan">
                            <optgroup label="Apakah Fasilitas Unggulan?">
                                <option value="Tidak">Tidak</option>
                                <option value="Ya">Ya</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="create-icon">Icon</label>
                        <input type="text" autofocus value="" class="form-control" id="create-icon"
                            name="icon" placeholder="Icon Fontawesome">
                    </div>
                    <div class="form-group">
                        <label for="create-name">Nama Fasilitas</label>
                        <input type="text" autofocus value="" class="form-control" id="create-name"
                            name="name" placeholder="Nama Fasilitas">
                    </div>
                    <div class="form-group">
                        <label for="create-slug">Slug</label>
                        <input type="text" value="" class="form-control" id="create-slug" name="slug"
                            placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-image">Gambar Berita</label>
                        <img class="create-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-image" name="image"
                                onchange="createPreviewImage()">
                            <label class="custom-file-label" for="create-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create-body" class="form-label">Isi Fasilitas</label>
                        <input id="create-body" type="hidden" name="body" value="{{ old('body') }}">
                        <trix-editor input="create-body"></trix-editor>
                        @error('body')
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
