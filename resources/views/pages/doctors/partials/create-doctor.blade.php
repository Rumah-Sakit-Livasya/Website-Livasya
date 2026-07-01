<div class="modal fade" id="tambah-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg" style="border-radius: 12px; border: none;">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-doctor-form">
                @method('post')
                @csrf
                <div class="modal-header bg-faded">
                    <h5 class="modal-title font-weight-bold text-dark">
                        <i class="fal fa-user-md text-primary mr-2" style="font-size: 1.2rem;"></i> Tambah Dokter Baru
                    </h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    {{-- Row 1: Nama & Jabatan --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark" for="create-name">Nama Beserta Gelar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-user"></i></span>
                                    </div>
                                    <input type="text" autofocus class="form-control" id="create-name" name="name" placeholder="Contoh: dr. H. Ling S Sudjono, Sp.OG" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark" for="create-jabatan">Jabatan / Spesialisasi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-stethoscope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="create-jabatan" name="jabatan" placeholder="Contoh: Dokter Spesialis Obgyn" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Row 2: Departement --}}
                    <div class="form-group mt-2">
                        <label class="form-label font-weight-bold text-dark" for="create-departement">Departement</label>
                        <select class="form-control w-100 select2" id="create-departement" name="departement_id" required>
                            <optgroup label="Pilih Departement">
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>

                    {{-- Row 3: Deskripsi --}}
                    <div class="form-group mt-2">
                        <label class="form-label font-weight-bold text-dark" for="create-deskripsi">Deskripsi & Biografi Dokter</label>
                        <input id="create-deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="create-deskripsi" class="bg-white border rounded" style="min-height: 150px;"></trix-editor>
                        @error('deskripsi')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-4 border-faded">

                    {{-- Row 4: Uploads Section (Foto, Poster, Jadwal) --}}
                    <div class="row">
                        {{-- Foto Profil --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark d-block">Foto Profil Dokter</label>
                                <div class="preview-box border rounded mb-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden;">
                                    <img class="create-img-preview img-fluid" style="display: none; height: 100%; width: 100%; object-fit: cover;">
                                    <span class="placeholder-icon text-muted text-center" id="photo-placeholder">
                                        <i class="fal fa-user-circle fs-xxl d-block mb-1"></i>
                                        <small class="d-block" style="font-size: 10px;">Format: JPG, PNG</small>
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="create-image" name="foto" onchange="createPreviewImage(); $('#photo-placeholder').hide();" required>
                                    <label class="custom-file-label text-truncate" for="create-image">Pilih gambar</label>
                                </div>
                            </div>
                        </div>

                        {{-- Poster --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark d-block">Poster Profile</label>
                                <div class="preview-box border rounded mb-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden;">
                                    <img class="create-poster-preview img-fluid" style="display: none; height: 100%; width: 100%; object-fit: cover;">
                                    <span class="placeholder-icon text-muted text-center" id="poster-placeholder">
                                        <i class="fal fa-image fs-xxl d-block mb-1"></i>
                                        <small class="d-block" style="font-size: 10px;">Format: JPG, PNG</small>
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="create-poster" name="poster" onchange="createPreviewPoster(); $('#poster-placeholder').hide();">
                                    <label class="custom-file-label text-truncate" for="create-poster">Pilih gambar</label>
                                </div>
                            </div>
                        </div>

                        {{-- Jadwal --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark d-block">Gambar Jadwal Praktik</label>
                                <div class="preview-box border rounded mb-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden;">
                                    <img class="create-jadwal-preview img-fluid" style="display: none; height: 100%; width: 100%; object-fit: cover;">
                                    <span class="placeholder-icon text-muted text-center" id="jadwal-placeholder">
                                        <i class="fal fa-calendar-alt fs-xxl d-block mb-1"></i>
                                        <small class="d-block" style="font-size: 10px;">Format: JPG, PNG</small>
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="create-jadwal" name="jadwal" onchange="createPreviewJadwal(); $('#jadwal-placeholder').hide();">
                                    <label class="custom-file-label text-truncate" for="create-jadwal">Pilih gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary font-weight-bold" id="create-button">
                        <span class="fal fa-plus-circle mr-1"></span>
                        Simpan Dokter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
