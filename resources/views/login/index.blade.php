<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/sweetalert.css">
    <title>Login</title>
</head>

<body>

    @if (session('success'))
        <div class="alert mb-5 m-auto alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('loginError'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Login Gagal!',
            })
        </script>
        @endif @if (session('success'))
            <div class="alert mb-5 m-auto alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('loginError'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Login Gagal!',
                })
            </script>
        @endif

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-12 col-lg-10">
                        <div class="wrap d-md-flex">
                            <div class="img d-flex align-items-center justify-content-center">
                                <img src="/img/login.jpg" alt="" style="max-width: 80%; height=auto;">
                            </div>
                            <div class="login-wrap p-4 p-md-5">

                                <form action="/bukan-login" class="signin-form" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="username">Username</label>
                                        <input type="text"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" id="username" name="username"
                                            placeholder="Dimas Kasep" autofocus required>
                                        @error('username')
                                            <div class="text-danger ms-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                        @error('password')
                                            <div class="text-danger ms-3">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                            class="form-control btn btn-primary rounded submit px-3">Sign
                                            In</button>
                                    </div>
                                    <div class="form-group d-md-flex">
                                        <div class="w-100">
                                            <a href="/">
                                                Kembali ke halaman awal ?
                                            </a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="/js/sweetalert2.js"></script>
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
            });
        </script>

</body>

</html>
