@extends('inc.layout')
@section('title', 'Dokter')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-dokter" title="Tambah Dokter">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Dokter
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Dokter</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Nama</th>
                                        <th style="white-space: nowrap">Jabatan</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $doctor->name }}</td>
                                            <td style="white-space: nowrap">{{ $doctor->jabatan }}</td>

                                            <td style="white-space: nowrap">
                                                <!-- Add a data-doctor-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-dokter" title="Ubah"
                                                    data-doctor-id="{{ $doctor->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>

                                                @if ($doctor->is_active == 1)
                                                    <!-- Button to deactivate doctor -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-danger p-2 border-0 text-white deactivate-button"
                                                        data-doctor-id="{{ $doctor->id }}" onclick="btnDeactivate(event)">
                                                        <i class='bx bx-minus-circle m-0'></i>
                                                    </button>
                                                @else
                                                    <!-- Button to activate doctor -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-success p-2 border-0 text-white activate-button"
                                                        data-doctor-id="{{ $doctor->id }}" onclick="btnActivate(event)">
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
                                        <th style="white-space: nowrap">Nama</th>
                                        <th style="white-space: nowrap">Jabatan</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.doctors.partials.edit-doctor')
                            @include('pages.doctors.partials.create-doctor')
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

        function createPreviewPoster() {
            const poster = document.querySelector('#create-poster');
            const imgPreview = document.querySelector('.create-poster-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(poster.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function createPreviewJadwal() {
            const jadwal = document.querySelector('#create-jadwal');
            const imgPreview = document.querySelector('.create-jadwal-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(jadwal.files[0])

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

        function editPreviewPoster() {
            const poster = document.querySelector('#edit-poster');
            const imgPreview = document.querySelector('.edit-poster-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(poster.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewJadwal() {
            const jadwal = document.querySelector('#edit-jadwal');
            const imgPreview = document.querySelector('.edit-jadwal-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(jadwal.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            // SELECT2
            $(function() {
                $('#create-category').select2({
                    dropdownParent: $('#tambah-dokter')
                });
                $('#edit-category').select2({
                    dropdownParent: $('#edit-dokter')
                });
            });
            // SELECT2

            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-doctor-form')[0]);

                $.ajax({
                    type: 'post',
                    url: '/api/doctors',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-dokter').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Dokter Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-dokter').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var doctorId = $(this).data('doctor-id');

                // Set the category ID to the modal input field
                $('#edit-doctor-id').val(doctorId);

                $.ajax({
                    type: 'GET',
                    url: '/api/doctors/' + doctorId,
                    success: function(data) {
                        $('#edit-name').val(data.name);
                        $('#edit-jabatan').val(data.jabatan);
                        $('#edit-deskripsi').val(data.deskripsi);
                        $('#edit-deskripsi-text').val(data.deskripsi);
                        $('#oldImage').val(data.foto);
                        $('#oldPoster').val(data.poster);
                        $('#oldJadwal').val(data.jadwal);

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.foto);
                        }

                        var previewPoster = $('.edit-poster-preview');
                        if (previewPoster.length) {
                            previewPoster.attr('src', '/storage/' + data.poster);
                        }

                        var previewJadwal = $('.edit-jadwal-preview');
                        if (previewJadwal.length) {
                            previewJadwal.attr('src', '/storage/' + data.jadwal);
                        }

                        // Show the modal
                        $('#edit-dokter').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-doctor-form').on('submit', function(e) {
                e.preventDefault();

                var doctorId = $('#edit-doctor-id').val();

                // Membuat FormData untuk mengambil data formulir, termasuk file
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/doctors/' + doctorId,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-dokter').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Dokter Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-dokter').modal('hide');
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

        function btnDeactivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let doctorId = button.getAttribute('data-doctor-id');

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
                    deactivateDoctor(doctorId);
                }
            });
        }

        function deactivateDoctor(doctorId) {
            $.ajax({
                url: '/api/doctors/' + doctorId + '/deactivate',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Nonaktifkan!',
                            'Doctor Anda telah dinonaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menonaktifkan doctor.',
                            'error'
                        );
                    }
                }
            });
        }

        function btnActivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let doctorId = button.getAttribute('data-doctor-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengaktifkan doctor ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    activateDoctor(doctorId);
                }
            });
        }

        function activateDoctor(doctorId) {
            $.ajax({
                url: '/api/doctors/' + doctorId + '/activate',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Diaktifkan!',
                            'Doctor Anda telah diaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal mengaktifkan doctor.',
                            'error'
                        );
                    }
                }
            });
        }
    </script>
@endsection
