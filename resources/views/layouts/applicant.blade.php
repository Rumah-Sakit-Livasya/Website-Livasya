<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Pelamar - RSIA Livasya</title>

    <!-- CSS Links (Same as main layout) -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <style>
        .applicant-navbar {
            background-color: #343a40;
            /* Dark grey/black */
            padding: 0.5rem 1rem;
        }

        .applicant-navbar .navbar-brand {
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .applicant-navbar .nav-link {
            color: #d1d1d1;
            padding: 0.5rem 1rem;
        }

        .applicant-navbar .nav-link:hover,
        .applicant-navbar .nav-link.active {
            color: #ffffff;
            background-color: #495057;
            border-radius: 0.25rem;
        }

        .top-brand-bar {
            background-color: #e9ecef;
            padding: 5px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .program-badge {
            background-color: #ffc107;
            color: #000;
            padding: 2px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .content-wrapper {
            background-color: #f4f6f9;
            min-height: 100vh;
            padding: 20px;
        }

        .card-custom {
            box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
            border-radius: 0.25rem;
            background: #fff;
            margin-bottom: 20px;
        }

        .card-header-custom {
            background-color: #558b9e;
            /* Muted blue/teal from image */
            color: #fff;
            padding: 10px 15px;
            font-weight: bold;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .profile-img-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #dee2e6;
        }

        .nav-tabs-custom .nav-link {
            color: #495057;
        }

        .nav-tabs-custom .nav-link.active {
            font-weight: bold;
            border-top: 3px solid #007bff;
        }

        .action-btn-group .btn {
            margin-right: 5px;
            font-size: 0.85rem;
        }
    </style>
</head>

<body class="layout-top-nav">
    <div class="wrapper">
        <!-- Top Brand Bar -->
        <div class="top-brand-bar">
            <div class="d-flex align-items-center">
                <img src="/img/logo.png" alt="Logo" style="height: 30px; margin-right: 10px;">
                <small class="text-muted mr-2">AKSES PROGRAM:</small>
                <span class="program-badge">PELAMAR</span>
            </div>
            <div>
                <!-- User dropdown or icons could go here -->
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md applicant-navbar">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('applicant.dashboard') }}">
                                <i class="fas fa-home mr-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-user mr-1"></i> Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-briefcase mr-1"></i> Lowongan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-question-circle mr-1"></i> Help
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-tools mr-1"></i> Tools
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-left"
                                    style="background: none; border: none;">
                                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- Breadcrumbs could be here -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left" style="background: none; padding: 0;">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Profil</li>
                            </ol>
                        </div>
                    </div>

                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center">
            <strong>&copy; {{ date('Y') }} RSIA Livasya.</strong> All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/adminlte.js"></script>
    @yield('scripts')
</body>

</html>
