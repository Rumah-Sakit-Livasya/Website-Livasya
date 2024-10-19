<div class="modal fade" id="edit-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-doctor-form">
                @method('put')
                @csrf
                <input type="hidden" name="doctor_id" id="edit-doctor-id" value="">
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <input type="hidden" id="oldPoster" name="oldPoster" value="">
                <input type="hidden" id="oldJadwal" name="oldJadwal" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-image">Foto</label>
                        <img class="edit-img-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image" name="foto"
                                onchange="editPreviewImage()">
                            <label class="custom-file-label" for="edit-image">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">Nama Beserta Gelar</label>
                        <input type="text" autofocus value="" class="form-control" id="edit-name"
                            name="name" placeholder="Nama Beserta Gelar">
                    </div>
                    <div class="form-group">
                        <label for="edit-jabatan">Jabatan</label>
                        <input type="text" value="" class="form-control" id="edit-jabatan" name="jabatan"
                            placeholder="Jabatan">
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
                        <label class="form-label d-block" for="edit-poster">Poster</label>
                        <img class="edit-poster-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-poster" name="poster"
                                onchange="editPreviewPoster()">
                            <label class="custom-file-label" for="edit-poster">Pilih gambar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label d-block" for="edit-jadwal">Jadwal</label>
                        <img class="edit-jadwal-preview img-fluid mb-3 col-sm-5">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-jadwal" name="jadwal"
                                onchange="editPreviewJadwal()">
                            <label class="custom-file-label" for="edit-jadwal">Pilih gambar</label>
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

<div class="modal fade" id="edit-departement-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data"
                id="update-departement-doctor-form">
                @method('put')
                @csrf
                <input type="hidden" id="edit-departement-doctor-id">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Departement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="edit-departement">
                            Departement
                        </label>
                        <select class="form-control w-100 select2" id="edit-departement" name="departement_id">
                            <optgroup label="Departement">
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
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
