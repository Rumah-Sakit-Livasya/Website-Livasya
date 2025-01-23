@section('css')
    <style>
        @media (max-width: 576px) {

            .topbar .nav-link,
            .topbar .btn {
                font-size: 11px;
                /* Adjust font size for smaller screens */
                padding: 3px 5px;
                /* Adjust padding for smaller screens */
            }
        }
    </style>
@endsection
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<div class="topbar d-flex align-items-center"
    style="background-color: #f8f9fa; padding: 5px 0; position: fixed; width: 100%; top: 0; z-index: 99999; transition: top 0.3s; white-space: nowrap;">
    <div class="container d-flex justify-content-between">
        <div class="d-flex justify-content-between w-100 g-5">
            <div class="left-group d-flex align-items-center" style="letter-spacing: 1px;">
                <a class="nav-link d-flex align-items-center me-5" href="javascript:void(0)"> <i
                        class="fas fa-phone me-1 text-primary"></i>
                    {{ $identity->no_telp }} </a>
                <a class="nav-link d-flex align-items-center me-5" href="https://wa.me/{{ $identity->no_hp }}"> <i
                        class="fab fa-whatsapp me-1 text-primary"></i>
                    {{ $identity->no_hp }} </a>
                <button class="btn btn-secondary d-flex align-items-center"
                    style="border-radius: 20px; padding: 5px 10px;" onclick="location.href='/dokter'"> <i
                        class="fas fa-user-md"></i>
                    <span class="me-2 p-0">Cari Dokter</span> </button>
            </div>
            <div class="right-group d-flex align-items-center">
                <a class="nav-link me-5 text-primary" href="{{ $identity->facebook }}"> <i
                        class="fab fa-facebook-f"></i></a>
                <a class="nav-link me-5 text-primary" href="{{ $identity->twitter }}"> <i
                        class="fab fa-twitter"></i></a>
                <a class="nav-link me-5 text-primary" href="{{ $identity->instagram }}/"> <i
                        class="fab fa-instagram"></i></a>
                <a class="nav-link text-primary" href="{{ $identity->youtube }}"> <i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>
<nav class="navbar header navbar-expand-lg bg-white" style="border: none; margin-top: 4.5rem">
    <div class="container mx-3" style="font-family: Montserrat ">
        <a href="/" class="logo nav-link p-3"> <img src="/img/logo.png" width="40" alt="">
        </a>
        <a href="/" class="nav-link fw-bold"> {{ $identity->name }}</a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto justify-content-end" id="navbarNavAltMarkup" style="border: none;">
            <div class="navbar-nav ">
                <a class="nav-link" href="/">Beranda</a>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Pelayanan
                    </a>
                    <ul class="dropdown-menu p-4 border-top shadow"
                        style="border:none;border:none; border-radius:15px;">
                        @foreach ($pelayanan as $p)
                            <li>
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/pelayanan/{{ $p->slug }}">{{ $p->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/#services" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Cari Dokter
                    </a>
                    <div class="dropdown-menu p-4 border-top shadow " style="border:none; border-radius:15px;">
                        <div class="row">
                            <div class="col">
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/dokter">Dokter</a>
                                {{-- <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/jadwal-dokter">Jadwal Dokter</a> --}}
                            </div>
                        </div>
                    </div>
                </li>
                {{-- <a class="nav-link" href="/posts">Berita & Acara</a> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Berita
                    </a>
                    <div class="dropdown-menu p-4 border-top shadow " style="border:none; border-radius:15px;">
                        <div class="row">
                            <div class="col" style="white-space: nowrap">
                                <a class="nav-link" href="/categories">Kategori Berita</a>
                                <a class="nav-link" href="/posts">Berita</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/#services" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Fasilitas
                    </a>
                    <div class="dropdown-menu p-4 border-top shadow " style="border:none; border-radius:15px;">
                        <div class="row">
                            <div class="col" style="white-space: nowrap">
                                <a class="nav-link" href="/fasilitas-unggulan">Fasilitas Unggulan</a>
                                <a class="nav-link" href="/fasilitas-lainnya">Fasilitas Lainnya</a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/#services" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ $identity->shortname }}
                    </a>
                    <div class="dropdown-menu p-4 border-top shadow " style="border:none; border-radius:15px;">
                        <div class="row">
                            <div class="col">
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/about-us">Tentang Kami</a>
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/gallery">Galeri</a>
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/mitra-kami">Mitra Kami</a>
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/faq">FAQ</a>
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/syarat-ketentuan">Syarat & Ketentuan</a>
                                <a class="dropdown-item fs-4" style="margin: 0; border-radius:10px;"
                                    href="/kebijakan-privasi">Kebijakan Privasi</a>
                            </div>
                        </div>
                    </div>
                </li>
                <a class="nav-link" href="/career">Karir</a>
                @auth
                    <li class="nav-link dropdown p-0">
                        <a class="nav-link dropdown-toggle" href="javasript:void(0)" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item fs-3" style="margin: 0;" href="/dashboard">Dashboard</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item fs-3">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </div>
        </div>
    </div>
</nav>
@section('plugin')
    <script>
        const topbar = document.querySelector('.topbar');
        const navbar = document.querySelector('.navbar'); // Assuming the navbar has a class of 'navbar'

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > 250) {
                topbar.style.top = "-100px"; // Hide the topbar
                navbar.style.marginTop = "0"; // Set margin-top to 0 when topbar is hidden
            } else {
                topbar.style.top = "0"; // Show the topbar
                navbar.style.marginTop = "4.5rem"; // Set margin-top to 3rem when topbar is visible
            }
        });

        // Remove 'me-5' class for mobile devices
        function adjustNavLinks() {
            const navLinks = document.querySelectorAll('.left-group .nav-link, .right-group .nav-link');
            if (window.innerWidth <= 576) {
                navLinks.forEach(link => {
                    link.classList.remove('me-5');
                });
            } else {
                navLinks.forEach(link => {
                    link.classList.add('me-5');
                });
            }
        }

        // Initial adjustment
        adjustNavLinks();

        // Adjust on window resize
        window.addEventListener('resize', adjustNavLinks);
    </script>
@endsection
