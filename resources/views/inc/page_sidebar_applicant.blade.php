@php
    use App\Models\Identity;
    $identity = Identity::first();
@endphp

<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        <img src="/img/logo.png" alt="{{ $identity->name ?? 'Livasya' }}" class="w-50" aria-roledescription="logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <span class="page-logo-text mr-1">{{ $identity->name ?? 'Livasya' }} <Applet></Applet></span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                    tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                    data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{ auth()->user()->profile_photo_url ?? '/img/demo/avatars/avatar-admin.png' }}"
                class="profile-image rounded-circle" alt="{{ auth()->user()->name }}">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ auth()->user()->name }}
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Pelamar</span>
            </div>
            <img src="/img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            <li class="{{ request()->routeIs('applicant.dashboard') ? 'active' : '' }}">
                <a href="{{ route('applicant.dashboard') }}" title="Dashboard" data-filter-tags="applicant dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="nav-link-text" data-i18n="nav.applicant_dashboard">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('applicant.profile.*') ? 'active' : '' }}">
                <a href="{{ route('applicant.profile.edit') }}" title="Profile" data-filter-tags="applicant profile">
                    <i class='bx bxs-user-detail'></i>
                    <span class="nav-link-text" data-i18n="nav.applicant_profile">Profile Saya</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('applicant.vacancies') ? 'active' : '' }}">
                <a href="{{ route('applicant.vacancies') }}" title="Lowongan Kerja"
                    data-filter-tags="applicant vacancies">
                    <i class='bx bxs-briefcase'></i>
                    <span class="nav-link-text" data-i18n="nav.applicant_vacancies">Lowongan Kerja</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ url('/') }}" title="Home" data-filter-tags="home website">
                    <i class='bx bxs-home'></i>
                    <span class="nav-link-text" data-i18n="nav.home">Ke Website Utama</span>
                </a>
            </li>
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
            class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
<!-- END Left Aside -->
