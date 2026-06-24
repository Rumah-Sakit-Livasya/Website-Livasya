<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('inc.header')
    <style nonce="{{ $nonce }}">
        /* Premium Card & Layout Upgrades */
        .premium-card {
            border: none !important;
            border-radius: 16px !important;
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(149, 157, 165, 0.08) !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            position: relative;
            overflow: hidden;
        }

        .premium-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(149, 157, 165, 0.16) !important;
        }

        /* Accent bar left and top */
        .premium-card-accent-left {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
        }

        .premium-card-accent-top {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 6px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        /* Soft Gradients */
        .accent-success { background: linear-gradient(180deg, #1dc9b7 0%, #00a65a 100%) !important; }
        .accent-primary { background: linear-gradient(180deg, #37a2ff 0%, #0056b3 100%) !important; }
        .accent-warning { background: linear-gradient(180deg, #ffb822 0%, #f39c12 100%) !important; }
        .accent-danger { background: linear-gradient(180deg, #fd3995 0%, #c82333 100%) !important; }
        .accent-purple { background: linear-gradient(180deg, #7b68ee 0%, #5d3fcf 100%) !important; }
        .accent-secondary { background: linear-gradient(180deg, #868e96 0%, #495057 100%) !important; }
        .accent-info { background: linear-gradient(180deg, #00c6ff 0%, #0072ff 100%) !important; }

        /* Premium Text and Spacing */
        .premium-card .card-body {
            padding: 1.75rem !important;
        }

        .card-title-premium {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a252f;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .card-subtitle-premium {
            font-size: 0.95rem;
            font-weight: 600;
            color: #0072ff;
            margin-bottom: 0.5rem;
        }

        /* Modern Translucent Badges */
        .premium-badge {
            font-size: 0.75rem !important;
            font-weight: 600 !important;
            padding: 0.4rem 0.9rem !important;
            border-radius: 50px !important;
            box-shadow: none !important;
            border: 1px solid transparent !important;
            display: inline-flex;
            align-items: center;
        }

        .premium-badge-success { background-color: rgba(29, 201, 183, 0.12) !important; color: #119284 !important; }
        .premium-badge-primary { background-color: rgba(55, 162, 255, 0.12) !important; color: #0056b3 !important; }
        .premium-badge-warning { background-color: rgba(255, 184, 34, 0.15) !important; color: #b07d00 !important; }
        .premium-badge-danger { background-color: rgba(253, 57, 149, 0.12) !important; color: #b81561 !important; }
        .premium-badge-purple { background-color: rgba(123, 104, 238, 0.12) !important; color: #5d3fcf !important; }
        .premium-badge-secondary { background-color: rgba(134, 142, 150, 0.12) !important; color: #495057 !important; }
        .premium-badge-info { background-color: rgba(0, 198, 255, 0.12) !important; color: #0072ff !important; }

        /* Premium Buttons */
        .btn-action-premium {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50% !important;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.1) !important;
            transition: all 0.2s ease !important;
            padding: 0 !important;
            border: none !important;
        }

        .btn-action-premium:hover {
            transform: scale(1.15) rotate(9deg);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.2) !important;
        }

        /* SmartAdmin Panel Upgrades */
        .panel.profile-premium-panel,
        .panel {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
            background: #ffffff !important;
            margin-bottom: 2rem !important;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .panel:hover {
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.07) !important;
        }

        .panel-hdr {
            background: #ffffff !important;
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 1.25rem 1.5rem !important;
            height: auto !important;
            min-height: 60px !important;
        }

        .panel-hdr h2 {
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            margin: 0 !important;
        }

        .panel-content {
            padding: 1.5rem !important;
        }

        /* Checklist Card Upgrade */
        .checklist-premium-card {
            border: none !important;
            border-radius: 16px !important;
            background: #ffffff !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
            margin-bottom: 2rem !important;
        }

        .checklist-premium-header {
            background: linear-gradient(135deg, #1dc9b7 0%, #00a65a 100%) !important;
            border: none !important;
            border-top-left-radius: 16px !important;
            border-top-right-radius: 16px !important;
            padding: 1.25rem 1.5rem !important;
        }

        .checklist-premium-header h5 {
            font-size: 1.15rem !important;
            font-weight: 700 !important;
        }

        /* Job Vacancies Cards */
        .job-premium-card {
            border: none !important;
            border-radius: 16px !important;
            background: #ffffff !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04) !important;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .job-premium-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12) !important;
        }

        .job-premium-card .card-body {
            padding: 1.5rem !important;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .zoom-effect img {
            transition: transform 0.5s ease;
        }

        .zoom-effect:hover img {
            transform: scale(1.08);
        }

        /* Clean Tab Buttons */
        .nav-tabs-clean .nav-link {
            font-weight: 600 !important;
            color: #64748b !important;
            border-bottom: 3px solid transparent !important;
            padding: 0.75rem 1.25rem !important;
            transition: all 0.25s ease;
        }

        .nav-tabs-clean .nav-link:hover {
            color: #0072ff !important;
        }

        .nav-tabs-clean .nav-link.active {
            color: #0072ff !important;
            border-bottom-color: #0072ff !important;
            background: transparent !important;
        }

        /* Custom File Input Overflows & Truncation Fix */
        .custom-file-label {
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            padding-right: 90px !important;
        }
    </style>
</head>

<body class="mod-bg-1 mod-nav-link header-function-fixed nav-function-fixed @yield('tmp_body')">
    @include('inc.script_body')
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            @include('inc.page_sidebar_applicant')
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                @include('inc.page_header', [
                    'settings_app' => 'N',
                    'my_app' => 'N',
                    'message_app' => 'N',
                    'notification_app' => 'N',
                ])
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
                @yield('content')
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                @include('inc.footer')
                <!-- END Page Footer -->
                <!-- BEGIN Shortcuts -->
                <!-- modal shortcut -->
                @include('inc.shortcuts') <!-- END Shortcuts -->
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <script nonce="{{ $nonce }}">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif

    @if (session()->has('error'))
        <script nonce="{{ $nonce }}">
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}!',
            })
        </script>
    @endif

    <!-- END Page Wrapper -->
    <!-- BEGIN Quick Menu -->
    @include('inc.quickmenu')
    <!-- END Quick Menu -->
    <!-- BEGIN Messenger -->
    @include('inc.messenger')
    <!-- END Messenger -->
    <!-- BEGIN Page Settings -->
    @include('inc.setting')
    <!-- END Page Settings -->
    @include('inc.script_footer')
</body>

</html>
