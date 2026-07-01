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
                        <label class="form-label font-weight-bold" for="create-category">
                            Kategori Berita
                        </label>
                        <select class="form-control w-100" id="create-category" name="category_id">
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
                    <input type="hidden" name="is_embeded" value="1">
                    <div class="form-group mb-0">
                        <label for="create-body" class="font-weight-bold">Link Postingan Instagram</label>
                        <input type="text" class="form-control" id="create-body" name="body" placeholder="https://www.instagram.com/p/..." value="{{ old('body') }}">
                        <small class="form-text text-muted mt-1">
                            <i class="fal fa-info-circle mr-1"></i> Wajib memasukkan tautan postingan Instagram, Reels, atau TV (misal: <code>https://www.instagram.com/p/C8o7kYNS4eX/</code>) untuk dijadikan sebagai berita.
                        </small>
                        @error('body')
                            <p class="text-danger mt-1">{{ $message }}</p>
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
