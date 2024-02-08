@extends('layouts.main')

@section('container')
    <!-- doctors section starts  -->
    <div class="hero-karir"></div>
    <section class="title" style="background: var(--primary);">
        <h1 class="fw-bold text-light text-left" data-aos="fade-left" data-aos-anchor-placement="top-bottom">
            {{ $title }}
        </h1>
    </section>

    <section class="main bg-white">
        <div class="col-12 text-center my-6">
            <h4 class="text-default fw-400 h1">Bergabunglah Dengan Kami</h4>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <a href="/career/medis" class="text-decoration-none">
                    <div class="card mt-5" style="overflow: visible">
                        <img src="/img/career-medis.png" class="card-img-top">
                        <div class="card-body text-center">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $medis }}
                            </span>
                            <span class="fw-bolder">Medis</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-lg-6">
                <a href="/career/non-medis" class="text-decoration-none">
                    <div class="card mt-5" style="overflow: visible">
                        <img src="/img/career-nonmedis.png" class="card-img-top">
                        <div class="card-body text-center">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $nonMedis }}
                            </span>
                            <span class="fw-bolder">Non Medis</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- <div class="col-12 col-lg-12 text-center mt-5">
            <div class="row gap-y">
                <div class="col-12 col-lg-12 container">
                    <div class="row gap-y justify-content-center">
                        <div class="col-12 col-lg-5">
                            <a href="/career/medis" style="text-decoration: none">
                                <p class="text-default">Medis</p>
                                <img class="img-thumbnail" src="/img/career-medis.png" alt="">
                            </a>
                        </div>

                        <div class="col-12 col-lg-5">
                            <a href="/career/non-medis" style="text-decoration: none">
                                <p class="text-default">Non Medis</p>
                                <img class="img-thumbnail" src="/img/career-nonmedis.png" alt="">
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div> --}}
    </section>
@endsection
