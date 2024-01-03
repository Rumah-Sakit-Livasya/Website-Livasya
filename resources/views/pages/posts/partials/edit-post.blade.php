<div class="modal fade" id="edit-berita" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-post-form">
                @method('put')
                @csrf
                <input type="hidden" name="user_id" id="edit-user-id" value="">
                <input type="hidden" name="post_id" id="edit-post-id" value="">
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Berita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-title">Judul</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-title"
                            name="title" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label for="edit-slug">Slug</label>
                        <input type="text" value="" class="form-control" id="edit-slug" name="slug"
                            placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-category">
                            Kategori Berita
                        </label>
                        <select class="form-control w-100" id="edit-category" name="category_id">
                            <optgroup label="Kategori Berita">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-image">Gambar Berita</label>
                        <img class="edit-img-preview img-fluid mb-3 col-sm-5" alt="Image">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image" name="image"
                                onchange="editPreviewImage()">
                            <label class="custom-file-label" for="edit-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-body" class="form-label">Isi Berita</label>
                        <input id="edit-body" type="hidden" name="body" value="{{ old('body') }}">
                        <trix-editor input="edit-body" id="edit-body-text"></trix-editor>
                        @error('body')
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
