@extends('inc.layout-blank')
@section('css')
    <style>
        .caption {
            text-align: center;
            font-weight: bolder;
            transform: scale(1.1)
        }

        .header-function-fixed:not(.nav-function-top) .page-content {
            margin-top: 0 !important;
        }
    </style>
@endsection

@section('title', 'Galeri')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-image" title="Tambah Image">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Image
                </button>

                <button type="button" class="btn btn-primary waves-effect waves-themed" id="close">
                    <i class='bx bx-x-circle'></i>
                    Close
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Galeri <span class="fw-300"><i>{{ $pelayanan->title }}</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <button type="button" class="ml-2 btn btn-danger waves-effect waves-themed"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#delete-image"
                                title="Hapus Galeri">
                                <span class="fal fa-trash mr-1"></span>
                                Hapus
                            </button>
                            @foreach ($images as $image)
                                <div id="js-lightgallery">
                                    <a class="" href="{{ asset('storage/' . $image->image) }}"
                                        data-sub-html="{{ $image->caption }}">
                                        <img class="img-responsive" src="{{ asset('storage/' . $image->thumbnail) }}"
                                            alt="ID: {{ $image->id }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </main>

    @include('pages.pelayanan.partials.edit-image')
    @include('pages.pelayanan.partials.create-image')
    @include('pages.pelayanan.partials.delete-image')
@endsection

@section('plugin')
    <script src="/js/miscellaneous/lightgallery/lightgallery.bundle.js"></script>

    {{-- CRUD --}}
    <script>
        $(document).ready(function() {
            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-image-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/images',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-image').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Image Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-image').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('#close').on('click', function() {
                window.close();
            });
            $('.edit-button').on('click', function() {
                var imageId = $(this).data('image-id');

                // Set the category ID to the modal input field
                $('#edit-image-id').val(imageId);

                $.ajax({
                    type: 'GET',
                    url: '/api/images/' + imageId,
                    success: function(data) {
                        $('#edit-icon').val(data.icon);
                        $('#edit-unggulan').val(data.unggulan);
                        $('#edit-name').val(data.name);
                        $('#edit-slug').val(data.slug);
                        $('#edit-body').val(data.body);
                        $('#edit-body-text').val(data.body);
                        $('#oldImage').val(data.image);

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }


                        // Set nilai dan atribut selected untuk dropdown berdasarkan data unggulan
                        $('#edit-unggulan').val(data.unggulan).select2({
                            dropdownParent: $('#edit-galeri')
                        });

                        // Show the modal
                        $('#edit-berita').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-image-form').on('submit', function(e) {
                e.preventDefault();

                var imageId = $('#edit-image-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/images/' + imageId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-image').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Image Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-image').modal('hide');
                        // Handle errors, e.g., display validation errors
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Delete button click event
            $('.delete-button').on('click', function() {
                var imageId = $('#id-gambar').val();

                // Show confirmation modal before deleting
                if (confirm('anda yakin mau menghapus gambar ini?')) {
                    // Perform AJAX delete request
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/images/' + imageId,
                        success: function(response) {
                            $('#delete-image').modal('hide');
                            // Handle success, e.g., remove the deleted item from UI
                            showSuccessAlert('Gallery Deleted!');

                            // Delay reload for 2 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(error) {
                            $('#delete-image').modal('hide');

                            // Handle errors, e.g., display error message
                            showErrorAlert('Tidak ada gambar dengan id ' + imageId + '.');
                        }
                    });
                }
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

    {{-- Light Gallery + Preview IMG --}}
    <script>
        $(document).ready(function() {
            var $initScope = $('#js-lightgallery');
            if ($initScope.length) {
                $initScope.justifiedGallery({
                    border: -1,
                    rowHeight: 150,
                    margins: 8,
                    waitThumbnailsLoad: true,
                    randomize: false,
                }).on('jg.complete', function() {
                    $initScope.lightGallery({
                        thumbnail: true,
                        animateThumb: true,
                        showThumbByDefault: true,
                    });
                });
            };
            $initScope.on('onAfterOpen.lg', function(event) {
                $('body').addClass("overflow-hidden");
            });
            $initScope.on('onCloseAfter.lg', function(event) {
                $('body').removeClass("overflow-hidden");
            });
        });

        // Image
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

        // Thumb
        function createPreviewThumb() {
            const thumb = document.querySelector('#create-thumb');
            const imgPreview = document.querySelector('.create-thumb-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(thumb.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewThumb() {
            const thumb = document.querySelector('#edit-thumb');
            const imgPreview = document.querySelector('.edit-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(thumb.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
