@extends('layouts.main')
@section('container')
<link href="signin.css" rel="stylesheet">
<div class="home container">
    <main class="form-signin w-100 m-auto mb-5">
        <div class="row justify-content-center">
            <div class="col-10 col-lg-6">
                <form action="/bukan-register" method="POST" class="mb-5" autocomplete="off">
                    @csrf
                    <div class="row justify-content-center">
                        <img class="mb-4 w-25" src="../img/logo.png" alt="">
                        <h1 class="h3 mb-3 fs-1 fw-normal text-center" style="transform: scale(1.99)"><strong>Register</strong></h1>
                    </div>
                    
                    <div class="form-floating mt-5 mb-3">
                        <input type="text" required value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Dimas Kasep">
                        <label for="name" class="fs-5">Nama Lengkap</label>
                        @error('name')
                            <div class="text-danger ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" required value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Dimas Kasep">
                        <label for="username" class="fs-5">Username</label>
                        @error('username')
                            <div class="text-danger ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="email" required value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Dimas Kasep">
                        <label for="email" class="fs-5">Alamat Email</label>
                        @error('email')
                            <div class="text-danger ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-floating mb-5">
                        <input type="password" required value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                        <label for="password" class="fs-5">Password</label>
                        @error('password')
                            <div class="text-danger ms-3">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button class="w-100 btn btn-lg" type="submit">Register</button>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection
