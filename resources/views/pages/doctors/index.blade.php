@extends('inc.layout')
@section('title', 'Dokter')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon bx bx-user text-primary'></i> Manajemen Dokter
                <small>
                    Kelola data dokter, departemen spesialisasi, dan jadwal praktik di RS Livasya.
                </small>
            </h1>
            <div class="subheader-block d-flex" style="gap: 8px;">
                <button id="btn-tambah-dokter" type="button" class="btn btn-primary waves-effect waves-themed font-weight-bold shadow-sm" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-dokter" title="Tambah Dokter">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Dokter
                </button>
                <button id="btn-tambah-departemen" type="button" class="btn waves-effect waves-themed font-weight-bold shadow-sm d-none" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-departement" title="Tambah Departemen"
                    style="background-color: #7c3aed; border-color: #7c3aed; color: #fff;">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Departemen
                </button>
            </div>
        </div>

        {{-- Statistik Ringkasan --}}
        <div class="row mb-g">
            {{-- Total Dokter --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Total Dokter</span>
                            <h2 class="font-weight-bold text-dark mb-0 mt-1" style="font-size: 24px;">{{ $doctors->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 46px; height: 46px; background-color: #eff6ff; border: 1px solid #bfdbfe;">
                            <i class="fal fa-user-md" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Spesialis --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Spesialis</span>
                            <h2 class="font-weight-bold mb-0 mt-1 text-purple" style="font-size: 24px; color: #7c3aed !important;">{{ $doctors->filter(fn($d) => strpos(strtolower($d->jabatan), 'spesialis') !== false)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-purple" style="width: 46px; height: 46px; background-color: #f3e8ff; border: 1px solid #e9d5ff; color: #7c3aed !important;">
                            <i class="fal fa-stethoscope" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Dokter Umum --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Dokter Umum</span>
                            <h2 class="font-weight-bold text-warning mb-0 mt-1" style="font-size: 24px;">{{ $doctors->filter(fn($d) => strpos(strtolower($d->jabatan), 'umum') !== false)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-warning" style="width: 46px; height: 46px; background-color: #fffbeb; border: 1px solid #fde68a;">
                            <i class="fal fa-heartbeat" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Dokter Aktif --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Status Aktif</span>
                            <h2 class="font-weight-bold text-success mb-0 mt-1" style="font-size: 24px;">{{ $doctors->where('is_active', 1)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 46px; height: 46px; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <i class="fal fa-check-circle" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pills Tab Navigation --}}
        <div class="row mb-2">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-dokter-tab" role="tablist" style="gap: 6px;">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" id="pills-dokter-link" data-toggle="pill"
                            href="#pills-dokter" role="tab" aria-controls="pills-dokter" aria-selected="true"
                            style="font-size: 13px; border-radius: 20px; padding: 6px 18px;">
                            <i class="fal fa-user-md mr-1"></i> Daftar Dokter
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="pills-departemen-link" data-toggle="pill"
                            href="#pills-departemen" role="tab" aria-controls="pills-departemen" aria-selected="false"
                            style="font-size: 13px; border-radius: 20px; padding: 6px 18px; color: #7c3aed;">
                            <i class="fal fa-building mr-1"></i> Departemen
                            <span class="badge badge-pill ml-1" style="background-color: #ede9fe; color: #7c3aed; font-size: 10px;">{{ $departements->count() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="pills-dokter-tabContent">
            {{-- TAB 1: Daftar Dokter --}}
            <div class="tab-pane fade show active" id="pills-dokter" role="tabpanel">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="panel-dokter" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                            <div class="panel-hdr bg-faded">
                                <h2><i class="fal fa-user-md mr-2 text-primary"></i> Daftar Dokter</h2>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <table id="dt-dokter" class="table table-bordered table-hover table-striped w-100 align-middle-table">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="width: 50px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">No</th>
                                                <th style="width: 70px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Foto</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Informasi Dokter</th>
                                                <th style="width: 250px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Departement</th>
                                                <th style="width: 120px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Status</th>
                                                <th style="width: 260px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($doctors as $doctor)
                                                <tr>
                                                    <td class="text-center font-weight-bold text-muted align-middle">{{ $loop->iteration }}</td>
                                                    <td class="text-center align-middle">
                                                        <div style="width: 45px; height: 45px; border-radius: 50%; overflow: hidden; display: inline-block; border: 2px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                                            @if($doctor->foto)
                                                                <img src="{{ asset('storage/' . $doctor->foto) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $doctor->name }}" onerror="this.onerror=null; this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2245%22%20height%3D%2245%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%23f1f5f9%22%2F%3E%3Ctext%20x%3D%2250%25%22%20y%3D%2250%25%22%20font-size%3D%228%22%20fill%3D%22%2394a3b8%22%20font-family%3D%22sans-serif%22%20text-anchor%3D%22middle%22%20dy%3D%22.3em%22%3EDoc%3C%2Ftext%3E%3C%2Fsvg%3E';">
                                                            @else
                                                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-muted" style="width: 100%; height: 100%;">
                                                                    <i class="fal fa-user-md" style="font-size: 18px;"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="align-middle" style="white-space: normal;">
                                                        <div class="font-weight-bold text-dark fs-md" style="font-size: 14px; margin-bottom: 2px;">{{ $doctor->name }}</div>
                                                        <div class="text-muted" style="font-size: 11px;"><i class="fal fa-briefcase mr-1"></i>{{ $doctor->jabatan }}</div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <span class="badge-category cat-rs" style="font-size: 11px; padding: 4px 10px; border-radius: 20px;">{{ $doctor->departement->name ?? '-' }}</span>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if($doctor->is_active == 1)
                                                            <span class="badge-status badge-status-active"><span class="status-dot bg-success mr-1"></span>Aktif</span>
                                                        @else
                                                            <span class="badge-status badge-status-inactive"><span class="status-dot bg-danger mr-1"></span>Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                                            <button type="button" data-backdrop="static" data-keyboard="false"
                                                                class="btn-action-custom btn-action-detail edit-button"
                                                                data-toggle="modal" data-target="#edit-dokter" title="Ubah Info"
                                                                data-doctor-id="{{ $doctor->id }}">
                                                                <span class="fal fa-pencil mr-1"></span>Ubah
                                                            </button>
                                                            <button type="button" data-backdrop="static" data-keyboard="false"
                                                                class="btn-action-custom btn-action-accept edit-departement-button"
                                                                data-toggle="modal" data-target="#edit-departement-dokter" title="Ubah Departemen"
                                                                data-doctor-id="{{ $doctor->id }}" style="background-color: #f0fdf4; color: #15803d !important; border-color: #bbf7d0;">
                                                                <i class='bx bx-card mr-1'></i>Departemen
                                                            </button>
                                                            @if ($doctor->is_active == 1)
                                                                <button type="button"
                                                                    class="btn-action-custom btn-action-reject deactivate-doctor-button"
                                                                    data-doctor-id="{{ $doctor->id }}" onclick="btnDeactivateDoctor(event)" title="Nonaktifkan Dokter">
                                                                    <i class='bx bx-minus-circle mr-1'></i>Nonaktif
                                                                </button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn-action-custom btn-action-accept activate-doctor-button"
                                                                    data-doctor-id="{{ $doctor->id }}" onclick="btnActivateDoctor(event)" title="Aktifkan Dokter">
                                                                    <i class='bx bx-check-circle mr-1'></i>Aktif
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Foto</th>
                                                <th>Informasi Dokter</th>
                                                <th>Departement</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @include('pages.doctors.partials.edit-doctor')
                                    @include('pages.doctors.partials.create-doctor')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TAB 2: Departemen --}}
            <div class="tab-pane fade" id="pills-departemen" role="tabpanel">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="panel-departemen" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                            <div class="panel-hdr" style="background: linear-gradient(135deg, #f3e8ff 0%, #ede9fe 100%);">
                                <h2><i class="fal fa-building mr-2" style="color: #7c3aed;"></i> <span style="color: #7c3aed;">Departemen Spesialisasi</span></h2>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <table id="dt-departemen" class="table table-bordered table-hover table-striped w-100 align-middle-table">
                                        <thead style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%); color: #fff;">
                                            <tr>
                                                <th style="width: 50px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">No</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Nama Departemen</th>
                                                <th style="width: 120px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Urutan</th>
                                                <th style="width: 120px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Status</th>
                                                <th style="width: 180px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($departements as $dep)
                                                <tr>
                                                    <td class="text-center font-weight-bold text-muted align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">
                                                        <div class="d-flex align-items-center" style="gap: 10px;">
                                                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; background-color: #ede9fe; border: 1px solid #c4b5fd;">
                                                                <i class="fal fa-stethoscope" style="font-size: 14px; color: #7c3aed;"></i>
                                                            </div>
                                                            <span class="font-weight-bold text-dark" style="font-size: 13px;">{{ $dep->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <span class="badge badge-pill" style="background-color: #ede9fe; color: #7c3aed; font-size: 12px; font-weight: 700; padding: 5px 12px;">#{{ $dep->urutan }}</span>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if($dep->is_active == 1)
                                                            <span class="badge-status badge-status-active"><span class="status-dot bg-success mr-1"></span>Aktif</span>
                                                        @else
                                                            <span class="badge-status badge-status-inactive"><span class="status-dot bg-danger mr-1"></span>Nonaktif</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                                            <button type="button" data-backdrop="static" data-keyboard="false"
                                                                class="btn-action-custom btn-action-detail edit-dep-button"
                                                                data-toggle="modal" data-target="#edit-departement-tab" title="Ubah Departemen"
                                                                data-dep-id="{{ $dep->id }}">
                                                                <span class="fal fa-pencil mr-1"></span>Ubah
                                                            </button>
                                                            @if ($dep->is_active == 1)
                                                                <button type="button"
                                                                    class="btn-action-custom btn-action-reject deactivate-dep-button"
                                                                    data-dep-id="{{ $dep->id }}" onclick="btnDeactivateDep(event)" title="Nonaktifkan">
                                                                    <i class='bx bx-minus-circle mr-1'></i>Nonaktif
                                                                </button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn-action-custom btn-action-accept activate-dep-button"
                                                                    data-dep-id="{{ $dep->id }}" onclick="btnActivateDep(event)" title="Aktifkan">
                                                                    <i class='bx bx-check-circle mr-1'></i>Aktif
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th>Nama Departemen</th>
                                                <th class="text-center">Urutan</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @include('pages.departements.partials.edit-departement')
                                    @include('pages.departements.partials.create-departement')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script nonce="{{ $nonce }}">
        function createPreviewImage() {
            const image = document.querySelector('#create-image');
            const imgPreview = document.querySelector('.create-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function createPreviewPoster() {
            const poster = document.querySelector('#create-poster');
            const imgPreview = document.querySelector('.create-poster-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(poster.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function createPreviewJadwal() {
            const jadwal = document.querySelector('#create-jadwal');
            const imgPreview = document.querySelector('.create-jadwal-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(jadwal.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewImage() {
            const image = document.querySelector('#edit-image');
            const imgPreview = document.querySelector('.edit-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewPoster() {
            const poster = document.querySelector('#edit-poster');
            const imgPreview = document.querySelector('.edit-poster-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(poster.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewJadwal() {
            const jadwal = document.querySelector('#edit-jadwal');
            const imgPreview = document.querySelector('.edit-jadwal-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(jadwal.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            // SELECT2
            $(function() {
                $('#create-category').select2({
                    dropdownParent: $('#tambah-dokter')
                });
                $('#edit-category').select2({
                    dropdownParent: $('#edit-dokter')
                });
                $('#create-departement').select2({
                    dropdownParent: $('#tambah-dokter')
                });
                $('#edit-departement').select2({
                    dropdownParent: $('#edit-departement-dokter')
                });
            });
            // SELECT2

            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-doctor-form')[0]);

                $.ajax({
                    type: 'post',
                    url: '/api/doctors',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-dokter').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Dokter Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-dokter').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var doctorId = $(this).data('doctor-id');

                // Set the category ID to the modal input field
                $('#edit-doctor-id').val(doctorId);

                $.ajax({
                    type: 'GET',
                    url: '/api/doctors/' + doctorId,
                    success: function(data) {
                        $('#edit-name').val(data.name);
                        $('#edit-jabatan').val(data.jabatan);
                        $('#edit-deskripsi').val(data.deskripsi);
                        $('#edit-deskripsi-text').val(data.deskripsi);
                        $('#oldImage').val(data.foto);
                        $('#oldPoster').val(data.poster);
                        $('#oldJadwal').val(data.jadwal);

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.foto);
                        }

                        var previewPoster = $('.edit-poster-preview');
                        if (previewPoster.length) {
                            previewPoster.attr('src', '/storage/' + data.poster);
                        }

                        var previewJadwal = $('.edit-jadwal-preview');
                        if (previewJadwal.length) {
                            previewJadwal.attr('src', '/storage/' + data.jadwal);
                        }

                        // Show the modal
                        $('#edit-dokter').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });

            // Submit the form via AJAX
            $('#update-doctor-form').on('submit', function(e) {
                e.preventDefault();

                var doctorId = $('#edit-departement-doctor-id').val();

                // Membuat FormData untuk mengambil data formulir, termasuk file
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/doctors/' + doctorId,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-dokter').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Dokter Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-dokter').modal('hide');
                        // Handle errors, e.g., display validation errors
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            $('.edit-departement-button').on('click', function() {
                var doctorId = $(this).data('doctor-id');
                console.log(doctorId);

                // Set the doctor ID to the modal input field
                $('#edit-departement-doctor-id').val(doctorId);

                $.ajax({
                    type: 'GET',
                    url: '/api/doctors/' + doctorId + '/departement',
                    success: function(data) {
                        console.log(data); // Debugging untuk melihat struktur data

                        // Mencari dokter berdasarkan doctorId
                        var doctor = data.find(function(item) {
                            return item.id === doctorId; // Mencocokkan ID dokter
                        });

                        // Set value for select2
                        if (doctor && doctor.departement_id !== undefined) {
                            $('#edit-departement').val(doctor.departement_id).trigger(
                                'change'); // Trigger change after setting value
                        } else {
                            showErrorAlert('Departement ID tidak ditemukan dalam respons.');
                        }

                        // Show the modal
                        $('#edit-departement-dokter').modal('show');
                    },
                    error: function(error) {
                        $('#edit-departement-dokter').modal('hide');
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });

            // Submit the form via AJAX
            $('#update-departement-doctor-form').on('submit', function(e) {
                e.preventDefault();

                var doctorId = $('#edit-departement-doctor-id').val();

                // Membuat FormData untuk mengambil data formulir, termasuk file
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/doctors/' + doctorId + '/departement',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-departement-dokter').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Dokter Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-departement-dokter').modal('hide');
                        // Handle errors, e.g., display validation errors
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Datatable initialization
            $('#dt-dokter').dataTable({ responsive: true });
            $('#dt-departemen').dataTable({ responsive: true });

            // --- Tab button toggle: show correct subheader button ---
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr('href');
                if (target === '#pills-departemen') {
                    $('#btn-tambah-dokter').addClass('d-none');
                    $('#btn-tambah-departemen').removeClass('d-none');
                } else {
                    $('#btn-tambah-departemen').addClass('d-none');
                    $('#btn-tambah-dokter').removeClass('d-none');
                }
            });

            // --- URL hash tab routing ---
            (function() {
                var hash = window.location.hash;
                if (hash === '#pills-departemen') {
                    $('#pills-departemen-link').tab('show');
                }
            })();

            // --- Departemen Tab: Tambah ---
            $('#create-departement-button').on('click', function() {
                var formData = new FormData($('#create-departement-form')[0]);
                $.ajax({
                    type: 'post',
                    url: '/api/departements',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#tambah-departement').modal('hide');
                        showSuccessAlert('Departemen Ditambah!');
                        setTimeout(function() { location.reload(); }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-departement').modal('hide');
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // --- Departemen Tab: Edit - Load Data ---
            $('.edit-dep-button').on('click', function() {
                var depId = $(this).data('dep-id');
                $('#edit-departement-tab-id').val(depId);
                $.ajax({
                    type: 'GET',
                    url: '/api/departements/' + depId,
                    success: function(data) {
                        $('#edit-departement-tab-name').val(data.name);
                        $('#edit-departement-tab-urutan').val(data.urutan);
                        $('#edit-departement-tab').modal('show');
                    },
                    error: function(error) { showErrorAlert('Terjadi kesalahan saat memuat data.'); }
                });
            });

            // --- Departemen Tab: Update Submit ---
            $('#update-departement-tab-form').on('submit', function(e) {
                e.preventDefault();
                var depId = $('#edit-departement-tab-id').val();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '/api/departements/' + depId,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#edit-departement-tab').modal('hide');
                        showSuccessAlert('Departemen Diubah!');
                        setTimeout(function() { location.reload(); }, 1000);
                    },
                    error: function(error) {
                        $('#edit-departement-tab').modal('hide');
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

        });

        function btnDeactivateDoctor(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let doctorId = button.getAttribute('data-doctor-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Dokter ini akan dinonaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) { deactivateDoctor(doctorId); }
            });
        }

        function deactivateDoctor(doctorId) {
            $.ajax({
                url: '/api/doctors/' + doctorId + '/deactivate',
                type: 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Nonaktifkan!', 'Dokter telah dinonaktifkan.', 'success').then(() => { location.reload(); });
                    } else {
                        Swal.fire('Gagal!', 'Gagal menonaktifkan dokter.', 'error');
                    }
                }
            });
        }

        function btnActivateDoctor(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let doctorId = button.getAttribute('data-doctor-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Dokter ini akan diaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) { activateDoctor(doctorId); }
            });
        }

        function activateDoctor(doctorId) {
            $.ajax({
                url: '/api/doctors/' + doctorId + '/activate',
                type: 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Diaktifkan!', 'Dokter telah diaktifkan.', 'success').then(() => { location.reload(); });
                    } else {
                        Swal.fire('Gagal!', 'Gagal mengaktifkan dokter.', 'error');
                    }
                }
            });
        }

        function btnDeactivateDep(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let depId = button.getAttribute('data-dep-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Departemen ini akan dinonaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) { deactivateDep(depId); }
            });
        }

        function deactivateDep(depId) {
            $.ajax({
                url: '/api/departements/' + depId + '/deactivate',
                type: 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Nonaktifkan!', 'Departemen telah dinonaktifkan.', 'success').then(() => { location.reload(); });
                    } else {
                        Swal.fire('Gagal!', 'Gagal menonaktifkan departemen.', 'error');
                    }
                }
            });
        }

        function btnActivateDep(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let depId = button.getAttribute('data-dep-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Departemen ini akan diaktifkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) { activateDep(depId); }
            });
        }

        function activateDep(depId) {
            $.ajax({
                url: '/api/departements/' + depId + '/activate',
                type: 'post',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Diaktifkan!', 'Departemen telah diaktifkan.', 'success').then(() => { location.reload(); });
                    } else {
                        Swal.fire('Gagal!', 'Gagal mengaktifkan departemen.', 'error');
                    }
                }
            });
        }
    </script>

    <style nonce="{{ $nonce }}">
        .border-light-blue {
            border-color: #e2e8f0 !important;
        }
        .align-middle-table td, .align-middle-table th {
            vertical-align: middle !important;
        }
        
        /* Category Pill Badges */
        .badge-category {
            display: inline-block;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 20px;
            text-align: center;
            white-space: nowrap;
        }
        .cat-rs {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #dbeafe;
        }

        /* Status Pill Badges with indicator dots */
        .badge-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 30px;
            min-width: 90px;
        }
        .badge-status-active {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .badge-status-inactive {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        /* Modern Action Buttons */
        .btn-action-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 600;
            border-radius: 6px;
            border: 1px solid transparent;
            transition: all 0.2s ease-in-out;
            text-decoration: none !important;
            cursor: pointer;
        }
        .btn-action-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
        }
        .btn-action-custom:active {
            transform: translateY(0);
        }
        
        .btn-action-detail {
            background-color: #eff6ff;
            color: #2563eb !important;
            border-color: #bfdbfe;
        }
        .btn-action-detail:hover {
            background-color: #2563eb;
            color: #ffffff !important;
            border-color: #2563eb;
        }
        
        .btn-action-accept {
            background-color: #ecfdf5;
            color: #10b981 !important;
            border-color: #a7f3d0;
        }
        .btn-action-accept:hover {
            background-color: #10b981;
            color: #ffffff !important;
            border-color: #10b981;
        }
        
        .btn-action-reject {
            background-color: #fef2f2;
            color: #ef4444 !important;
            border-color: #fecaca;
        }
        .btn-action-reject:hover {
            background-color: #ef4444;
            color: #ffffff !important;
            border-color: #ef4444;
        }
    </style>
@endsection
