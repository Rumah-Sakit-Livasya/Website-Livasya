<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head> @include('inc.header') </head>

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
        <script>
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
        <script>
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
