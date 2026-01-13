<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard Pelamar' }} - RSIA Livasya</title>
    <meta name="author" content="RSIA Livasya">
    <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .navbar-light {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .08);
            border-bottom: 3px solid #00a65a;
            /* Livasya Green Accent */
        }

        .navbar-brand {
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-nav .nav-link {
            color: #555;
            font-weight: 500;
            padding: 0.8rem 1rem;
            transition: all 0.2s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #00a65a;
            background-color: rgba(0, 166, 90, 0.05);
            /* Soft green background */
            border-radius: 5px;
        }

        div.dropdown-menu {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .content-header {
            padding: 20px 0;
        }

        .content-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
        }

        .program-badge {
            background-color: #ffc107;
            color: #212529;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            vertical-align: middle;
            margin-left: 10px;
        }

        /* Custom Card Style for Content */
        .card-custom {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        /* Footer */
        .main-footer {
            background: #fff;
            border-top: 1px solid #dee2e6;
            color: #869099;
            padding: 1rem;
        }
    </style>
    @yield('styles')
</head>

<body class="layout-top-nav" style="height: auto; min-height: 100%;">
    <div class="wrapper">

        <!-- Navbar (Legacy Style: Dark & Icon-based) -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="border-bottom: 3px solid #f39c12;">
            <div class="container-fluid">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <img src="/img/logo.png" alt="RSIA Livasya Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">RSIA LIVASYA</span>
                    <small class="badge badge-warning ml-2" style="font-size: 0.6rem;">PELAMAR</small>
                </a>

                <button class="navbar-toggler order-1" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ route('applicant.dashboard') }}"
                                class="nav-link text-center {{ request()->routeIs('applicant.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home d-block mb-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applicant.profile.create') }}"
                                class="nav-link text-center {{ request()->routeIs('applicant.profile.*') ? 'active' : '' }}">
                                <i class="fas fa-user d-block mb-1"></i> Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/career') }}" class="nav-link text-center">
                                <i class="fas fa-briefcase d-block mb-1"></i> Lowongan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-center">
                                <i class="fas fa-question-circle d-block mb-1"></i> Help
                            </a>
                        </li>
                    </ul>

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-center" data-toggle="dropdown" href="#">
                                <i class="fas fa-cogs d-block mb-1"></i> Tools
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="#" class="dropdown-item" id="darkModeToggle">
                                    <i class="fas fa-moon mr-2"></i> Dark Mode
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-center text-white">
                                    <i class="fas fa-sign-out-alt d-block mb-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sub Header -->
        <div class="bg-light border-bottom py-2 shadow-sm">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 text-dark"><i class="fas fa-home mr-1"></i> {{ $title ?? 'Program Pelamar Online' }}
                    </h6>
                    <ol class="breadcrumb m-0 p-0" style="background: transparent;">
                        <li class="breadcrumb-item"><a href="{{ route('applicant.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title ?? 'Dashboard' }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> @yield('header', $title ?? 'Dashboard') </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('applicant.dashboard') }}">Pelamar</a>
                                </li>
                                @if (isset($title))
                                    <li class="breadcrumb-item active">{{ $title }}</li>
                                @endif
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="container text-center">
                <strong>Copyright &copy; {{ date('Y') }} <a href="https://rsialivasya.com">RSIA
                        Livasya</a>.</strong> All rights reserved.
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/adminlte.js"></script>
    @yield('scripts')

    <script>
        $(document).ready(function() {
            var toggleSwitch = $('#darkModeToggle');
            var icon = toggleSwitch.find('i');
            var body = $('body');
            var navbar = $('.navbar');

            // Function to enable dark mode
            function enableDarkMode() {
                body.addClass('dark-mode');
                navbar.removeClass('navbar-light').addClass('navbar-dark');
                icon.removeClass('fa-moon').addClass('fa-sun');
                localStorage.setItem('theme', 'dark');
            }

            // Function to disable dark mode
            function disableDarkMode() {
                body.removeClass('dark-mode');
                navbar.addClass('navbar-light').removeClass('navbar-dark');
                icon.removeClass('fa-sun').addClass('fa-moon');
                localStorage.setItem('theme', 'light');
            }

            // Check local storage on load
            if (localStorage.getItem('theme') === 'dark') {
                enableDarkMode();
            }

            // Toggle click event
            toggleSwitch.on('click', function(e) {
                e.preventDefault();
                if (body.hasClass('dark-mode')) {
                    disableDarkMode();
                } else {
                    enableDarkMode();
                }
            });
        });
    </script>
</body>

</html>
