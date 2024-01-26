@extends('inc.layout')
@section('css')
    <style>
        .caption {
            text-align: center;
            font-weight: bolder;
            transform: scale(1.1)
        }
    </style>
@endsection

@section('title', 'Galeri')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-galeri" title="Tambah Galeri">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Galeri
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Galeri <span class="fw-300"><i>Preview</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <button type="button" class="ml-2 btn btn-danger waves-effect waves-themed"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                data-target="#delete-galery" title="Hapus Galeri">
                                <span class="fal fa-trash mr-1"></span>
                                Hapus
                            </button>
                            @foreach ($galeries as $galery)
                                <div id="js-lightgallery">
                                    <a class="" href="{{ asset('storage/' . $galery->image) }}"
                                        data-sub-html="{{ $galery->caption }}">
                                        <img class="img-responsive" src="{{ asset('storage/' . $galery->thumbnail) }}"
                                            alt="ID: {{ $galery->id }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </main>

    @include('pages.galery.partials.edit-galery')
    @include('pages.galery.partials.create-galery')
    @include('pages.galery.partials.delete-galery')
@endsection

@section('plugin')
    <script src="/js/miscellaneous/lightgallery/lightgallery.bundle.js"></script>

    {{-- CRUD --}}
    <script>
        $(document).ready(function() {
            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-galery-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/galeries',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-galeri').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Galeri Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-galeri').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var galeryId = $(this).data('galery-id');

                // Set the category ID to the modal input field
                $('#edit-galery-id').val(galeryId);

                $.ajax({
                    type: 'GET',
                    url: '/api/galeries/' + galeryId,
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
            $('#update-galery-form').on('submit', function(e) {
                e.preventDefault();

                var galeryId = $('#edit-galery-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/galeries/' + galeryId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-galeri').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Galeri Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-galeri').modal('hide');
                        // Handle errors, e.g., display validation errors
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Delete button click event
            $('.delete-button').on('click', function() {
                var galeryId = $('#id-gambar').val();

                // Show confirmation modal before deleting
                if (confirm('anda yakin mau menghapus gambar ini?')) {
                    // Perform AJAX delete request
                    $.ajax({
                        type: 'DELETE',
                        url: '/api/galeries/' + galeryId,
                        success: function(response) {
                            $('#delete-galery').modal('hide');
                            // Handle success, e.g., remove the deleted item from UI
                            showSuccessAlert('Gallery Deleted!');

                            // Delay reload for 2 seconds
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(error) {
                            $('#delete-galery').modal('hide');

                            // Handle errors, e.g., display error message
                            showErrorAlert('Tidak ada gambar dengan id ' + galeryId + '.');
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
