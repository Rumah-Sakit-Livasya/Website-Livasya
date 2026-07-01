@extends('layouts.main')

@section('container')
    <style>
        .hero-berita {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.65) 100%),
                        url("/img/WorldMap.svg") center center / cover no-repeat;
            height: 240px;
            border-radius: 0 0 24px 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            background-color: #0c1e35;
        }

        .search-card {
            border-radius: 12px;
            background: #fff;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .search-input {
            border: 1px solid #e5e7eb;
            border-radius: 8px 0 0 8px;
            font-size: 14px;
            padding: 10px 16px;
        }

        .search-input:focus {
            border-color: #3b82f6;
            box-shadow: none;
        }

        .search-btn {
            background-color: #2563eb;
            color: #fff;
            border: 1px solid #2563eb;
            border-radius: 0 8px 8px 0;
            font-weight: 700;
            font-size: 14px;
            padding: 0 20px;
            transition: all 0.2s;
        }

        .search-btn:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
            color: #fff;
        }

        .news-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
            border-color: #dbeafe;
        }

        .news-img {
            height: 240px;
            width: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .news-card:hover .news-img {
            transform: scale(1.03);
        }

        .category-badge {
            background-color: #eff6ff;
            color: #2563eb;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 20px;
            padding: 4px 10px;
        }

        .news-title {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.4;
            color: #1f2937;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 42px;
        }

        .instagram-embed-wrapper {
            max-height: 480px;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #e0edf4;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            width: 100%;
            height: 100%;
            padding: 8px;
        }

        /* Customize scrollbar inside instagram embed wrapper */
        .instagram-embed-wrapper::-webkit-scrollbar {
            width: 6px;
        }
        .instagram-embed-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 16px;
        }
        .instagram-embed-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 16px;
        }
        .instagram-embed-wrapper::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    {{-- Unified Compact Hero Banner --}}
    <div class="container my-4">
        <div class="hero-berita position-relative d-flex align-items-end" style="overflow: hidden;">
            <div class="p-4 w-100" data-aos="fade-up">
                <span class="badge bg-light text-primary font-weight-bold px-3 py-1-5 mb-2 text-uppercase" style="border-radius: 20px; font-size: 10px; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">Informasi Livasya</span>
                <h1 class="text-white font-weight-bold mb-0 text-shadow" style="font-size: 2rem; text-shadow: 2px 2px 10px rgba(0,0,0,0.65);">
                    Berita Terkini & Artikel
                </h1>
            </div>
        </div>
    </div>

    {{-- News Section --}}
    <section class="blogs py-4 bg-light overflow-hidden" id="blogs">
        <div class="container">
            {{-- Compact Search Bar --}}
            <div class="row justify-content-center mb-4">
                <div class="col-md-6 col-lg-5">
                    <div class="card p-2 border-0 search-card">
                        <form action="/posts" class="mb-0">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" value="{{ request('search') }}"
                                    placeholder="Cari artikel berita..." name="search" required>
                                <div class="input-group-append">
                                    <button class="btn search-btn" type="submit">
                                        <i class="fas fa-search mr-1"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            @if ($posts->count())
                <div class="row g-4 justify-content-center">
                    @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                            @if ($post->is_embeded)
                                <div class="news-card p-0" style="border: none; background: transparent; box-shadow: none;">
                                    <div class="instagram-embed-wrapper">
                                        {!! str_replace('//www.instagram.com/embed.js', 'https://www.instagram.com/embed.js', $post->body) !!}
                                    </div>
                                </div>
                            @else
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none d-flex flex-column w-100">
                                    <div class="news-card d-flex flex-column justify-content-between h-100 w-100">
                                        <div>
                                            {{-- Post Image --}}
                                            <div class="position-relative overflow-hidden" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                                <img src="{{ $post->image ? asset('/storage/' . $post->image) : asset('img/rsialivasya.webp') }}"
                                                     alt="Foto {{ $post->title }}"
                                                     class="news-img"
                                                     onerror="this.onerror=null; this.src='{{ asset('img/rsialivasya.webp') }}';">
                                                
                                                <div class="position-absolute top-0 right-0 p-3">
                                                    <span class="category-badge shadow-sm">
                                                        {{ $post->category->name }}
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Post Details --}}
                                            <div class="p-4">
                                                {{-- Meta Info --}}
                                                <div class="d-flex align-items-center justify-content-between mb-2 text-muted" style="font-size: 11px; font-weight: 500;">
                                                    <span><i class="fas fa-calendar-alt mr-1 text-primary"></i> {{ $post->created_at->diffForHumans() }}</span>
                                                    <span><i class="fas fa-user mr-1 text-primary"></i> {{ $post->user->name ?? 'Admin' }}</span>
                                                </div>
                                                
                                                {{-- Title --}}
                                                <h5 class="news-title mb-3">{{ $post->title }}</h5>
                                                
                                                {{-- Excerpt / Short description fallback --}}
                                                <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px;">
                                                    {{ strip_tags($post->excerpt ?? $post->body) }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Footer Action Link --}}
                                        <div class="px-4 pb-4 bg-white" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                                            <hr class="my-2 border-faded">
                                            <div class="d-flex align-items-center justify-content-between text-primary font-weight-bold" style="font-size: 13px;">
                                                <span>Baca Selengkapnya</span>
                                                <i class="fas fa-arrow-right ml-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center text-muted mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-newspaper" style="font-size: 30px;"></i>
                    </div>
                    <p class="fs-5 font-weight-bold text-dark">Tidak ditemukan berita.</p>
                </div>
            @endif

            <div class="d-flex justify-content-center mt-5" id="pagination-container">
                <div class="pagination">{{ $posts->links() }}</div>
            </div>
        </div>
    </section>

    <script nonce="{{ $nonce }}">
        document.addEventListener('DOMContentLoaded', function() {
            attachPaginationLinks();

            function attachPaginationLinks() {
                const paginationLinks = document.querySelectorAll('#pagination-container .pagination a');

                paginationLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        const url = this.href;

                        fetch(url)
                            .then(response => response.text())
                            .then(data => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(data, 'text/html');
                                const newPosts = doc.querySelector('.row.g-4');
                                const newPagination = doc.querySelector('#pagination-container');

                                document.querySelector('.row.g-4').innerHTML = newPosts.innerHTML;
                                document.querySelector('#pagination-container').innerHTML = newPagination.innerHTML;

                                // Scroll to the top of the blogs container
                                document.getElementById('blogs').scrollIntoView({ behavior: 'smooth' });

                                // Reinitialize Instagram embeds after new content is loaded
                                if (typeof instgrm !== 'undefined') {
                                    instgrm.Embeds.process();
                                }

                                // Reattach pagination links after new content is loaded
                                attachPaginationLinks();
                            });
                    });
                });
            }
        });
    </script>
@endsection
