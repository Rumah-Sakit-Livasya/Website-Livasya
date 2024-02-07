@php
    use App\Models\Career;
@endphp
@extends('layouts.main')

@section('container')
    <style>
        .custom-file-input:lang(en)~.custom-file-label::after {
            height: max-content !important;
        }
    </style>
    <section class="gallery bg-white" style="padding-top: 15rem">
        <h1 class="heading my-5"><span style="font-size: 3rem !important">{{ $title }}</span> </h1>

        <div class="container-fluid" id="general">
            <div class="row">
                <form autocomplete="off" novalidate method="post" enctype="multipart/form-data" id="create-applier-form">
                    @method('post')
                    @csrf
                    <input type="hidden" value="{{ $career->id }}" name="career_id">
                    <div class="col-lg-12 col-m col-12 mx-auto">
                        <h4 class="mt-5">&nbsp;</h4>
                        <div class="row gap-y">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="create-find-vacancy" class="fw-normal">Bagaimana Anda menemukan lowongan
                                        ini? <span class="text-danger">*</span></label>
                                    <select name="find_vacancy" id="create-find-vacancy"
                                        class="select2 form-control form-control-lg">
                                        <option value="lain-lain">Lain lain</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                        <option value="Agen Perekrutan">Agen Perekrutan</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Jalan kerja">Jalan kerja</option>
                                        <option value="Referensi Staf">Referensi Staf</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="personal" class="section">
                            <h4 class="mt-5 fw-bold">Data pribadi</h4>
                            <hr class="w-100 my-4">
                            <div class="row gap-y">
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-first-name" class="fw-normal">Nama depan <span
                                                class="text-danger">*</span></label>
                                        <input name="first_name" id="create-first-name" class="form-control form-control-lg"
                                            type="text" placeholder="Masukkan Nama Depan Anda" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-last-name" class="fw-normal">Nama Belakang <span
                                                class="text-danger">*</span></label>
                                        <input name="last_name" id="create-last-name" class="form-control form-control-lg"
                                            type="text" placeholder="Masukkan Nama Belakang Anda" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-birth-place" class="fw-normal">Tempat Lahir <span
                                                class="text-danger">*</span></label>
                                        <input name="birth_place" id="createbirth-place"
                                            class="form-control form-control-lg" type="text"
                                            placeholder="misalnya Jakarta" required="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-birth-day" class="fw-normal">Tanggal lahir <span
                                                class="text-danger">*</span></label>
                                        <input name="birth_day" id="create-birth-day" class="form-control form-control-lg"
                                            type="date" placeholder="" required="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label for="create-email" class="fw-normal">Alamat email <span
                                                class="text-danger">*</span></label>
                                        <input name="email" id='create-email' class="form-control form-control-lg"
                                            type="email" placeholder="misalnya nama@gmail.com" required="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <div class="form-group">
                                        <label for="create-sex" class="fw-normal">Jenis Kelamin <span
                                                class="text-danger">*</span> </label>
                                        <select name="sex" id="create-sex" class="form-control form-control-lg">
                                            <option value="Laki laki">Laki laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <div class="form-group">
                                        <label for="create-martial-status" class="fw-normal">Status Pernikahan <span
                                                class="text-danger">*</span></label>
                                        <select name="marital_status" id="create-martial-status"
                                            class="form-control form-control-lg">
                                            <option value="Lajang">Lajang</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Perceraian">Perceraian</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 mb-3">
                                    <div class="form-group">
                                        <label for="create-religion" class="fw-normal">Agama <span
                                                class="text-danger">*</span></label>
                                        <select name="religion" id="create-religion"
                                            class="form-control form-control-lg">
                                            <option value="Islam">Islam</option>
                                            <option value="Protestan">Protestan</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Konfusius">Konfusius</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group" class="fw-normal">
                                        <label for="create-id-card" class="fw-normal">Nomor KTP/Paspor <span
                                                class="text-danger">*</span></label>
                                        <input name="id_card" id="create-id-card" class="form-control form-control-lg"
                                            type="number" placeholder="misalnya 1234567890123456" required="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-suku" class="fw-normal">Suku <span
                                                class="text-danger">*</span></label>
                                        <input name="suku" id="create-suku" class="form-control form-control-lg"
                                            type="text" placeholder="misalnya bahasa Sunda" required>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-npwp" class="fw-normal">NPWP </label>
                                        <input name="npwp" id="create-npwp" class="form-control form-control-lg"
                                            type="text" placeholder="misal 00.000.000.0-000.000">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label for="create-social-security" class="fw-normal">BPJS Ketenagakerjaan
                                        </label>
                                        <input name="social_security" id="create-social-security"
                                            class="form-control form-control-lg" type="number"
                                            placeholder="misalnya 0001234567890">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label class="fw-normal" for="create-ktp-address">Alamat KTP <span
                                            class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <textarea id="create-ktp-address" name="ktp_address" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mb-3">
                                    <label for="create-domisili-address" class="float-left fw-normal">Alamat Domisili
                                        <span class="text-danger">*</span></label>
                                    <div class="switch float-right">
                                        <input id="create-domisili-address" name="cb_address" type="checkbox"
                                            class="switch-input">
                                        <label class="switch-label fw-normal">
                                            Sama seperti di atas
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="permanent_address" name="permanent_address" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="family" class="section pt-0">
                            <h4 class="mt-5 fw-bold">Informasi keluarga</h4>
                            <p>(Informasi keluarga yang bisa dihubungi)</p>
                            <hr class="w-100 my-4">
                            <div id="familyForm">
                                <div class="row gap-y" id="familyForm0">
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-family-name" class="fw-normal">Nama <span
                                                    class="text-danger">*</span></label>
                                            <input name="family_name" id="create-family-name"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="Masukkan Nama Lengkap">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-family-sex" class="fw-normal">Jeis Kelamin <span
                                                    class="text-danger">*</span></label>
                                            <select name="family_sex" id="create-family-sex"
                                                class="form-control form-control-lg">
                                                <option value="Laki laki">Laki Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-family-relationship" class="fw-normal">Hubungan <span
                                                    class="text-danger">*</span></label>
                                            <input name="family_relationship" id="create-family-relationship"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="misalnya Sepupu/Pasangan/Anak Perempuan dll.">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-family-occupation" class="fw-normal">Pekerjaan <span
                                                    class="text-danger">*</span></label>
                                            <input name="family_occupation" id="create-family-occupation"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="misalnya SMA">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label for="create-family-contact" class="fw-normal">Nomor Kontak <span
                                                    class="text-danger">*</span></label>
                                            <input name="family_contact" id="create-family-contact"
                                                class="form-control form-control-lg" type="number"
                                                placeholder="misalnya +6212341234123">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="emergency" class="section pt-0">
                            <h4 class="mt-5 fw-bold">Kontak darurat </h4>
                            <hr class="w-100 my-4">
                            <div id="emergencyForm">
                                <div class="row gap-y" id="emergencyForm0">
                                    <div class="col-12 col-lg-4 mt-3">
                                        <div class="form-group">
                                            <label for="create-emergency-name" class="fw-normal">Nama <span
                                                    class="text-danger">*</span></label>
                                            <input name="emergency_name" id="create-emergency-name"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="Masukkan Nama Lengkap">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 mt-3">
                                        <div class="form-group">
                                            <label for="create-emergency-relation" class="fw-normal">Hubungan <span
                                                    class="text-danger">*</span></label>
                                            <input name="emergency_relation" id="create-emergency-relation"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="misalnya Pasangan">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 mt-3">
                                        <div class="form-group">
                                            <label for="create-emergency-phone" class="fw-normal">Nomor Telepon <span
                                                    class="text-danger">*</span></label>
                                            <input name="emergency_phone" id="create-emergency-phone"
                                                class="form-control form-control-lg" type="number"
                                                placeholder="+6212341234123">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3">
                                        <label for="create-emergency-address" class="fw-normal">Alamat <span
                                                class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <textarea name="emergency_address" id="create-emergency-address" class="form-control" placeholder=""
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="education" class="section pt-0">
                            <h4 class="mt-5 fw-bold">Pendidikan Terakhir </h4>
                            <hr class="w-100 my-4">
                            <div id="educationForm">
                                <div class="row gap-y" id="educationForm0">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="create-school-name" class="fw-normal">Sekolah/Institusi <span
                                                    class="text-danger">*</span></label>
                                            <input name="school_name" id="create-school-name"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="Masuk Sekolah/Institusi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-lg-4 mt-3">
                                        <div class="form-group">
                                            <label for="create-school-city" class="fw-normal">Kota <span
                                                    class="text-danger">*</span></label>
                                            <input name="school_city" id="create-school-city"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="misalnya Jakarta">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 mt-3">
                                        <div class="form-group">
                                            <label for="create-school-major" class="fw-normal">Jurusan <span
                                                    class="text-danger">*</span></label>
                                            <input name="school_major" id="create-school-major"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="misalnya Jurusan Kedokteran">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 mt-3">
                                        <div class="form-group">
                                            <label for="create-schoor-year" class="fw-normal">Tahun Lulus <span
                                                    class="text-danger">*</span></label>
                                            <input name="school_year" id="create-schoor-year"
                                                class="form-control form-control-lg" type="number"
                                                placeholder="misalnya tahun 2010">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-school-qual" class="fw-normal">Kualifikasi yang
                                                Diperoleh <span class="text-danger">*</span></label>
                                            <input name="school_qual" id="create-school-qual"
                                                class="form-control form-control-lg" type="text"
                                                placeholder="misalnya Gelar Sarjana">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-school-gpa" class="fw-normal">IPK / Nilai Akhir <span
                                                    class="text-danger">*</span></label>
                                            <input name="school_gpa" id="create-school-gpa"
                                                class="form-control form-control-lg" type="number"
                                                placeholder="Masukan Nilai">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="language" class="section pt-0">
                            <h4 class="mt-5" class="fw-bold">Bahasa</h4>
                            <hr class="w-100 my-4">
                            <div class="row gap-y">
                                <div class="col-12 col-lg-3">
                                    <div class="form-group">
                                        <label for="language_name" class="fw-normal">Bahasa</label>
                                        <input name="language_name[]" class="form-control form-control-lg" type="text"
                                            placeholder="misalnya bahasa Inggris">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-spoken" class="fw-normal">Lisan</label>
                                        <select name="language_spoken[]" id="create-language-spoken"
                                            class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-written" class="fw-normal">Tertulis</label>
                                        <select name="language_written[]" class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-reading" class="fw-normal">Membaca</label>
                                        <select name="language_reading[]" id="create-language-reading"
                                            class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-name-2" class="fw-normal">Bahasa</label>
                                        <input name="language_name[]" id="create-language-name-2"
                                            class="form-control form-control-lg" type="text"
                                            placeholder="misalnya bahasa mandarin">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-spoken-2" class="fw-normal">Lisan</label>
                                        <select name="language_spoken[]" id="create-language-spoken-2"
                                            class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-written-2" class="fw-normal">Tertulis</label>
                                        <select name="language_written[]" class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-reading-2" class="fw-normal">Membaca</label>
                                        <select name="language_reading[]" id="create-language-reading-2"
                                            class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-name-3" class="fw-normal">Bahasa</label>
                                        <input name="language_name[]" id="create-language-name-3"
                                            class="form-control form-control-lg" type="text"
                                            placeholder="misalnya bahasa Jerman">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-spoken-3" class="fw-normal">Lisan</label>
                                        <select name="language_spoken[]" id="create-language-spoken-3"
                                            class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-written-3" class="fw-normal">Tertulis</label>
                                        <select name="language_written[]" id="create-language-written-3"
                                            class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-language-reading-3" class="fw-normal">Membaca</label>
                                        <select name="language_reading[]" class="form-control form-control-lg">
                                            <option value="">-</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Tinggi">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="certification" class="section pt-0">
                            <h4 class="mt-5 fw-bold">Lisensi atau Sertifikasi Profesional </h4>
                            <hr class="w-100 my-4">
                            <div class="row gap-y">
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-name" class="fw-normal">Nama Sertifikasi </label>
                                        <input name="certification_name[]" id="create-certification-name"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-institution" class="fw-normal">Nama
                                            Institusi </label>
                                        <input name="certification_institution[]" id="create-certification-institution"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-obtained" class="fw-normal">Tahun yang
                                            Diperoleh </label>
                                        <input name="certification_obtained[]" id="create-certification-obtained"
                                            class="form-control form-control-lg" type="number" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-name-2" class="fw-normal">Nama
                                            Sertifikasi </label>
                                        <input name="certification_name[]" id="create-certification-name-2"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-institution-2" class="fw-normal">Nama
                                            Institusi </label>
                                        <input name="certification_institution[]" id="create-certification-institution-2"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-obtained-2" class="fw-normal">Tahun yang
                                            Diperoleh </label>
                                        <input name="certification_obtained[]" id="create-certification-obtained-2"
                                            class="form-control form-control-lg" type="number" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-name-3" class="fw-normal">Nama
                                            Sertifikasi </label>
                                        <input name="certification_name[]" id="create-certification-name-3"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-institution-3" class="fw-normal">Nama
                                            Institusi </label>
                                        <input name="certification_institution[]" id="create-certification-institution-3"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 mt-3">
                                    <div class="form-group">
                                        <label for="create-certification-obtained-3" class="fw-normal">Tahun yang
                                            Diperoleh </label>
                                        <input name="certification_obtained[]" id="create-certification-obtained-3"
                                            class="form-control form-control-lg" type="number" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="work" class="section pt-0">
                            <h4 class="mt-5 fw-bold">Pengalaman kerja <span class="text-danger">*</span></h4>
                            <hr class="w-100 my-4">
                            <div id="workForm">
                                <div class="row gap-y" id="workForm0">
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-name" class="fw-normal">Nama Perusahaan <span
                                                    class="text-danger">*</span></label>
                                            <input name="work_name[]" id="create-work-name"
                                                class="form-control form-control-lg" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-position" class="fw-normal">Posisi Terakhir <span
                                                    class="text-danger">*</span></label>
                                            <input name="work_position[]" id="create-work-position"
                                                class="form-control form-control-lg" type="text" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-address" class="fw-normal">Alamat Perusahaan <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="work_address[]" id="create-work-address" class="form-control" placeholder="" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-start" class="fw-normal">Mulai tanggal <span
                                                    class="text-danger">*</span></label>
                                            <input name="work_start[]" id="create-work-start"
                                                class="form-control form-control-lg" type="date" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-end" class="fw-normal">Tanggal Berakhir <span
                                                    class="text-danger">*</span></label>
                                            <input name="work_end[]" id="create-work-end"
                                                class="form-control form-control-lg" type="date" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-start-salary" class="fw-normal">Gaji awal <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input name="work_start_salary[]" id="create-work-start-salary"
                                                    type="text" class="form-control form-control-lg"
                                                    oninput="formatInput(this)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-latest-salary" class="fw-normal">Gaji Terbaru (sebelum
                                                pindah) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input name="work_latest_salary[]" id="create-work-latest-salary"
                                                    type="text" class="form-control form-control-lg"
                                                    oninput="formatInput(this)">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-reason" class="fw-normal">Alasan Pindah <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="work_reason[]" id="create-work-reason" class="form-control" placeholder="" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="container row">
                                        <div class="col-12 col-lg-8 mt-3 col-m">
                                            <div class="form-group">
                                                <label for="create-work-contact-employer" class="fw-normal">Bolehkah kami
                                                    menghubungi perusahaan saat ini/sebelumnya secara
                                                    langsung? <span class="text-danger">*</span></label>
                                                <select name="work_contact_employer[]" id="create-work-contact-employer"
                                                    class="form-control form-control-lg">
                                                    <option value="">-</option>
                                                    <option value="ya">Ya</option>
                                                    <option value="tidak">Tidak</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-contact-yes" class="fw-normal">Jika ya, harap berikan
                                                nama, nomor kontak. Jika tidak, jelaskan alasannya <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="work_contact_yes[]" id="create-work-contact-yes" class="form-control" placeholder=""
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label for="create-work-achievement" class="fw-normal">Prestasi <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="work_achievement[]" id="create-work-achievement" class="form-control" placeholder=""
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-lg-12">
                                        <div class="form-group">
                                            <button id="workFormGroup" name="workFormGroup"
                                                class="btn btn-primary">Tambahkan
                                                Lebih Banyak </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="others" class="section pt-0 mt-5">
                            <h4 class="fw-bold">Harapan &amp; Permulaan Manfaat Kompensasi</h4>
                            <hr class="w-100 my-4">
                            <div class="row gap-y">
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-compensation-salary" class="fw-normal">Gaji bulanan
                                            (Kotor) <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input name="compensation_salary" id="create-compensation-salary"
                                                type="text" class="form-control form-control-lg"
                                                oninput="formatInput(this)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-compensation-benefit" class="fw-normal">Manfaat /
                                            Lainnya <span class="text-danger">*</span></label>
                                        <input name="compensation_benefit" id="create-compensation-benefit"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <div class="form-group">
                                        <label for="create-compensation-workdate" class="fw-normal">Jika Anda ditawari
                                            pekerjaan bersamakami kapan Anda bisa mulai bekerja (atau periode pemberitahuan)
                                            <span class="text-danger">*</span></label>
                                        <input name="compensation_workdate" id="create-compensation-workdate"
                                            class="form-control form-control-lg" type="date" placeholder="">
                                    </div>
                                </div>

                                <div class="col-12 mt-5">
                                    <h4 class="fw-bold">Deklarasi dan Otorisasi</h4>
                                    <hr class="w-100 my-4">
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-family-member" class="fw-normal">
                                        1. Apakah Anda mempunyai anggota keluarga;
                                        karyawan, siapa yang bekerja di perusahaan ini? (Ya/Tidak) <span
                                            class="text-danger">*</span>
                                        <br>
                                        <small><i>Jika ya, sebutkan nama karyawan, jabatan dan hubungannya</i></small>
                                    </label>
                                    <div class="form-group">
                                        <textarea name="declare_family_member" id="create-declare-family-member" class="form-control" placeholder=""
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-suspended" class="fw-normal">
                                        2. Apakah Anda pernah diberhentikan atau ditangguhkan dari posisi apa pun, atau
                                        dikenakan tindakan disipliner internal
                                        oleh perusahaan tempat Anda bekerja sebelumnya? (Ya/Tidak) <span
                                            class="text-danger">*</span>
                                        <br>
                                        <small><i>Jika ya, sebutkan di mana, kapan, dan penyebabnya</i></small>
                                    </label>

                                    <div class="form-group">
                                        <textarea name="declare_suspended" id="create-declare-suspended" class="form-control" placeholder=""
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-criminal" class="fw-normal">3. Apakah Anda pernah dihukum
                                        karena
                                        melakukan tindak pidana di mana pun di dunia, kecuali hukuman yang telah
                                        dibatalkan atau dibatalkan? (Ya / Tidak) <span class="text-danger">*</span>
                                        <br>
                                        <small><i>Jika ya, berikan rinciannya.</i></small>
                                    </label>

                                    <div class="form-group">
                                        <textarea name="declare_criminal" id="create-declare-criminal" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-lvs" class="fw-normal">4. Apakah anda pernah
                                        melamar/bekerja di
                                        RUMAH SAKIT LIVASYA? pilih salah satu (Ya/Tidak) <span
                                            class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <textarea name="declare_lvs" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-declare-lvs-when" class="fw-normal">Jika ya kapan ?</label>
                                        <input name="declare_lvs_when" id="create-declare-lvs-when"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-declare-lvs-where" class="fw-normal">Di mana</label>
                                        <input name="declare_lvs_where" id="create-declare-lvs-where"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-declare-lvs-position" class="fw-normal">Untuk posisi?</label>
                                        <input name="declare_lvs_position" id="create-declare-lvs-position"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mt-3">
                                    <div class="form-group">
                                        <label for="create-declare-lvs-stage" class="fw-normal">Tahap seleksi terakhir
                                            (untuk
                                            melamar)</label>
                                        <input name="declare_lvs_stage" id="create-declare-lvs-stage"
                                            class="form-control form-control-lg" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-politic" class="fw-normal">5. Apakah Anda saat ini memegang
                                        posisi di partai politik atau calon pejabat politik mana pun? <span
                                            class="text-danger">*</span>
                                        <br>
                                        <small><i>Jika iya, harap berikan rincian jabatan dan partai politik serta tanggal
                                                bergabungnya Anda pada partai politik tersebut dan jabatan yang Anda lamar
                                                sebagai calon.</i></small>
                                    </label>
                                    <div class="form-group">
                                        <textarea name="declare_politic" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-government" class="fw-normal">6. Apakah ada anggota
                                        keluarga
                                        dekat Anda yang
                                        merupakan pejabat atau lembaga pemerintah, pegawai lembaga pemerintah,
                                        pejabat partai politik, atau calon pejabat politik? <span
                                            class="text-danger">*</span>
                                        <br>
                                        <small><i>Jika ya, mohon sebutkan rincian nama, jabatan/jabatan yang dijabat dan
                                                hubungan keluarga. dekat artinya suami, istri, anak, ibu, ayah, saudara
                                                kandung.</i></small>
                                    </label>
                                    <div class="form-group">
                                        <textarea name="declare_government" id="" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 mt-3">
                                    <label for="create-declare-business" class="fw-normal">7. Apakah Anda mempunyai
                                        pekerjaan
                                        atau kegiatan usaha lain di luar pekerjaan saat ini?
                                        <span class="text-danger">*</span>
                                        <br>
                                        <small><i>Jika ya, harap berikan rinciannya termasuk nama perusahaan, jenis usaha,
                                                jabatan dan tahun mulai jabatan.</i></small>
                                    </label>

                                    <div class="form-group">
                                        <textarea name="declare_business" id="create-declare-business" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="create-attachment" class="fw-normal">Lampirkan CV (PDF Format | Max File
                                        Size 2 MB) <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input name="attachment" id="create-attachment" type="file"
                                            class="custom-file-input" id="customFile" accept=".pdf" required=""
                                            style="height: unset">
                                        <label class="custom-file-label" style="height: unset" for="customFile">Choose
                                            file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="others" class="pt-0 mt-5">
                            <button type="button" id="create-button"
                                class="btn btn-block btn-success fw-800 fs-20">Lamar
                                Sekarang</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

    <!-- script SasS-->
    {{-- <script src="/js/page.js"></script> --}}
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> --}}
    <script>
        // Fungsi untuk mengubah angka menjadi format mata uang Rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }

        // Fungsi untuk memformat input saat pengguna mengetik
        function formatInput(input) {
            // Menghapus karakter selain angka
            var value = input.value.replace(/\D/g, '');
            // Mengubah angka menjadi format Rupiah
            input.value = formatRupiah(value);
        }

        // Mendapatkan elemen input
        // var input = document.getElementById('create-compensation-salary');

        // // Menambahkan event listener untuk memanggil fungsi formatInput saat input berubah
        // input.addEventListener('input', function() {
        //     formatInput(input);
        // });
    </script>

    {{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"> --}}
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script>
        // function subscribe() {
        //     var email = $('#subscribeemail').val();
        //     $.ajax({
        //         url: '/news_/subscribe',
        //         method: 'POST',
        //         data: {
        //             email: email
        //         },
        //         beforeSend: function() {
        //             $('#btn-subs').html('Please Wait...')
        //             $('#btn-subs').prop('disabled', true);
        //         },
        //         success: function() {
        //             Swal.fire(
        //                 'Thank You!',
        //                 'You Subscribe to Mayapada',
        //                 'success'
        //             );
        //             $('#subscribeemail').val('')
        //             $('#btn-subs').html('Subscribe')
        //             $('#btn-subs').prop('disabled', false);
        //         },
        //         error: function(msg) {
        //             $("#btn-subs").attr("disabled", false);
        //             $('#btn-subs').html('Subscribe')
        //             var json = $.parseJSON(msg.responseText);
        //             // console.log(json);
        //             var errorsHtml = '';
        //             $.each(json.errors, function(key, value) {
        //                 errorsHtml += '<li>' + value + '</li>';
        //             });
        //             Command: toastr["error"](errorsHtml);

        //             toastr.options = {
        //                 "closeButton": false,
        //                 "debug": false,
        //                 "newestOnTop": false,
        //                 "progressBar": true,
        //                 "positionClass": "toast-top-right",
        //                 "preventDuplicates": true,
        //                 "onclick": null,
        //                 "showDuration": "300",
        //                 "hideDuration": "1000",
        //                 "timeOut": "5000",
        //                 "extendedTimeOut": "1000",
        //                 "showEasing": "swing",
        //                 "hideEasing": "linear",
        //                 "showMethod": "fadeIn",
        //                 "hideMethod": "fadeOut"
        //             }
        //         }
        //     });
        // }
        // $(function() {
        //     $('.lazy').lazy({
        //         delay: 0,
        //         combined: true,
        //     });
        // });
    </script>
    {{-- <script src="/js/jquery.easy-autocomplete.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/timepicker@1.11.15/jquery.timepicker.min.js"></script> --}}
    {{-- <script src="/js/datepicker.min.js"></script>
    <script src="/js//jquery.blockUI.js"></script> --}}
    <script>
        // $('body').scrollspy({
        //     target: '#navbar-form'
        // })
        // $('[data-spy="scroll"]').each(function() {
        //     var $spy = $(this).scrollspy('refresh')
        // })

        // $('[data-spy="scroll"]').on('activate.bs.scrollspy', function() {
        //     // do something...
        // })

        // $(document).ready(function() {
        //     $('#career_form').validate();
        // });

        $('#switch_address').change(function() {
            if ($(this).is(':checked')) {
                var address = $('#create-ktp-address').val();
                console.log(address);
                $('#create-domisili-address').val(address);
            } else {
                $('#create-domisili-address').val("");
            }
        })

        // $(".custom-file-input").on("change", function() {
        //     var fileName = $(this).val().split("\\").pop();
        //     $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        // });

        // var applier = document.getElementById('create-applier-form');

        // Kirim formulir tambah melalui AJAX
        $('#create-button').on('click', function() {
            var applierForm = document.getElementById(
                'create-applier-form'); // Ganti 'applier' dengan ID formulir Anda

            // Form data
            var formData = new FormData(applierForm);

            $.ajax({
                type: 'POST',
                url: '/api/appliers/',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: 'Complete',
                        icon: 'success',
                        html: "You Completed our application form, please wait for response from our team",
                        showConfirmButton: false,
                        timer: 4000,
                    });
                    setTimeout(function() {
                        window.location.href = "/career";
                    }, 3000);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Tangani kesalahan validasi
                        var errors = xhr.responseJSON.errors;
                        var errorMessage =
                            "Formulir tidak lengkap. Silakan periksa kembali isian berikut:\n\n";

                        // Membangun pesan kesalahan
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '\n';
                        });

                        alert(errorMessage);
                    } else {
                        alert('Terjadi kesalahan. Mohon coba lagi.');
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var next = 0;
            $("#workFormGroup").click(function(e) {
                e.preventDefault();
                var addto = "#workForm" + next;
                var addRemove = "#workForm" + (next);
                next = next + 1;
                var newIn = ' <div id="workForm' + next + '" name="workForm' + next +
                    '"><div class="row gap-y"id="workForm0"><div class="col-12 col-lg-6"><div class="form-group"><label for="create-work-name" class="fw-normal">Nama Perusahaan <span class="text-danger">*</span></label><input name="work_name[]" id="create-work-name" class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-6"><div class="form-group"><label for="create-work-position" class="fw-normal">Posisi Terakhir <span class="text-danger">*</span></label><input name="work_position[]" id="create-work-position" class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-12"><div class="form-group"><label for="create-work-address" class="fw-normal">Alamat Perusahaan <span class="text-danger">*</span></label><textarea name="work_address[]" id="create-work-address" class="form-control"placeholder=""rows="3"></textarea></div></div><div class="col-12 col-lg-6"><div class="form-group"><label for="create-work-start" class="fw-normal">Mulai Tanggal <span class="text-danger">*</span></label><input name="work_start[]" id="create-work-start" class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-6"><div class="form-group"><label for=" create-work-end" class="fw-normal">Tanggal Berakhir <span class="text-danger">*</span></label><input name="work_end[]"id="create-work-end"class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-6 mt-3"><div class="form-group"><label for="create-work-start-salary" class="fw-normal">Gaji awal <span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Rp</span></div><input name="work_start_salary[]" id="create-work-start-salary"type="text" class="form-control form-control-lg" oninput="formatInput(this)"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></div></div><div class="col-12 col-lg-6 mt-3"><div class="form-group"><label for="create-work-latest-salary" class="fw-normal">Gaji Terbaru <span class="text-danger">*</span></label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Rp</span></div><input name="work_latest_salary[]" id="create-work-latest-salary"type="text" class="form-control form-control-lg" oninput="formatInput(this)"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></div></div><div class="col-12 col-lg-12 mt-3"><div class="form-group"><label for="create-work-reason" class="fw-normal">Alasan Pindah <span class="text-danger">*</span></label><textarea name="work_reason[]" id="create-work-reason" class="form-control" placeholder="" rows="3"></textarea></div></div><div class="container row"><div class="col-12 col-lg-8 mt-3 col-m"><div class="form-group"><label for="create-work-contact-employer" class="fw-normal">Bolehkah kami menghubungi perusahaan saat ini/sebelumnya secara langsung? <span class="text-danger">*</span></label><select name="work_contact_employer[]" id="create-work-contact-employer"class="form-control form-control-lg"><option value="">-</option><option value="ya">Ya</option><option value="tidak">Tidak</option></select></div></div></div><div class="col-12 col-lg-12 mt-3"><div class="form-group"> <label for="create-work-contact-yes" class="fw-normal"> Jika ya, harap berikan nama, nomor kontak Jika tidak, jelaskan alasannya <span class="text-danger">*</span></label> <textarea name="work_contact_yes[]" id="create-work-contact-yes" class="form-control" placeholder="" rows="3"></textarea></div> </div> <div class="col-12 col-lg-12 mt-3"> <div class="form-group"><label for="create-work-achievement" class="fw-normal">Prestasi <span class="text-danger">*</span> </label><textarea name="work_achievement[]" id="create-work-achievement" class="form-control" placeholder="" rows="3"> </textarea> </div> </div> </div> </div></div> ';
                var newInput = $(newIn);
                var removeBtn = '<button id="remove' + (next - 1) +
                    '" class="btn btn-danger remove-me mt-3" >Hapus</button></div></div><div id="workForm">';
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                $(addRemove).after(removeButton);
                $("#workForm" + next).attr('data-source', $(addto).attr('data-source'));
                $("#count").val(next);

                $('.remove-me').click(function(e) {
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length - 1);
                    var fieldID = "#workForm" + fieldNum;
                    $(this).remove();
                    $(fieldID).remove();
                });
            });
        });
    </script>
@endsection
