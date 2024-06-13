@php
    use App\Models\ImagePelayanan;
@endphp
@extends('layouts.main')

@section('container')
    <style>
        .hero-igd {
            background:
                linear-gradient(rgba(255, 255, 255, 0.50), rgba(255, 255, 255, 0.50)),
                url("{{ asset('/storage/' . $pelayananPage->header) }}");
            background-size: cover;
            background-position: center center;
            margin-top: 8rem;
            height: 40rem;
        }

        .list:hover {
            margin-left: 20px;
        }

        .aktif {
            margin-left: 20px;
        }

        @media only screen and (max-width: 600px) {
            .hero-igd {
                height: 30rem;
                background-position: left center;
            }
        }
    </style>

    <div class="hero-igd overflow-hidden"></div>

    <section class="title bg-primary overflow-hidden">
        <h1 class="fw-bold text-light" data-aos="fade-right" data-aos-anchor-placement="top-bottom">{{ $title }}
        </h1>
    </section>

    <section class="content bg-white overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                @foreach ($pelayanan as $p)
                    <a href="/pelayanan/{{ $p->slug }}" class="text-decoration-none ">
                        <div class="list p-4 my-3 {{ Request::is('pelayanan/' . $p->slug) ? 'aktif' : '' }}">
                            <span class="fas fa-chevron-right"></span> {{ $p->title }}
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="col-lg-6 mx-5 overflow-hidden">
                <div id="page">
                    <div class="row overflow-hidden">
                        <div class="column small-11 small-centered">
                            <div class="slider slider-single">
                                @foreach (ImagePelayanan::where('pelayanan_id', $pelayananPage->id)->get() as $item)
                                    <div>
                                        <img src="{{ asset('/storage/' . $item->thumbnail) }}"
                                            alt="{{ $pelayananPage->title }}" class="img-fluid img-thumbnail"
                                            style="filter: brightness(1); border-radius: 20px">
                                    </div>
                                @endforeach
                            </div>

                            <div class="slider slider-nav mt-3">
                                @foreach (ImagePelayanan::where('pelayanan_id', $pelayananPage->id)->get() as $item)
                                    <div>
                                        <img src="{{ asset('/storage/' . $item->image) }}" alt="IGD"
                                            class="img-fluid mx-3 img-thumbnail" style="border-radius: 20px">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text mt-5 overflow-hidden">
                {!! $pelayananPage->body !!}
            </div>
        </div>
    </section>
@endsection
