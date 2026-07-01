<div class="modal fade" id="edit-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content shadow-lg" style="border-radius: 12px; border: none;">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-doctor-form">
                @method('put')
                @csrf
                <input type="hidden" name="doctor_id" id="edit-doctor-id" value="">
                <input type="hidden" id="oldImage" name="oldImage" value="">
                <input type="hidden" id="oldPoster" name="oldPoster" value="">
                <input type="hidden" id="oldJadwal" name="oldJadwal" value="">
                <div class="modal-header bg-faded">
                    <h5 class="modal-title font-weight-bold text-dark">
                        <i class="fal fa-edit text-primary mr-2" style="font-size: 1.2rem;"></i> Ubah Informasi Dokter
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
                                <label class="form-label font-weight-bold text-dark" for="edit-name">Nama Beserta Gelar</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-user"></i></span>
                                    </div>
                                    <input type="text" autofocus class="form-control" id="edit-name" name="name" placeholder="Nama Beserta Gelar" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark" for="edit-jabatan">Jabatan / Spesialisasi</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-stethoscope"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-jabatan" name="jabatan" placeholder="Jabatan" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Row 2: Deskripsi --}}
                    <div class="form-group mt-2">
                        <label class="form-label font-weight-bold text-dark" for="edit-deskripsi">Deskripsi & Biografi Dokter</label>
                        <input id="edit-deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                        <trix-editor input="edit-deskripsi" id="edit-deskripsi-text" class="bg-white border rounded" style="min-height: 150px;"></trix-editor>
                        @error('deskripsi')
                            <p class="text-danger small mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-4 border-faded">

                    {{-- Row 3: Uploads Section (Foto, Poster, Jadwal) --}}
                    <div class="row">
                        {{-- Foto Profil --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark d-block">Foto Profil Dokter</label>
                                <div class="preview-box border rounded mb-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden; position: relative;">
                                    <img class="edit-img-preview img-fluid" style="height: 100%; width: 100%; object-fit: cover;" onerror="this.style.display='none'; $(this).siblings('.placeholder-icon').show();" onload="this.style.display='block'; $(this).siblings('.placeholder-icon').hide();">
                                    <span class="placeholder-icon text-muted text-center" style="display: none;">
                                        <i class="fal fa-user-circle fs-xxl d-block mb-1"></i>
                                        <small class="d-block" style="font-size: 10px;">Belum ada foto</small>
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit-image" name="foto" onchange="editPreviewImage()">
                                    <label class="custom-file-label text-truncate" for="edit-image">Pilih gambar</label>
                                </div>
                            </div>
                        </div>

                        {{-- Poster --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark d-block">Poster Profile</label>
                                <div class="preview-box border rounded mb-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden; position: relative;">
                                    <img class="edit-poster-preview img-fluid" style="height: 100%; width: 100%; object-fit: cover;" onerror="this.style.display='none'; $(this).siblings('.placeholder-icon').show();" onload="this.style.display='block'; $(this).siblings('.placeholder-icon').hide();">
                                    <span class="placeholder-icon text-muted text-center" style="display: none;">
                                        <i class="fal fa-image fs-xxl d-block mb-1"></i>
                                        <small class="d-block" style="font-size: 10px;">Belum ada poster</small>
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit-poster" name="poster" onchange="editPreviewPoster()">
                                    <label class="custom-file-label text-truncate" for="edit-poster">Pilih gambar</label>
                                </div>
                            </div>
                        </div>

                        {{-- Jadwal --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label font-weight-bold text-dark d-block">Gambar Jadwal Praktik</label>
                                <div class="preview-box border rounded mb-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden; position: relative;">
                                    <img class="edit-jadwal-preview img-fluid" style="height: 100%; width: 100%; object-fit: cover;" onerror="this.style.display='none'; $(this).siblings('.placeholder-icon').show();" onload="this.style.display='block'; $(this).siblings('.placeholder-icon').hide();">
                                    <span class="placeholder-icon text-muted text-center" style="display: none;">
                                        <i class="fal fa-calendar-alt fs-xxl d-block mb-1"></i>
                                        <small class="d-block" style="font-size: 10px;">Belum ada jadwal</small>
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit-jadwal" name="jadwal" onchange="editPreviewJadwal()">
                                    <label class="custom-file-label text-truncate" for="edit-jadwal">Pilih gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <span class="fal fa-edit mr-1"></span>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-departement-dokter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content shadow-lg" style="border-radius: 12px; border: none;">
            <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="update-departement-doctor-form">
                @method('put')
                @csrf
                <input type="hidden" id="edit-departement-doctor-id">
                <div class="modal-header bg-faded">
                    <h5 class="modal-title font-weight-bold text-dark">
                        <i class="fal fa-building text-primary mr-2" style="font-size: 1.2rem;"></i> Ubah Departemen Dokter
                    </h5>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="form-label font-weight-bold text-dark" for="edit-departement">Pilih Departemen Baru</label>
                        <select class="form-control w-100 select2" id="edit-departement" name="departement_id" required>
                            <optgroup label="Daftar Departemen">
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <small class="form-text text-muted mt-2">Pilih departemen spesialisasi medis yang sesuai untuk dokter ini.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">
                        <span class="fal fa-save mr-1"></span>
                        Simpan Departemen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
