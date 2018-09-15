<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>Kleid | @yield('titulo')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icono.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('vendor/bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('vendor/bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('vendor/bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('vendor/bsb/css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page" style="background-image: url({{ asset('vendor/bsb/images/back2.jpg') }}) !important; background-size: cover;>
    <div class="login-box">
        <div class="logo">
            <a href="{{ url('/') }}" style="color: #918787 !important;">Kleid<b>Boutique</b></a>
            <small style="color: #918787 !important;">Moda al alcance</small>
        </div>
        <div class="card">
            <div class="body">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('vendor/bsb/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="v{{ asset('endor/bsb/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('vendor/bsb/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('vendor/bsb/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('vendor/bsb/js/admin.js') }}"></script>
    <script src="{{ asset('vendor/bsb/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>