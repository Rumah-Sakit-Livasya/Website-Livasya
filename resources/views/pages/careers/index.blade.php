@extends('inc.layout')
@section('title', 'Karir')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon bx bxs-briefcase text-primary'></i> Manajemen Karir
                <small>
                    Kelola daftar lowongan pekerjaan dan proses seleksi berkas pelamar.
                </small>
            </h1>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel shadow-sm">
                    <div class="panel-hdr bg-faded">
                        <h2>
                            Daftar <span class="fw-300"><i>Lowongan Karir</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed font-weight-bold"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                data-target="#tambah-karir">
                                <i class="fal fa-plus-circle mr-1"></i> Tambah Karir
                            </button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 align-middle-table">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th style="width: 50px;" class="text-center">No</th>
                                        <th>Judul Lowongan</th>
                                        <th style="width: 80px;" class="text-center">Poster</th>
                                        <th style="width: 110px;" class="text-center">Tipe</th>
                                        <th>Keterangan</th>
                                        <th style="width: 100px;" class="text-center">Status</th>
                                        <th style="width: 140px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careers as $career)
                                        <tr>
                                            <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="font-weight-bold text-dark fs-md">{{ $career->title }}</div>
                                            </td>
                                            <td class="text-center">
                                                @if ($career->image && Storage::disk('public')->exists($career->image))
                                                    <a href="{{ Storage::url($career->image) }}" target="_blank">
                                                        <img src="{{ Storage::url($career->image) }}" alt="Poster"
                                                            class="img-thumbnail shadow-xs"
                                                            style="height: 40px; width: 40px; object-fit: cover; border-radius: 6px;">
                                                    </a>
                                                @else
                                                    <div class="d-inline-flex align-items-center justify-content-center bg-light text-muted border rounded shadow-2" 
                                                         style="height: 40px; width: 40px; border-style: dashed !important;" 
                                                         title="Poster tidak tersedia">
                                                        <i class="fal fa-image fs-sm"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($career->tipe == 'medis')
                                                    <span class="badge badge-info px-2 py-1" style="border-radius: 4px;">Medis</span>
                                                @else
                                                    <span class="badge badge-primary px-2 py-1" style="border-radius: 4px;">Non-Medis</span>
                                                @endif
                                            </td>
                                            <td style="text-wrap: wrap; min-width: 220px; font-size: 0.85rem;" class="text-muted">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($career->deskripsi), 80) !!}
                                            </td>
                                            <td class="text-center">
                                                @if ($career->status == 'on')
                                                    <span class="badge badge-success px-2 py-1" style="border-radius: 4px;"><i class="fal fa-check-circle mr-1"></i>Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary px-2 py-1" style="border-radius: 4px;"><i class="fal fa-times-circle mr-1"></i>Non-Aktif</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                                    <!-- Edit Button -->
                                                    <button type="button" data-backdrop="static" data-keyboard="false"
                                                        class="btn btn-sm btn-outline-primary btn-icon waves-effect waves-themed edit-button"
                                                        data-toggle="modal" data-target="#edit-karir" title="Ubah Info"
                                                        data-career-id="{{ $career->id }}">
                                                        <i class="fal fa-edit"></i>
                                                    </button>

                                                    <!-- View Applicants Button -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-info waves-effect waves-themed js-open-window font-weight-bold d-flex align-items-center"
                                                        data-url="/careers/{{ $career->id }}" title="Lihat Pelamar">
                                                        <i class="fal fa-users mr-1"></i> Pelamar
                                                        <span class="badge badge-light ml-2" style="border-radius: 3px; font-size: 0.75rem;">{{ $career->applier_count }}</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.careers.partials.edit-career')
                            @include('pages.careers.partials.create-career')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style nonce="{{ $nonce }}">
        .align-middle-table td {
            vertical-align: middle !important;
        }
    </style>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/js/formplugins/summernote/summernote.js"></script>
    <script nonce="{{ $nonce }}">
        $(document).ready(function() {
            $(document).on('click', '.js-open-window', function() {
                var url = $(this).data('url');
                window.open(url, '_blank', 'width=' + screen.width + ',height=' + screen.height);
            });

            // Initialize Summernote
            $('.summernote').summernote({
                height: 200,
                dialogsInBody: true,
                callbacks: {
                    onInit: function(e) {
                        $('body > .note-popover').hide();
                    }
                }
            });

            // SELECT2
            $(function() {
                $('#create-tipe').select2({
                    dropdownParent: $('#tambah-karir')
                });
                $('#edit-tipe').select2({
                    dropdownParent: $('#edit-karir')
                });
            });
            // SELECT2


            // Custom file input label change
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-career-form')[0]);
                $.ajax({
                    type: 'POST',
                    url: '/api/careers',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#tambah-karir').modal('hide');
                        showSuccessAlert('Karir Ditambah!');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-karir').modal('hide');
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Add the career ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var careerId = $(this).data('career-id');

                // Set the career ID to the modal input field
                $('#edit-career-id').val(careerId);

                // Assume you have an endpoint that returns career data based on the ID
                $.ajax({
                    type: 'GET',
                    url: '/api/careers/' + careerId,
                    success: function(data) {
                        $('#edit-title').val(data.title);
                        // Populate Summernote
                        $('#edit-deskripsi').summernote('code', data.deskripsi);

                        $('#edit-status').val(data.status);
                        // Check the checkbox if status is "on"
                        if (data.status === 'on') {
                            $('#edit-status').prop('checked', true);
                        } else {
                            $('#edit-status').prop('checked', false);
                        }

                        $('#edit-tipe').val(data.tipe).select2({
                            dropdownParent: $('#edit-karir')
                        });

                        // Reset file input label
                        $('#edit-image').next('.custom-file-label').html(
                            'Pilih file gambar...');

                        // Show the modal
                        $('#edit-karir').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });

            // Submit the form via AJAX
            $('#update-career-form').on('submit', function(e) {
                e.preventDefault();

                var careerId = $('#edit-career-id').val();
                var formData = new FormData(this);
                // Ensure method is PUT for Laravel via POST
                formData.append('_method', 'PUT');

                $.ajax({
                    type: 'POST', // Use POST with _method=PUT for file uploads
                    url: '/api/careers/' + careerId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#edit-karir').modal('hide');
                        showSuccessAlert('Karir Diubah!');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-karir').modal('hide');
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Datatable initialization
            $('#dt-basic-example').dataTable({
                responsive: true
            });

            $('.js-thead-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });
        });
    </script>
@endsection
