@extends('layouts.main')

@section('container')
    <section></section>
    <section class="blogs my-5" style="padding-top: 7rem" id="blogs">
        <h1 class="heading mb-5" style="font-size: 3rem">Kategori</h1>
        <div class="box-container container-fluid">
            <div class="row row-cols-lg-3 g-5 justify-content-center">
                <div class="box m-3" style="max-width: 45rem">
                    @foreach ($categories as $category)
                        <ul>
                            <li><a class="nav-link fs-3" href="/categories/{{ $category->slug }}">{{ $category->name }}</a>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
