@extends('layouts.main')

@section('container')
    <section class="gallery bg-white" style="padding-top: 15rem">
        <h1 class="heading my-5"><span>Mitra Kami</span> </h1>
        <div class="container mt-5" style="margin-top: 8rem">
            <div class="row justify-content-center align-items-center g-5">
                @foreach ($mitraPage as $mitra)
                    <div class="col-6 col-md-4 col-lg-2 mt-5">
                        <img src="{{ asset('storage/' . $mitra->image) }}" alt="{{ $mitra->name }}" class="img-thumbnail"
                            style="border: none; box-shadow: none; outline: none">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
