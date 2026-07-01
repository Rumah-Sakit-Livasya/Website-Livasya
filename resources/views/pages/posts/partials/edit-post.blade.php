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
                        <label class="form-label font-weight-bold" for="edit-category">
                            Kategori Berita
                        </label>
                        <select class="form-control w-100" id="edit-category" name="category_id">
                            <optgroup label="Kategori Berita">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <small class="form-text text-muted mt-1">
                            <i class="fal fa-info-circle mr-1"></i> Pilih kategori yang paling sesuai agar berita dikelompokkan dengan benar di website utama.
                        </small>
                    </div>
                    <!-- Instagram Link Input (hidden by default) -->
                    <div class="form-group" id="edit-instagram-group" style="display: none;">
                        <label for="edit-body-text" class="font-weight-bold">Link Postingan Instagram</label>
                        <input type="text" class="form-control" id="edit-body-text" name="body" placeholder="https://www.instagram.com/p/...">
                        <small class="form-text text-muted mt-1">
                            <i class="fal fa-info-circle mr-1"></i> Tautan postingan Instagram, Reels, atau TV (misal: <code>https://www.instagram.com/p/C8o7kYNS4eX/</code>) untuk berita ini.
                        </small>
                    </div>

                    <!-- Standard Trix Editor Input for older posts (hidden by default) -->
                    <div class="form-group" id="edit-standard-group" style="display: none;">
                        <label for="edit-body" class="form-label font-weight-bold">Isi Berita</label>
                        <input id="edit-body" type="hidden" name="body" value="">
                        <trix-editor input="edit-body" id="edit-body-trix"></trix-editor>
                        <small class="form-text text-muted mt-1">
                            <i class="fal fa-info-circle mr-1"></i> Tulis konten utama berita Anda di sini. Gunakan editor di atas untuk memformat teks.
                        </small>
                    </div>
                    
                    @error('body')
                        <p class="text-danger mt-1">{{ $message }}</p>
                    @enderror
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
