@extends('inc.layout')
@section('title', 'Identitas')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr text-center">
                        <h2>
                            <span class="fw-300">Identitas</span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <button type="button" class="btn btn-primary waves-effect waves-themed edit-button"
                                data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                data-target="#edit-identity" title="Edit Identitas">
                                <span class="fal fa-edit mr-1"></span>
                                Edit Identitas
                            </button>

                            <div class="row justify-content-center align-items-center mt-5">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label text-muted">Nama Instansi</label>
                                        <input type="text" class="form-control" id="name" disabled="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label text-muted">Nama Pendek (1 Kata)</label>
                                        <input type="text" class="form-control" id="shortname" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Misi</label>
                                        <textarea class="form-control" id="misi" rows="5" disabled></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Twitter</label>
                                        <input type="text" class="form-control" disabled="" id="twitter">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Youtube</label>
                                        <input type="text" class="form-control" disabled="" id="youtube">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">No HP</label>
                                        <input type="text" class="form-control" disabled="" id="no-hp">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Jumlah Pasien Puas</label>
                                        <input type="text" class="form-control" disabled="" id="jumlah-pasien-puas">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label text-muted">Visi</label>
                                        <input type="text" class="form-control" disabled="" id="visi">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Tujuan</label>
                                        <textarea class="form-control" rows="5" id="tujuan" disabled></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Email</label>
                                        <input type="text" class="form-control" disabled="" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">No Telp</label>
                                        <input type="text" class="form-control" disabled="" id="no-telp">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-muted">Jumlah Fasilitas Kamar</label>
                                        <input type="text" class="form-control" disabled=""
                                            id="jumlah-fasilitas-kamar">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div class="form-group w-100">
                                        <label class="form-label text-muted">Sejarah</label>
                                        <textarea class="form-control" rows="5" id="sejarah" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            @include('pages.identity.partials.edit-identity')
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
            var formData = new FormData($('#update-identity-form')[0]);
            $.ajax({
                type: 'GET',
                url: '/api/identity/',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#name').val(data.name);
                    $('#shortname').val(data.shortname);
                    $('#visi').val(data.visi);
                    $('#misi').val(data.misi);
                    $('#tujuan').val(data.tujuan);
                    $('#alamat').val(data.alamat);
                    $('#facebook').val(data.facebook);
                    $('#instagram').val(data.instagram);
                    $('#twitter').val(data.twitter);
                    $('#youtube').val(data.youtube);
                    $('#email').val(data.email);
                    $('#no-hp').val(data.no_hp);
                    $('#no-telp').val(data.no_telp);
                    $('#jumlah-pasien-puas').val(data.jml_pasien_puas);
                    $('#jumlah-fasilitas-kamar').val(data.jml_fasilitas_kamar);
                    $('#sejarah').val(data.sejarah);
                },
                error: function(error) {
                    showErrorAlert('Terjadi kesalahan:', error);
                }
            });

            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var formData = new FormData($('#update-identity-form')[0]);

                $.ajax({
                    type: 'GET',
                    url: '/api/identity/',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#update-identity-form').attr("data-id", data.id);
                        $('#edit-name').val(data.name);
                        $('#edit-shortname').val(data.shortname);
                        $('#edit-visi').val(data.visi);
                        $('#edit-misi').val(data.misi);
                        $('#edit-misi-text').val(data.misi);
                        $('#edit-tujuan').val(data.tujuan);
                        $('#edit-tujuan-text').val(data.tujuan);
                        $('#edit-alamat').val(data.alamat);
                        $('#edit-facebook').val(data.facebook);
                        $('#edit-instagram').val(data.instagram);
                        $('#edit-twitter').val(data.twitter);
                        $('#edit-youtube').val(data.youtube);
                        $('#edit-email').val(data.email);
                        $('#edit-no-hp').val(data.no_hp);
                        $('#edit-no-telp').val(data.no_telp);
                        $('#edit-jumlah-pasien-puas').val(data.jml_pasien_puas);
                        $('#edit-jumlah-fasilitas-kamar').val(data.jml_fasilitas_kamar);
                        $('#edit-sejarah').val(data.sejarah);
                        $('#edit-sejarah-text').val(data.sejarah);

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }

                        // Show the modal
                        $('#edit-identity').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-identity-form').on('submit', function(e) {
                e.preventDefault();
                var id = $('#update-identity-form').attr("data-id");

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/identity/' + id,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-identity').modal('hide');

                        //tampilkan pesan
                        showSuccessAlert('Identity Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-identity').modal('hide');
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
