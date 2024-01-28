@extends('layouts.main')

@section('container')
    <section class="home" id="home">
        <div class="image">
            <img src="img/home-img.svg" alt="">
        </div>

        <div class="content">
            <h5 class="judul">Baca Berita Terkini dari Kami</h5>
            <p>{{ $deskripsi_jumbotron }}</p>
        </div>
    </section>

    <section class="blogs my-5" id="blogs">
        <h1 class="heading mb-5"> Berita <span>Terkini</span> </h1>

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
            <div class="box-container container">
                <div class="row row-cols-lg-3 g-5   align-content-between justify-content-center">
                    @foreach ($posts as $post)
                        <div class="box m-3" style="max-width: 35.35rem">
                            <div class="image">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid img-thumbnail"
                                        alt="{{ $post->gambar }}">
                                @else
                                    <img src="https://source.unsplash.com/400x200/?{{ $post->category->name }}"
                                        class="img-fluid img-thumbnail" alt="{{ $post->gambar }}">
                                @endif
                            </div>
                            <div class="content">
                                <div class="icon">
                                    <a class="nav-link" href="javascript:void(0)"> <i class="fas fa-calendar"></i>
                                        {{ $post->created_at->diffForHumans() }}
                                    </a>
                                    <a class="nav-link" href="#"> <i class="fas fa-user"></i> by
                                        {{ $post->user->name }}
                                    </a>
                                </div>
                                <h1>{{ $post->title }}</h1>
                                <p>{{ $post->excerpt }}</p>
                                <div class="row row-cols-2 mt-auto">
                                    <a class="nav-link fs-5" href="/posts/{{ $post->slug }}" class="btn"> Baca
                                        Selengkapnya
                                        <span class="fas fa-chevron-right"></span>
                                    </a>

                                    <a class="nav-link text-end fs-5" href="/categories/{{ $post->category->slug }}"
                                        class="btn">
                                        <i class="fas fa-list-alt"></i> {{ $post->category->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="fs-4 text-center">Tidak ditemukan berita.</p>
        @endif

        <div class="d-flex justify-content-center fs-1 mt-5">
            {{ $posts->links() }}
        </div>

    </section>
@endsection
