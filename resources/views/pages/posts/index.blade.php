@extends('inc.layout')
@section('title', 'Berita')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-berita" title="Tambah Berita">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Berita
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Berita</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Kategori</th>
                                        <th style="white-space: nowrap">Judul</th>
                                        <th style="white-space: nowrap">Slug</th>
                                        <th style="white-space: nowrap">Status</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $post->category->name }}</td>
                                            <td style="white-space: nowrap">{{ $post->title }}</td>
                                            <td style="white-space: nowrap">{{ $post->slug }}</td>
                                            <td style="white-space: nowrap">
                                                {{ $post->is_active == 1 ? 'Aktif' : 'Nonaktif' }}
                                            </td>

                                            <td style="white-space: nowrap">
                                                <!-- Edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-berita" title="Ubah"
                                                    data-post-id="{{ $post->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>
                                                @if ($post->is_active == 1)
                                                    <!-- Button to deactivate post -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-danger p-2 border-0 text-white deactivate-button"
                                                        data-post-id="{{ $post->id }}" onclick="btnDeactivate(event)">
                                                        <i class='bx bx-minus-circle m-0'></i>
                                                    </button>
                                                @else
                                                    <!-- Button to activate post -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-success p-2 border-0 text-white activate-button"
                                                        data-post-id="{{ $post->id }}" onclick="btnActivate(event)">
                                                        <i class='bx bx-check-circle m-0'></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Kategori</th>
                                        <th style="white-space: nowrap">Judul</th>
                                        <th style="white-space: nowrap">Slug</th>
                                        <th style="white-space: nowrap">Nonaktif</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.posts.partials.edit-post')
                            @include('pages.posts.partials.create-post')
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

        $(document).ready(function() {
            // SELECT2
            $(function() {
                $('#create-category').select2({
                    dropdownParent: $('#tambah-berita')
                });
                $('#edit-category').select2({
                    dropdownParent: $('#edit-berita')
                });
            });
            // SELECT2

            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-post-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/posts',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-berita').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Berita Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-berita').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var postId = $(this).data('post-id');

                // Set the category ID to the modal input field
                $('#edit-post-id').val(postId);

                $.ajax({
                    type: 'GET',
                    url: '/api/posts/' + postId,
                    success: function(data) {
                        $('#edit-user-id').val(data.user_id);
                        $('#edit-category').val(data.category_id);
                        $('#edit-title').val(data.title);
                        $('#edit-slug').val(data.slug);
                        $('#edit-body').val(data.body);
                        $('#edit-body-text').val(data.body);
                        $('#oldImage').val(data.image);

                        $('#edit-category').val(data.category_id).select2({
                            dropdownParent: $('#edit-berita')
                        });

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }

                        // Show the modal
                        $('#edit-berita').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            $('#update-post-form').on('submit', function(e) {
                e.preventDefault();

                var postId = $('#edit-post-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/posts/' + postId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-berita').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Berita Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-berita').modal('hide');
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

        function btnDeactivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let postId = button.getAttribute('data-post-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, nonaktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deactivatePost(postId);
                }
            });
        }

        function deactivatePost(postId) {
            $.ajax({
                url: '/api/posts/' + postId + '/deactivate',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Nonaktifkan!',
                            'Post Anda telah dinonaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menonaktifkan post.',
                            'error'
                        );
                    }
                }
            });
        }

        function btnActivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let postId = button.getAttribute('data-post-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengaktifkan post ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    activatePost(postId);
                }
            });
        }

        function activatePost(postId) {
            $.ajax({
                url: '/api/posts/' + postId + '/activate',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Diaktifkan!',
                            'Post Anda telah diaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal mengaktifkan post.',
                            'error'
                        );
                    }
                }
            });
        }
    </script>
@endsection
