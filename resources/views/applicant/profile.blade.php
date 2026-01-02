@extends('layouts.main')

@section('container')
    <section class="profile-section py-5" style="min-height: 80vh; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-5">
                            <h3 class="font-weight-bold text-dark mb-1">Lengkapi Profil Anda</h3>
                            <p class="text-muted">Silahkan lengkapi data diri Anda untuk melanjutkan proses lamaran.</p>
                        </div>
                        <div class="card-body p-5">

                            @if (session('status'))
                                <div class="alert alert-success mb-4">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('applicant.profile.store') }}">
                                @csrf

                                <!-- Email (Readonly) -->
                                <div class="mb-4">
                                    <label for="email" class="form-label font-weight-bold">Email</label>
                                    <input type="email" class="form-control bg-light" id="email" name="email"
                                        value="{{ $user->email }}" readonly>
                                    <small class="text-muted">Email tidak dapat diubah karena terhubung dengan akun login
                                        Anda.</small>
                                </div>

                                <div class="row">
                                    <!-- Phone / Whatsapp -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label font-weight-bold">No. Whatsapp <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}" required
                                            placeholder="Contoh: 08123456789">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- ID Card (KTP) -->
                                    <div class="col-md-6 mb-3">
                                        <label for="id_card" class="form-label font-weight-bold">No. KTP <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('id_card') is-invalid @enderror"
                                            id="id_card" name="id_card" value="{{ old('id_card') }}" required
                                            placeholder="16 digit NIK">
                                        @error('id_card')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Birth Place -->
                                    <div class="col-md-6 mb-3">
                                        <label for="birth_place" class="form-label font-weight-bold">Tempat Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('birth_place') is-invalid @enderror" id="birth_place"
                                            name="birth_place" value="{{ old('birth_place') }}" required>
                                        @error('birth_place')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Birth Day -->
                                    <div class="col-md-6 mb-3">
                                        <label for="birth_day" class="form-label font-weight-bold">Tanggal Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('birth_day') is-invalid @enderror"
                                            id="birth_day" name="birth_day" value="{{ old('birth_day') }}" required>
                                        @error('birth_day')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Gender -->
                                    <div class="col-md-6 mb-3">
                                        <label for="sex" class="form-label font-weight-bold">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control @error('sex') is-invalid @enderror"
                                            id="sex" name="sex" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('sex') == 'L' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="P" {{ old('sex') == 'P' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        @error('sex')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Blood Type -->
                                    <div class="col-md-6 mb-3">
                                        <label for="blood_type" class="form-label font-weight-bold">Golongan Darah <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control @error('blood_type') is-invalid @enderror"
                                            id="blood_type" name="blood_type" required>
                                            <option value="" disabled selected>Pilih Golongan Darah</option>
                                            <option value="-" {{ old('blood_type') == '-' ? 'selected' : '' }}>-
                                            </option>
                                            <option value="A" {{ old('blood_type') == 'A' ? 'selected' : '' }}>A
                                            </option>
                                            <option value="B" {{ old('blood_type') == 'B' ? 'selected' : '' }}>B
                                            </option>
                                            <option value="AB" {{ old('blood_type') == 'AB' ? 'selected' : '' }}>AB
                                            </option>
                                            <option value="O" {{ old('blood_type') == 'O' ? 'selected' : '' }}>O
                                            </option>
                                        </select>
                                        @error('blood_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Marital Status -->
                                    <div class="col-md-6 mb-3">
                                        <label for="marital_status" class="form-label font-weight-bold">Status Pernikahan
                                            <span class="text-danger">*</span></label>
                                        <select
                                            class="form-select form-control @error('marital_status') is-invalid @enderror"
                                            id="marital_status" name="marital_status" required>
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Belum Menikah"
                                                {{ old('marital_status') == 'Belum Menikah' ? 'selected' : '' }}>Belum
                                                Menikah</option>
                                            <option value="Menikah"
                                                {{ old('marital_status') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                            <option value="Janda/Duda"
                                                {{ old('marital_status') == 'Janda/Duda' ? 'selected' : '' }}>Janda/Duda
                                            </option>
                                        </select>
                                        @error('marital_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Religion -->
                                    <div class="col-md-6 mb-3">
                                        <label for="religion" class="form-label font-weight-bold">Agama <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select form-control @error('religion') is-invalid @enderror"
                                            id="religion" name="religion" required>
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>
                                                Buddha</option>
                                            <option value="Konghucu"
                                                {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Suku (Ethnicity) -->
                                    <div class="col-md-6 mb-3">
                                        <label for="suku" class="form-label font-weight-bold">Suku <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('suku') is-invalid @enderror"
                                            id="suku" name="suku" value="{{ old('suku') }}" required
                                            placeholder="Contoh: Sunda, Jawa">
                                        @error('suku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Career / Position Interest -->
                                    <div class="col-md-6 mb-3">
                                        <label for="career_id" class="form-label font-weight-bold">Minat Posisi / Bagian
                                            <span class="text-danger">*</span></label>
                                        <select class="form-select form-control @error('career_id') is-invalid @enderror"
                                            id="career_id" name="career_id" required>
                                            <option value="" disabled selected>Pilih Posisi yang Dilamar</option>
                                            @foreach ($careers as $career)
                                                <option value="{{ $career->id }}"
                                                    {{ old('career_id') == $career->id ? 'selected' : '' }}>
                                                    {{ $career->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('career_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="mb-4">
                                    <label for="address" class="form-label font-weight-bold">Alamat Lengkap <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                        required placeholder="Masukkan alamat lengkap sesuai domisili">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save mr-2"></i> Simpan Profil
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-4 text-muted">
                        <small>&copy; {{ date('Y') }} RSIA Livasya. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
