@extends('layouts.main')

@section('title', 'Login Pelamar')
@section('container')
    <section class="login-section py-5" style="min-height: 80vh; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-white border-0 text-center pt-4 pb-0">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo RSIA Livasya" style="width: 80px;" class="mb-3">
                            <h3 class="font-weight-bold text-dark">Login Pelamar</h3>
                            <p class="text-muted">Portal Karir RSIA Livasya</p>
                        </div>
                        <div class="card-body p-5">
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Username -->
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label font-weight-bold">Username</label>
                                    <input id="username" type="text"
                                        class="form-control form-control-lg @error('username') is-invalid @enderror"
                                        name="username" value="{{ old('username') }}" required autofocus
                                        autocomplete="username" placeholder="Masukkan username anda">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label font-weight-bold">Password</label>
                                    <input id="password" type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password"
                                        placeholder="Masukkan password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Captcha -->
                                <div class="form-group mb-4">
                                    <label for="captcha" class="form-label font-weight-bold">Keamanan</label>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="captcha-image border rounded mr-2 overflow-hidden">
                                            {!! captcha_img('flat') !!}
                                        </div>
                                        <button type="button" class="btn btn-light border" onclick="reloadCaptcha()"
                                            title="Reload Captcha">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                    <input id="captcha" type="text"
                                        class="form-control @error('captcha') is-invalid @enderror" name="captcha" required
                                        placeholder="Masukkan kode captcha di atas">
                                    @error('captcha')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group form-check mb-4">
                                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                    <label class="form-check-label" for="remember_me">Ingat Saya</label>
                                </div>

                                <!-- Buttons -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block"
                                        style="background-color: #0d6efd; border-color: #0d6efd;">
                                        Masuk Sekarang
                                    </button>
                                </div>

                                <div class="text-center my-3">
                                    <span class="text-muted">Atau masuk dengan</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="{{ route('auth.google') }}"
                                        class="btn btn-outline-danger btn-block d-flex align-items-center justify-content-center">
                                        <i class="fab fa-google mr-2"></i> Google
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="text-center mt-4 text-muted">
                        <small>&copy; {{ date('Y') }} RSIA Livasya. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function reloadCaptcha() {
            let img = document.querySelector('.captcha-image img');
            img.src = '/captcha/flat?' + Math.random();
        }
    </script>
@endsection
