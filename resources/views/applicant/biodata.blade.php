@extends('layouts.main')

@section('title', 'Lengkapi Biodata')

@section('container')
    <section class="py-5" style="min-height: 80vh; background-color: #f8f9fa;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-header bg-white border-bottom py-3">
                            <h4 class="font-weight-bold text-success mb-0">
                                <i class="fas fa-user-circle mr-2"></i> Formulir Biodata Diri
                            </h4>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="alert alert-light border-left-info mb-5 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x text-info mr-3"></i>
                                    <div>
                                        <h6 class="font-weight-bold mb-1">Informasi Penting</h6>
                                        <p class="small mb-0 text-muted">Mohon lengkapi data diri Anda dengan benar sesuai
                                            dokumen resmi (KTP) sebelum melanjutkan ke dashboard pelamar.</p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('applicant.profile.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg shadow-sm"
                                            name="full_name" value="{{ Auth::user()->name }}"
                                            placeholder="Masukkan nama sesuai KTP" required>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Nomor Induk Kependudukan (NIK)
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg shadow-sm" name="id_card"
                                            placeholder="16 digit nomor NIK" required maxlength="16">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Tempat Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg shadow-sm"
                                            name="birth_place" required>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Tanggal Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-lg shadow-sm"
                                            name="birth_day" required>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" name="sex" required>
                                            <option value="">PILIH</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Status Pernikahan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" name="marital_status" required>
                                            <option value="">PILIH</option>
                                            <option value="Lajang">Lajang</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Cerai">Cerai</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Agama <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" name="religion" required>
                                            <option value="Islam">Islam</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Kewarganegaraan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" name="nationality" required>
                                            <option value="WNI">WNI (Warga Negara Indonesia)</option>
                                            <option value="WNA">WNA (Warga Negara Asing)</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Minat Bagian <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control select2" name="position_interest" required>
                                            <option value="">PILIH</option>
                                            @foreach ($jobPositions as $position)
                                                <option value="{{ $position->name }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Tentang Saya <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-lg shadow-sm" name="about_me" rows="4"
                                            placeholder="Ceritakan singkat tentang diri Anda, pengalaman, atau keahlian yang relevan..." required></textarea>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Nomor Whatsapp <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0"><i
                                                        class="fab fa-whatsapp text-success"></i></span>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-lg shadow-sm border-left-0"
                                                name="whatsapp_number" placeholder="Contoh: 08123456789" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Email Aktif</label>
                                        <input type="email" class="form-control form-control-lg bg-light"
                                            value="{{ Auth::user()->email }}" readonly disabled>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label class="form-label font-weight-bold text-dark">Alamat Domisili Saat Ini <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-lg shadow-sm" name="address" rows="3" required></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="blood_type" value="-">
                                <input type="hidden" name="phone" value="-">

                                <div class="mt-4 text-right">
                                    <button type="submit"
                                        class="btn btn-success btn-lg px-5 shadow-sm rounded-pill font-weight-bold">
                                        Simpan & Lanjutkan <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('plugin')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap4'
            });
        });
    </script>
@endsection
