@extends('inc.layout')
@section('title', 'Mitra')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-mitra" title="Tambah Mitra">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Mitra
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Mitra</i></span>
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
                                        <th style="white-space: nowrap">Image</th>
                                        <th style="white-space: nowrap">Primary</th>
                                        <th style="white-space: nowrap">Status</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mitras as $mitra)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">{{ $mitra->name }}</td>
                                            <td style="white-space: nowrap">
                                                <img class="img-responsive" width="50"
                                                    src="{{ asset('storage/' . $mitra->image) }}" alt="{{ $mitra->name }}">
                                            </td>
                                            <td style="white-space: nowrap">{{ $mitra->is_primary == 1 ? 'Ya' : 'Tidak' }}
                                            <td style="white-space: nowrap">
                                                {{ $mitra->is_active == 1 ? 'Aktif' : 'Nonaktif' }}
                                            </td>

                                            <td style="white-space: nowrap">
                                                <!-- Add a data-mitra-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-mitra" title="Ubah"
                                                    data-mitra-id="{{ $mitra->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>
                                                @if ($mitra->is_active == 1)
                                                    <!-- Button to deactivate mitra -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-danger p-2 border-0 text-white deactivate-button"
                                                        data-mitra-id="{{ $mitra->id }}" onclick="btnDeactivate(event)">
                                                        <i class='bx bx-minus-circle m-0'></i>
                                                    </button>
                                                @else
                                                    <!-- Button to activate mitra -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-success p-2 border-0 text-white activate-button"
                                                        data-mitra-id="{{ $mitra->id }}" onclick="btnActivate(event)">
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
                                        <th style="white-space: nowrap">Nama Poli</th>
                                        <th style="white-space: nowrap">Image</th>
                                        <th style="white-space: nowrap">Primary</th>
                                        <th style="white-space: nowrap">Status</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.mitra.partials.edit-mitra')
                            @include('pages.mitra.partials.create-mitra')
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
            const header = document.querySelector('#create-image');
            const imgPreview = document.querySelector('.create-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(header.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function editPreviewImage() {
            const header = document.querySelector('#edit-image');
            const imgPreview = document.querySelector('.edit-img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(header.files[0])

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-mitra-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/mitras',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-mitra').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Mitra Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-mitra').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            $('.edit-button').on('click', function() {
                var mitraId = $(this).data('mitra-id');

                // Set the category ID to the modal input field
                $('#edit-mitra-id').val(mitraId);

                $.ajax({
                    type: 'GET',
                    url: '/api/mitras/' + mitraId,
                    success: function(data) {
                        $('#edit-name').val(data.name);
                        $('#oldImage').val(data.image);

                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }

                        // Set the is_primary checkbox state
                        if (data.is_primary == 1) {
                            $('#edit-is_primary').prop('checked', true);
                        } else {
                            $('#edit-is_primary').prop('checked', false);
                        }

                        // Show the modal
                        $('#edit-mitra').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });

            // Submit the form via AJAX
            $('#update-mitra-form').on('submit', function(e) {
                e.preventDefault();

                var mitraId = $('#edit-mitra-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/mitras/' + mitraId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-mitra').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Mitra Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-mitra').modal('hide');
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
            let mitraId = button.getAttribute('data-mitra-id');

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
                    deactivateMitra(mitraId);
                }
            });
        }

        function deactivateMitra(mitraId) {
            $.ajax({
                url: '/api/mitras/' + mitraId + '/deactivate',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Nonaktifkan!',
                            'Mitra Anda telah dinonaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menonaktifkan mitra.',
                            'error'
                        );
                    }
                }
            });
        }

        function btnActivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let mitraId = button.getAttribute('data-mitra-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengaktifkan mitra ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    activateMitra(mitraId);
                }
            });
        }

        function activateMitra(mitraId) {
            $.ajax({
                url: '/api/mitras/' + mitraId + '/activate',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Diaktifkan!',
                            'Mitra Anda telah diaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal mengaktifkan mitra.',
                            'error'
                        );
                    }
                }
            });
        }
    </script>
@endsection
