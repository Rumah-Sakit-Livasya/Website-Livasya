@extends('layouts.main')

@section('container')
    <style>
        .page_banner_content {
            background-color: #006CBF;
            background-size: auto 100%;
            background-position: left center;
            background-repeat: no-repeat;
            --banner-overlay-color: rgba(62, 150, 108, 0.71);
        }

        .dropcap {
            float: left;
            margin-right: 5px;
            font-size: 3em;
            vertical-align: text-top;
        }
    </style>

    {{-- <section style="margin-top: 40rem; padding: 0;" class="w-100 bg-white ">
        <div class="page_banner_content w-100 overlay position-relative"
            style="height: 15rem; background-image: url(//rssansani.co.id/wp-content/uploads/2019/09/about-breadcrumb-bg.png);; --banner-overlay-color: rgba(62,150,108,0.71); --banner-breadcumb-color: #3e966c">
            <div class="d-lg-flex justify-content-between">
                <h1 class="page_banner_title text-white w-100"
                    style="line-height: 15rem; padding-left: 10rem; background: rgba(34, 44, 184, 0.5);">Tentang Kami</h1>
            </div>
        </div>
    </section> --}}

    <section id="about" class="overflow-hidden bg-white">
        @include('about.timeline')
        

        <div class="row blur " >
            <h2>Visi Misi dan Motto RS Livasya</h2>
            <div class="col-lg-4 blur1" >
                <div class="shadow card" style="height: 35rem; border:none; border-radius:20px;">
                    <div class="card-header fw-bold text-center">Visi</div>
                    <div class="card-body align-items-center">
                        <div class="row align-items-center h-100">
                            <p class="text-center">
                                Menjadi Rumah Sakit terpercaya dan diandalkan oleh masyarakat yang berorientasi pada kepuasan dan
                                keselamatan pasien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 blur1" >
                <div class="shadow card" style="height: 35rem; border:none; border-radius:20px;">
                    <div class="card-header fw-bold text-center">Misi</div>
                    <div class="card-body align-items-center">
                        <div class="row align-items-center h-100">
                            <p class="px-5">
                                <strong>Sumber daya manusia:</strong> <br>
                                Menciptakan sumber daya manusia yang berkualitas dan profesional serta memiliki rasa
                                empati yang tinggi terhadap pasien dan lingkungan sekitar.
                            </p>
                            <p class="px-5">
                                <strong>Sarana Prasarana:</strong> <br>
                                Mengembagkan sarana prasarana yang memadai guna menunjang pelayanan prima dan keselamatan
                                pasien
                                rumah sakit
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 blur1">
                <div class="shadow card" style="height: 35rem; border:none; border-radius:20px;">
                    <div class="card-header fw-bold text-center">Motto</div>
                    <div class="card-body">
                        <div class="row align-items-center h-100">
                            <figure class="p-5">
                                <blockquote class="blockquote">
                                    <p class="h3"><span class="dropcap">"</span>Melayani Sepenuh Hati, Kepuasan Anda
                                        adalah
                                        Prioritas Kami.</p>
                                </blockquote>
                                <figcaption class="blockquote-footer mt-3">
                                    Owner RS Livasya
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
