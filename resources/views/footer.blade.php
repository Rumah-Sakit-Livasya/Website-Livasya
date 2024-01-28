<!-- footer section starts  -->

<section class="footer" style="background: rgba(255, 255, 255, 0.9)">

    <div class="box-container">
        <div class="box">
            <h3 class="fw-bold">Hubungi Kami</h3>
            <a class="nav-link" href="https://wa.me/{{ $about->no_hp }}"> <i class="fas fa-phone"></i>
                +{{ $about->no_hp }}</a>
            <a class="nav-link" href="javascript:void(0)"> <i class="fas fa-phone"></i> {{ $about->no_telp }} </a>
            <a class="nav-link" href="mailto:{{ $about->email }}"> <i class="fas fa-envelope"></i>
                {{ $about->email }} </a>
            <a class="nav-link" href="javascript:void(0)"> <i class="fas fa-map-marker-alt"></i>
                {{ $about->alamat }}</a>
        </div>

        <div class="box">
            <h3 class="fw-bold">Ikuti Kami</h3>
            <a class="nav-link" href="{{ $about->facebook }}"> <i class="fab fa-facebook-f"></i> Facebook </a>
            <a class="nav-link" href="{{ $about->twitter }}"> <i class="fab fa-twitter"></i> Twitter </a>
            <a class="nav-link" href="{{ $about->instagram }}/"> <i class="fab fa-instagram"></i> Instagram </a>
            <a class="nav-link" href="{{ $about->youtube }}"> <i class="fab fa-youtube"></i> Youtube </a>
        </div>

    </div>

    <div class="credit"> created by <span>Team IT Livasya</span> | all rights reserved
        @guest
            <a style="margin-left: -6px" href="/bukan-login" class="text-decoration-none text-black-50">.</a>
        @endguest
    </div>

</section>
<!-- footer section ends -->
