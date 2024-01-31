@php
    use App\Models\Career;
@endphp
@extends('layouts.main')

@section('container')
    <section class="gallery bg-white" style="padding-top: 15rem">
        <h1 class="heading my-5"><span>{{ $title }}</span> </h1>

        <div class="container">
            <div class="accordion" id="accordionExample">
                @foreach (Career::where('status', 'on')->where('tipe', $tipe)->get() as $career)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $career->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $career->id }}" aria-expanded="true"
                                aria-controls="collapse{{ $career->id }}">
                                {{ $career->title }}
                            </button>
                        </h2>
                        <div id="collapse{{ $career->id }}" class="accordion-collapse collapse"
                            aria-labelledby="heading{{ $career->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $career->deskripsi !!}
                                <a href="/career/{{ $tipe }}/{{ $career->id }}" class="btn btn-primary">Lamar
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
