@extends('inc.layout')
@section('title', 'Jadwal')
@section('content')
    <style>
        .home {
            background: transparent !important;
        }

        .book .row {
            gap: 0;
        }

        .swiper {
            width: 600px;
            height: 300px;
        }

        .home .image img {
            background: rgba(255, 255, 255, .5);
            animation: anim 5s ease-in-out infinite;
        }

        @keyframes anim {
            0% {
                transform: translatey(0px);
            }

            50% {
                transform: translatey(-30px);
            }

            100% {
                transform: translatey(0px);
            }
        }

        .title-web {
            font-size: 3rem;
            text-align: right !important;
            line-height: 4rem;
            font-family: poppins;
            font-weight: 800;
        }

        .wrap-text div {
            text-align: right !important;
        }
    </style>

    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr text-center">
                        <h2>
                            <span class="fw-300">Jadwal</span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <button type="button" class="btn btn-primary waves-effect waves-themed edit-button"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#edit-jadwal"
                                title="Edit Jadwal">
                                <span class="fal fa-edit mr-1"></span>
                                Edit Jadwal
                            </button>

                            <div id="js-lightgallery">
                                <a class="" href="{{ asset('storage/' . $jadwal->image) }}"
                                    data-sub-html="{{ $jadwal->caption }}">
                                    <img class="img-responsive" src="{{ asset('storage/' . $jadwal->thumbnail) }}"
                                        alt="ID: {{ $jadwal->id }}">
                                </a>
                            </div>

                            <!-- Modal -->
                            @include('pages.jadwal.partials.edit-jadwal')
                            <!-- Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('plugin')
    <script src="/js/miscellaneous/lightgallery/lightgallery.bundle.js"></script>
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script>
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

        function editPreviewThumbnail() {
            const thumbnail = document.querySelector('#edit-thumbnail');
            const imgPreview = document.querySelector('.edit-thumbnail-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(thumbnail.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var formData = new FormData($('#update-jadwal-form')[0]);

                $.ajax({
                    type: 'GET',
                    url: '/api/jadwal/',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#update-jadwal-form').attr("data-id", data.id);
                        $('#edit-caption').val(data.caption);
                        $('#edit-caption-text').val(data.caption);
                        $('#oldImage').val(data.image);
                        $('#oldThumbnail').val(data.thumbnail);

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }
                        var previewthumbnail = $('.edit-thumbnail-preview');
                        if (previewthumbnail.length) {
                            previewthumbnail.attr('src', '/storage/' + data.thumbnail);
                        }

                        // Show the modal
                        $('#edit-jadwal').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-jadwal-form').on('submit', function(e) {
                e.preventDefault();
                var id = $('#update-jadwal-form').attr("data-id");

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/jadwal/' + id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-jadwal').modal('hide');

                        //tampilkan pesan
                        showSuccessAlert('Jadwal Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-jadwal').modal('hide');
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

        });
    </script>

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
    </script>
@endsection
