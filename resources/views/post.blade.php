@extends('layouts.main')

@section('container')
    <div class="bg-white">

        <span></span>
        <section class="title bg-primary mb-3" style="margin-top: 8rem;">
            <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $post->title }}
            </h1>
        </section>
        <div class="container bg-white" padding-bottom: 5rem;">
            <div class="mb-3 row">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card" style="border: none; border-radius: 20px">
                            <div class="card-body">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->gambar }}" style="border: none; border-radius: 20px">
                                @else
                                    <img src="https://source.unsplash.com/400x200/?{{ $post->category->name }}"
                                        class="img-fluid" alt="{{ $post->gambar }}"
                                        style="border: none; border-radius: 20px">
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="col fs-5 text-center">
                                        <i class="fas fa-calendar"></i> {{ $post->created_at->diffForHumans() }}
                                    </div>
                                    <div class="col fs-5 text-center">
                                        <a class="nav-link" href="/categories/{{ $post->category->slug }}"><i
                                                class="fas fa-list-alt"></i>
                                            {{ $post->category->name }}</a>
                                    </div>
                                    <div class="col fs-5 text-center">
                                        <i class="fas fa-user"></i> {{ $post->user->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <h5 class="card-title fs-3 fw-bold">{{ $post->title }}</h5>
            </div>
            <div class="row">
                <span class="card-text container fs-4 text-justify">
                    {!! $post->body !!}
                </span>
            </div>
            <a href="/posts" class="kembali-parent text-decoration-none text-primary my-5 d-inline-block">
                <span class="fas fa-chevron-left"></span>
                <p class="kembali d-inline-block">Kembali ke halaman Berita</p>
            </a>
        </div>
    </div>
@endsection
