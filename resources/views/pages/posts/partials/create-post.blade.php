<div class="modal fade" id="tambah-berita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-post-form">
                @method('post')
                @csrf
                <input type="hidden" name="user_id" id="create-user-id" value="{{ auth()->user()->id }}">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-title">Judul</label>
                        <input type="text" autofocus value="" class="form-control" id="create-title"
                            name="title" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label for="create-slug">Slug</label>
                        <input type="text" value="" class="form-control" id="create-slug" name="slug"
                            placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-category">
                            Kategori Berita
                        </label>
                        <select class="form-control w-100" id="create-category" name="category_id">
                            <optgroup label="Kategori Berita">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
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
                        <label for="create-body" class="form-label">Isi Berita</label>
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
