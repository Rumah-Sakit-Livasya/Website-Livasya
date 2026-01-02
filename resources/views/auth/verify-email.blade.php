@extends('layouts.main')

@section('container')
    <section class="verify-email-section py-5" style="min-height: 80vh; background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-body p-5 text-center">
                            <div class="mb-4">
                                <i class="fas fa-envelope-open-text text-primary" style="font-size: 4rem;"></i>
                            </div>

                            <h3 class="font-weight-bold text-dark mb-3">Verifikasi Email Anda</h3>

                            <div class="mb-4 text-muted">
                                {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan yang baru.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success mb-4" role="alert">
                                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
                                </div>
                            @endif

                            <div class="d-grid gap-2 mb-3">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        {{ __('Kirim Verifikasi Email') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4 text-muted">
                        <small>&copy; {{ date('Y') }} RSIA Livasya. All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
