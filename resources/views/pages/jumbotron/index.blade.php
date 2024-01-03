@extends('inc.layout')
@section('title', 'Jumbotron')
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
                            <span class="fw-300">Jumbotron</span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <button type="button" class="btn btn-primary waves-effect waves-themed edit-button"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                data-target="#edit-jumbotron" title="Edit Jumbotron">
                                <span class="fal fa-edit mr-1"></span>
                                Edit Jumbotron
                            </button>

                            <div class="row justify-content-center align-items-center">
                                <div class="col-sm-6">
                                    <img src="{{ asset('/storage/' . $jumbotron->main_image) }}"
                                        class="d-block m-auto img-fluid p-5 rounded-circle" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <div class="wrap-text">
                                        <h1 class="heading section-heading-lg title-web">{!! $jumbotron->title !!}</h1>
                                        <p id="tex">{!! ucwords($jumbotron->title_description) !!}
                                        </p>
                                        <div class="row">
                                            <div class="col" data-aos="fade-left">
                                                <a href="https://dafol.livasya.id" target="_blank" class="btn mt-3"> Daftar
                                                    Sekarang <span class="fas fa-chevron-right"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            @include('pages.jumbotron.partials.edit-jumbotron')
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
            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var formData = new FormData($('#update-jumbotron-form')[0]);

                $.ajax({
                    type: 'GET',
                    url: '/api/jumbotron/',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#update-jumbotron-form').attr("data-id", data.id);
                        $('#edit-title').val(data.title);
                        $('#edit-description').val(data.title_description);
                        $('#edit-description-text').val(data.title_description);
                        $('#oldImage').val(data.main_image);

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.main_image);
                        }

                        // Show the modal
                        $('#edit-jumbotron').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-jumbotron-form').on('submit', function(e) {
                e.preventDefault();
                var id = $('#update-jumbotron-form').attr("data-id");

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/jumbotron/' + id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-jumbotron').modal('hide');

                        //tampilkan pesan
                        showSuccessAlert('Jumbotron Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-jumbotron').modal('hide');
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
@endsection
