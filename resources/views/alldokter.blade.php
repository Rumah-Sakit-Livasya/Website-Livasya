@extends('layouts.main')

@section('container')
    <!-- doctors section starts  -->
    <div class="hero-dokter"></div>

    <section class="title" style="background: var(--primary);">
        <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $title }}</h1>
    </section>

    <section class="doctors pt-5 overflow-hidden bg-white" id="doctors">
        @php
            $currentDepartment = null;
            $isFirstDepartment = true;
        @endphp
        @foreach ($dokters as $dokter)
            @if ($currentDepartment != $dokter->departement->id)
                @if (!$isFirstDepartment)
                    </div> <!-- Close previous department's row -->
                    </div> <!-- Close previous department's container -->
                @endif
                @php
                    $currentDepartment = $dokter->departement->id;
                    $isFirstDepartment = false;
                @endphp
                <div class="container mb-5">
                    <h1 class="heading pt-5" style="font-size: 18pt; text-align: left">
                        <span>Dokter {{ $dokter->departement->name }}</span>
                    </h1>
                    <div class="row">
            @endif
            <div class="col-md-4 mb-4">
                <a href="/dokter/{{ $dokter->id }}" class="nav-link">
                    <div class="box p-5" data-aos="fade-up">
                        <img src="{{ asset('storage/' . $dokter->foto) }}" alt="">
                        <h4>{{ $dokter->name }}</h4>
                        <span style="color: #e97f0d">{{ $dokter->jabatan }}</span>
                    </div>
                </a>
            </div>
        @endforeach
        @if ($currentDepartment != null)
            </div> <!-- Close last department's row -->
            </div> <!-- Close last department's container -->
        @endif
    </section>



    <!-- doctors section ends -->
@endsection
