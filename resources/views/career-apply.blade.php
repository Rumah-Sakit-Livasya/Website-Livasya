@php
    use App\Models\Career;
@endphp
@extends('layouts.main')

@section('container')
    <section class="gallery bg-white" style="padding-top: 15rem">
        <h1 class="heading my-5"><span style="font-size: 3rem !important">{{ $title }}</span> </h1>

        <div class="container-fluid" id="general">
            <div class="row">
                <div class="col-lg-12 col-m col-12 mx-auto">
                    <h4 class="mt-5">&nbsp;</h4>
                    <div class="row gap-y">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="create-find-vacancy" class="fw-normal">Bagaimana Anda menemukan lowongan
                                    ini?<span class="text-danger">*</span></label>
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
                                    <label for="create-last-name" class="fw-normal">Nama Belakang<span
                                            class="text-danger">*</span></label>
                                    <input name="last_name" id="create-last-name" class="form-control form-control-lg"
                                        type="text" placeholder="Masukkan Nama Belakang Anda" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="create-birth-place" class="fw-normal">Tempat Lahir <span
                                            class="text-danger">*</span></label>
                                    <input name="birth_place" id="createbirth-place" class="form-control form-control-lg"
                                        type="text" placeholder="misalnya Jakarta" required="">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="create-birth-day" class="fw-normal">Tanggal lahir<span
                                            class="text-danger">*</span></label>
                                    <input name="birth_day" id="create-birth-day" class="form-control form-control-lg"
                                        type="date" placeholder="" required="">
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 mb-3">
                                <div class="form-group">
                                    <label for="create-email" class="fw-normal">Alamat email<span
                                            class="text-danger">*</span></label>
                                    <input name="email" id='create-email' class="form-control form-control-lg"
                                        type="email" placeholder="misalnya nama@gmail.com" required="">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="create-sex" class="fw-normal">Jenis Kelamin</label>
                                    <select name="sex" id="create-sex" class="form-control form-control-lg">
                                        <option value="pria">Pria</option>
                                        <option value="wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="create-martial-status" class="fw-normal">Status Pernikahan</label>
                                    <select name="marital_status" id="create-martial-status"
                                        class="form-control form-control-lg">
                                        <option value="lajang">Lajang</option>
                                        <option value="telah-menikah">Telah menikah</option>
                                        <option value="perceraian">Perceraian</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="create-religion" class="fw-normal">Agama</label>
                                    <select name="religion" id="create-religion" class="form-control form-control-lg">
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
                                    <label for="create-id-card" class="fw-normal">Nomor KTP/Paspor<span
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
                                        type="text" placeholder="misalnya bahasa Indonesia" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="create-npwp" class="fw-normal">NPWP Number</label>
                                    <input name="npwp" id="create-npwp" class="form-control form-control-lg"
                                        type="number" placeholder="misal 00.000.000.0-000.000">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="form-group">
                                    <label for="create-social-security" class="fw-normal">Social Security No (BPJS
                                        Ketenagakerjaan)</label>
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
                                <label for="create-domisili-address" class="float-left fw-normal">Alamat Domisili <span
                                        class="text-danger">*</span></label>
                                <div class="switch float-right">
                                    <input id="create-domisili-address" name="cb_address" type="checkbox"
                                        class="switch-input">
                                    <label class="switch-label">
                                        Sama seperti di atas
                                    </label>
                                </div>
                                <div class="form-group">
                                    <textarea id="permanent_address" name="permanent_address" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label for="create-contact-1" class="fw-normal">Nomor Kontak (1)<span
                                            class="text-danger">*</span></label>
                                    <input name="contact_1" id="create-contact-1" class="form-control form-control-lg"
                                        type="number" placeholder="misalnya +6212341234123" required="">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nomor Kontak (2)
                                            </font>
                                        </font>
                                    </label>
                                    <input name="contact_2" class="form-control form-control-lg" type="number"
                                        placeholder="misalnya +6212341234123">
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 mb-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                Nomor Kontak (Keluarga / Kerabat)
                                            </font>
                                        </font>
                                    </label>
                                    <input name="contact_residence" class="form-control form-control-lg" type="number"
                                        placeholder="misalnya +6212341234123">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="family" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Informasi keluarga</font>
                            </font>
                        </h4>
                        <p>
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">(Bagi yang sudah menikah, harap
                                    mengisi data
                                    pasangan &amp; anak)</font>
                            </font>
                        </p>
                        <hr class="w-100 my-4">
                        <div id="familyForm">
                            <div class="row gap-y" id="familyForm0">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Nama</font>
                                            </font>
                                        </label>
                                        <input name="family_name[]" class="form-control form-control-lg" type="text"
                                            placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Seks</font>
                                            </font>
                                        </label>
                                        <select name="family_sex[]" class="form-control form-control-lg">
                                            <option value="male">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Pria</font>
                                                </font>
                                            </option>
                                            <option value="male">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Perempuan
                                                    </font>
                                                </font>
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Hubungan</font>
                                            </font>
                                        </label>
                                        <input name="family_relationship[]" class="form-control form-control-lg"
                                            type="text" placeholder="misalnya Sepupu/Pasangan/Anak Perempuan dll.">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    Pendidikan/Pekerjaan/Perusahaan
                                                </font>
                                            </font>
                                        </label>
                                        <input name="family_occupation[]" class="form-control form-control-lg"
                                            type="text" placeholder="misalnya SMA">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <button type="button" id="familyformGroup" name="familyformGroup"
                                            class="btn btn-primary">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tambahkan Lebih
                                                    Banyak</font>
                                            </font>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div id="relatives" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Data Orang Tua dan Kerabat
                                </font>
                            </font>
                        </h4>
                        <p>
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">(silakan isi informasi anggota
                                    keluarga)</font>
                            </font>
                        </p>
                        <hr class="w-100 my-4">
                        <div id="relativesForm">
                            <div class="row gap-y" id="relativesForm0">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Nama</font>
                                            </font>
                                        </label>
                                        <input name="relative_name[]" class="form-control form-control-lg" type="text"
                                            placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Seks</font>
                                            </font>
                                        </label>
                                        <select name="relative_sex[]" class="form-control form-control-lg">
                                            <option>
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Pria</font>
                                                </font>
                                            </option>
                                            <option>
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Perempuan
                                                    </font>
                                                </font>
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Hubungan</font>
                                            </font>
                                        </label>
                                        <input name="relative_relation[]" class="form-control form-control-lg"
                                            type="text" placeholder="misalnya Sepupu/Pasangan/Anak Perempuan dll.">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Pendidikan/
                                                    Pekerjaan/ Perusahaan:
                                                </font>
                                            </font>
                                        </label>
                                        <input name="relative_occupation[]" class="form-control form-control-lg"
                                            type="text" placeholder="misalnya SMA">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tanggal lahir
                                                </font>
                                            </font>
                                        </label>
                                        <input name="relative_birthdate[]" class="form-control form-control-lg"
                                            type="date" placeholder="">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tempat Lahir
                                                </font>
                                            </font>
                                        </label>
                                        <input name="relative_birthplace[]" class="form-control form-control-lg"
                                            type="text" placeholder="Jakarta">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <button id="relativesFormGroup" name="relativesFormGroup"
                                            class="btn btn-primary">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tambahkan Lebih
                                                    Banyak</font>
                                            </font>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div id="emergency" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Kontak darurat</font>
                            </font>
                        </h4>
                        <hr class="w-100 my-4">
                        <div id="emergencyForm">
                            <div class="row gap-y" id="emergencyForm0">

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Nama</font>
                                            </font>
                                        </label>
                                        <input name="emergency_name[]" class="form-control form-control-lg"
                                            type="text" placeholder="Masukkan Nama Lengkap">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Hubungan</font>
                                            </font>
                                        </label>
                                        <input name="emergency_relation[]" class="form-control form-control-lg"
                                            type="text" placeholder="misalnya Pasangan">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Nomor telepon
                                                </font>
                                            </font>
                                        </label>
                                        <input name="emergency_phone[]" class="form-control form-control-lg"
                                            type="number" placeholder="+6212341234123">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Alamat</font>
                                        </font>
                                    </label>

                                    <div class="form-group">
                                        <textarea name="emergency_address[]" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <button id="emergencyFormGroup" name="emergencyFormGroup" class="btn btn-primary"
                                            type="button">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tambahkan Lebih
                                                    Banyak</font>
                                            </font>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div id="education" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Pendidikan formal</font>
                            </font>
                        </h4>
                        <hr class="w-100 my-4">
                        <div id="educationForm">
                            <div class="row gap-y" id="educationForm0">

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    Sekolah/Institusi</font>
                                            </font>
                                        </label>
                                        <input name="school_name[]" class="form-control form-control-lg" type="text"
                                            placeholder="Masuk Sekolah/Institusi">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Kota </font>
                                            </font><small style="color:#c3c3c3">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">(Opsional)
                                                    </font>
                                                </font>
                                            </small>
                                        </label>
                                        <input name="school_city[]" class="form-control form-control-lg" type="text"
                                            placeholder="misalnya Jakarta">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Mayor </font>
                                            </font><small style="color:#c3c3c3">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">(Opsional)
                                                    </font>
                                                </font>
                                            </small>
                                        </label>
                                        <input name="school_major[]" class="form-control form-control-lg" type="text"
                                            placeholder="misalnya Jurusan Kedokteran">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tahun </font>
                                            </font><small style="color:#c3c3c3">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">(Opsional)
                                                    </font>
                                                </font>
                                            </small>
                                        </label>
                                        <input name="school_year[]" class="form-control form-control-lg" type="number"
                                            placeholder="misalnya tahun 2010">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Kualifikasi
                                                    yang Diperoleh </font>
                                            </font><small style="color:#c3c3c3">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">(Opsional)
                                                    </font>
                                                </font>
                                            </small>
                                        </label>
                                        <input name="school_qual[]" class="form-control form-control-lg" type="text"
                                            placeholder="misalnya Gelar Sarjana">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">IPK </font>
                                            </font><small style="color:#c3c3c3">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">(Opsional)
                                                    </font>
                                                </font>
                                            </small>
                                        </label>
                                        <input name="school_gpa[]" class="form-control form-control-lg" type="number"
                                            placeholder="misalnya 4.00">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <button id="educationformGroup" name="educationformGroup"
                                            class="btn btn-primary">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tambahkan Lebih
                                                    Banyak</font>
                                            </font>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div id="language" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Bahasa</font>
                            </font>
                        </h4>
                        <hr class="w-100 my-4">
                        <div class="row gap-y">

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Bahasa</font>
                                        </font>
                                    </label>
                                    <input name="language_name[]" class="form-control form-control-lg" type="text"
                                        placeholder="misalnya bahasa Inggris">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Lisan</font>
                                        </font>
                                    </label>
                                    <select name="language_spoken[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tertulis</font>
                                        </font>
                                    </label>
                                    <select name="language_written[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Membaca</font>
                                        </font>
                                    </label>
                                    <select name="language_reading[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Bahasa</font>
                                        </font>
                                    </label>
                                    <input name="language_name[]" class="form-control form-control-lg" type="text"
                                        placeholder="misalnya bahasa mandarin">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Lisan</font>
                                        </font>
                                    </label>
                                    <select name="language_spoken[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tertulis</font>
                                        </font>
                                    </label>
                                    <select name="language_written[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Membaca</font>
                                        </font>
                                    </label>
                                    <select name="language_reading[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Bahasa</font>
                                        </font>
                                    </label>
                                    <input name="language_name[]" class="form-control form-control-lg" type="text"
                                        placeholder="misalnya bahasa Jerman">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Lisan</font>
                                        </font>
                                    </label>
                                    <select name="language_spoken[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tertulis</font>
                                        </font>
                                    </label>
                                    <select name="language_written[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Membaca</font>
                                        </font>
                                    </label>
                                    <select name="language_reading[]" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Rendah</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Sedang</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tinggi</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>



                    <div id="certification" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Lisensi atau Sertifikasi
                                    Profesional</font>
                            </font>
                        </h4>
                        <hr class="w-100 my-4">
                        <div class="row gap-y">

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama Sertifikasi
                                            </font>
                                        </font>
                                    </label>
                                    <input name="certification_name[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama Institusi
                                            </font>
                                        </font>
                                    </label>
                                    <input name="certification_institution[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tahun yang
                                                Diperoleh</font>
                                        </font>
                                    </label>
                                    <input name="certification_obtained[]" class="form-control form-control-lg"
                                        type="number" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama Sertifikasi
                                            </font>
                                        </font>
                                    </label>
                                    <input name="certification_name[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama Institusi
                                            </font>
                                        </font>
                                    </label>
                                    <input name="certification_institution[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tahun yang
                                                Diperoleh</font>
                                        </font>
                                    </label>
                                    <input name="certification_obtained[]" class="form-control form-control-lg"
                                        type="number" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama Sertifikasi
                                            </font>
                                        </font>
                                    </label>
                                    <input name="certification_name[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama Institusi
                                            </font>
                                        </font>
                                    </label>
                                    <input name="certification_institution[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tahun yang
                                                Diperoleh</font>
                                        </font>
                                    </label>
                                    <input name="certification_obtained[]" class="form-control form-control-lg"
                                        type="number" placeholder="">
                                </div>
                            </div>

                        </div>
                    </div>



                    <div id="work" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Pengalaman kerja</font>
                            </font>
                        </h4>
                        <hr class="w-100 my-4">
                        <div id="workForm">
                            <div class="row gap-y" id="workForm0">

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Nama perusahaan
                                                </font>
                                            </font>
                                        </label>
                                        <input name="work_name[]" class="form-control form-control-lg" type="text"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">posisi terakhir
                                                </font>
                                            </font>
                                        </label>
                                        <input name="work_position[]" class="form-control form-control-lg" type="text"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Alamat
                                                    perusahaan</font>
                                            </font>
                                        </label>
                                        <textarea name="work_address[]" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Mulai tanggal
                                                </font>
                                            </font>
                                        </label>
                                        <input name="work_start[]" class="form-control form-control-lg" type="text"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tanggal
                                                    Berakhir</font>
                                            </font>
                                        </label>
                                        <input name="work_end[]" class="form-control form-control-lg" type="text"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Gaji awal
                                                </font>
                                            </font>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">Rp
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                            <input name="work_start_salary[]" type="text"
                                                class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">.00
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Gaji Terbaru
                                                </font>
                                            </font>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">Rp
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                            <input name="work_latest_salary[]" type="text"
                                                class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">.00
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Alasan untuk
                                                    pergi</font>
                                            </font>
                                        </label>
                                        <textarea name="work_reason[]" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="container row">
                                    <div class="col-12 col-lg-8 col-m">
                                        <div class="form-group">
                                            <label>
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Bolehkah
                                                        kami menghubungi
                                                        perusahaan saat ini/sebelumnya secara langsung?
                                                    </font>
                                                </font>
                                            </label>
                                            <select name="work_contact_employer[]" class="form-control form-control-lg">
                                                <option>
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">-
                                                        </font>
                                                    </font>
                                                </option>
                                                <option>
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">Ya
                                                        </font>
                                                    </font>
                                                </option>
                                                <option>
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">TIDAK
                                                        </font>
                                                    </font>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Jika ya, harap
                                                    berikan nama, nomor
                                                    kontak. Jika tidak, jelaskan alasannya</font>
                                            </font>
                                        </label>
                                        <textarea name="work_contact_yes[]" class="form-control" placeholder="" rows="1"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Prestasi</font>
                                            </font>
                                        </label>
                                        <textarea name="work_achievement[]" class="form-control" placeholder="" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Struktur organisasi
                                            </font>
                                        </font>
                                    </label>
                                    <br>
                                    <small>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">(silakan gambar
                                                struktur organisasi yang
                                                menunjukkan posisi Anda di perusahaan Anda saat ini)</font>
                                        </font>
                                    </small>
                                    <div class="custom-file">
                                        <input name="work_structure[]" type="file" class="custom-file-input"
                                            id="customFile" accept=".png, .jpg, .jpeg">
                                        <label class="custom-file-label" for="customFile">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Pilih File
                                                </font>
                                            </font>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <div class="form-group">
                                        <button id="workFormGroup" name="workFormGroup" class="btn btn-primary">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Tambahkan Lebih
                                                    Banyak</font>
                                            </font>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div id="references" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Referensi</font>
                            </font>
                        </h4>
                        <p>
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Sebutkan dua orang yang TIDAK
                                    berhubungan dengan
                                    Anda, </font>
                            </font><br>
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">yang mengetahui karakter, latar
                                    belakang atau
                                    prestasi kerja Anda </font>
                            </font><br>
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">(sebaiknya atasan langsung
                                    Anda)</font>
                            </font>
                        </p>
                        <hr class="w-100 my-4">
                        <div class="row gap-y">

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama</font>
                                        </font>
                                    </label>
                                    <input name="reference_name[]" class="form-control form-control-lg" type="text"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tahun Diketahui
                                            </font>
                                        </font>
                                    </label>
                                    <input name="reference_known[]" class="form-control form-control-lg" type="number"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">nomor kontak</font>
                                        </font>
                                    </label>
                                    <input name="reference_contact[]" class="form-control form-control-lg" type="number"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Perusahaan</font>
                                        </font>
                                    </label>
                                    <input name="reference_company[]" class="form-control form-control-lg" type="text"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Hubungan</font>
                                        </font>
                                    </label>
                                    <input name="reference_relation[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Posisi pekerjaan
                                            </font>
                                        </font>
                                    </label>
                                    <input name="reference_position[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <hr class="w-100 my-0">

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Nama</font>
                                        </font>
                                    </label>
                                    <input name="reference_name[]" class="form-control form-control-lg" type="text"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tahun Diketahui
                                            </font>
                                        </font>
                                    </label>
                                    <input name="reference_known[]" class="form-control form-control-lg" type="number"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">nomor kontak</font>
                                        </font>
                                    </label>
                                    <input name="reference_contact[]" class="form-control form-control-lg" type="number"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Perusahaan</font>
                                        </font>
                                    </label>
                                    <input name="reference_company[]" class="form-control form-control-lg" type="text"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Hubungan</font>
                                        </font>
                                    </label>
                                    <input name="reference_relation[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Posisi pekerjaan
                                            </font>
                                        </font>
                                    </label>
                                    <input name="reference_position[]" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                        </div>
                    </div>



                    <div id="benefits" class="section pt-0">
                        <h4 class="mt-5">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Gaji dan Tunjangan Saat Ini
                                </font>
                            </font>
                        </h4>
                        <hr class="w-100 my-4">
                        <div class="row gap-y">

                            <div class="container row pt-2">
                                <div class="col-12 col-lg-8 col-m">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Gaji pokok
                                                    bulanan kotor</font>
                                            </font>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">Rp
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                            <input name="salary_gross" type="text"
                                                class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">.00
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Memenuhi syarat
                                                untuk jangka waktu
                                                tertentu?</font>
                                        </font>
                                    </label>
                                    <select name="salary_overtime" class="form-control form-control-lg">
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">-</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Ya</font>
                                            </font>
                                        </option>
                                        <option>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">TIDAK</font>
                                            </font>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Jika ya, rata-rata
                                                bulanan?</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_average" type="text" class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">Tunjangan</font>
                                    </font>
                                </h5>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Makanan</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_meal" type="text" class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Angkutan</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_transport" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Telepon /
                                                Handphone</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_phone" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Yang lain</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_other" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">Fasilitas Pinjaman
                                            Jenis Pinjaman</font>
                                    </font>
                                </h5>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input name="salary_house" type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Perumahan</font>
                                        </font>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input name="salary_car" type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Mobil</font>
                                        </font>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="custom-control custom-checkbox">
                                    <input name="salary_personal" type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Pribadi</font>
                                        </font>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Jumlah yang luar
                                                biasa</font>
                                        </font>
                                    </label>
                                    <input name="salary_out_amount" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">Bunga per Tahun</font>
                                    </font>
                                </label>
                                <div class="input-group">
                                    <input name="salary_interest" type="text" class="form-control form-control-lg">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">%</font>
                                            </font>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Batas Maks</font>
                                        </font>
                                    </label>
                                    <br>
                                    <input name="salary_limit" class="form-control form-control-lg" type="number"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Periode Hutang
                                            </font>
                                        </font><small>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">(bulan/tahun)
                                                </font>
                                            </font>
                                        </small>
                                    </label>
                                    <input name="salary_out_period" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Metode Pembayaran
                                            </font>
                                        </font><small>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">(bulan/tahun)
                                                </font>
                                            </font>
                                        </small>
                                    </label>
                                    <br>
                                    <input name="salary_repayment" class="form-control form-control-lg" type="number"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="container row">
                                <div class="col-12 col-lg-8 col-m">
                                    <div class="form-group">
                                        <label>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Cuti tahunan
                                                </font>
                                            </font>
                                        </label>
                                        <div class="input-group">
                                            <input name="salary_leave" type="text"
                                                class="form-control form-control-lg">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <font style="vertical-align: inherit; font-weight: normal;">
                                                        <font style="vertical-align: inherit; font-weight: normal;">hari
                                                        </font>
                                                    </font>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">Bonus tahunan</font>
                                    </font>
                                </h5>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tunjangan Hari
                                                Raya THR</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_thr" type="text" class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Bonus penampilan
                                            </font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_bonus" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Yang lain</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_others" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">Manfaat Medis</font>
                                    </font>
                                </h5>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="custom-control custom-checkbox">
                                    <input name="salary_cashless" type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Tanpa uang tunai
                                            </font>
                                        </font>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="custom-control custom-checkbox">
                                    <input name="salary_reimbursement" type="checkbox" class="custom-control-input">
                                    <label class="custom-control-label">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Pengembalian
                                            </font>
                                        </font>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Pasien Keluar Per
                                                Tahun</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_out_patient" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Pada Pasien (Kamar
                                                &amp; Dewan)</font>
                                        </font>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">Rp</font>
                                                </font>
                                            </span>
                                        </div>
                                        <input name="salary_in_patient" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <font style="vertical-align: inherit; font-weight: normal;">
                                                    <font style="vertical-align: inherit; font-weight: normal;">.00</font>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Asuransi jiwa
                                            </font>
                                        </font>
                                    </label>
                                    <input name="salary_insurance" class="form-control form-control-lg" type="text"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label>
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Manfaat Lainnya,
                                                Mohon Penjelasannya
                                            </font>
                                        </font>
                                    </label>
                                    <textarea name="salary_other_benefit" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>


                        </div>
                    </div>



                    <div id="others" class="section pt-0">
                        <h4 class="mt-5">Compensation Benefit Expectation &amp; Commencement</h4>
                        <hr class="w-100 my-4">
                        <div class="row gap-y">

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Monthly salary (Gross)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">IDR</span>
                                        </div>
                                        <input name="compensation_salary" type="text"
                                            class="form-control form-control-lg">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Benefits / Others </label>
                                    <input name="compensation_benefit" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label>If you are offered employment with us when can you start work
                                        (or
                                        notice period) <span class="text-danger">*</span></label>
                                    <input name="compensation_workdate" class="form-control form-control-lg"
                                        type="date" placeholder="">
                                </div>
                            </div>

                            <div class="col-12">
                                <h5>Declarations and Authorizations</h5>
                            </div>


                            <div class="col-12 col-lg-12">
                                <label>1. Do you have any family members; as an employee, who working in
                                    this company? (Yes/ No)
                                    <br>
                                    <small><i> If yes, please state the name of the employee,
                                            designation
                                            and relation</i></small>
                                </label>

                                <div class="form-group">
                                    <textarea name="declare_family_member" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <label>2. Have you ever been dismissed or suspended from any position,
                                    or
                                    subject to internal disciplinary action by any of your previous
                                    employers? (Yes/ No)
                                    <br>
                                    <small><i> If yes, please state where, when and cause</i></small>
                                </label>

                                <div class="form-group">
                                    <textarea name="declare_suspended" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <label>3. Have you ever been convicted of a criminal offence anywhere in
                                    the
                                    world, excluding convictions that have been set aside or quashed?
                                    (Yes
                                    /No)
                                    <br>
                                    <small><i> If yes, please provide details.</i></small>
                                </label>

                                <div class="form-group">
                                    <textarea name="declare_criminal" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <label>4. Have you ever apply/ work in MAYAPADA HEALTHCARE GROUP?
                                    (choose
                                    one) (Yes/ No)</label>
                                <div class="form-group">
                                    <textarea name="declare_mypd" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>If yes, When ?</label>
                                    <input name="declare_mypd_when" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Where</label>
                                    <input name="declare_mypd_where" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>For position ?</label>
                                    <input name="declare_mypd_position" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label>Last selection stage (for apply)</label>
                                    <input name="declare_mypd_stage" class="form-control form-control-lg"
                                        type="text" placeholder="">
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <label>5. Are you currently holding any position in any political party
                                    or a
                                    candidate for any political office?
                                    <br>
                                    <small><i>If yes, please provide the detail of position and
                                            political
                                            party and your joining date to that political party and the
                                            position that you are running for as candidate.</i></small>
                                </label>

                                <div class="form-group">
                                    <textarea name="declare_politic" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <label>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">6. Apakah ada anggota
                                            keluarga dekat Anda
                                            yang merupakan pejabat atau lembaga pemerintah, pegawai lembaga pemerintah,
                                            pejabat partai politik, atau calon pejabat politik?
                                        </font>
                                    </font><br>
                                    <small><i>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Jika ya, mohon
                                                    sebutkan rincian
                                                    nama, jabatan/jabatan yang dijabat dan hubungan keluarga. </font>
                                                <font style="vertical-align: inherit; font-weight: normal;">Keluarga dekat
                                                    artinya suami,
                                                    istri, anak, ibu, ayah, saudara kandung.</font>
                                            </font>
                                        </i></small>
                                </label>

                                <div class="form-group">
                                    <textarea name="declare_government" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-12">
                                <label>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">7. Apakah Anda
                                            mempunyai pekerjaan atau
                                            kegiatan usaha lain di luar pekerjaan saat ini?
                                        </font>
                                    </font><br>
                                    <small><i>
                                            <font style="vertical-align: inherit; font-weight: normal;">
                                                <font style="vertical-align: inherit; font-weight: normal;">Jika ya, harap
                                                    berikan rinciannya
                                                    termasuk nama perusahaan, jenis usaha, jabatan dan tahun mulai jabatan.
                                                </font>
                                            </font>
                                        </i></small>
                                </label>

                                <div class="form-group">
                                    <textarea name="declare_business" class="form-control" placeholder="" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <label>
                                    <font style="vertical-align: inherit; font-weight: normal;">
                                        <font style="vertical-align: inherit; font-weight: normal;">Lampirkan CV (Format
                                            PDF | Ukuran File Maks
                                            2 MB) </font>
                                    </font><span class="text-danger">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">*</font>
                                        </font>
                                    </span>
                                </label>
                                <div class="custom-file">
                                    <input name="attachment" type="file" class="custom-file-input"
                                        id="customFile" accept=".pdf" required="">
                                    <label class="custom-file-label" for="customFile">
                                        <font style="vertical-align: inherit; font-weight: normal;">
                                            <font style="vertical-align: inherit; font-weight: normal;">Pilih File</font>
                                        </font>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="others" class="pt-0">
                        <button type="button" onclick="apply()" class="btn btn-block btn-success py-5 fw-800 fs-20">
                            <font style="vertical-align: inherit; font-weight: normal;">
                                <font style="vertical-align: inherit; font-weight: normal;">Lamar Sekarang
                                </font>
                            </font>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- script SasS-->
    <script src="/js/page.js"></script>
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close"
                        title="Tutup (Esc)"></button> <button class="pswp__button pswp__button--share"
                        title="Membagikan"></button> <button class="pswp__button pswp__button--fs"
                        title="Beralih ke layar penuh"></button> <button class="pswp__button pswp__button--zoom"
                        title="Memperbesar/memperkecil"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Sebelumnya (panah kiri)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Berikutnya (panah kanan)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script>
        function subscribe() {
            var email = $('#subscribeemail').val();
            $.ajax({
                url: '/news_/subscribe',
                method: 'POST',
                data: {
                    email: email
                },
                beforeSend: function() {
                    $('#btn-subs').html('Please Wait...')
                    $('#btn-subs').prop('disabled', true);
                },
                success: function() {
                    Swal.fire(
                        'Thank You!',
                        'You Subscribe to Mayapada',
                        'success'
                    );
                    $('#subscribeemail').val('')
                    $('#btn-subs').html('Subscribe')
                    $('#btn-subs').prop('disabled', false);
                },
                error: function(msg) {
                    $("#btn-subs").attr("disabled", false);
                    $('#btn-subs').html('Subscribe')
                    var json = $.parseJSON(msg.responseText);
                    // console.log(json);
                    var errorsHtml = '';
                    $.each(json.errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    Command: toastr["error"](errorsHtml);

                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            });
        }
        $(function() {
            $('.lazy').lazy({
                delay: 0,
                combined: true,
            });
        });
    </script>
    <script src="/js/jquery.easy-autocomplete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/timepicker@1.11.15/jquery.timepicker.min.js"></script>
    <script src="/js/datepicker.min.js"></script>
    <script src="/js//jquery.blockUI.js"></script>
    <script>
        $('body').scrollspy({
            target: '#navbar-form'
        })
        $('[data-spy="scroll"]').each(function() {
            var $spy = $(this).scrollspy('refresh')
        })

        $('[data-spy="scroll"]').on('activate.bs.scrollspy', function() {
            // do something...
        })

        $(document).ready(function() {
            $('#career_form').validate();
        });

        $('#switch_address').change(function() {
            if ($(this).is(':checked')) {
                var address = $('#current_address').val();
                console.log(address);
                $('#permanent_address').val(address);
            } else {
                $('#permanent_address').val("");
            }
        })

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var career = document.getElementById('career_form');

        function apply() {
            if ($('#career_form').valid()) {
                console.log('hey');
                $.ajax({
                    type: 'POST',
                    url: '/career/form/10',
                    data: new FormData(career),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $.blockUI({
                            message: '<img src="/img/loading.gif" />',
                            css: {
                                border: '0',
                                backgroundColor: 'transparent',
                            }
                        });
                    },
                    success: function(response) {
                        console.log(response);
                        $.unblockUI();
                        Swal.fire({
                            title: 'Complete',
                            icon: 'success',
                            html: "You Completed our application form, please wait for response from our team",
                            // showCloseButton: tr,
                            // showCancelButton: true,
                            // focusConfirm: false,
                            showConfirmButton: false,
                            timer: 4000,
                        });
                        setTimeout(function() {
                            window.location.href = "/career"
                        }, 3000);
                        // $('#modal_book').unblock();
                        // $('#modal_book').modal('toggle');
                        // $('#modal_book').html(response);
                    },
                    error: function(xhr) {
                        alert('Incomplete form, You must fill all required form!');
                        $.unblockUI();
                        $('html, body').animate({
                            scrollTop: $("#application_start").offset().top
                        });
                    }
                })
            } else {
                alert('Incomplete form, You must fill all required form!');
                $('html, body').animate({
                    scrollTop: $("#application_start").offset().top
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var next = 0;
            $("#familyformGroup").click(function(e) {
                e.preventDefault();
                var addto = "#familyForm" + next;
                var addRemove = "#familyForm" + (next);
                next = next + 1;
                var newIn = ' <div id="familyForm' + next + '" name="familyForm' + next +
                    '"> <div class="row gap-y" id="familyForm0"> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Name</label> <input name="family_name[]" class="form-control form-control-lg" type="text" placeholder="Enter Full Name"> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Sex</label> <select name="family_sex[]" class="form-control form-control-lg"> <option>Male</option> <option>Female</option> </select> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Relationship</label> <input name="family_relationship[]" class="form-control form-control-lg" type="text" placeholder="e.g. Cousin/Spouse/Daughter etc."> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Education/ Occupation/ Company</label> <input name="family_occupation[]" class="form-control form-control-lg" type="text" placeholder="e.g. Highschool"> </div> </div> </div>';
                var newInput = $(newIn);
                var removeBtn = '<button id="remove' + (next - 1) +
                    '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="familyForm">';
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                $(addRemove).after(removeButton);
                $("#familyForm" + next).attr('data-source', $(addto).attr('data-source'));
                $("#count").val(next);

                $('.remove-me').click(function(e) {
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length - 1);
                    var fieldID = "#familyForm" + fieldNum;
                    $(this).remove();
                    $(fieldID).remove();
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var next = 0;
            $("#relativesFormGroup").click(function(e) {
                e.preventDefault();
                var addto = "#relativesForm" + next;
                var addRemove = "#relativesForm" + (next);
                next = next + 1;
                var newIn = '<div id="relativesForm' + next + '" name="relativesForm' + next +
                    '"><div class="row gap-y" id="relativesForm0"> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Name</label> <input name="relative_name[]" class="form-control form-control-lg" type="text" placeholder="Enter Full Name"> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Sex</label> <select name="relative_sex[]" class="form-control form-control-lg"> <option>Male</option> <option>Female</option> </select> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Relationship</label> <input name="relative_relation[]" class="form-control form-control-lg" type="text" placeholder="e.g. Cousin/Spouse/Daughter etc."> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Education/ Occupation/ Company:</label> <input name="relative_occupation[]" class="form-control form-control-lg" type="text" placeholder="e.g. Highschool"> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Date of Birth</label> <input name="relative_birthdate[]" class="form-control form-control-lg" type="date" placeholder=""> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Place of Birth</label> <input name="relative_birthplace[]" class="form-control form-control-lg" type="text" placeholder="Jakarta"> </div> </div> </div>';
                var newInput = $(newIn);
                var removeBtn = '<button id="remove' + (next - 1) +
                    '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="relativesForm">';
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                $(addRemove).after(removeButton);
                $("#relativesForm" + next).attr('data-source', $(addto).attr('data-source'));
                $("#count").val(next);

                $('.remove-me').click(function(e) {
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length - 1);
                    var fieldID = "#relativesForm" + fieldNum;
                    $(this).remove();
                    $(fieldID).remove();
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var next = 0;
            $("#emergencyFormGroup").click(function(e) {
                e.preventDefault();
                var addto = "#emergencyForm" + next;
                var addRemove = "#emergencyForm" + (next);
                next = next + 1;
                var newIn = '<div id="emergencyForm' + next + '" name="emergencyForm' + next +
                    '"><div class="row gap-y" id="emergencyForm0"><div class="col-12 col-lg-4"id="emergencyForm0"><div class="form-group"><label>Name</label><input name="emergency_name[]"class="form-control form-control-lg"type="text"placeholder="Enter Full Name"></div></div><div class="col-12 col-lg-4"><div class="form-group"><label>Relationship</label><input name="emergency_relation[]"class="form-control form-control-lg"type="text"placeholder="e.g. Spouse"></div></div><div class="col-12 col-lg-4"><div class="form-group"><label>Phone Number</label><input name="emergency_phone[]"class="form-control form-control-lg"type="number"placeholder="+6212341234123"></div></div><div class="col-12 col-lg-12"><label>Address</label><div class="form-group"><textarea name="emergency_address[]"class="form-control"placeholder=""rows="3"></textarea></div></div></div>';
                var newInput = $(newIn);
                var removeBtn = '<button id="remove' + (next - 1) +
                    '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="emergencyForm">';
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                $(addRemove).after(removeButton);
                $("#emergencyForm" + next).attr('data-source', $(addto).attr('data-source'));
                $("#count").val(next);

                $('.remove-me').click(function(e) {
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length - 1);
                    var fieldID = "#emergencyForm" + fieldNum;
                    $(this).remove();
                    $(fieldID).remove();
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            var next = 0;
            $("#educationformGroup").click(function(e) {
                e.preventDefault();
                var addto = "#educationForm" + next;
                var addRemove = "#educationForm" + (next);
                next = next + 1;
                var newIn = ' <div id="educationForm' + next + '" name="educationForm' + next +
                    '"><div class="row gap-y" id="educationForm0"> <div class="col-12 col-lg-12"> <div class="form-group"> <label>School/Institution</label> <input name="school_name[]" class="form-control form-control-lg" type="text" placeholder="Enter School/Institution"> </div> </div> <div class="col-12 col-lg-4"> <div class="form-group"> <label>City <small style="color:#c3c3c3">(Optional)</small></label> <input name="school_city[]" class="form-control form-control-lg" type="text" placeholder="e.g. Jakarta"> </div> </div> <div class="col-12 col-lg-4"> <div class="form-group"> <label>Major <small style="color:#c3c3c3">(Optional)</small></label> <input name="school_major[]" class="form-control form-control-lg" type="text" placeholder="e.g. Major in Medicine"> </div> </div> <div class="col-12 col-lg-4"> <div class="form-group"> <label>Year <small style="color:#c3c3c3">(Optional)</small></label> <input name="school_year[]" class="form-control form-control-lg" type="number" placeholder="e.g. 2010"> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>Qualification Obtained <small style="color:#c3c3c3">(Optional)</small></label> <input name="school_qual[]" class="form-control form-control-lg" type="text" placeholder="e.g. Bachelors Degree"> </div> </div> <div class="col-12 col-lg-6"> <div class="form-group"> <label>GPA <small style="color:#c3c3c3">(Optional)</small></label> <input name="school_gpa[]" class="form-control form-control-lg" type="number" placeholder="e.g. 4.00"> </div> </div> </div>';
                var newInput = $(newIn);
                var removeBtn = '<button id="remove' + (next - 1) +
                    '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="educationForm">';
                var removeButton = $(removeBtn);
                $(addto).after(newInput);
                $(addRemove).after(removeButton);
                $("#educationForm" + next).attr('data-source', $(addto).attr('data-source'));
                $("#count").val(next);

                $('.remove-me').click(function(e) {
                    e.preventDefault();
                    var fieldNum = this.id.charAt(this.id.length - 1);
                    var fieldID = "#educationForm" + fieldNum;
                    $(this).remove();
                    $(fieldID).remove();
                });
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
                    '"><div class="row gap-y"id="workForm0"><div class="col-12 col-lg-6"><div class="form-group"><label>Company Name</label><input name="work_name[]"class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-6"><div class="form-group"><label>Latest Position</label><input name="work_position[]"class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-12"><div class="form-group"><label>Company Address</label><textarea name="work_address[]"class="form-control"placeholder=""rows="3"></textarea></div></div><div class="col-12 col-lg-6"><div class="form-group"><label>Start Date</label><input name="work_start[]"class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-6"><div class="form-group"><label>End Date</label><input name="work_end[]"class="form-control form-control-lg"type="text"placeholder=""></div></div><div class="col-12 col-lg-6"><div class="form-group"><label>Starting Salary</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">IDR</span></div><input name="work_start_salary[]"type="text"class="form-control form-control-lg"type="number"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></div></div><div class="col-12 col-lg-6"><div class="form-group"><label>Latest Salary</label><div class="input-group"><div class="input-group-prepend"><span class="input-group-text">IDR</span></div><input name="work_latest_salary[]"type="text"class="form-control form-control-lg"type="number"><div class="input-group-append"><span class="input-group-text">.00</span></div></div></div></div><div class="col-12 col-lg-12"><div class="form-group"><label>Reason for leaving</label><textarea name="work_reason[]"class="form-control"placeholder=""rows="3"></textarea></div></div><div class="container row"><div class="col-12 col-lg-8 col-m"><div class="form-group"><label>May we contact this current/ previous employer directly? </label><select name="work_contact_employer[]"class="form-control form-control-lg"><option>-</option><option>Yes</option><option>No</option></select></div></div></div><div class="col-12 col-lg-12"><div class="form-group"><label>If yes, please provide name, contact number If not, please explain why</label><textarea name="work_contact_yes[]"class="form-control"placeholder=""rows="1"></textarea></div></div><div class="col-12 col-lg-12"><div class="form-group"><label>Achievement(s)</label><textarea name="work_achievement[]"class="form-control"placeholder=""rows="3"></textarea></div></div><div class="col-md-12"><label>Organization Structure</label><br><small>(please draw organization structure showing your position in your current company)</small><div class="custom-file"><input name="work_structure[]"type="file"class="custom-file-input"id="customFile"accept=".png, .jpg, .jpeg"><label class="custom-file-label"for="customFile">Choose file</label></div></div></div></div>';
                var newInput = $(newIn);
                var removeBtn = '<button id="remove' + (next - 1) +
                    '" class="btn btn-danger remove-me" >Remove</button></div></div><div id="workForm">';
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
