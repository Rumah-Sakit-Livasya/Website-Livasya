<!-- footer section starts  -->

<section class="footer" style="background: rgba(255, 255, 255, 0.9)" id="services">


    <div class="box-container mt-5">
        <div class="box">
            <img src="/img/logofooter.png" width="150px" alt="" class="mb-5">
            <p>{{ $identity->alamat }}</p>
            <div class="col">
                <a class="nav-link" href="{{ $identity->facebook }}"> <i class="fab fa-facebook-f"></i> Facebook </a>
                <a class="nav-link" href="{{ $identity->twitter }}"> <i class="fab fa-twitter"></i> Twitter </a>
                <a class="nav-link" href="{{ $identity->instagram }}/"> <i class="fab fa-instagram"></i> Instagram </a>
                <a class="nav-link" href="{{ $identity->youtube }}"> <i class="fab fa-youtube"></i> Youtube </a>
            </div>
        </div>
        <div class="box">
            <h3 class="fw-bold ">Hubungi Kami</h3>
            <a class="nav-link" href="https://wa.me/{{ $identity->no_hp }}"> <i class="fab fa-whatsapp"></i>
                +{{ $identity->no_hp }} </a>
            <span class="nav-link"> <i class="fas fa-phone"></i> {{ $identity->no_telp }} </span>
            <a class="nav-link" href="mailto:{{ $identity->email }}"> <i class="fas fa-envelope"></i>
                {{ $identity->email }} </a>
        </div>
        <div class="box">
            <h3 class="fw-bold">Mitra Kami</h3>
            <div class="row justify-content-center align-items-center">
                @foreach ($mitras as $mitra)
                    <div class="col-3 col-lg-4">
                        <img src="{{ asset('storage/' . $mitra->image) }}" alt="{{ $mitra->name }}"
                            class="img-thumbnail" style="background: none; border: none; box-shadow: none">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="credit">&copy; {{ date('Y') }} created by <a href="https://www.instagram.com/dmscndraa/"
            class="text-decoration-none"><span>Team
                IT Livasya</span></a> | all
        rights reserved
        @guest
            <a style="margin-left: -6px" href="/bukan-login" class="text-decoration-none text-black-50">.</a>
        @endguest
    </div>
</section>
<!-- footer section ends -->
