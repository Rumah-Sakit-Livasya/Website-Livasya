@extends('inc.layout')
@section('title', 'Karir')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-briefcase'></i> Manajemen Karir
                <small>
                    Kelola daftar lowongan pekerjaan dan seleksi pelamar.
                </small>
            </h1>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Daftar <span class="fw-300"><i>Lowongan</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                data-target="#tambah-karir">
                                <span class="fal fa-plus-circle mr-1"></span> Tambah Karir
                            </button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Judul</th>
                                        <th style="white-space: nowrap">Poster</th>
                                        <th style="white-space: nowrap">Tipe</th>
                                        <th style="white-space: nowrap">Keterangan</th>
                                        <th style="white-space: nowrap">Status</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careers as $career)
                                        <tr>
                                            <td style="white-space: nowrap" class="text-center">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap" class="font-weight-bold">{{ $career->title }}
                                            </td>
                                            <td class="text-center">
                                                @if ($career->image)
                                                    <a href="{{ Storage::url($career->image) }}" target="_blank">
                                                        <img src="{{ Storage::url($career->image) }}" alt="Poster"
                                                            class="img-thumbnail"
                                                            style="height: 50px; width: 50px; object-fit: cover;">
                                                    </a>
                                                @else
                                                    <span class="text-muted small">No Image</span>
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap">
                                                @if ($career->tipe == 'medis')
                                                    <span class="badge badge-info badge-pill">Medis</span>
                                                @else
                                                    <span class="badge badge-primary badge-pill">Non-Medis</span>
                                                @endif
                                            </td>
                                            <td style="text-wrap: wrap; min-width: 200px;">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($career->deskripsi), 100) !!}</td>
                                            <td style="white-space: nowrap">
                                                @if ($career->status == 'on')
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary">Non-Aktif</span>
                                                @endif
                                            </td>

                                            <td style="white-space: nowrap">
                                                <!-- Edit Button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="btn btn-sm btn-outline-primary btn-icon waves-effect waves-themed edit-button"
                                                    data-toggle="modal" data-target="#edit-karir" title="Ubah Info"
                                                    data-career-id="{{ $career->id }}">
                                                    <i class="fal fa-edit"></i>
                                                </button>

                                                <!-- View Applicants Button -->
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-info waves-effect waves-themed"
                                                    onclick="openWindows({{ $career->id }})" title="Lihat Pelamar">
                                                    <i class="fal fa-users mr-1"></i>
                                                    <span class="badge badge-info ml-1">{{ $career->applier_count }}</span>
                                                </button>

                                                <!-- Delete Button (Optional, simply adding UI placeholder or delete logic if exists) -->
                                                {{--
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-icon waves-effect waves-themed" title="Hapus">
                                                    <i class="fal fa-trash-alt"></i>
                                                </button>
                                                --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="thead-themed">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Judul</th>
                                        <th>Poster</th>
                                        <th>Tipe</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
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
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/js/formplugins/summernote/summernote.js"></script>
    <script>
        function openWindows(careerId) {
            // Construct the URL based on your application's logic
            var url = '/careers/' + careerId; // Change this to match your route

            // Open the URL in a new window with full screen size
            window.open(url, '_blank', 'width=' + screen.width + ',height=' + screen.height);
        }

        $(document).ready(function() {
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
