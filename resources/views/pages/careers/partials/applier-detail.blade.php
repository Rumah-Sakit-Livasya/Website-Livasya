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
                        <div class="row ml-5">
                            <table>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Nama Lengkap
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">:
                                        {{ ucfirst($applier->first_name) }} {{ ucfirst($applier->last_name) }}</td>
                                </tr>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Jenis Kelamin
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">: {{ ucfirst($applier->sex) }}</td>
                                </tr>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Tempat Lahir
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">:
                                        {{ ucfirst($applier->birth_place) }}</td>
                                </tr>
                                <tr>
                                    <td style="display: inline-block; line-height: 5px; font-weight: bold;">Tanggal Lahir
                                    </td>
                                    <td style="display: inline-block; line-height: 5px;">:
                                        {{ ucfirst($applier->birth_day) }}</td>
                                </tr>
                            </table>
                        </div>
                        <hr class="fc-divider mt-2">
                        <section id="data-pribadi" class="border">
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <h5 class="text-center p-3" style="font-weight: bolder">DATA PRIBADI</h5>
                                </div>
                            </div>

                            <div class="row">
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

                        <!-- datatable start -->
                        <table id="dt-basic-example"
                            class="overflow-hidden mt-3 table table-bordered table-hover table-striped w-100">
                            <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" class="text-center font-weight-bold">DATA PRIBADI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                No KTP
                                            </div>
                                            <div class="col-6">
                                                : {{ $applier->id_card }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Alamat Email
                                            </div>
                                            <div class="col-6">
                                                : {{ $applier->email }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Status Pernikahan
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->marital_status) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Agama
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->religion) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Suku
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->suku) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap"></td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                No. NPWP
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->npwp) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                No. BPJS Kesehatan
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->social_security) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Alamat KTP
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->ktp_address) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Alamat Domisili
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->permanent_address) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- datatable end -->
                        <hr class="fc-divider my-2">
                        <!-- datatable start -->
                        <table id="dt-basic-example"
                            class="overflow-hidden mt-3 table table-bordered table-hover table-striped w-100">
                            <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" class="text-center font-weight-bold">INFORMASI KELUARGA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Nama
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->family_name) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Jenis Kelamin
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->family_sex) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Hubungan
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->family_relationship) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Pendidikan / Pekerjaan / Perusahaan
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->family_occupation) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-50">
                                            <div class="col-6" style="font-weight: bold">
                                                Nomor Kontak
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->family_contact) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- datatable end -->
                        <hr class="fc-divider my-2">
                        <table id="dt-basic-example"
                            class="overflow-hidden mt-3 table table-bordered table-hover table-striped w-100">
                            <thead class="bg-secondary">
                                <tr>
                                    <th colspan="2" class="text-center font-weight-bold">KONTAK DARURAT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Nama
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->emergency_name) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Hubungan
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->emergency_relation) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Nomor Telpon
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->emergency_phone) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="white-space: nowrap">
                                        <div class="row w-75">
                                            <div class="col-6" style="font-weight: bold">
                                                Alamat
                                            </div>
                                            <div class="col-6">
                                                : {{ ucfirst($applier->emergency_address) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
