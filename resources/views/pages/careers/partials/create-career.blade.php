<div class="modal fade" id="tambah-karir" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-career-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Karir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create-title">Judul Lamaran</label>
                        <input type="text" autofocus value="" class="form-control" id="create-title"
                            name="title" placeholder="Judul Lamaran">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-tipe">
                            Tipe Lamaran
                        </label>
                        <select class="form-control w-100" id="create-tipe" name="tipe">
                            <optgroup label="Tipe Lamaran">
                                <option value="medis">Medis</option>
                                <option value="non-medis">Non Medis</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="create-deskripsi" class="form-label">Deskripsi</label>
                        <input id="create-deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="create-deskripsi"></trix-editor>
                        @error('deskripsi')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="create-status" name="status"
                                value="on">
                            <label class="custom-control-label" for="create-status">Aktif</label>
                        </div>
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
