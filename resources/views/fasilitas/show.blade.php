@extends('layouts.main')

@section('container')
    <style>
        .bg-white,
        .bg-white>a {
            color: unset !important;
        }
    </style>
    <div class="bg-white">

        <span></span>
        <section class="title bg-primary mb-3" style="margin-top: 8rem;">
            <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $facility->name }}
            </h1>
        </section>
        <div class="container bg-white" padding-bottom: 5rem;">
            <div class="mb-3 row">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card" style="border: none; border-radius: 20px">
                            <div class="card-body">
                                @if ($facility->image)
                                    <img src="{{ asset('storage/' . $facility->image) }}" class="img-fluid"
                                        alt="{{ $facility->gambar }}" style="border: none; border-radius: 20px">
                                @else
                                    <img src="https://source.unsplash.com/400x200/?{{ $facility->name }}" class="img-fluid"
                                        alt="{{ $facility->image }}" style="border: none; border-radius: 20px">
                                @endif
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-center">
                                    <div class="col fs-5 text-center">
                                        <i class="fas fa-calendar"></i> {{ $facility->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <h5 class="card-title fs-3 fw-bold">{{ $facility->name }}</h5>
            </div>
            <div class="row">
                <span class="card-text container fs-4 text-justify">
                    {!! $facility->body !!}
                </span>
            </div>
            <a href="/fasilitas-unggulan" class="text-decoration-none my-5 d-inline-block">
                <span class="fas fa-chevron-left"></span>
                Kembali ke halaman fasilitas
            </a>
        </div>
    </div>
@endsection
