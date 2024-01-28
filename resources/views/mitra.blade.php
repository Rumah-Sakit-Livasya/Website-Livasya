@extends('layouts.main')

@section('container')
<section class="gallery bg-white" style="padding-top: 15rem">
    <h1 class="heading my-5"><span>Mitra Kami</span> </h1>
    <div class="container mt-5" style="margin-top: 8rem">
        <div class="row justify-content-center align-items-center g-5" style="margin-top: 8rem;">
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/admedika.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/owlexa.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/iziklaim.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/ykp.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/fullerton.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/bpjs.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
            </div>
        <div class="row justify-content-center align-items-center g-5">
            @for ($i = 1; $i <= 81; $i++)
                <div class="col-6 col-md-4 col-lg-2 mt-5">
                    <img src="/img/asuransi/{{ $i }}.webp" alt="Mitra Kami" class="img-thumbnail" style="border: none; box-shadow: none; outline: none">
                </div>
            @endfor
        </div>
    </div>
</section>
@endsection

