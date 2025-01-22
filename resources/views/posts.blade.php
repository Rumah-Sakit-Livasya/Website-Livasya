@extends('layouts.main')

@section('container')
    <section class="hero-berita"
        style="background: url(img/WorldMap.svg);  background-size: cover; background-position: right; margin-top: 8rem; height: 40rem;">
        <section class="title bg-light justify-content-center" style="margin-top:8rem;border-radius: 20em;opacity: 0,5;">
            <center>
                <h1 class="fw-bold " style="color: var(--primary)" data-aos="fade-right" data-aos-anchor-placement="top-bottom">
                    Berita Terkini
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
            <div class="row g-5 align-content-between justify-content-around">
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
                                style="border-radius: 20px; outline: none; border: none;">
                                @if ($post->image)
                                    <div class="card-img-top img overflow-hidden">
                                        <p class="text-muted"
                                            style="font-size: 0.9rem; margin: 0; position: absolute; top: 10px; left: 10px; background-color: rgba(255, 255, 255, 0.7); padding: 5px; border-radius: 5px;">
                                            @rslivasya</p>
                                        <div
                                            style="background-image: url({{ asset('/storage/' . $post->image) }}); background-size: cover; height: 400px; background-position: center;">
                                        </div>
                                    </div>
                                @else
                                    <div class="card-img-top img overflow-hidden">
                                        <p class="text-muted"
                                            style="font-size: 0.9rem; margin: 0; position: absolute; top: 10px; left: 10px; background-color: rgba(255, 255, 255, 0.7); padding: 5px; border-radius: 5px;">
                                            @rslivasya</p>
                                        <div
                                            style="background-image: url(https://source.unsplash.com/random/900×700/?{{ $post->category->slug }}); background-size: cover; height: 400px;">
                                        </div>
                                    </div>
                                @endif
                                <div class="card-body text-center" style="background-color: #fff; padding: 1rem;">
                                    <h5 class="card-title" style="font-size: 1.2rem; font-weight: bold;">{{ $post->title }}
                                    </h5>
                                    <p class="card-text" style="font-size: 0.9rem; color: #6c757d;"><i
                                            class="far fa-folder-open" style="color:#0d6efd;"></i>
                                        {{ $post->category->name }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="text-muted">{{ $tanggal }} {{ $bulan }}</span>
                                        <span class="text-muted"><i class="far fa-heart"></i>
                                            {{ $post->likes_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="fs-4 text-center">Tidak ditemukan berita.</p>
        @endif

        <div class="d-flex justify-content-center mt-5">
            <div class="pagination">{{ $posts->links() }}</div>
        </div>

    </section>
@endsection
