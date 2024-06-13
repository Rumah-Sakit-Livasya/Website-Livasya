@extends('layouts.main')

@section('container')
    <!-- doctors section starts  -->
    <div class="hero-dokter"></div>

    <section class="title" style="background: var(--primary);">
        <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $title }}</h1>
    </section>

    <section class="doctors pt-5 overflow-hidden bg-white" id="doctors">
        @foreach ($sortedDokters as $jabatan => $doktersGroup)
            @if ($doktersGroup->isNotEmpty())
                <h1 class="heading pt-5" style="font-size: 18pt"><span>{{ $jabatan }}</span></h1>
                <div class="box-container">
                    @foreach ($doktersGroup as $d)
                        <a href="/dokter/{{ $d->id }}" class="nav-link">
                            <div class="box p-5" data-aos="fade-up">
                                <img src="{{ asset('storage/' . $d->foto) }}" alt="">
                                <h4>{{ $d->name }}</h4>
                                <span style="color: #e97f0d">{{ $d->jabatan }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        @endforeach
    </section>
    <!-- doctors section ends -->
@endsection
