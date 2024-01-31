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

        <div class="col-12 col-lg-12 text-center">
            <div class="row gap-y">

                <div class="col-12 col-lg-12 container">
                    <div class="row gap-y justify-content-center">
                        <div class="col-12 col-lg-5">
                            <a href="/career/medis">
                                <p class="text-default td-none">Medis</p>
                                <img class="img-thumbnail" src="https://mayapadahospital.com/assets/banner/career-medis.png"
                                    alt="">
                            </a>
                        </div>

                        <div class="col-12 col-lg-5">
                            <a href="/career/non-medis">
                                <p class="text-default td-none">Non Medis</p>
                                <img class="img-thumbnail"
                                    src="https://mayapadahospital.com/assets/banner/career-nonmedis.png" alt="">
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
