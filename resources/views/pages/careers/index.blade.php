@extends('inc.layout')
@section('title', 'Karir')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-karir" title="Tambah Karir">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Karir
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Karir</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Judul</th>
                                        <th style="white-space: nowrap">Tipe</th>
                                        <th style="white-space: nowrap">Keterangan</th>
                                        <th style="white-space: nowrap">Status</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($careers as $career)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $career->title }}</td>
                                            <td style="white-space: nowrap">{{ $career->tipe }}</td>
                                            <td style="white-space: nowrap">{{ $career->deskripsi }}</td>
                                            <td style="white-space: nowrap">{{ $career->status }}</td>

                                            <td style="white-space: nowrap">
                                                <!-- Add a data-career-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-karir" title="Ubah"
                                                    data-career-id="{{ $career->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>

                                                <!-- Add a new button for opening in a new window -->
                                                <button type="button"
                                                    class="badge mx-1 badge-success p-2 border-0 text-white open-new-window-button"
                                                    data-career-id="{{ $career->id }}">
                                                    <span class="fal fa-eye"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Judul</th>
                                        <th style="white-space: nowrap">Tipe</th>
                                        <th style="white-space: nowrap">Keterangan</th>
                                        <th style="white-space: nowrap">Status</th>
                                        <th style="white-space: nowrap">Aksi</th>
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
    <script>
        $(document).ready(function() {
            // Popup Windows
            $('.open-new-window-button').click(function() {
                // Get the career ID from the data attribute
                var careerId = $(this).data('career-id');

                // Construct the URL based on your application's logic
                var url = '/careers/' + careerId; // Change this to match your route

                // Open the URL in a new window with full screen size
                window.open(url, '_blank', 'width=' + screen.width + ',height=' + screen.height);
            });
            // Popup Windows

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


            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '/api/careers',
                    data: $('#create-career-form').serialize(),
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-karir').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data karir

                        //tampilkan pesan
                        showSuccessAlert('Karir Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-karir').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
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
                        $('#edit-deskripsi').val(data.deskripsi);
                        $('#edit-deskripsi-text').val(data.deskripsi);
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

                $.ajax({
                    type: 'PUT',
                    url: '/api/careers/' + careerId,
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-karir').modal('hide');

                        //tampilkan pesan
                        showSuccessAlert('Karir Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-karir').modal('hide');
                        // Handle errors, e.g., display validation errors
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

            // Slugable
            const createtitle = document.querySelector('#create-title');
            const createslug = document.querySelector('#create-deskripsi');
            const edittitle = document.querySelector('#edit-title');
            const editslug = document.querySelector('#edit-deskripsi');

            createtitle.addEventListener('change', function() {
                fetch('/dashboard/careers/checkSlug?title=' + createtitle.value)
                    .then(response => response.json())
                    .then(data => createslug.value = data.slug)
            });

            edittitle.addEventListener('change', function() {
                fetch('/dashboard/careers/checkSlug?title=' + edittitle.value)
                    .then(response => response.json())
                    .then(data => editslug.value = data.slug)
            });
        });
    </script>
@endsection
