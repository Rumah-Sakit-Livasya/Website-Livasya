@extends('inc.layout')
@section('title', 'Faq')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon bx bx-help-circle text-primary'></i> Tanya Jawab (FAQ)
                <small>
                    Kelola data pertanyaan dan jawaban umum untuk membantu pengunjung mendapatkan informasi penting.
                </small>
            </h1>
            <div class="subheader-block">
                <button type="button" class="btn btn-primary waves-effect waves-themed font-weight-bold" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-faq" title="Tambah FAQ">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah FAQ
                </button>
            </div>
        </div>

        {{-- Statistik Ringkasan --}}
        <div class="row mb-g">
            {{-- Total FAQ --}}
            <div class="col-sm-6 col-xl-4">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Total FAQ</span>
                            <h2 class="font-weight-bold text-dark mb-0 mt-1" style="font-size: 24px;">{{ $faqs->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 46px; height: 46px; background-color: #eff6ff; border: 1px solid #bfdbfe;">
                            <i class="fal fa-question-circle" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- FAQ Aktif --}}
            <div class="col-sm-6 col-xl-4">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Aktif</span>
                            <h2 class="font-weight-bold text-success mb-0 mt-1" style="font-size: 24px;">{{ $faqs->where('is_active', 1)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 46px; height: 46px; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <i class="fal fa-check-circle" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- FAQ Nonaktif --}}
            <div class="col-sm-6 col-xl-4">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Nonaktif</span>
                            <h2 class="font-weight-bold text-danger mb-0 mt-1" style="font-size: 24px;">{{ $faqs->where('is_active', 0)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-danger" style="width: 46px; height: 46px; background-color: #fef2f2; border: 1px solid #fca5a5;">
                            <i class="fal fa-minus-circle" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Daftar <span class="fw-300"><i>FAQ</i></span>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="white-space: nowrap; width: 5%;">No</th>
                                        <th style="white-space: nowrap; width: 10%;">Aksi</th>
                                        <th style="white-space: nowrap; width: 35%;">Pertanyaan</th>
                                        <th style="white-space: nowrap; width: 40%;">Jawaban</th>
                                        <th style="white-space: nowrap; width: 10%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="btn btn-sm btn-icon btn-outline-primary mr-1 edit-button"
                                                    data-toggle="modal" data-target="#edit-faq" title="Ubah"
                                                    data-faq-id="{{ $faq->id }}">
                                                    <i class="fal fa-edit"></i>
                                                </button>

                                                @if ($faq->is_active == 1)
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-outline-danger deactivate-button"
                                                        data-faq-id="{{ $faq->id }}" onclick="btnDeactivate(event)" title="Nonaktifkan">
                                                        <i class="fal fa-ban"></i>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-outline-success activate-button"
                                                        data-faq-id="{{ $faq->id }}" onclick="btnActivate(event)" title="Aktifkan">
                                                        <i class="fal fa-check"></i>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="font-weight-bold text-dark" style="font-size: 13.5px; min-width: 220px; white-space: normal;">
                                                    {!! strip_tags($faq->question) !!}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted" style="font-size: 13px; line-height: 1.55; min-width: 320px; white-space: normal;">
                                                    {!! strip_tags($faq->answer) !!}
                                                </div>
                                            </td>
                                            <td style="white-space: nowrap">
                                                @if ($faq->is_active == 1)
                                                    <span class="badge badge-success px-2 py-1" style="font-size: 11px; border-radius: 4px;">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary px-2 py-1" style="font-size: 11px; border-radius: 4px;">Nonaktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Status</th>
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
