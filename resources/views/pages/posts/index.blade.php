@extends('inc.layout')
@section('title', 'Berita')
@section('content')
    <main id="js-page-content" role="main" class="page-content">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon bx bx-news text-primary'></i> Berita & Pengumuman
                <small>
                    Kelola data berita, artikel, dan informasi penting untuk website Rumah Sakit Livasya.
                </small>
            </h1>
            <div class="subheader-block">
                <button id="btn-tambah-berita" type="button" class="btn btn-primary waves-effect waves-themed font-weight-bold" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-berita" title="Tambah Berita">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Berita
                </button>
                <button id="btn-tambah-kategori" type="button" class="btn text-white waves-effect waves-themed font-weight-bold d-none" data-backdrop="static"
                    data-keyboard="false" data-toggle="modal" data-target="#tambah-kategori" title="Tambah Kategori" style="background-color: #7c3aed; border-color: #7c3aed;">
                    <span class="fal fa-plus-circle mr-1"></span>
                    Tambah Kategori
                </button>
            </div>
        </div>

        {{-- Statistik Ringkasan --}}
        <div class="row mb-g">
            {{-- Total Berita --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Total Berita</span>
                            <h2 class="font-weight-bold text-dark mb-0 mt-1" style="font-size: 24px;">{{ $posts->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-primary" style="width: 46px; height: 46px; background-color: #eff6ff; border: 1px solid #bfdbfe;">
                            <i class="fal fa-newspaper" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Berita Aktif --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Aktif</span>
                            <h2 class="font-weight-bold text-success mb-0 mt-1" style="font-size: 24px;">{{ $posts->where('is_active', 1)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-success" style="width: 46px; height: 46px; background-color: #ecfdf5; border: 1px solid #a7f3d0;">
                            <i class="fal fa-check-circle" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Berita Nonaktif --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Nonaktif</span>
                            <h2 class="font-weight-bold text-danger mb-0 mt-1" style="font-size: 24px;">{{ $posts->where('is_active', 0)->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-danger" style="width: 46px; height: 46px; background-color: #fef2f2; border: 1px solid #fecaca;">
                            <i class="fal fa-minus-circle" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Kategori --}}
            <div class="col-sm-6 col-xl-3">
                <div class="card p-3 shadow-xs border-light-blue bg-white" style="border-radius: 8px; min-height: 100px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted font-weight-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Total Kategori</span>
                            <h2 class="font-weight-bold text-purple mb-0 mt-1" style="font-size: 24px; color: #7c3aed !important;">{{ $categories->count() }}</h2>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-purple" style="width: 46px; height: 46px; background-color: #f3e8ff; border: 1px solid #e9d5ff; color: #7c3aed !important;">
                            <i class="fal fa-tags" style="font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Switcher -->
        <div class="row mb-4">
            <div class="col-xl-12">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold shadow-sm" id="pills-berita-tab" data-toggle="pill" href="#pills-berita" role="tab" aria-controls="pills-berita" aria-selected="true" style="border-radius: 6px; padding: 10px 20px;">
                            <i class="fal fa-newspaper mr-2"></i> Daftar Berita & Artikel
                        </a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link font-weight-bold shadow-sm" id="pills-kategori-tab" data-toggle="pill" href="#pills-kategori" role="tab" aria-controls="pills-kategori" aria-selected="false" style="border-radius: 6px; padding: 10px 20px;">
                            <i class="fal fa-tags mr-2"></i> Kategori Berita
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <!-- Tab Pane 1: Berita -->
            <div class="tab-pane fade show active" id="pills-berita" role="tabpanel" aria-labelledby="pills-berita-tab">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="panel-posts" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                            <div class="panel-hdr bg-faded">
                                <h2>
                                    <i class="fal fa-newspaper mr-2 text-primary"></i> Daftar Berita & Artikel
                                </h2>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <!-- datatable start -->
                                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 align-middle-table">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="width: 50px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">No</th>
                                                <th style="width: 80px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Gambar</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Informasi Berita</th>
                                                <th style="width: 150px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Kategori</th>
                                                <th style="width: 120px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Status</th>
                                                <th style="width: 150px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td class="text-center font-weight-bold text-muted align-middle">{{ $loop->iteration }}</td>
                                                    <td class="text-center align-middle">
                                                        <div class="news-thumbnail-wrapper">
                                                            @if($post->image)
                                                                <img src="{{ asset('storage/' . $post->image) }}" class="news-thumbnail rounded shadow-xs" alt="{{ $post->title }}" onerror="this.onerror=null; this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2280%22%20height%3D%2260%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%22100%25%22%20height%3D%22100%25%22%20fill%3D%22%23f1f5f9%22%2F%3E%3Ctext%20x%3D%2250%25%22%20y%3D%2250%25%22%20font-size%3D%2210%22%20fill%3D%22%2394a3b8%22%20font-family%3D%22sans-serif%22%20text-anchor%3D%22middle%22%20dy%3D%22.3em%22%3ENo%20Image%3C%2Ftext%3E%3C%2Fsvg%3E';">
                                                            @else
                                                                <div class="news-thumbnail-placeholder rounded d-flex align-items-center justify-content-center bg-light text-muted">
                                                                    <i class="fal fa-image" style="font-size: 16px;"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="align-middle" style="white-space: normal;">
                                                        <div class="font-weight-bold text-dark news-title" style="font-size: 14px; line-height: 1.4; margin-bottom: 3px;">
                                                            {{ $post->title ?? 'Embeded Instagram' }}
                                                        </div>
                                                        <div class="d-flex flex-wrap align-items-center" style="gap: 12px; font-size: 11px;">
                                                            <span class="text-muted news-slug" style="font-family: monospace;">
                                                                <i class="fal fa-link mr-1"></i>{{ $post->slug ?? 'embeded-instagram' }}
                                                            </span>
                                                            <span class="text-muted news-date">
                                                                <i class="fal fa-calendar-alt mr-1"></i>{{ $post->created_at ? $post->created_at->format('d M Y') : '-' }}
                                                            </span>
                                                            @if($post->is_embeded)
                                                                <span class="badge badge-warning py-1 px-2 font-weight-bold" style="font-size: 9px; text-transform: uppercase;">
                                                                    <i class="fal fa-code mr-1"></i>Embed
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        @php
                                                            $categoryName = $post->category->name ?? 'Uncategorized';
                                                            $slugCat = Str::slug($categoryName);
                                                            $catClass = 'cat-default';
                                                            if (strpos($slugCat, 'rumah-sakit') !== false || strpos($slugCat, 'rs') !== false) {
                                                                $catClass = 'cat-rs';
                                                            } elseif (strpos($slugCat, 'lowongan') !== false || strpos($slugCat, 'karir') !== false || strpos($slugCat, 'kerja') !== false) {
                                                                $catClass = 'cat-career';
                                                            } elseif (strpos($slugCat, 'kesehatan') !== false || strpos($slugCat, 'tips') !== false) {
                                                                $catClass = 'cat-health';
                                                            } elseif (strpos($slugCat, 'promo') !== false || strpos($slugCat, 'event') !== false) {
                                                                $catClass = 'cat-event';
                                                            }
                                                        @endphp
                                                        <span class="badge-category {{ $catClass }}">{{ $categoryName }}</span>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        @if($post->is_active == 1)
                                                            <span class="badge-status badge-status-active">
                                                                <span class="status-dot bg-success mr-1"></span>Aktif
                                                            </span>
                                                        @else
                                                            <span class="badge-status badge-status-inactive">
                                                                <span class="status-dot bg-danger mr-1"></span>Nonaktif
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                                            <!-- Edit button -->
                                                            <button type="button" data-backdrop="static" data-keyboard="false"
                                                                class="btn-action-custom btn-action-detail edit-button"
                                                                data-toggle="modal" data-target="#edit-berita" title="Ubah Berita"
                                                                data-post-id="{{ $post->id }}">
                                                                <span class="fal fa-pencil mr-1"></span>Ubah
                                                            </button>
                                                            @if ($post->is_active == 1)
                                                                <!-- Button to deactivate post -->
                                                                <button type="button"
                                                                    class="btn-action-custom btn-action-reject deactivate-button"
                                                                    data-post-id="{{ $post->id }}" onclick="btnDeactivate(event)"
                                                                    title="Nonaktifkan Berita">
                                                                    <i class='bx bx-minus-circle mr-1'></i>Nonaktif
                                                                </button>
                                                            @else
                                                                <!-- Button to activate post -->
                                                                <button type="button"
                                                                    class="btn-action-custom btn-action-accept activate-button"
                                                                    data-post-id="{{ $post->id }}" onclick="btnActivate(event)"
                                                                    title="Aktifkan Berita">
                                                                    <i class='bx bx-check-circle mr-1'></i>Aktif
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center align-middle">No</th>
                                                <th class="text-center align-middle">Gambar</th>
                                                <th class="align-middle">Informasi Berita</th>
                                                <th class="align-middle">Kategori</th>
                                                <th class="text-center align-middle">Status</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- datatable end -->
                                    <!-- Modal -->
                                    @include('pages.posts.partials.edit-post')
                                    @include('pages.posts.partials.create-post')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Pane 2: Kategori -->
            <div class="tab-pane fade" id="pills-kategori" role="tabpanel" aria-labelledby="pills-kategori-tab">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="panel-categories" class="panel" style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                            <div class="panel-hdr bg-faded">
                                <h2>
                                    <i class="fal fa-tags mr-2 text-purple" style="color: #7c3aed;"></i> Daftar Kategori Berita
                                </h2>
                            </div>
                            <div class="panel-container show">
                                <div class="panel-content">
                                    <!-- datatable start -->
                                    <table id="dt-categories" class="table table-bordered table-hover table-striped w-100 align-middle-table">
                                        <thead class="text-white" style="background-color: #7c3aed;">
                                            <tr>
                                                <th style="width: 50px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">No</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Nama Kategori</th>
                                                <th style="font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="align-middle">Slug</th>
                                                <th style="width: 150px; font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;" class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td class="text-center font-weight-bold text-muted align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle font-weight-bold text-dark" style="font-size: 14px;">{{ $category->name }}</td>
                                                    <td class="align-middle text-muted" style="font-family: monospace; font-size: 12px;">{{ $category->slug }}</td>
                                                    <td class="text-center align-middle">
                                                        <button type="button" data-backdrop="static" data-keyboard="false"
                                                            class="btn-action-custom btn-action-detail edit-category-button"
                                                            data-toggle="modal" data-target="#edit-kategori" title="Ubah Kategori"
                                                            data-category-id="{{ $category->id }}">
                                                            <span class="fal fa-pencil mr-1"></span>Ubah
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center align-middle">No</th>
                                                <th class="align-middle">Nama Kategori</th>
                                                <th class="align-middle">Slug</th>
                                                <th class="text-center align-middle">Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- datatable end -->
                                    <!-- Modal -->
                                    @include('pages.category.partials.edit-category')
                                    @include('pages.category.partials.create-category')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Custom scoped styles for premium UI elements --}}
        <style>
            .border-light-blue {
                border-color: #e2e8f0 !important;
            }
            .align-middle-table td, .align-middle-table th {
                vertical-align: middle !important;
            }
            
            /* Thumbnail styles */
            .news-thumbnail-wrapper {
                width: 55px;
                height: 38px;
                display: inline-block;
                overflow: hidden;
                position: relative;
                border-radius: 4px;
            }
            .news-thumbnail {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border: 1px solid #e2e8f0;
                transition: transform 0.2s ease-in-out;
            }
            .news-thumbnail:hover {
                transform: scale(1.15);
            }
            .news-thumbnail-placeholder {
                width: 55px;
                height: 38px;
                border: 1px dashed #cbd5e1;
            }

            /* Category Pill Badges */
            .badge-category {
                display: inline-block;
                padding: 4px 10px;
                font-size: 11px;
                font-weight: 600;
                border-radius: 20px;
                text-align: center;
                white-space: nowrap;
            }
            .cat-rs {
                background-color: #eff6ff;
                color: #1d4ed8;
                border: 1px solid #dbeafe;
            }
            .cat-career {
                background-color: #fff7ed;
                color: #c2410c;
                border: 1px solid #ffedd5;
            }
            .cat-health {
                background-color: #f0fdf4;
                color: #15803d;
                border: 1px solid #dcfce7;
            }
            .cat-event {
                background-color: #faf5ff;
                color: #6b21a8;
                border: 1px solid #f3e8ff;
            }
            .cat-default {
                background-color: #f3f4f6;
                color: #374151;
                border: 1px solid #e5e7eb;
            }

            /* Status Pill Badges with indicator dots */
            .badge-status {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 4px 10px;
                font-size: 11px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-radius: 30px;
                min-width: 90px;
            }
            .badge-status-active {
                background-color: #ecfdf5;
                color: #047857;
                border: 1px solid #a7f3d0;
            }
            .badge-status-inactive {
                background-color: #fef2f2;
                color: #b91c1c;
                border: 1px solid #fecaca;
            }
            .status-dot {
                width: 6px;
                height: 6px;
                border-radius: 50%;
                display: inline-block;
            }

            /* Modern Action Buttons */
            .btn-action-custom {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 5px 12px;
                font-size: 11px;
                font-weight: 600;
                border-radius: 6px;
                border: 1px solid transparent;
                transition: all 0.2s ease-in-out;
                text-decoration: none !important;
                cursor: pointer;
            }
            .btn-action-custom:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
            }
            .btn-action-custom:active {
                transform: translateY(0);
            }
            
            .btn-action-detail {
                background-color: #eff6ff;
                color: #2563eb !important;
                border-color: #bfdbfe;
            }
            .btn-action-detail:hover {
                background-color: #2563eb;
                color: #ffffff !important;
                border-color: #2563eb;
            }
            
            .btn-action-accept {
                background-color: #ecfdf5;
                color: #10b981 !important;
                border-color: #a7f3d0;
            }
            .btn-action-accept:hover {
                background-color: #10b981;
                color: #ffffff !important;
                border-color: #10b981;
            }
            
            .btn-action-reject {
                background-color: #fef2f2;
                color: #ef4444 !important;
                border-color: #fecaca;
            }
            .btn-action-reject:hover {
                background-color: #ef4444;
                color: #ffffff !important;
                border-color: #ef4444;
            }
        </style>
    </main>
@endsection
@section('plugin')
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script nonce="{{ $nonce }}">
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

        $(document).ready(function() {
            // SELECT2
            $(function() {
                $('#create-category').select2({
                    dropdownParent: $('#tambah-berita')
                });
                $('#edit-category').select2({
                    dropdownParent: $('#edit-berita')
                });
            });
            // SELECT2

            // Kirim formulir tambah melalui AJAX
            $('#create-button').on('click', function() {
                var formData = new FormData($('#create-post-form')[0]);

                $.ajax({
                    type: 'POST',
                    url: '/api/posts',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tangani keberhasilan, misalnya, tutup modal atau perbarui UI
                        $('#tambah-berita').modal('hide');
                        // Lakukan sesuatu setelah berhasil, seperti memuat kembali data kategori

                        // Tampilkan pesan keberhasilan
                        showSuccessAlert('Berita Ditambah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-berita').modal('hide');
                        // Tangani kesalahan, misalnya, tampilkan pesan kesalahan validasi
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });


            // Add the category ID to the modal when the Edit button is clicked
            $('.edit-button').on('click', function() {
                var postId = $(this).data('post-id');

                // Set the category ID to the modal input field
                $('#edit-post-id').val(postId);

                $.ajax({
                    type: 'GET',
                    url: '/api/posts/' + postId,
                    success: function(data) {
                        $('#edit-user-id').val(data.user_id);
                        $('#edit-category').val(data.category_id);
                        $('#edit-title').val(data.title);
                        $('#edit-slug').val(data.slug);
                        if (data.is_embeded == 1) {
                            $('#edit-instagram-group').show();
                            $('#edit-standard-group').hide();

                            var bodyValue = data.body;
                            if (bodyValue) {
                                var match = bodyValue.match(/data-instgrm-permalink="([^"]+)"/);
                                if (match) {
                                    bodyValue = match[1];
                                } else {
                                    var temp = document.createElement("div");
                                    temp.innerHTML = bodyValue;
                                    bodyValue = temp.textContent || temp.innerText || bodyValue;
                                }
                            }
                            $('#edit-body-text').val(bodyValue ? bodyValue.trim() : '');
                        } else {
                            $('#edit-instagram-group').hide();
                            $('#edit-standard-group').show();

                            $('#edit-body').val(data.body);
                            var trix = document.getElementById('edit-body-trix');
                            if (trix && trix.editor) {
                                trix.editor.loadHTML(data.body);
                            }
                        }
                        $('#oldImage').val(data.image);

                        $('#edit-category').val(data.category_id).select2({
                            dropdownParent: $('#edit-berita')
                        });

                        // Set attribut src pada elemen gambar berdasarkan data image dari respons
                        var previewImage = $('.edit-img-preview');
                        if (previewImage.length) {
                            previewImage.attr('src', '/storage/' + data.image);
                        }

                        // Show the modal
                        $('#edit-berita').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan:', error);
                    }
                });
            });


            $('#update-post-form').on('submit', function(e) {
                e.preventDefault();

                // Dynamic name attribute assignment to only submit the active field
                if ($('#edit-instagram-group').is(':visible')) {
                    $('#edit-body-text').attr('name', 'body');
                    $('#edit-body').attr('name', '');
                } else {
                    $('#edit-body').attr('name', 'body');
                    $('#edit-body-text').attr('name', '');
                }

                var postId = $('#edit-post-id').val();
                var formData = new FormData(this); // Gunakan 'this' untuk mengambil data dari form saat ini

                $.ajax({
                    type: 'POST', // Ganti menjadi POST
                    url: '/api/posts/' + postId,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle success, e.g., close modal or update UI
                        $('#edit-berita').modal('hide');

                        // Tampilkan pesan
                        showSuccessAlert('Berita Diubah!');

                        // Tunda reload selama 2 detik
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-berita').modal('hide');
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

            // ==========================================
            // KATEGORI BERITA INTEGRATION
            // ==========================================

            // Tab shown event listener (to toggle subheader buttons dynamically)
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                if (target === '#pills-kategori') {
                    $('#btn-tambah-berita').addClass('d-none');
                    $('#btn-tambah-kategori').removeClass('d-none');
                } else {
                    $('#btn-tambah-kategori').addClass('d-none');
                    $('#btn-tambah-berita').removeClass('d-none');
                }
            });

            // Handle URL Hash to switch tabs on load
            var hash = window.location.hash;
            if (hash) {
                $('.nav-pills a[href="' + hash + '"]').tab('show');
            }

            // Kirim formulir tambah kategori melalui AJAX
            $('#create-category-button').on('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '/api/categories',
                    data: $('#create-category-form').serialize(),
                    success: function(response) {
                        $('#tambah-kategori').modal('hide');
                        showSuccessAlert('Kategori Ditambah!');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#tambah-kategori').modal('hide');
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Add the category ID to the modal when the Edit Category button is clicked
            $(document).on('click', '.edit-category-button', function() {
                var categoryId = $(this).data('category-id');

                // Set the category ID to the modal input field
                $('#edit-category-id').val(categoryId);

                $.ajax({
                    type: 'GET',
                    url: '/api/categories/' + categoryId,
                    success: function(data) {
                        $('#edit-category-name').val(data.name);
                        $('#edit-category-slug').val(data.slug);
                        $('#edit-kategori').modal('show');
                    },
                    error: function(error) {
                        showErrorAlert('Terjadi kesalahan saat memuat data kategori.');
                    }
                });
            });

            // Submit the category update form via AJAX
            $('#update-category-form').on('submit', function(e) {
                e.preventDefault();

                var categoryId = $('#edit-category-id').val();

                $.ajax({
                    type: 'PUT',
                    url: '/api/categories/' + categoryId,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#edit-kategori').modal('hide');
                        showSuccessAlert('Kategori Diubah!');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        $('#edit-kategori').modal('hide');
                        showErrorAlert('Cek kembali data yang dikirim');
                    }
                });
            });

            // Datatable initialization for Categories
            $('#dt-categories').dataTable({
                responsive: true
            });

            // Category Slugable Auto-generation
            const createCategoryName = document.querySelector('#create-category-name');
            const createCategorySlug = document.querySelector('#create-category-slug');
            const editCategoryName = document.querySelector('#edit-category-name');
            const editCategorySlug = document.querySelector('#edit-category-slug');

            if (createCategoryName && createCategorySlug) {
                createCategoryName.addEventListener('change', function() {
                    fetch('/dashboard/categories/checkSlug?title=' + encodeURIComponent(createCategoryName.value))
                        .then(response => response.json())
                        .then(data => createCategorySlug.value = data.slug)
                });
            }

            if (editCategoryName && editCategorySlug) {
                editCategoryName.addEventListener('change', function() {
                    fetch('/dashboard/categories/checkSlug?title=' + encodeURIComponent(editCategoryName.value))
                        .then(response => response.json())
                        .then(data => editCategorySlug.value = data.slug)
                });
            }
        });

        function btnDeactivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let postId = button.getAttribute('data-post-id');

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
                    deactivatePost(postId);
                }
            });
        }

        function deactivatePost(postId) {
            $.ajax({
                url: '/api/posts/' + postId + '/deactivate',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Nonaktifkan!',
                            'Post Anda telah dinonaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal menonaktifkan post.',
                            'error'
                        );
                    }
                }
            });
        }

        function btnActivate(event) {
            event.preventDefault();
            let button = event.currentTarget;
            let postId = button.getAttribute('data-post-id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengaktifkan post ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, aktifkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    activatePost(postId);
                }
            });
        }

        function activatePost(postId) {
            $.ajax({
                url: '/api/posts/' + postId + '/activate',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Diaktifkan!',
                            'Post Anda telah diaktifkan.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page to see changes
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Gagal mengaktifkan post.',
                            'error'
                        );
                    }
                }
            });
        }
    </script>
@endsection
