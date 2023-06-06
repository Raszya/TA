<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register E-learning SMAN 1 Surakarta</title>
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
    @include('sweetalert::alert')
    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">

                    <center><a href="/"><img src="{{ asset('assets/img/sman1.png') }}" height="500px"
                                width="200px"></a></center>



                    <form method="POST" action="{{ route('register') }}">
                        <center>
                            <h1 class="form-title mt-4">REGISTER</h1>
                        </center>
                        @csrf

                        <!-- NIP -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">NIP/NIS</label>
                            <input type="text" maxlength="16" class="form-control" id="nis" name="nis"
                                :value="old('nip')" required autofocus />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>
                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email </label>
                            <input type="email" class="form-control" id="email" name="email"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="d-grid gap-2 col-8 mx-auto mt-5">
                            <button class="btn btn-success" type="submit"> {{ __('Register') }}</button>
                        </div>

                    </form>

                    <p class="loginhere">
                        Sudah mempunyai akun ? <a href="{{ route('login') }}" class="loginhere-link">Login disini</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="tmp_loginregister/vendor/jquery/jquery.min.js"></script>
    <script src="tmp_loginregister/js/main.js"></script>
    @include('sweetalert::alert')
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
