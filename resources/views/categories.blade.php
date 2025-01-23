@extends('layouts.main')

@section('container')
    <section class="hero-berita"
        style="background: url(/img/WorldMap.svg);  background-size: cover; background-position: right; height: 40rem;">
        <section class="title bg-light justify-content-center" style="margin-top:8rem;border-radius: 20em;opacity: 0,5;">
            <h1 class="fw-bold text-center " style="color: var(--primary)" data-aos="fade-right"
                data-aos-anchor-placement="top-bottom">
                {{ $title }}
            </h1>
        </section>
    </section>

    <section class="blogs bg-white" style="padding-top: 7rem" id="blogs">
        <div class="box-container container-fluid">
            <div class="row row-cols-lg-2 g-5 justify-content-center">
                @foreach ($categories as $category)
                    <div class="box m-3" style="max-width: 45rem">
                        <a class="nav-link fs-3" href="/categories/{{ $category->slug }}">{{ $category->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
            <a href="/" class="kembali-parent h5 text-decoration-none text-primary my-5 d-inline-block">
                <span class="fas fa-chevron-left"></span>
                <p class="kembali d-inline-block">Kembali ke Beranda</p>
            </a>
        </div>
    </section>
@endsection
