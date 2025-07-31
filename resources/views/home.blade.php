@extends('layouts.main')

@section('container')
    <style>
        .home {
            background: transparent !important;
        }

        .book .row {
            gap: 0;
        }

        .swiper {
            width: 600px;
            height: 300px;
        }

        .home .image img {
            background: rgba(255, 255, 255, .5);
            animation: anim 5s ease-in-out infinite;
        }

        @keyframes anim {
            0% {
                transform: translatey(0px);
            }

            50% {
                transform: translatey(-30px);
            }

            100% {
                transform: translatey(0px);
            }
        }

        .title-web {
            font-size: 3rem;
            text-align: right !important;
            line-height: 4rem;
            font-family: poppins;
            font-weight: 800;
        }

        .wrap-text div {
            text-align: justify !important;
        }
    </style>
    <link rel="stylesheet" href="css/animasi.css">
    <!-- home section start -->
    <section class="home my-5 overflow-x-hidden" id="home">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="image row juctify-content-center">
                    <div class="">
                        <img src="{{ asset('storage/' . $jumbotron->main_image) }}"
                            class="d-block img-fluid m-auto p-5 rounded-circle" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wrap-text">
                    <h1 class="heading section-heading-lg title-web">{!! $jumbotron->title !!}</h1>
                    <p id="tex">{!! ucwords($jumbotron->title_description) !!}
                    </p>
                    <div class="row">
                        <div class="col" data-aos="fade-left">
                            <a href="https://dafol.livasya.com" target="_blank" class="btn mt-3"> Daftar Sekarang <span
                                    class="fas fa-chevron-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home section ends -->

    <!-- icons section starts  -->
    {{-- Waves --}}
    <svg class="waves mt-5" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
        </g>
    </svg>
    {{-- ./Waves --}}
    <section class="icons-container overflow-hidden bg-white" style="margin-top: 0 !important">
        <div class="icons" data-aos="fade-right">
            <i class="fas fa-user-md"></i>
            <h3><span data-purecounter-start="0" data-purecounter-end="{{ count($dokter) }}" data-purecounter-duration="1"
                    class="purecounter"></span></h3>
            <p>Dokter</p>
        </div>
        <div class="icons" data-aos="fade-up">
            <i class="fas fa-users"></i>
            <h3><span data-purecounter-start="0" data-purecounter-end="{{ $identity->jml_pasien_puas }}"
                    data-purecounter-duration="5" class="purecounter"></span>+</h3>
            <p>Pasien Puas</p>
        </div>
        <div class="icons" data-aos="fade-left">
            <i class="fas fa-procedures"></i>
            <h3 data-purecounter-start="0" data-purecounter-end="{{ $identity->jml_fasilitas_kamar }}"
                data-purecounter-duration="2" class="purecounter">{{ $identity->jml_fasilitas_kamar }}+</h3>
            <p>Fasilitas Tempat Tidur</p>
        </div>
    </section>
    <!-- icons section ends -->

    <!-- services section starts  -->
    <section class="services py-5 overflow-hidden" style="background: #f5f5f5;" id="services">
        <div class="box-custom row d-flex justify-content-center align-items-center">
            <div class="pelayanan col-lg-2 d-flex m-5 align-items-center">
                <div class="card-body mt-4 text-center ">
                    <i class="fas fa-heartbeat" style="font-size: 5rem"></i>
                    <p class="fs-3 mt-3 text fw-bold">Poliklinik</p>
                </div>
            </div>

            <div class="col-lg-9 align-items-center" style="height: 18rem;">
                <section class="splide" aria-labelledby="carousel-heading">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($polikliniks as $poliklinik)
                                <li class="splide__slide">
                                    <div class="card mx-3 border-0 " style="border-radius:20px;">
                                        <div class="card-body mt-4 text-center">
                                            <img src="{{ asset('storage/' . $poliklinik->image) }}"
                                                alt="{{ $poliklinik->name }}" width="50">
                                            <p class="fs-3 mt-3 text fw-bold" style="color: #e97f0d;">
                                                {{ $poliklinik->name }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>

        <h1 class="heading mt-5"> Pelayanan <span>Kami</span> </h1>
        <div class="box-custom row justify-content-center align-items-center">
            @foreach ($pelayanan as $p)
                <a href="/pelayanan/{{ $p->slug }}"
                    class="pelayanan g-5 shadow col-lg-3 mx-5 d-flex align-items-center text-decoration-none"
                    style="height: 23rem; border-radius: 2rem">
                    <div class="card-body text-center">
                        <i class="{{ $p->icon }} mb-3" style="font-size: 7rem;"></i>
                        <p class="fs-1 mt-3 text fw-bold">{{ $p->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    <!-- services section end  -->

    <!-- booking section starts   -->
    <section class="gallery overflow-hidden" style="background: #f5f5f5;" id="services">
        <h1 class="heading pt-5" style="margin-bottom:-10px;"> <span>Jadwal</span> Dokter </h1>
        <div class="container">
            <div class="row justify-content-center g-5">
                <p class="imglist">
                    {{-- @foreach ($jadwals as $jadwal) --}}
                <div class="col-12 col-lg-6">
                    <a href="{{ asset('/storage/' . $jadwal->image) }}" data-fancybox="group"
                        data-caption="{{ $jadwal->caption }}">
                        <img src="{{ asset('/storage/' . $jadwal->image) }}" class="img-thumbnail" alt=""
                            style="border: none; border-radius: 20px">
                        <div class="card-img-top img overflow-hidden img-thumbnail"
                            style="z-index: 0; background-image: url({{ asset('/storage/' . $jadwal->image) }}); background-size: cover; background-position: center top;">
                        </div>
                    </a>
                </div>
                {{-- @endforeach --}}
                </p>
            </div>
        </div>
    </section>
    <!-- booking section ends -->

    <!-- review section starts  -->
    <section class="review pt-5 overflow-hidden bg-white" id="review">
        <h1 class="heading">Berita <span>Terbaru</span></h1>
        <div class="box-container mb-5 mt-3">
            <div class="row g-5 align-content-between justify-content-center">
                @foreach ($post->take($post->count() - 1) as $p)
                    <div class="col-lg-3 m-4">
                        @if ($p->is_embeded)
                            {!! $p->body !!}
                        @else
                            <a href="/posts/{{ $p->slug }}" class="text-decoration-none">
                                <div class="card img-parent overflow-hidden position-relative shadow"
                                    style=" outline: none; border: none;">
                                    <div class="card-header bg-white m-3"
                                        style="border: none; display: flex; align-items: center;">
                                        <img src="{{ asset('img/ig.jpg') }}" alt="Image"
                                            style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px; vertical-align: middle;">
                                        <div class="ml-3"
                                            style="display: flex; flex-direction: column; line-height: 1.2; font-size: 12px;">
                                            <strong class="mb-1">rslivasya</strong>
                                            <p class="mb-0">Majalengka</p>
                                        </div>
                                    </div>
                                    @if ($p->image)
                                        <div class="card-img-top overflow-hidden">
                                            <div
                                                style="background-image: url({{ asset('/storage/' . $p->image) }}); background-size: cover; height: 470px; background-position: center;">
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-img-top overflow-hidden">
                                            <div
                                                style="background-image: url(https://source.unsplash.com/random/900×700/?{{ $p->category->slug }}); background-size: cover; height: 470px;">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-body text-center" style="background-color: #fff; padding: 1rem;">
                                        <h5 class="card-title" style="font-size: 1.2rem; font-weight: bold;">
                                            {{ $p->title }}
                                        </h5>
                                        <div class="d-flex justify-content-start align-items-center mt-5"
                                            style="gap: 10px;">
                                            <span class="text-muted"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/1077/1077035.png"
                                                    width="24"></span>
                                            <span class="text-muted" style="opacity: 0.7;"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/5948/5948565.png"
                                                    width="24"></span>
                                            <span class="text-muted" style="opacity: 0.7; transform: rotate(-90deg)"><img
                                                    src="https://cdn-icons-png.flaticon.com/128/1286/1286853.png"
                                                    width="24"></span>
                                        </div>
                                        <p class="text-bold mt-2 text-left">99k likes</p>
                                    </div>
                                    <hr>
                                    <div class="add-comment" style="height: 30px; display: flex; align-items: center;">
                                        <h6 class="ml-3 text-muted">Add a comment...</h6>
                                        <img src="https://cdn-icons-png.flaticon.com/128/1384/1384031.png"
                                            class="mr-3 mb-3" alt="Instagram Icon"
                                            style="width: 24px; height: 24px; margin-left: auto;">
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-3">
                    <a href="/posts" class="btn mt-3 mb-5z d-block m-auto"> Lihat Selengkapnya <span
                            class="fas fa-chevron-right"></span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- review section ends -->

    <!-- youtube section starts -->
    <section class="youtube-section py-5 overflow-hidden" style="background: #f5f5f5;">
        <div class="container">
            <h1 class="heading">Video <span>Kami</span></h1>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="embed-responsive embed-responsive-16by9">
                        {!! $identity->youtube_link_video !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center align-items-center">
            <div class="col-lg-3">
                <a href="{{ $identity->youtube }}" target="_blank" class="btn mt-3 mb-5z d-block m-auto">
                    Lihat Selengkapnya <span class="fas fa-chevron-right"></span></a>
            </div>
        </div>
    </section>
    <!-- youtube section ends -->

    <!-- review section starts  -->
    <section class="review pt-5 overflow-hidden" style="background: #fff;" id="review">
        <h1 class="heading">Temukan <span>Kami</span></h1>
        <div class="box-container mb-5">
            <div class="row juctify-content-center">
                <div class="card" style="border: none; border-radius: 20px">
                    <div class="card-body">
                        <iframe class="w-100" style="height: 50rem; border: none; border-radius: 20px"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.0386969407605!2d108.17566195081062!3d-6.765136368012836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f29b82be5b779%3A0xfc24e001da3669f9!2sRSIA%20Livasya%20Majalengka!5e0!3m2!1sid!2sid!4v1667793553251!5m2!1sid!2sid style="
                            border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- review section ends -->
@endsection
