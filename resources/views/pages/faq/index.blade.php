@extends('inc.layout')
@section('title', 'Faq')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-faq" title="Tambah Faq">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Faq
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Faq</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                        <th style="white-space: nowrap">Pertanyaan</th>
                                        <th style="white-space: nowrap">Jawaban</th>
                                        <th style="white-space: nowrap">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">
                                                <!-- Add a data-faq-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-faq" title="Ubah"
                                                    data-faq-id="{{ $faq->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>

                                                @if ($faq->is_active == 1)
                                                    <!-- Button to deactivate faq -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-danger p-2 border-0 text-white deactivate-button"
                                                        data-faq-id="{{ $faq->id }}" onclick="btnDeactivate(event)">
                                                        <i class='bx bx-minus-circle m-0'></i>
                                                    </button>
                                                @else
                                                    <!-- Button to activate faq -->
                                                    <button type="button"
                                                        class="badge mx-1 badge-success p-2 border-0 text-white activate-button"
                                                        data-faq-id="{{ $faq->id }}" onclick="btnActivate(event)">
                                                        <i class='bx bx-check-circle m-0'></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap">{!! str_replace(['<div>', '</div>'], '', $faq->question) !!}</td>
                                            <td style="white-space: nowrap">{!! str_replace(['<div>', '</div>'], '', $faq->answer) !!}</td>
                                            <td style="white-space: nowrap">
                                                {{ $faq->is_active == 1 ? 'Aktif' : 'Nonaktif' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                        <th style="white-space: nowrap">Pertanyaan</th>
                                        <th style="white-space: nowrap">Jawaban</th>
                                        <th style="white-space: nowrap">Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.faq.partials.edit-faq')
                            @include('pages.faq.partials.create-faq')
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
                var formData = new FormData($('#create-faq-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/faqs',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-faq').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Faq Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-faq').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            $('.edit-button').on('click', function() {
                var faqId = $(this).data('faq-id');
                console.log("asdasdasd");
                // Set the category ID to the modal input field
                $('#edit-faq-id').val(faqId);

                $.ajax({
                    type: 'GET',
                    url: '/api/faqs/' + faqId,
                    success: function(data) {
                        $('#edit-question').val(data.question);
                        $('#edit-question-text').val(data.question);
                        $('#edit-answer').val(data.answer);
                        $('#edit-answer-text').val(data.answer);
                        console.log(data);

                        // Show the modal
                        $('#edit-faq').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });

            // Submit the form via AJAX
            $('#update-faq-form').on('submit', function(e) {
                e.preventDefault();

                var faqId = $('#edit-faq-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/faqs/' + faqId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-faq').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Faq Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-faq').modal('hide');
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
            let faqId = button.getAttribute('data-faq-id');

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
                    deactivateFaq(faqId);
                }
            });
        }

        function deactivateFaq(faqId) {
            $.ajax({
                url: '/api/faqs/' + faqId + '/deactivate',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Nonaktifkan!',
                            'Faq Anda telah dinonaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menonaktifkan faq.',
                            'error'
                        );
                    }
                }
            });
        }

        function btnActivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let faqId = button.getAttribute('data-faq-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengaktifkan faq ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    activateFaq(faqId);
                }
            });
        }

        function activateFaq(faqId) {
            $.ajax({
                url: '/api/faqs/' + faqId + '/activate',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Diaktifkan!',
                            'Faq Anda telah diaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal mengaktifkan faq.',
                            'error'
                        );
                    }
                }
            });
        }
    </script>
@endsection
