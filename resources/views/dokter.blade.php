@extends('layouts.main')

@section('container')
    <!-- doctors section starts  -->
    <div class="hero-dokter"></div>
    <section class="title" style="background: var(--primary);">
        <h1 class="fw-bold text-light text-right" data-aos="fade-left" data-aos-anchor-placement="top-bottom">Profil
            {{ $title }}
        </h1>
    </section>

    <section class="main bg-white">
        <div class="row mt-5">
            <div class="col-lg-2">
                <img src="{{ asset('storage/' . $dokter->foto) }}" class="img-fluid" style="width: 20rem"
                    alt="{{ $dokter->name }}">
            </div>
            <div class="col-lg-3">
                <div class="row align-items-center h-100">
                    <div class="col">
                        <p class="fw-bold">{{ $dokter->name }}</p>
                        <p>{{ $dokter->jabatan }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    {!! $dokter->deskripsi !!}
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center g-5">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <a href="{{ asset('storage/' . $dokter->poster) }}" data-fancybox="gallery"
                        data-caption="{{ $dokter->name }}">
                        <img src="{{ asset('storage/' . $dokter->poster) }}" class="img-fluid"
                            style="border-radius: 20px; height: 100%;" alt="{{ $dokter->name }}">
                    </a>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <a href="{{ asset('storage/' . $dokter->jadwal) }}" data-fancybox="gallery"
                        data-caption="{{ $dokter->name }}">
                        <img src="{{ asset('storage/' . $dokter->jadwal) }}" class="img-fluid"
                            style="border-radius: 20px; height: 100%;" alt="{{ $dokter->name }}">
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
