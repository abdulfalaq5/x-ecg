<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Site keywords here">
    <meta name="description" content="">
    <meta name='copyright' content=''>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Register Course</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/nice-select.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}">
    <!-- icofont CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/icofont.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('web/css/slicknav.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/owl-carousel.css') }}">
    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/datepicker.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/animate.min.css') }}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/magnific-popup.css') }}">

    <!-- Medipro CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('web/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .checked {
            color: orange;
        }

        .komen {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            padding-left: 100px;
            padding-right: 100px;
        }
    </style>

</head>

<body>

    <!-- Preloader -->
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator">
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header Area -->
    <header class="header">
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-12">
                            <!-- Start Logo -->
                            <div class="logo">
                                <a href="{{ route('home.index') }}"><img src="{{ asset('web/img/logoecg.png') }}" alt="Mobile ECG" width="90px"></a>
                            </div>
                            <!-- End Logo -->
                            <!-- Mobile Nav -->
                            <div class="mobile-nav"></div>
                            <!-- End Mobile Nav -->
                        </div>

                        <!-- Main Menu -->
                        @if (!empty(Auth::user()->name))
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="{{ route('peserta.mycourse') }}">My Courses </a></li>
                                        <li><a href="#">Bring Your ECG </a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6 col-md-7 col-12">
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="#">Courses </a></li>
                                        <li><a href="#">Bring Your ECG </a></li>
                                        <li><a href="#">About </a></li>
                                        <li><a href="#">Help </a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        @endif
                        <!--/ End Main Menu -->

                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="get-quote">

                            </div>
                        </div>
                        @if (!empty(Auth::user()->name))
                        <div class="col-lg-4 col-12 text-right">

                            <a style="color:black" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <img src="{{ asset('web/img/profil2.png') }}" alt="#" width="10%" title="{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}">
                            </a>



                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <!--<a href="#" class="dropdown-item">My Profil</a>-->

                                <a class="dropdown-item" href="{{ route('logout.index') }}">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-1 col-12">
                            <div class="get-quote">
                                <button class="btn" data-toggle="modal" data-target="#modal-login">Log In
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-1 col-12">
                            <div class="get-quote">
                                <button data-toggle="modal" data-target="#modal-sign-up" class="btn">Sign
                                    Up</button>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>

    <div class="container-fluid head-container mt-5">
    </div>
    <div class="container body-container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="diagram-head">
                    <div class="mb-4">
                        <h3><b>{{ $data_course->title }}</b></h3>
                    </div>
                    <div class="mb-3">
                        <p>Instructor : {{ $data_course->name }}</p>
                    </div>
                    <!--<div class="learning-objective">
                        <h6>Learning Objective</h6>
                        <div class="row mt-2">
                            <div class="col-6">
                                <ul>
                                    <li>Lorem ipsum color</li>
                                    <li>Lorem ipsum color</li>
                                    <li>Lorem ipsum color</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul>
                                    <li>Lorem ipsum color</li>
                                    <li>Lorem ipsum color</li>
                                    <li>Lorem ipsum color</li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="col-6">
                <div class="box-detail">
                    <div class="row h-100 d-flex justify-content-center align-items-center flex-column">
                        <div class="card-body-right">
                            <h5 class="card-title text-center">Sertifikat SKP/ Non SKP</h5>
                            <div class="line"></div>
                            <h6>Advance Level</h6>
                            <p>{{ $data_course->waktu_per_minggu }} hours a week</p>
                            <h6 class="mt-3">What you get?</h6>
                            @php
                            $income = explode(',', $data_course->income);
                            @endphp
                            @foreach ($income as $item)
                            <p>{{ $item }}</p>
                            @endforeach
                            <div class="line"></div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start align-items-center">
                                    <p class="price">Rp. {{ number_format($data_course->harga, 0, ',', '.') }}</p>
                                </div>
                                <div class="col-6 d-flex justify-content-end align-items-center action-form">
                                    <form action="{{ route('payment.regCourse') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="course_id" value="{{ $id }}">

                                        <button type="submit" id="submit" class="btn">Enroll</button>
                                    </form>

                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <button class="enroll-btn">Enroll</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container body-container-2">
        <div class="row">
            <div class="col-12">
                {!! $data_course->des !!}
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="container mt-3">
            <div class="container mt-3">
                <!-- Accordion -->
                <div id="accordion" class="mt-4">

                    <div class="container">
                        <div class="accordion" id="faq">
                            @if (!empty($data_materi))
                            @foreach ($data_materi as $item)
                            <div class="card mb-0">
                                <div class="card-header" id="faqhead{{ $item->id }}">
                                    <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq100{{ $item->id }}" aria-expanded="true" aria-controls="faq100{{ $item->id }}">{{ $item->title_materi }}</a>
                                </div>

                                @if (!empty($data_module))
                                @foreach ($data_module as $row)
                                @if ($item->id == $row->materi_id)
                                <div id="faq100{{ $row->materi_id }}" class="collapse" aria-labelledby="faqhead{{ $row->materi_id }}" data-parent="#faq">
                                    <div class="card-body">
                                        <a type="button" class="accord mb-0">{{ $row->title }}<i class="fa fa-check" style="color: green; right: 0;position: absolute;"></i></a>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif

                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>

                </div>

                <!-- Button to go to next section (example for going to Section 3) -->

            </div>

        </div>

    </div>

    <div class="container mt-5 body-container-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Reviews</h2>
                @if (!empty($review))
                <!-- Review 1 -->
                <div class="card mb-3">
                    <div class="card-body d-flex">
                        <img src="{{ asset('web/img/Avatar-review.png') }}" alt="Arlene McCoy" class="profile-pic mr-2" style="width:110px">
                        <div>
                            <h5 class="card-title">Arlene McCoy</h5>
                            <h6 class="card-subtitle mb-2 text-muted">about an hour ago</h6>
                            <p class="card-text">Access to IBM Cloud modelling what is I was looking for and Aaron
                                got
                                me the solution.</p>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="card">
                    <div class="card-body d-flex">
                        <img src="{{ asset('web/img/Avatar-review.png') }}" alt="Kristin Watson" class="profile-pic mr-2" style="width:110px">
                        <div>
                            <h5 class="card-title">Kristin Watson</h5>
                            <h6 class="card-subtitle mb-2 text-muted">about an hour ago</h6>
                            <p class="card-text">Upon completion of this ipsum dolor sit amet, consectetur
                                adipiscing
                                elit. Odio dictum morbi odio facilisi. At posuere purus, eget pretium sem nec
                                feugiat.
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-body d-flex">
                        <div>
                            <h5 class="card-title">Tidak ada Review</h5>
                        </div>
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>
    <!-- End Header Area -->

    <!-- Slider Area -->



    <style>
        .modal-backdrop {
            background-color: #2FD2DC;
        }

        .warna-ecg-text {
            color: #2FD2DC;
        }

        .warna-ecg-text-body {
            color: #000000;
        }

        .warna-ecg-background {
            background-color: #F7F7F8;
        }

        .center {
            margin: auto;
            width: 100%;
            padding: 10px;
            text-align: center;
        }

        .modal-dialog {
            max-width: 60%;
        }

        .modal-body {
            padding-left: 9%;
            padding-right: 9%;
        }

        .modal-footer-register {
            justify-content: center;
            background-color: #F7F7F8;
        }

        .modal-dialog-sukses {
            max-width: 20%;
        }

        .showpassword {
            border: 0;
            background: url("{{ asset('web/css/icon-hide-pass.svg') }}") no-repeat;
            height: 30px;
            width: 30px;
            position: absolute;
            right: 10px;
            top: 7px;
        }

        .showpassword.active {
            background: url("{{ asset('web/css/icon-show-pass.svg') }}") no-repeat;
            top: 10px;
        }

        .password-input {
            position: relative;
        }

        .home-course {
            margin: 0 5%;
        }

        .single-news {
            box-shadow: 3px 4px #0000002e !important;
            border-radius: 5px;
        }

        .quiz-step {
            display: none;
        }

        .active-step {
            display: block;
        }


        .quiz-box {
            height: 469px;
            padding: 100px 50px;
            background-color: #2FD2DC;
        }

        .quiz-box h5 {
            color: #fff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .quiz-box p {
            color: #fff;
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .quiz-box textarea {
            height: 70px;
            border-radius: 5px;
            border: 0;
            padding: 20px;
            font-size: 18px;
            font-weight: 400;
            color: #000;
            background-color: #fff;
        }

        .breadcrumb {
            list-style: none;
            overflow: hidden;
            font: 18px Helvetica, Arial, sans-serif;
            background-color: white;
        }

        .breadcrumb a {
            color: #0275d8;
            text-decoration: none;
        }

        .breadcrumb>li {
            display: inline;
        }

        .breadcrumb li+li:before {
            padding: 0 8px;
            color: #6c757d;
            content: ">";
        }

        .head-container {
            background-color: #2fd2dc4f;
            position: absolute;
            height: 323px;
            top: 0;
            left: 0;
            z-index: -1;
        }

        .learning-objective {
            margin-top: 100px;
        }

        .diagram-head {
            margin: 7%;
        }


        /* box header kanan */
        .body-container {
            height: 60%;
        }

        .body-container-2 {
            height: 30%;
        }

        .body-container-3 {
            height: 40%;
        }

        .body-container-4 {
            height: 50%;
        }

        .card-body-right {
            width: 100%;
            padding: 70px 60px;

        }

        .box-detail {
            border: 1px solid #2FD2DC;
            background-color: #ffffff;
            height: 100%;
        }

        .price {
            color: #ff4d4d;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .enroll-btn {
            border-radius: 20px;
            color: white;
            background-color: #ff4d4d;
            padding: 5px 25px;
            font-size: 1rem;
        }

        .stars {
            color: #ffc107;
        }

        .level {
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 8px;
        }

        .line {
            width: 100%;
            height: 4px;
            background-color: #000;
            margin: 20px 0;
        }

        /* accordion */
        .row.collapse {
            margin-left: calc(-1 * var(--sidebar-width));
            left: 0;
            transition: margin-left .15s linear;
        }

        .row.collapse.show {
            margin-left: 0 !important;
        }

        .row.collapsing {
            margin-left: calc(-1 * var(--sidebar-width));
            left: -0.05%;
            transition: all .15s linear;
        }

        .content-page {
            margin: 7% 2%;
        }

        .profile-header {
            gap: 20px;
        }

        .notif-header {
            width: 45px;
            height: 0;
        }

        .accordion a {
            border: 0;
        }

        div#faq::-webkit-scrollbar {
            display: none;
        }

        #faq {
            overflow-y: scroll;
            max-height: 66vh;
        }

        .accord {
            padding: 15px 0 15px 18px;
            font-size: 16px;
            color: #222;
            width: 100%
        }

        .accordion a.accord::after {
            font-size: 1px !important;
        }

        .accordion a:after {
            font-size: 16px;
        }

        #faq .card {
            margin-bottom: 30px;
            border: 0;
            color: #000000;
        }

        #faq .card .card-header {
            border: 0;
            border-radius: 2px;
            padding: 0;
        }

        #faq .card .card-header .btn-header-link {
            color: #fff;
            display: block;
            text-align: left;
            color: #222;
        }

        #faq .card .card-header .btn-header-link:after {
            content: "\f107";
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            float: right;
            color: #000000;
        }

        #faq .card .card-header .btn-header-link.collapsed:after {
            content: "\f106";
        }

        #faq .card .collapsing {
            line-height: 30px;
        }

        #faq .card .collapse {
            border: 0;
        }

        #faq .card .collapse.show {
            line-height: 30px;
            color: #222;
        }

        /* end accordion */
    </style>

    <!---modal register -->

    <div class="modal fade" id="modal-sign-up" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header warna-ecg-background">
                    <div class="center">
                        <h5 class="modal-title warna-ecg-text" id="exampleModalLabel">Sign Up 👋</h5>
                        <p>Please login or sign up to continue using our app</p>
                    </div>

                    <button type="button" class="close warna-ecg-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body warna-ecg-background">
                    <form>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Nama</label>
                            <input type="text" class="form-control" id="name" value="" placeholder="Input your fullname">
                            <span class="text-danger" style="display: none" id="error_name"></span>
                        </div>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Email</label>
                            <input type="email" class="form-control" id="email" value="" placeholder="Input your email">
                            <span class="text-danger" style="display: none" id="error_email"></span>
                        </div>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Phone Number</label>
                            <input type="text" class="form-control" id="phone" value="" placeholder="Input your phone number">
                            <span class="text-danger" style="display: none" id="error_phone"></span>
                        </div>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Password</label>
                            <input type="password" class="form-control" id="password-register" value="" placeholder="Input your password">
                            <span class="text-danger" style="display: none" id="error_password-register"></span>
                            <input type="checkbox" class="" id="show-password-register"> Tampilkan
                            Password
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer-register">
                    <div class="row">
                        <button type="button" onclick="register()" class="btn btn-primary">Sign Up</button>
                    </div>
                </div>
                <div class="modal-footer modal-footer-register">
                    <div class="row">
                        <p class="warna-ecg-text">Already have an account? <a href="#">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---end modal register -->

    <!---modal register sukses -->

    <div class="modal fade" id="modal-sign-up-sukses" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-sukses">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="center">
                        <h5 class="modal-title warna-ecg-text" id="exampleModalLabel">Sign Up Success,
                            <a href="#">Login Now</a>
                        </h5>
                    </div>
                    <button type="button" class="close warna-ecg-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <img src="{{ asset('web/img/ceklis.png') }}" width="50%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---end modal register sukses -->

    <!--modal error register -->
    <div class="modal fade" id="modal-error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-sukses">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="center">
                        <h5 class="modal-title warna-ecg-text" id="exampleModalLabel">Sign Up Failed</h5>
                    </div>
                    <button type="button" class="close warna-ecg-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <img src="{{ asset('web/img/gagal.png') }}" width="50%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal error register -->

    <!--modal login -->
    <div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header warna-ecg-background">
                    <div class="center">
                        <h5 class="modal-title warna-ecg-text" id="exampleModalLabel">Welcome Back !</h5>
                        <p>Hello again, you’ve been missed!</p>
                    </div>

                    <button type="button" class="close warna-ecg-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body warna-ecg-background">
                    <form>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Email</label>
                            <input type="email" class="form-control" id="email-login" value="" placeholder="Input your email">
                            <span class="text-danger" style="display: none" id="error_email_login"></span>
                        </div>
                        <div class="form-group">
                            <div class="password-input">
                                <label class="warna-ecg-text-body" for="">Password</label>
                                <input type="password" class="form-control" id="password-login" value="" placeholder="Input your password" autocomplete="off">
                                <div class="text-right">
                                    <span class="text-danger" style="display: none" id="error_password_login"></span>
                                </div>

                                <input type="checkbox" class="" id="show-password-login"> Tampilkan
                                Password
                            </div>
                            <div class="text-right">
                                <a href="#">Forget Password ?</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer modal-footer-register">
                    <div class="row">
                        <button type="button" onclick="login()" class="btn btn-primary">Log In</button>
                    </div>
                </div>
                <div class="modal-footer modal-footer-register">
                    <div class="row">
                        <p class="warna-ecg-text">Don’t have an account? <a href="#">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal login -->

    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="single-footer">
                            <table>
                                <tr>
                                    <td><img src="{{ asset('web/img/logo-foot.png') }}" alt="#" width="100%"></td>
                                    <td>
                                        <h2>Departemen Kardiologi dan Kedokteran Vaskular Universitas Gadjah Mada</h2>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-footer">
                            <a href="https://maps.app.goo.gl/8e5WLLgKBPgAFNFF8"><img src="{{ asset('web/img/peta.png') }}" alt="#" width="100%"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-footer f-link">
                            <ul>
                                <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Gedung
                                        Radiopoetro Lantai 2 Sayap Barat
                                        Jalan Farmako Sekip Utara 55281</a>
                                </li>
                                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>kardiologi_fkugm@yahoo.co.id</a></li>
                                <li><a href="#"><i class="fa fa-fa-phone" aria-hidden="true"></i>+62 (274)
                                        631011</a></li>
                                <li><a href="#"><i class="fa fa-phone-office" aria-hidden="true"></i>+62 (274)
                                        547783</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-footer">
                            <h2>Download our App :</h2>
                            <table>
                                <tr>
                                    <td><a href="#"><img src="{{ asset('web/img/gplay.png') }}" alt="#" width="100%"></a></td>
                                    <td><a href="#"><img src="{{ asset('web/img/aplay.png') }}" alt="#" width="100%"></a></td>
                                </tr>
                            </table>
                            <!-- Social -->
                            <ul class="social">
                                <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                <li><a href="#"><i class="icofont-google-plus"></i></a></li>
                                <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                <li><a href="#"><i class="icofont-vimeo"></i></a></li>
                                <li><a href="#"><i class="icofont-pinterest"></i></a></li>
                            </ul>
                            <!-- End Social -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="copyright-content">
                            <p>© Copyright 2023 | All Rights Reserved by <a href="#" target="_blank">ecg.ugm.co.id</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Copyright -->
    </footer>
    <!--/ End Footer Area -->
    <input type="hidden" id="crsf_token" value="{{ csrf_token() }}">
    <script>
        function register() {
            if ($('#name').val() == '') {
                $('#error_name').css('display', 'block');
                $('#error_name').text('The name is required.');
                return false;
            } else {
                $('#error_name').css('display', 'none');
                $('#error_name').text('');
            }

            if ($('#email').val() == '') {
                $('#error_email').css('display', 'block');
                $('#error_email').text('The email is required.');
                return false;
            } else {
                $('#error_email').css('display', 'none');
                $('#error_email').text('');
            }

            if ($('#phone').val() == '') {
                $('#error_phone').css('display', 'block');
                $('#error_phone').text('The phone is required.');
                return false;
            } else {
                $('#error_phone').css('display', 'none');
                $('#error_phone').text('');
            }

            if ($('#password-register').val() == '') {
                $('#error_password-register').css('display', 'block');
                $('#error_password-register').text('The password is required.');
                return false;
            } else {
                $('#error_password-register').css('display', 'none');
                $('#error_password-register').text('');
            }

            var params = {
                "_token": $('#crsf_token').val(),
                "name": $('#name').val(),
                "email": $('#email').val(),
                "phone": $('#phone').val(),
                "password": $('#password-register').val(),
            };
            var url = "{{ route('register.simpan') }}" + '?' + jQuery.param(params);

            $.ajax({
                type: 'POST',
                url: url,
                beforeSend: function() {

                },
                success: function(data) {
                    if (data.status == 1) {
                        $('#modal-sign-up-sukses').modal('show');
                        $('#modal-sign-up').modal('hide');
                    } else {
                        $('#modal-error').modal('show');
                        $('#modal-sign-up').modal('hide');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function login() {

            if ($('#email-login').val() == '') {
                $('#error_email_login').css('display', 'block');
                $('#error_email_login').text('The email is required.');
                return false;
            } else {
                $('#error_email_login').css('display', 'none');
                $('#error_email_login').text('');
            }

            if ($('#password-login').val() == '') {
                $('#error_password_login').css('display', 'block');
                $('#error_password_login').text('The password is required.');
                return false;
            } else {
                $('#error_password_login').css('display', 'none');
                $('#error_password_login').text('');
            }

            var params = {
                "_token": $('#crsf_token').val(),
                "email": $('#email-login').val(),
                "password": $('#password-login').val(),
            };
            var url = "{{ route('login.proses-login') }}" + '?' + jQuery.param(params);

            $.ajax({
                type: 'POST',
                url: url,
                beforeSend: function() {

                },
                success: function(data) {
                    if (data.status == true) {
                        $('#error_password_login').css('display', 'none');
                        $('#error_password_login').text('');
                        $('#modal-login').modal('hide');
                        location.reload();
                    } else {
                        $('#error_password_login').css('display', 'block');
                        $('#error_password_login').text('please check your password and email');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        let currentStep = 1;

        function navigate(direction) {
            const totalSteps = 5;
            if (direction === 'next' && currentStep < totalSteps) {
                currentStep++;
            } else if (direction === 'previous' && currentStep > 1) {
                currentStep--;
            }
            updateQuizStep();
            styleCircleNumber();
        }

        function updateQuizStep() {
            $('.quiz-step').removeClass('active-step').filter(`[data-step="${currentStep}"]`).addClass('active-step');
            $('#progressBar').css('width', (currentStep * 20) + '%').text(currentStep);
        }

        // Initialize the quiz to show the first step
        $(document).ready(function() {
            updateQuizStep();
        });

        function styleCircleNumber() {
            // Assuming each step has a unique circle number element
            const circleNumbers = document.querySelectorAll('.circle-number');

            // First, remove any inline styles from all circle numbers
            circleNumbers.forEach(circle => {
                circle.style = '';
            });

            // Then, style the current step's circle number
            const currentCircleNumber = document.querySelector(`.circle-number[data-step="${currentStep}"]`);
            if (currentCircleNumber) {
                currentCircleNumber.style.backgroundColor = '#fff';
                currentCircleNumber.style.color = '#000';
                currentCircleNumber.style.borderRadius = '50%';
                currentCircleNumber.style.width = '30px';
                currentCircleNumber.style.height = '30px';
                currentCircleNumber.style.textAlign = 'center';
                currentCircleNumber.style.lineHeight = '30px';
                currentCircleNumber.style.display = 'inline-block';
                currentCircleNumber.style.border = '2px solid #3498db';
                currentCircleNumber.style.position = 'absolute';
                currentCircleNumber.style.zIndex = '2';
            }
        }

        // Call styleCircleNumber on initial load
        document.addEventListener('DOMContentLoaded', styleCircleNumber);
    </script>

    <!-- jquery Min JS -->
    <script src="{{ asset('web/js/jquery.min.js') }}"></script>
    <!-- jquery Migrate JS -->
    <script src="{{ asset('web/js/jquery-migrate-3.0.0.js') }}"></script>
    <!-- jquery Ui JS -->
    <script src="{{ asset('web/js/jquery-ui.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('web/js/easing.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('web/js/colors.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('web/js/popper.min.js') }}"></script>
    <!-- Bootstrap Datepicker JS -->
    <script src="{{ asset('web/js/bootstrap-datepicker.js') }}"></script>
    <!-- Jquery Nav JS -->
    <script src="{{ asset('web/js/jquery.nav.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('web/js/slicknav.min.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('web/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Niceselect JS -->
    <script src="{{ asset('web/js/niceselect.js') }}"></script>
    <!-- Tilt Jquery JS -->
    <script src="{{ asset('web/js/tilt.jquery.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('web/js/owl-carousel.js') }}"></script>
    <!-- counterup JS -->
    <script src="{{ asset('web/js/jquery.counterup.min.js') }}"></script>
    <!-- Steller JS -->
    <script src="{{ asset('web/js/steller.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('web/js/wow.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Counter Up CDN JS -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('web/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <input type="hidden" id="crsf_token" value="{{ csrf_token() }}">
    <input type="hidden" id="url_payment" value="{{ route('payment.snaptoken') }}">
    <input type="hidden" id="url_register" value="{{ route('payment.regCourse') }}">
    <script type="text/javascript">
        function paymentGoManual(id) {
            var params = {
                "_token": $('#crsf_token').val(),
                "course_id": id,
            };
            var url = $('#url_register').val() + '?' + jQuery.param(params);

            $.ajax({
                method: 'GET',
                url: url,
                beforeSend: function() {
                    $('#preloader').removeClass('hide');
                },
                success: function(data) {
                    window.location.href = {
                        {
                            route('peserta.mycourse')
                        }
                    };
                }
            }).done(function() {
                $('#preloader').addClass('hide');
            })
        }
    </script>
    @if (env('MIDTRANS_PRODUCTION') == '1')
    <script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="production" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @else
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script id="midtrans-script" type="text/javascript" src="https://api.midtrans.com/v2/assets/js/midtrans-new-3ds.min.js" data-environment="sandbox" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    @endif

    <script>
        /*
        $(document).ready(function() {
            $('#show-password-login').click(function() {
                if ($(this).is(':checked')) {
                    $('#password-login').attr('type', 'text');
                } else {
                    $('#password-login').attr('type', 'password');
                }
            });

            $('#show-password-register').click(function() {
                if ($(this).is(':checked')) {
                    $('#password-register').attr('type', 'text');
                } else {
                    $('#password-register').attr('type', 'password');
                }
            });

            $('#cari').select2({
                placeholder: "Search Course",
                //minimumInputLength: 1,
                allowClear: true,
                multiple: false,
                ajax: {
                    url: "{{ route('home.option') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        var json = [];
                        //append the results to the select2 ALL option
                        //count data
                        var total_data = data.data.length;
                        if (total_data > 0) {
                            json.push({
                                id: 'all',
                                text: 'All'
                            });
                        }


                        $.each(data.data, function(i, obj) {
                            json.push({
                                id: obj.id,
                                text: obj.name
                            });
                        });
                        return {
                            results: json
                        };

                    },
                    cache: true
                }
            });

            $('.action-form a#submit').on('click', function(e) {
                /*e.preventDefault();
                //delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
                $.ajax({
                    method: 'post',
                    //url: '{{ config('app.payment_service_api') }}/v1/payments/get-token-snap',
                    url: '',
                    data: {
                        'course_id': "{{ $id }}"
                    },
                    beforeSend: function() {
                        $('#preloader').removeClass('hide');
                    },
                    success: function(data) {
                        snap.pay(data.token, {
                            onSuccess: function() {
                                window.location.href = data.redirect_url;
                            },
                            onPending: function() {
                                window.location.href = data.redirect_url;
                            },
                            onError: function(result) {
                                console.log('error');
                                console.log(result);
                            }
                        })
                    }
                }).done(function() {
                    $('#preloader').addClass('hide');
                })

                $.ajaxSettings.headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr(
                    'content'); // Add it back immediately
            });
        });

        function paymentGo(id) {
            var params = {
                "_token": $('#crsf_token').val(),
                "course_id": id,
            };
            var url = $('#url_payment').val() + '?' + jQuery.param(params);

            $.ajax({
                method: 'GET',
                url: url,
                beforeSend: function() {
                    $('#preloader').removeClass('hide');
                },
                success: function(data) {
                    snap.pay(data.token, {
                        onSuccess: function() {
                           // window.location.href = data.redirect_url;
                        },
                        onPending: function() {
                            //window.location.href = data.redirect_url;
                        },
                        onError: function(result) {
                            console.log('error');
                            console.log(result);
                        }
                    })
                }
            }).done(function() {
                $('#preloader').addClass('hide');
            })

            $.ajaxSettings.headers["X-CSRF-TOKEN"] = $('meta[name="csrf-token"]').attr(
                'content'); // Add it back immediately
        }

        function midtrans3dsAuth(redirect_url) {
            // callback functions
            var options = {
                performAuthentication: function(redirect_url) {
                    midtransPopupModal.openPopup(redirect_url);
                },
                onSuccess: function(response) {
                    midtransPopupModal.closePopup();
                    // redirect to success page
                    window.location.href = "{{ route('payment.sukses') }}"
                },
                onFailure: function(response) {
                    midtransPopupModal.closePopup();

                    $("#payment-failed-modal").modal('show');
                },
                onPending: function(response) {
                    midtransPopupModal.closePopup();

                    $("#payment-pending-modal").modal('show');
                }
            };

            MidtransNew3ds.authenticate(redirect_url, options);
        }

        var midtransPopupModal = (function() {
            var modal = null;
            return {
                openPopup(url) {
                    modal = picoModal({
                        content: '<iframe frameborder="0" style="height:90vh; width:100%;" src="' + url +
                            '"></iframe>',
                        width: "75%",
                        closeButton: false,
                        overlayClose: false,
                        escCloses: false
                    }).show();
                },
                closePopup() {
                    try {
                        modal.close();
                    } catch (e) {}
                }
            }
        }());
        */
    </script>
</body>

</html>