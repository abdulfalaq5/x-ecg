<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/style.css?v=1.0.2') }}">

    <style>
        body {
            height: 100vh;
        }

        .login-container {
            display: flex;
            flex-direction: row;
        }

        .side-image {
            height: 100vh;
        }

        .logo-bank-jatim {
            width: 200px;
            position: absolute;
            right: 0;
            top: 0;
            margin-right: 2em;
            margin-top: 1em;
        }

        .form-login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .login-btn {
            background-color: #484848;
            color: #fff;
            width: 100%;
        }

        .login-btn:hover{
            color: #fff;
        }

        #frmLogin {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img class="logo-bank-jatim" src="{{ asset('img/bankjatim.png') }}" />
        <div>
            <img class="side-image" src="{{ asset('img/jperform_login.jpg') }}" />
        </div>
        <div class="form-login-container">
            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/vendor/slick-1.8.1/slick.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-4.0.0-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/global.fe.js') }}"></script>

    <script></script>
</body>

</html>
