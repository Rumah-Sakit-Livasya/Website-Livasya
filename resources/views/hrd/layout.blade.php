<!DOCTYPE html>
<html lang="id">

<head>
    @include('inc.header')
    <style nonce="{{ $nonce }}">
        :root {
            --hrd-primary: #1a56db;
            --hrd-accent: #e74694;
            --hrd-dark: #111827;
            --hrd-surface: #1f2937;
            --hrd-border: rgba(255,255,255,0.08);
        }

        body {
            background: #f4f6fb;
            font-family: 'Inter', sans-serif;
        }

        /* ── Topbar ── */
        .hrd-topbar {
            background: linear-gradient(135deg, #1e3a5f 0%, #1a56db 100%);
            color: #fff;
            padding: 0 1.5rem;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 12px rgba(26,86,219,.3);
        }

        .hrd-topbar .brand {
            display: flex;
            align-items: center;
            gap: .75rem;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: .3px;
        }

        .hrd-topbar .brand img {
            height: 36px;
        }

        .hrd-topbar .nav-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .hrd-topbar .nav-right a {
            color: rgba(255,255,255,.8);
            font-size: .85rem;
            text-decoration: none;
            transition: color .2s;
        }

        .hrd-topbar .nav-right a:hover { color: #fff; }

        .hrd-topbar .user-chip {
            background: rgba(255,255,255,.15);
            border-radius: 50px;
            padding: .35rem .9rem;
            font-size: .82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        /* ── Page Wrapper ── */
        .hrd-page {
            min-height: calc(100vh - 62px);
            padding: 1.75rem 1.5rem;
            max-width: 1280px;
            margin: 0 auto;
        }

        /* ── Breadcrumb ── */
        .hrd-breadcrumb {
            font-size: .8rem;
            color: #6b7280;
            margin-bottom: 1.25rem;
        }
        .hrd-breadcrumb a { color: var(--hrd-primary); text-decoration: none; }
        .hrd-breadcrumb span { margin: 0 .4rem; }
    </style>
</head>

<body class="mod-bg-1">
    @include('inc.script_body')

    <!-- Topbar -->
    <div class="hrd-topbar">
        <div class="brand">
            <img src="{{ asset('img/logo.png') }}" alt="RS Livasya">
            <span>HRD Panel &mdash; RS Livasya</span>
        </div>
        <div class="nav-right">
            <a href="{{ route('hrd.index') }}"><i class="fal fa-home mr-1"></i> Dashboard</a>
            <div class="user-chip">
                <i class="fal fa-user-circle"></i>
                {{ Auth::user()->name }}
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" style="background:none;border:none;color:rgba(255,255,255,.8);cursor:pointer;font-size:.82rem;">
                    <i class="fal fa-sign-out-alt mr-1"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- Page Content -->
    <div class="hrd-page">
        @yield('breadcrumb')
        @yield('content')
    </div>

    @if (session()->has('success'))
        <script nonce="{{ $nonce }}">
            const Toast = Swal.mixin({
                toast: true, position: 'top-end',
                showConfirmButton: false, timer: 3000, timerProgressBar: true
            });
            Toast.fire({ icon: 'success', title: '{{ session('success') }}' });
        </script>
    @endif

    @if (session()->has('error'))
        <script nonce="{{ $nonce }}">
            Swal.fire({ icon: 'error', title: 'Gagal', text: '{{ session('error') }}' });
        </script>
    @endif

    @include('inc.script_footer')
    @yield('scripts')
</body>

</html>
