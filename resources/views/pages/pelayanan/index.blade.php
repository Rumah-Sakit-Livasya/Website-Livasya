@extends('inc.layout')
@section('title', 'Pelayanan')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-pelayanan" title="Tambah Pelayanan">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Pelayanan
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Pelayanan</i></span>
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
                                        <th style="white-space: nowrap">Slug</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelayanans as $pelayanan)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $pelayanan->title }}</td>
                                            <td style="white-space: nowrap">{{ $pelayanan->slug }}</td>

                                            <td style="white-space: nowrap">
                                                <!-- Add a data-pelayanan-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-pelayanan" title="Ubah"
                                                    data-pelayanan-id="{{ $pelayanan->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>

                                                <button type="button"
                                                    class="badge mx-1 badge-success p-2 border-0 text-white open-new-window-button"
                                                    data-pelayanan-id="{{ $pelayanan->id }}">
                                                    <span class="fal fa-images"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Judul</th>
                                        <th style="white-space: nowrap">Slug</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.pelayanan.partials.edit-pelayanan')
                            @include('pages.pelayanan.partials.create-pelayanan')
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
        function createPreviewHeader() {
            const header = document.querySelector('#create-header');
            const imgPreview = document.querySelector('.create-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(header.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewHeader() {
            const header = document.querySelector('#edit-header');
            const imgPreview = document.querySelector('.edit-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(header.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            // Popup Windows
            $('.open-new-window-button').click(function() {
                // Get the career ID from the data attribute
                var pelayananId = $(this).data('pelayanan-id');

                // Construct the URL based on your application's logic
                var url = '/dashboard/pelayanan/' + pelayananId +
                    '/images'; // Change this to match your route

                // Open the URL in a new window with full screen size
                window.open(url, '_blank', 'width=' + screen.width + ',height=' + screen.height);
            });
            // Popup Windows

            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-pelayanan-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/pelayanan',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-pelayanan').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Pelayanan Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-pelayanan').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var pelayananId = $(this).data('pelayanan-id');

                // Set the category ID to the modal input field
                $('#edit-pelayanan-id').val(pelayananId);

                $.ajax({
                    type: 'GET',
                    url: '/api/pelayanan/' + pelayananId,
                    success: function(data) {
                        $('#edit-icon').val(data.icon);
                        $('#edit-title').val(data.title);
                        $('#edit-slug').val(data.slug);
                        $('#edit-body').val(data.body);
                        $('#edit-body-text').val(data.body);
                        $('#oldImage').val(data.header);

                        // Set nilai dan atribut selected untuk dropdown berdasarkan data unggulan
                        $('#edit-unggulan').val(data.unggulan).select2({
                            dropdownParent: $('#edit-pelayanan')
                        });

                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.header);
                        }

                        // Show the modal
                        $('#edit-berita').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-pelayanan-form').on('submit', function(e) {
                e.preventDefault();

                var pelayananId = $('#edit-pelayanan-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/pelayanan/' + pelayananId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-pelayanan').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Pelayanan Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-pelayanan').modal('hide');
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
            const createslug = document.querySelector('#create-slug');
            const edittitle = document.querySelector('#edit-title');
            const editslug = document.querySelector('#edit-slug');

            createtitle.addEventListener('change', function() {
                fetch('/dashboard/posts/checkSlug?title=' + createtitle.value)
                    .then(response => response.json())
                    .then(data => createslug.value = data.slug)
            });

            edittitle.addEventListener('change', function() {
                fetch('/dashboard/posts/checkSlug?title=' + edittitle.value)
                    .then(response => response.json())
                    .then(data => editslug.value = data.slug)
            });
        });
    </script>
@endsection
