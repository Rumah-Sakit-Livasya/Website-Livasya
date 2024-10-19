<div class="modal fade" id="tambah-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-doctor-form">
                @method('post')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="create-image">Foto</label>
                        <img class="create-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-image" name="foto"
                                onchange="createPreviewImage()">
                            <label class="custom-file-label" for="create-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="create-name">Nama Beserta Gelar</label>
                        <input type="text" autofocus value="" class="form-control" id="create-name"
                            name="name" placeholder="Nama Beserta Gelar">
                    </div>
                    <div class="form-group">
                        <label for="create-jabatan">Jabatan</label>
                        <input type="text" value="" class="form-control" id="create-jabatan" name="jabatan"
                            placeholder="Jabatan">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-departement">
                            Departement
                        </label>
                        <select class="form-control w-100 select2" id="create-departement" name="departement_id">
                            <optgroup label="Departement">
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
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
                        <label class="form-label" for="create-poster">Poster</label>
                        <img class="create-poster-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-poster" name="poster"
                                onchange="createPreviewPoster()">
                            <label class="custom-file-label" for="create-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-jadwal">Jadwal</label>
                        <img class="create-jadwal-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="create-jadwal" name="jadwal"
                                onchange="createPreviewJadwal()">
                            <label class="custom-file-label" for="create-image">Pilih gambar</label>
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
