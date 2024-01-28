@extends('layouts.main')

@section('container')
<div class="hero-jadwal-dokter"></div>

    <section class="title" style="background: var(--primary);">
        <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $title }}</h1>
    </section>

<section class="gallery bg-white" style="padding-top: 15rem">
    <div class="container">
        <div class="row justify-content-center g-5">
            <p class="imglist">
                @foreach($dokter as $d)
                    @if($d->poster_dokter && $d->poster_jadwal)
                        <div class="col-lg-3 h-100" style="border-radius: 16px;">
                            <a href="{{ asset('public/'. $d->poster_jadwal) }}"  data-fancybox="group" data-caption="{{ $d->nama_dokter }}">
                                <img src="{{ asset('public/' . $d->poster_dokter)}}" class="w-100 img" style="border-radius: 20px">                        
                            </a>
                        </div>
                    @endif
                @endforeach
            </p>
        </div>
    </div>
</section>
@endsection

