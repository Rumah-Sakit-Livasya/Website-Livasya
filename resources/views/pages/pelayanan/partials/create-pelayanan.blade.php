<div class="modal fade" id="tambah-pelayanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-pelayanan-form">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-icon">Icon</label>
                        <input type="text" autofocus value="" class="form-control" id="create-icon"
                            name="icon" placeholder="Icon Fontawesome">
                    </div>
                    <div class="form-group">
                        <label for="create-title">Nama Pelayanan</label>
                        <input type="text" autofocus value="" class="form-control" id="create-title"
                            name="title" placeholder="Nama Pelayanan">
                    </div>
                    <div class="form-group">
                        <label for="create-slug">Slug</label>
                        <input type="text" value="" class="form-control" id="create-slug" name="slug"
                            placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label for="create-body" class="form-label">Isi Pelayanan</label>
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
