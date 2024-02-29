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
            text-align: right !important;
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
                            class="d-block m-auto img-fluid m-auto p-5 rounded-circle" alt="">
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
                            <a href="https://dafol.livasya.id" target="_blank" class="btn mt-3"> Daftar Sekarang <span
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
                            <li class="splide__slide">
                                <div class="card mx-3 border-0 " style="border-radius:20px;">
                                    <div class="card-body mt-4 text-center">
                                        <img src="/img/doctorpoli.webp" alt="" width="50">
                                        <p class="fs-3 mt-3 text fw-bold" style="color: #e97f0d;">Poli Umum</p>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="card mx-3 border-0 " style="border-radius:20px;">
                                    <div class="card-body mt-4 text-center">
                                        <img src="/img/pediatrics.webp" alt="" width="50">
                                        <p class="fs-3 mt-3 text fw-bold" style="color: #e97f0d;">Poli Anak</p>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="card mx-3 border-0 " style="border-radius:20px;">
                                    <div class="card-body mt-4 text-center">
                                        <img src="/img/surgery.webp" alt="" width="50">
                                        <p class="fs-3 mt-3 text fw-bold" style="color: #e97f0d;">Poli Bedah</p>
                                    </div>
                                </div>
                            </li>
                            <li class="splide__slide">
                                <div class="card mx-3 border-0 " style="border-radius:20px;">
                                    <div class="card-body mt-4 text-center">
                                        <img src="/img/newborn.webp" width="50" alt="">
                                        <p class="fs-3 mt-3 text fw-bold" style="color: #e97f0d;">Poli Obgyn</p>
                                    </div>
                                </div>
                            </li>
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
                @foreach ($post as $p)
                    @php
                        $date = substr($p->created_at, 0, 10);
                        $date_convert = date_create($date);
                        $tanggal = date_format($date_convert, 'd');
                        $bulan = date_format($date_convert, 'M');
                    @endphp
                    <div class="col-lg-3">
                        <a href="/posts/{{ $p->slug }}" class="text-decoration-none">
                            <div class="card img-parent overflow-hidden position-relative shadow"
                                style="border-radius: 5px; outline: none; border: none; border-radius: 20px; transform: scale(.95);">
                                @if ($p->image)
                                    <div class="card-img-top img overflow-hidden"
                                        style="z-index: 0; background-image: url({{ asset('/storage/' . $p->image) }}); background-size: cover; height: 300px; background-position: center;">
                                    </div>
                                @else
                                    <div class="card-img-top img overflow-hidden"
                                        style="z-index: 0; background-image: url(https://source.unsplash.com/random/900×700/?{{ $p->category->slug }}); background-size: cover; height: 25rem;">
                                    </div>
                                @endif
                                <div class="position-absolute"
                                    style="z-index: 3; left: 0; top: 60%; width: 5rem; height: 7rem; background-color: rgba(0, 108, 191, .5);">
                                    <h3 class="text-center text-white mt-3">{{ $tanggal }} <br>
                                        {{ $bulan }}</h3>
                                </div>
                                <div class="card-body text-center"
                                    style="z-index: 2; height: 8rem; line-height: 6rem; background-color: #fff;">
                                    <p class="card-text" style="font-size: 11pt"><i class="far fa-folder-open"
                                            style="color:#0d6efd;"></i> {{ $p->category->name }}</p>
                                </div>
                            </div>
                        </a>
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

    <!-- review section starts  -->
    <section class="review pt-5 overflow-hidden" style="background: #f5f5f5;" id="review">
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

    <script>
        // Mengambil elemen <div> dalam paragraf
        var divElement = document.querySelector('#tex div');

        // Menambahkan atribut data-aos dengan nilai "fade-right" ke elemen <div>
        divElement.setAttribute('data-aos', 'fade-right');
    </script>
@endsection
