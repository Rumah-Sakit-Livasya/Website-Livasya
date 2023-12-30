@extends('inc.layout')
@section('title', 'Kategori')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-kategori" title="Tambah Kategori">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Kategori
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Kategori</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Nama Kategori</th>
                                        <th style="white-space: nowrap">Slug</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $category->name }}</td>
                                            <td style="white-space: nowrap">{{ $category->slug }}</td>

                                            <td style="white-space: nowrap">
                                                <!-- Add a data-category-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-kategori" title="Ubah"
                                                    data-category-id="{{ $category->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Nama Kategori</th>
                                        <th style="white-space: nowrap">Slug</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.category.partials.edit-category')
                            @include('pages.category.partials.create-category')
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
            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '/api/categories',
                    data: $('#create-category-form').serialize(),
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-kategori').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        //tampilkan pesan
                        showSuccessAlert('Kategori Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-kategori').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var categoryId = $(this).data('category-id');

                // Set the category ID to the modal input field
                $('#edit-category-id').val(categoryId);

                // Assume you have an endpoint that returns category data based on the ID
                $.ajax({
                    type: 'GET',
                    url: '/api/categories/' + categoryId,
                    success: function(data) {
                        $('#edit-name').val(data.name);
                        $('#edit-slug').val(data.slug);

                        // Show the modal
                        $('#edit-kategori').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });

            // Submit the form via AJAX
            $('#update-category-form').on('submit', function(e) {
                e.preventDefault();

                var categoryId = $('#edit-category-id').val();

                $.ajax({
                    type: 'PUT',
                    url: '/api/categories/' + categoryId,
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-kategori').modal('hide');

                        //tampilkan pesan
                        showSuccessAlert('Kategori Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-kategori').modal('hide');
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
            const createtitle = document.querySelector('#create-name');
            const createslug = document.querySelector('#create-slug');
            const edittitle = document.querySelector('#edit-name');
            const editslug = document.querySelector('#edit-slug');

            createtitle.addEventListener('change', function() {
                fetch('/dashboard/categories/checkSlug?title=' + createtitle.value)
                    .then(response => response.json())
                    .then(data => createslug.value = data.slug)
            });

            edittitle.addEventListener('change', function() {
                fetch('/dashboard/categories/checkSlug?title=' + edittitle.value)
                    .then(response => response.json())
                    .then(data => editslug.value = data.slug)
            });
        });
    </script>
@endsection
