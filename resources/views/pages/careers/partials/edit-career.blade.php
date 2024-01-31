<div class="modal fade" id="edit-karir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-career-form">
                @method('put')
                @csrf
                <input type="hidden" name="career_id" id="edit-career-id" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Karir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-title">Judul Lamaran</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-title"
                            name="title" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="edit-tipe">
                            Tipe Lamaran
                        </label>
                        <select class="form-control w-100" id="edit-tipe" name="tipe">
                            <optgroup label="Tipe Lamaran">
                                <option value="medis">Medis</option>
                                <option value="non-medis">Non Medis</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                        <input id="edit-deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="edit-deskripsi" id="edit-deskripsi-text"></trix-editor>
                        @error('deskripsi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="edit-status" name="status"
                                value="on">
                            <label class="custom-control-label" for="edit-status">Aktif</label>
                        </div>
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
