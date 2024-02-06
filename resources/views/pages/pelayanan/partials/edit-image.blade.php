<div class="modal fade" id="edit-pelayanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-pelayanan-form">
                @method('put')
                @csrf
                <input type="hidden" name="pelayanan_id" id="edit-pelayanan-id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-icon">Icon</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-icon"
                            name="icon" placeholder="Icon Fontawesome">
                    </div>
                    <div class="form-group">
                        <label for="edit-title">Nama Pelayanan</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-title"
                            name="title" placeholder="Nama Pelayanan">
                    </div>
                    <div class="form-group">
                        <label for="edit-slug">Slug</label>
                        <input type="text" value="" class="form-control" id="edit-slug" name="slug"
                            placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label for="edit-body" class="form-label">Isi Pelayanan</label>
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
