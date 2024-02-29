@extends('layouts.main')

@section('container')
    <section class="hero-berita"
        style="background: url(/img/WorldMap.svg);  background-size: cover; background-position: right; margin-top: 8rem; height: 40rem;">
        <section class="title bg-light justify-content-center" style="margin-top:8rem;border-radius: 20em;opacity: 0,5;">
            <center>
                <h1 class="fw-bold " style="color: var(--primary)" data-aos="fade-right" data-aos-anchor-placement="top-bottom">
                    Berita Kategori {{ $category }}
                </h1>
            </center>
        </section>
    </section>

    <section class="blogs py-5" id="blogs">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <form action="/posts">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control fs-4" value="{{ request('search') }}"
                            placeholder="Cari berita" name="search">
                        <button class="btn pe-3" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($posts->count())
            <div class="box container-fluid">
                <div class="wrapper">
                    <div class="row g-5 align-content-between justify-content-center">
                        @foreach ($posts as $post)
                            @php
                                $date = substr($post->created_at, 0, 10);
                                $date_convert = date_create($date);
                                $tanggal = date_format($date_convert, 'd');
                                $bulan = date_format($date_convert, 'M');
                            @endphp

                            <div class="col-lg-4">
                                <a href="/posts/{{ $post->slug }}" class="text-decoration-none">
                                    <div class="card img-parent overflow-hidden position-relative shadow"
                                        style="border-radius: 5px; outline: none; border: none; border-radius: 20px">
                                        @if ($post->image)
                                            <div class="card-img-top img overflow-hidden"
                                                style="z-index: 0; background-image: url({{ asset('/storage/' . $post->image) }}); background-size: cover; height: 300px; background-position: center;">
                                            </div>
                                        @else
                                            <div class="card-img-top img overflow-hidden"
                                                style="z-index: 0; background-image: url(https://source.unsplash.com/random/900×700/?{{ $post->category->slug }}); background-size: cover; height: 25rem;">
                                            </div>
                                        @endif
                                        <div class="position-absolute"
                                            style="z-index: 3; left: 0; top: 60%; width: 5rem; height: 7rem; background-color: rgba(0, 108, 191, .5);">
                                            <h3 class="text-center text-white mt-3">{{ $tanggal }} <br>
                                                {{ $bulan }}</h3>
                                        </div>
                                        <div class="card-body text-center"
                                            style="z-index: 2; height: 8rem; line-height: 6rem; background-color: #fff;">
                                            <p class="card-text" style="font-size: 11pt"><i class="far fa-folder-open"
                                                    style="color:#0d6efd;"></i> {{ $post->category->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <p class="fs-4 text-center">Tidak ditemukan berita.</p>
        @endif

        <div class="d-flex justify-content-center mt-5">
            <div class="pagination">{{ $posts->links() }}</div>
        </div>

        <div class="text-center">
            <a href="/categories" class="kembali-parent h5 text-decoration-none text-primary my-5 d-inline-block">
                <span class="fas fa-chevron-left"></span>
                <p class="kembali d-inline-block">Kembali ke halaman Kategori</p>
            </a>
        </div>

    </section>
@endsection
