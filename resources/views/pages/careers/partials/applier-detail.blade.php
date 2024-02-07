@extends('inc.layout-blank')

@section('content')
    <div class="row overflow-y-hidden">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <h2 class="text-center fw-bold mt-3" style="text-decoration: underline; font-weight: bolder">
                    FORMULIR DATA PELAMAR
                </h2>

                <div class="row justify-content-center overflow-hidden">
                    <div class="col-lg-10 col-12">
                        <span class="ml-3">Jabatan yang dilamar:</span> <span
                            style="text-decoration: underline">{{ $applier->career->title }}</span>
                        <hr class="fc-divider mt-2">
                        <div class="row ml-3">
                            <table>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Nama Lengkap
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">:
                                        {{ strtoupper($applier->first_name) }} {{ strtoupper($applier->last_name) }}</td>
                                </tr>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Jenis Kelamin
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">: {{ strtoupper($applier->sex) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Tempat Lahir
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">:
                                        {{ strtoupper($applier->birth_place) }}</td>
                                </tr>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Tanggal Lahir
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">:
                                        {{ strtoupper(tgl($applier->birth_day)) }}</td>
                                </tr>
                            </table>
                        </div>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center p-1 text-white" style="font-weight: bolder">DATA PRIBADI</h5>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-lg-2">
                                    <strong>No. KTP</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->id_card }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Alamat Email</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->email }}
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Status Pernikahan</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->marital_status }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Agama</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->religion }}
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Suku</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->suku }}
                                </div>
                                <div class="col-12 col-lg-2"></div>
                                <div class="col-12 col-lg-4"></div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Alamat KTP</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->ktp_address }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Alamat Domisili</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->permanent_address }}
                                </div>
                            </div>
                        </section>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">INFORMASI KELUARGA
                                    </h5>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-lg-2">
                                    <strong>Nama</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->family_name }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Jenis Kelamin</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->family_sex }}
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Hubungan</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->family_relationship }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Pekerjaan</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->family_occupation }}
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Nomor Kontak</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->family_contact }}
                                </div>
                                <div class="col-12 col-lg-2"></div>
                                <div class="col-12 col-lg-4"></div>
                            </div>
                        </section>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">PENDIDIKAN TERAKHIR
                                    </h5>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-lg-2">
                                    <strong>Sekolah/Institusi </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->school_name }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Kota </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->school_city }}
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Tahun Lulus </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->school_year }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Kualifikasi yang Diperoleh</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->school_qual }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Jurusan </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->school_major }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>IPK / Nilai Akhir</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->school_gpa }}
                                </div>
                            </div>
                        </section>
                        <hr class="fc-divider my-2">
                        @foreach ($works as $work)
                            <section id="data-pribadi" class="border px-3 pb-3">
                                <div class="row bg-secondary">
                                    <div class="col-12 col-lg-12">
                                        <h5 class="text-center  p-1 text-white" style="font-weight: bolder">PENGALAMAN KERJA
                                            {{ count($works) > 1 ?? $loop->iteration }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-lg-2">
                                        <strong>Nama Perusahaan </strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_name }}
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <strong>Posisi Terakhir </strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_position }}
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12 col-lg-2">
                                        <strong>Mulai Tanggal </strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_start }}
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <strong>Berakhir Tanggal</strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_end }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 col-lg-2">
                                        <strong>Gaji Awal </strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_start_salary }}
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <strong>Gaji Sebelum Pindah</strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_latest_salary }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 col-lg-2">
                                        <strong>Alamat Perusahaan </strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_address }}
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <strong>Alasan Pindah</strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_reason }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 col-lg-2">
                                        <strong>Boleh menghubungi perusahaan? </strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_contact_employer }}
                                    </div>
                                    <div class="col-12 col-lg-2">
                                        <strong>Ya/Tidak</strong>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        : {{ $work->work_contact_yes }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 col-lg-2">
                                        <strong>Prestasi </strong>
                                    </div>
                                    <div class="col-12 col-lg-10">
                                        : {{ $work->work_achievement }}
                                    </div>
                                </div>
                            </section>
                        @endforeach
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">HARAPAN &
                                        PERMULAAN MANFAAT KOMPENSASI
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-2">
                                    <strong>Gaji bulanan (Kotor) </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $work->work_name }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Manfaat / Lainnya </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $work->work_position }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Kapan bisa mulai bekerja </strong>
                                </div>
                                <div class="col-12 col-lg-10">
                                    : {{ tgl($work->work_start) }}
                                </div>
                            </div>
                        </section>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">DEKLARASI DAN
                                        OTORISASI
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>1. Apakah Anda mempunyai anggota keluarga; karyawan, siapa yang bekerja di
                                        perusahaan ini? (Ya/Tidak) * </strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->declare_family_member }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>2. Apakah Anda pernah diberhentikan atau ditangguhkan dari posisi apa pun, atau
                                        dikenakan tindakan disipliner internal oleh perusahaan tempat Anda bekerja
                                        sebelumnya? (Ya/Tidak) </strong>
                                </div>
                                <div class="col-12 col-lg-2">
                                    : {{ $applier->declare_suspended }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>3. Apakah Anda pernah dihukum karena melakukan tindak pidana di mana pun di
                                        dunia, kecuali hukuman yang telah dibatalkan atau dibatalkan? (Ya / Tidak) </strong>
                                </div>
                                <div class="col-12 col-lg-2">
                                    : {{ $applier->declare_criminal }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>4. Apakah anda pernah melamar/bekerja di RUMAH SAKIT LIVASYA? pilih salah satu
                                        (Ya/Tidak) </strong>
                                </div>
                                <div class="col-12 col-lg-2">
                                    : {{ $applier->declare_lvs }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-3">
                                    <strong>Jika ya kapan ?</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    : {{ $applier->declare_lvs_when == '' ? ' -' : "$applier->declare_lvs_when" }}
                                </div>
                                <div class="col-12 col-lg-3">
                                    <strong>Dimana?</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    : {{ $applier->declare_lvs_where == '' ? ' -' : "$applier->declare_lvs_where" }}
                                </div>
                            </div>
                            <div class="row mt-3">

                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-3">
                                    <strong>Untuk Posisi?</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    : {{ $applier->declare_lvs_position == '' ? ' -' : "$applier->declare_lvs_position" }}
                                </div>
                                <div class="col-12 col-lg-3">
                                    <strong>Tahap seleksi terakhir (untuk melamar)</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    : {{ $applier->declare_lvs_stage == '' ? ' -' : "$applier->declare_lvs_stage" }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>5. Apakah Anda saat ini memegang posisi di partai politik atau calon pejabat
                                        politik mana pun? </strong>
                                </div>
                                <div class="col-12 col-lg-2">
                                    : {{ $applier->declare_politic }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>6. Apakah ada anggota keluarga dekat Anda yang merupakan pejabat atau lembaga
                                        pemerintah, pegawai lembaga pemerintah, pejabat partai politik, atau calon pejabat
                                        politik? </strong>
                                </div>
                                <div class="col-12 col-lg-2">
                                    : {{ $applier->declare_government }}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-8">
                                    <strong>7. Apakah Anda mempunyai pekerjaan atau kegiatan usaha lain di luar pekerjaan
                                        saat ini? </strong>
                                </div>
                                <div class="col-12 col-lg-2">
                                    : {{ $applier->declare_business }}
                                </div>
                            </div>
                        </section>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">BAHASA
                                    </h5>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-lg-3">
                                    <strong>Bahasa</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <strong>Lisan</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <strong>Menulis</strong>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <strong>Membaca</strong>
                                </div>
                            </div>
                            @foreach ($languages as $language)
                                <div class="row mt-3">
                                    <div class="col-12 col-lg-3">
                                        {{ $language->language_name }}
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        {{ $language->language_spoken }}
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        {{ $language->language_written }}
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        {{ $language->language_reading }}
                                    </div>
                                </div>
                            @endforeach
                        </section>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">LISENSI ATAU
                                        SERTIFIKASI PROFESIONAL
                                    </h5>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 col-lg-4">
                                    <strong>Nama Sertifikasi</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <strong>Nama Institusi</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <strong>Tahun yang Diperoleh</strong>
                                </div>
                            </div>
                            @foreach ($certifications as $certification)
                                <div class="row mt-3">
                                    <div class="col-12 col-lg-3">
                                        {{ $certification->certification_name }}
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        {{ $certification->certification_institution }}
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        {{ $certification->certification_obtained }}
                                    </div>
                                </div>
                            @endforeach
                        </section>
                        <hr class="fc-divider my-2">
                        <section id="data-pribadi" class="border px-3 pb-3 mb-5">
                            <div class="row bg-secondary">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center  p-1 text-white" style="font-weight: bolder">KONTAK DARURAT
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-lg-2">
                                    <strong>Nama</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->emergency_name }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Hubungan</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->emergency_relation }}
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12 col-lg-2">
                                    <strong>Nomor Telpon</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->emergency_phone }}
                                </div>
                                <div class="col-12 col-lg-2">
                                    <strong>Alamat</strong>
                                </div>
                                <div class="col-12 col-lg-4">
                                    : {{ $applier->emergency_address }}
                                </div>
                            </div>
                        </section>

                        <a href="{{ url()->previous() }}" class="btn btn-outline-primary waves-effect waves-themed mb-5">
                            <i class='bx bx-left-arrow-alt'></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
