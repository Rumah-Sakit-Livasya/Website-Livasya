@extends('layouts.main')

@section('container')
    <style>
        .hero-rajal{
                background:
                    linear-gradient(rgba(255, 255, 255, 0.50), rgba(255, 255, 255, 0.50)),
                    url('/img/rajal/header.webp');
                background-size: cover;
                background-position: center center;
                margin-top: 8rem;
                height: 40rem;
            }
            
            @media only screen and (max-width: 600px) {
                .hero-rajal {
                    height: 30rem;
                    background-position: left center;
                }
            }
            
    </style>

    <div class="hero-rajal overflow-hidden"></div>

    <section class="title bg-primary overflow-hidden">
        <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $title }}</h1>
    </section>

    <section class="content bg-white overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                @foreach ($pelayanan as $p)
                    <div class="list p-4 my-3 {{ Request::is($p->url) ? 'aktif' : '' }}">
                        <a href="/{{ $p->url }}" class="text-decoration-none">{{ $p->title }} <span
                                class="fas fa-chevron-right"></span></a>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6 mx-5">

                <div id="page">
                    <div class="row">
                        <div class="column small-11 small-centered">
                            <div class="slider slider-single">
                                <div>
                                    <img src="/img/rajal/1.webp" alt="LAB" class="img-fluid img-thumbnail" style="filter: brightness(1); border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/2.webp" alt="LAB" class="img-fluid img-thumbnail" style="filter: brightness(1); border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/3.webp" alt="LAB" class="img-fluid img-thumbnail" style="filter: brightness(1); border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/4.webp" alt="LAB" class="img-fluid img-thumbnail" style="filter: brightness(1); border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/5.webp" alt="LAB" class="img-fluid img-thumbnail" style="filter: brightness(1); border-radius: 20px">
                                </div>
                            </div>

                            <div class="slider slider-nav mt-3">
                                <div>
                                    <img src="/img/rajal/1.webp" alt="LAB" class="img-fluid mx-3 img-thumbnail" style="border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/2.webp" alt="LAB" class="img-fluid mx-3 img-thumbnail" style="border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/3.webp" alt="LAB" class="img-fluid mx-3 img-thumbnail" style="border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/4.webp" alt="LAB" class="img-fluid mx-3 img-thumbnail" style="border-radius: 20px">
                                </div>
                                <div>
                                    <img src="/img/rajal/5.webp" alt="LAB" class="img-fluid mx-3 img-thumbnail" style="border-radius: 20px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text mt-5">
                    <h1 class="fw-bold" style="font-size:24px;">{{ $title }}</h1>
                    <p class="text-black-50 mt-4" style="font-size:14px;">Rumah Sakit Livasya memiliki berbagai macam poli klinik yang bisa memberikan pelayanan terhadap pasien sesuai dengan keluhan yang dirasakannya</p>
                </div>
                
            </div>
        </div>
    </section>
@endsection
