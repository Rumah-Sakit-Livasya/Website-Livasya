@extends('layouts.main')

@section('container')
    <section></section>
    <section class="blogs my-5" style="padding-top: 7rem" id="blogs">
        <h1 class="heading mb-5" style="font-size: 3rem"> Berita <span>{{ $category }}</span> </h1>
        <div class="box-container container-fluid">
            <div class="row row-cols-lg-3 g-5 justify-content-center">
                @foreach ($posts as $post)
                    <div class="col-lg-4">
                        <a href="/posts/{{ $post->slug }}">
                            <div class="kolom" ontouchstart="this.classList.toggle('hover');">
                                <div class="containers">
                                    @if ($post->image)
                                        <div class="front"
                                            style="background-image: url({{ asset('storage/' . $post->image) }})">
                                            <div class="inner">
                                                <p class="fs-5">{{ $post->title }}</p>
                                                <span class="fs-5">{{ $post->category->name }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="front" style="background-image: url(https://unsplash.it/500/500/)">
                                            <div class="inner">
                                                <p class="fs-5">{{ $post->title }}</p>
                                                <span class="fs-5">{{ $post->category->name }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="back">
                                        <div class="inner">
                                            <p>{{ $post->excerpt }}</p>
                                            <p class="fs-5 mt-5">
                                                Baca
                                                Selengkapnya
                                                <span class="fas fa-chevron-right"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
