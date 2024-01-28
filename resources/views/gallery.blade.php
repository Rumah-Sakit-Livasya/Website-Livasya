@extends('layouts.main')

@section('container')
    <div class="hero-gallery"></div>

    <section class="title" style="background: var(--primary);">
        <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">Galeri Kami</h1>
    </section>

    <section class="gallery bg-white" style="padding-top: 15rem">
        {{-- <h1 class="heading mt-5"><span>Galeri</span> Kami</h1> --}}
        <div class="container">
            <div class="row justify-content-center g-5">
                <p class="imglist">
                    @foreach ($galleries as $gallery)
                        <div class="col-lg-3" style="border-radius: 20px;">
                            <a href="{{ asset('/public/'. $gallery->image) }}"  data-fancybox="group" data-caption="{{ $gallery->caption }}">
                                <div class="card-img-top img overflow-hidden img-thumbnail shadow" style="z-index: 0; background-image: url({{ asset('/public/' . $gallery->image)}}); background-size: cover; height: 300px; background-position: center top; border-radius: 20px;"></div>                        
                            </a>
                        </div>
                    @endforeach
                </p>
            </div>
        </div>
    </section>
@endsection

