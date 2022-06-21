<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Incidencias IESPSur - @yield('title')</title>
    <link rel="icon" type="image/x-icon" href=" {{ asset('/storage/IESP_Sur_Logo.ico') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/1680769545.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1">
                    <img src="https://iespoligonosur.org/www/wp-content/uploads/2020/07/cropped-IespsurLogov3.png" alt="IESPSur Logo"
                        style="opacity: .8">
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Registrar un nuevo usuario</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                            <x-input id="first_name" class="form-control" type="text" name="first_name" placeholder="Nombre" :value="old('first_name')" required />
             
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-input id="last_name" class="form-control" type="text" name="last_name" placeholder="Apellidos" :value="old('last_name')" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-input id="dni" class="form-control" type="text" name="dni" placeholder="DNI" :value="old('dni')" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <x-input id="email" class="form-control" type="email" name="email" placeholder="Email" :value="old('email')" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                placeholder="Contraseña"
                                required autocomplete="new-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <x-input id="password_confirmation" class="form-control"
                                type="password"
                                placeholder="Confirmar Contraseña"
                                name="password_confirmation" required />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="/login" class="text-center">Tengo actualmente una cuenta.</a>
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src=" {{ asset('/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>

</html>
