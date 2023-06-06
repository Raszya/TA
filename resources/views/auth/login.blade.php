<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login E-learning SMAN 1 Surakarta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Icon -->
    <link rel="stylesheet" href="tmp_loginregister/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="tmp_loginregister/css/style.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <center><a href="/"><img src={{ asset('assets/img/sman1.png') }} height="300px"
                                width="200px"></a></center>

                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('login') }}">
                        <center>
                            <h1 class="form-title mt-4">LOGIN</h1>
                        </center>
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control" id="email" name="email"
                                :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <div class="d-grid gap-2 col-8 mx-auto mt-5">
                            <button class="btn btn-primary" type="submit"> {{ __('Log in') }}</button>
                        </div>
                    </form>


                    <p class="loginhere">
                        Belum mempunyai akun ? <a href="{{ route('register') }}" class="loginhere-link">Register
                            disini</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="tmp_loginregister/vendor/jquery/jquery.min.js"></script>
    <script src="tmp_loginregister/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
