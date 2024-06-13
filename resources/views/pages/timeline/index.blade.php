@extends('inc.layout')
@section('title', 'Timeline')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="row mb-5">
            <div class="col-xl-12">
                <button type="button" class="btn btn-primary waves-effect waves-themed" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-timeline" title="Tambah Timeline">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Timeline
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Table <span class="fw-300"><i>Timeline</i></span>
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
                                        <th style="white-space: nowrap">Flag</th>
                                        <th style="white-space: nowrap">Time Wrap</th>
                                        <th style="white-space: nowrap">Descript</th>
                                        <th style="white-space: nowrap">Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timelines as $timeline)
                                        <tr>
                                            <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                            <td style="white-space: nowrap">
                                                <!-- Add a data-timeline-id attribute to the edit button -->
                                                <button type="button" data-backdrop="static" data-keyboard="false"
                                                    class="badge mx-1 badge-primary p-2 border-0 text-white edit-button"
                                                    data-toggle="modal" data-target="#edit-timeline" title="Ubah"
                                                    data-timeline-id="{{ $timeline->id }}">
                                                    <span class="fal fa-pencil"></span>
                                                </button>
                                            </td>
                                            <td style="white-space: nowrap">{{ $timeline->flag }}</td>
                                            <td style="white-space: nowrap">{{ $timeline->time }}</td>
                                            <td style="white-space: nowrap">{!! str_replace(['<div>', '</div>'], '', $timeline->desc) !!}</td>
                                            <td style="white-space: nowrap">
                                                <img class="img-responsive" width="50"
                                                    src="{{ asset('storage/' . $timeline->image) }}"
                                                    alt="{{ $timeline->flag }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="white-space: nowrap">No</th>
                                        <th style="white-space: nowrap">Aksi</th>
                                        <th style="white-space: nowrap">Flag</th>
                                        <th style="white-space: nowrap">Time Wrap</th>
                                        <th style="white-space: nowrap">Descript</th>
                                        <th style="white-space: nowrap">Image</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                            <!-- Modal -->
                            @include('pages.timeline.partials.edit-timeline')
                            @include('pages.timeline.partials.create-timeline')
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
                var formData = new FormData($('#create-timeline-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/timelines',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-timeline').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Timeline Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-timeline').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var timelineId = $(this).data('timeline-id');

                // Set the category ID to the modal input field
                $('#edit-timeline-id').val(timelineId);

                $.ajax({
                    type: 'GET',
                    url: '/api/timelines/' + timelineId,
                    success: function(data) {
                        $('#edit-name').val(data.name);
                        $('#edit-time').val(data.time);
                        $('#edit-desc').val(data.desc);
                        $('#edit-desc-text').val(data.desc);
                        $('#oldImage').val(data.image);

                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }

                        // Show the modal
                        $('#edit-timeline').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            // Submit the form via AJAX
            $('#update-timeline-form').on('submit', function(e) {
                e.preventDefault();

                var timelineId = $('#edit-timeline-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/timelines/' + timelineId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-timeline').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Timeline Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-timeline').modal('hide');
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
