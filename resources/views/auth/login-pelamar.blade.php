@extends('layouts.main')

@section('title', 'Login Pelamar')
@section('container')
    <section class="login-section py-5" style="min-height: 80vh; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-white border-0 text-center pt-4 pb-0">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo Rumah Sakit Livasya" style="width: 80px;" class="mb-3">
                            <h3 class="font-weight-bold text-dark">Login Pelamar</h3>
                            <p class="text-muted">Portal Karir Rumah Sakit Livasya</p>
                        </div>
                        <div class="card-body p-5">
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4 alert alert-info" :status="session('status')" />

                            <!-- Terms Checkbox -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreeTerms">
                                <label class="form-check-label text-muted small" for="agreeTerms">
                                    Saya menyetujui <a href="{{ url('/syarat-ketentuan') }}" target="_blank"
                                        class="text-decoration-none">Syarat & Ketentuan</a> dan <a
                                        href="{{ url('/kebijakan-privasi') }}" target="_blank"
                                        class="text-decoration-none">Kebijakan Privasi</a>.
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('auth.google') }}" id="googleLoginBtn"
                                    class="btn btn-danger btn-lg btn-block d-flex align-items-center justify-content-center disabled"
                                    aria-disabled="true" tabindex="-1">
                                    <i class="fab fa-google mr-2"></i> Masuk dengan Google
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="text-center mt-4 text-muted">
                        <small>&copy; {{ date('Y') }} Rumah Sakit Livasya. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/login-pelamar.js') }}"></script>
    <script>
        // Fallback for any other inline scripts or if immediate execution is needed for variables passed from PHP
    </script>
@endsection
