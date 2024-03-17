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
    <title>ECG | Course</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            padding-left: 58px;
            padding-right: 58px;
            margin-bottom: 35px;
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
                                <a href="{{ route('home.index') }}"><img src="{{ asset('web/img/logoecg.png') }}"
                                        alt="Mobile ECG" width="90px"></a>
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
                                            <li><a href="{{ route('home.course') }}">Courses </a></li>
                                            <li><a href="#" onclick="formLogin()">Bring Your ECG </a></li>
                                            <li><a href="#">About </a></li>
                                            <li><a href="{{ route('home.help') }}">Help </a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                        <!--/ End Main Menu -->

                        <div class="col-lg-2 col-md-2 col-12">
                            <div class="get-quote">
                                <div id="cari" class="form-control cari"></div>
                            </div>
                        </div>
                        @if (!empty(Auth::user()->name))
                            <div class="col-lg-4 col-12 text-right">

                                <a style="color:black" id="navbarDropdown" class="nav-link dropdown-toggle"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                    <img src="{{ asset('web/img/profil2.png') }}" alt="#" width="10%"
                                        title="{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}">
                                </a>



                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="#" class="dropdown-item">My Profil</a>

                                    <a class="dropdown-item" href="{{ route('logout.index') }}">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-1 col-12">
                                <div class="get-quote">
                                    <button class="btn" data-toggle="modal" data-target="#modal-login"
                                        id="btn_login">Log In
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-1 col-12">
                                <div class="get-quote">
                                    <button data-toggle="modal" data-target="#modal-sign-up" class="btn"
                                        id="btn_register">Sign
                                        Up</button>
                                    <button data-toggle="modal" data-target="#modal-sign-up-sukses" class="btn"
                                        id="btn-modal-sign-up-sukses" style="display:none"></button>
                                    <button data-toggle="modal" data-target="#modal-error" class="btn"
                                        id="btn-modal-error" style="display:none"></button>

                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!-- End Header Area -->

    <section class="blog section" id="blog">
        <div class="home-course">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Most Popular Courses</h2>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                        classical Latin literature from 45 BC, making it over 2000 years old.</p>
                    <img src="{{ asset('web/img/section-img.png') }}" alt="#">
                </div>
            </div>
            <div class="row">
                @if (!empty($get_course))
                    @foreach ($get_course as $item)
                        <div class="col-lg-3 col-md-6 col-12 mt-4" onclick="formLogin()">
                            <!-- Single Blog -->
                            <div class="single-news">
                                <div class="news-head">
                                    <img src="{{ url('/cover/' . $item->cover) }}" alt="#">
                                </div>
                                <div class="news-body">
                                    <div class="news-content">
                                        <!--<div class="date">22 Aug, 2020</div>-->
                                        <h2><a href="#" onclick="formLogin()">{{ $item->title }}</a></h2>
                                        <p class="text mt-2">{!! batasString($item->des, 100) !!}</p>
                                        <div class="mt-3">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Blog -->
                        </div>
                    @endforeach

                @endif
            </div>
    </section>

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
    </style>

    <!---modal register -->

    <div class="modal fade" id="modal-sign-up" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header warna-ecg-background">
                    <div class="center">
                        <h5 class="modal-title warna-ecg-text" id="exampleModalLabel">Sign Up 👋</h5>
                        <p>Please login or sign up to continue using our app</p>
                    </div>

                    <button type="button" class="close warna-ecg-text" id="btn_close_register" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body warna-ecg-background">
                    <form>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Nama</label>
                            <input type="text" class="form-control" id="name" value=""
                                placeholder="Input your fullname">
                            <span class="text-danger" style="display: none" id="error_name"></span>
                        </div>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Email</label>
                            <input type="email" class="form-control" id="email" value=""
                                placeholder="Input your email">
                            <span class="text-danger" style="display: none" id="error_email"></span>
                        </div>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Phone Number</label>
                            <input type="text" class="form-control" id="phone" value=""
                                placeholder="Input your phone number">
                            <span class="text-danger" style="display: none" id="error_phone"></span>
                        </div>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Password</label>
                            <input type="password" class="form-control" id="password-register" value=""
                                placeholder="Input your password">
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
                        <p class="warna-ecg-text">Already have an account? <a href="#"
                                onclick="formLogin()">Log In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---end modal register -->

    <!---modal register sukses -->

    <div class="modal fade" id="modal-sign-up-sukses" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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

                    <button type="button" class="close warna-ecg-text" id="btn_close_login" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body warna-ecg-background">
                    <form>
                        <div class="form-group">
                            <label class="warna-ecg-text-body" for="">Email</label>
                            <input type="email" class="form-control" id="email-login" value=""
                                placeholder="Input your email">
                            <span class="text-danger" style="display: none" id="error_email_login"></span>
                        </div>
                        <div class="form-group">
                            <div class="password-input">
                                <label class="warna-ecg-text-body" for="">Password</label>
                                <input type="password" class="form-control" id="password-login" value=""
                                    placeholder="Input your password" autocomplete="off">
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
                        <p class="warna-ecg-text">Don’t have an account? <a href="#"
                                onclick="formRegister()">Sign Up</a></p>
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
                                    <td><img src="{{ asset('web/img/logo-foot.png') }}" alt="#"
                                            width="100%"></td>
                                    <td>
                                        <h2>Departemen Kardiologi dan Kedokteran Vaskular Universitas Gadjah Mada</h2>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-footer">
                            <a href="https://maps.app.goo.gl/8e5WLLgKBPgAFNFF8"><img
                                    src="{{ asset('web/img/peta.png') }}" alt="#" width="100%"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="single-footer f-link">
                            <ul>
                                <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Gedung
                                        Radiopoetro Lantai 2 Sayap Barat
                                        Jalan Farmako Sekip Utara 55281</a>
                                </li>
                                <li><a href="#"><i class="fa fa-envelope"
                                            aria-hidden="true"></i>kardiologi_fkugm@yahoo.co.id</a></li>
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
                                    <td><a href="#"><img src="{{ asset('web/img/gplay.png') }}" alt="#"
                                                width="100%"></a></td>
                                    <td><a href="#"><img src="{{ asset('web/img/aplay.png') }}" alt="#"
                                                width="100%"></a></td>
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
                            <p>© Copyright 2023 | All Rights Reserved by <a href="#"
                                    target="_blank">ecg.ugm.co.id</a> </p>
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
                    console.log(data);
                    if (data.status == 1) {
                        suksesRegister();
                    } else {
                        errorRegister();
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
                "username": $('#email-login').val(),
                "password": $('#password-login').val(),
            };
            var url = "{{ route('login.proses-login') }}" + '?' + jQuery.param(params);

            $.ajax({
                type: 'POST',
                url: url,
                beforeSend: function() {

                },
                success: function(data) {
                    if (data == 1) {
                        window.location.href = "{{ route('admin.beranda') }}";
                    } else if (data == 2) {
                        window.location.href = "{{ route('editor.beranda') }}";
                    } else if (data == 3) {
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        function formRegister() {
            $("#btn_close_login").click();
            $("#btn_register").click();
        }

        function formLogin() {
            $("#btn_close_register").click();
            $("#btn_login").click();
        }

        function suksesRegister() {
            $("#btn-modal-sign-up-sukses").click();
            $("#btn_close_register").click();
        }

        function errorRegister() {
            $("#btn-modal-error").click();
            $("#btn_close_register").click();
        }

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

            $('.cari').select2({
                minimumInputLength: 0,
                allowClear: true,
                placeholder: 'Masukkan nama kursus',
                theme: 'bootstrap4',
                ajax: {
                    dataType: 'json',
                    url: "{{ route('home.option') }}",
                    delay: 800,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data, page) {
                        return {
                            results: data
                        };
                    },
                }
            }).on('cari:select', function(evt) {
                var data = $(".cari option:selected").text();
                var value = $(".cari option:selected").val();
                // loadKota('kota_id', value)

            }).on('instruktur:clear', function(evt) {
                // $('.select2-kota').empty();
            });

        });
    </script>
</body>

</html>
