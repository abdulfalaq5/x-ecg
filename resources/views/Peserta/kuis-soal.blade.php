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
    <title>My Courses Quiz</title>

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
    <div class="container-fluid fixed-top bg-white py-3">
        <div class="row collapse show no-gutters d-flex h-100 position-relative">
            <div class="col-3 px-0 w-sidebar navbar-collapse collapse d-none d-md-flex">
                <!-- spacer col -->
            </div>
            <div class="col px-3 px-md-0 d-flex flex-row align-items-center">
                <!-- toggler -->
                <a data-toggle="collapse" href="#" data-target=".collapse" role="button" class="text-black p-1">
                    <i class="fa fa-bars fa-lg"></i>
                </a>
            </div>
            <ul class="navbar-nav d-flex flex-row me-1">
                <li class="nav-item notif-header">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                    </svg>
                </li>
                <li class="nav-item d-flex justify-content-center align-items-center profile-header">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }} </a> <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle dropdown-toggle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <!--<a href="#" class="dropdown-item">My Profil</a>-->

                        <a class="dropdown-item" href="{{ route('logout.index') }}">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row collapse show no-gutters d-flex h-100 position-relative">
            <div class="col-3 p-0 h-100 w-sidebar navbar-collapse collapse d-none d-md-flex sidebar">
                <!-- fixed sidebar -->
                <div class="navbar-dark bg-white position-fixed h-100 align-self-start w-sidebar">
                    <div class="col-12 mt-5 mb-3">
                        <!-- Start Logo -->
                        <div class="logo d-flex justify-content-center align-items-center">
                            <a href="{{ route('home.index') }}"><img src="{{ asset('web/img/logoecg.png') }}" alt="Mobile ECG" width="150px"></a>
                        </div>
                        <!-- End Logo -->
                        <!-- Mobile Nav -->
                        <div class="mobile-nav"></div>
                        <!-- End Mobile Nav -->
                    </div>
                    <div class="container">
                        <div class="accordion" id="faq">
                            <label href="Dashboard" class="mb-0" style="padding: 15px 0 15px 18px; font-size: 16px; color: #222; width:100%">Dashboard</label>
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
                                        <a type="button" onclick="window.location.href='{{ route('peserta.module.detail', [$id, $row->materi_id, $row->id]) }}'" class="accord mb-0">{{ $row->title }}</a>
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
            </div>
            <div class="col content-page p-5 bg-white">
                <nav aria-label="Breadcrumb" class="mb-2">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('peserta.mycourse') }}">Home</a></li>
                        <li><a href="{{ route('peserta.mycourse') }}">My Courses</a></li>
                        <li>Detail Course</li>
                    </ol>
                </nav>
                <div class="col-12 mb-4">
                    <img src="{{ url('/cover/' . $data_course->cover) }}" alt="">
                </div>
                <div class="col-12 mb-4">
                    <h2>{{ $data_course->title }}</h2>
                    <p>Instruktur : {{ $data_course->name }} | {{ $data_course->waktu_per_minggu }} jam/minggu</p>
                </div>
                <div class="row mb-5 text-center">
                    <div class="col-2 ">
                        <a href="{{ route('peserta.course.detail', $id) }}">Informasi</a>
                    </div>
                    <div class="col-2 ">
                        <a href="{{ route('peserta.course.conten', $id) }}">Konten</a>
                    </div>
                    <div class="col-2 info-active">
                        <a class="" href="#">Kuis</a>
                    </div>
                </div>
                @if (!empty($data_quiz_detail))
                <div class="container mt-5">
                    @if ($data_quiz_detail->jenis == 3)
                    <form action="{{ route('peserta.simpanquiz') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="jenis" value="{{ $data_quiz_detail->jenis }}">
                        <input type="hidden" name="course_id" value="{{ $id }}">
                        <input type="hidden" name="materi_id" value="{{ $materi }}">
                        <input type="hidden" name="quiz_detail_id" value="{{ $data_quiz_detail->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $presentasi_sudah }}%;" id="progressBar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <div class="circle-number"></div>
                                    </div>
                                </div>

                                <div id="quizForm">
                                    <!-- Step 1 -->
                                    <div class="quiz-step active-step" data-step="1">
                                        <div class="quiz-box mt-5 mb-5">
                                            <p>{{ $data_quiz_detail->pertanyaan }}</p>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row mb-5">
                                            <div class="col-md-6 mb-6" onclick="setJawaban('BENAR')">
                                                <div class="card h-100 card-clickable">
                                                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                        <h4>Benar</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-6" onclick="setJawaban('SALAH')">
                                                <div class="card h-100 card-clickable">
                                                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                        <h4>Salah</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="form-controll" type="hidden" name="jawaban" id="jawaban">

                                    <!-- Placeholder for other steps -->
                                    <!-- ... Steps 2-5 ... -->

                                    <!-- Navigation buttons -->
                                    <div class="row">
                                        <div class="col-5 d-flex justify-content-start">
                                            <button type="button" class="btn btn-secondary" onclick="navigate('previous')" disabled>Previous</button>
                                        </div>
                                        <div class="col-2 w-10 d-flex justify-content-center">
                                            <h3 id="waktu" style="color: #000">60</h3>
                                        </div>
                                        <div class="col-5 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" onclick="navigate('next')">Next</button>
                                            <button type="submit" id="btn_simpan_quiz" style="display: none"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                    @if ($data_quiz_detail->jenis == 2)
                    <form action="{{ route('peserta.simpanquiz') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="jenis" value="{{ $data_quiz_detail->jenis }}">
                        <input type="hidden" name="course_id" value="{{ $id }}">
                        <input type="hidden" name="materi_id" value="{{ $materi }}">
                        <input type="hidden" name="quiz_detail_id" value="{{ $data_quiz_detail->id }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $presentasi_sudah }}%;" id="progressBar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                        <div class="circle-number"></div>
                                    </div>
                                </div>

                                <div id="quizForm">
                                    <!-- Step 1 -->
                                    <div class="quiz-step active-step" data-step="1">
                                        <div class="quiz-box mt-5 mb-5">
                                            <p>{{ $data_quiz_detail->pertanyaan }}</p>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row mb-5">
                                            <div class="col-md-3 mb-3" onclick="setJawaban('A')">
                                                <div class="card h-100 card-clickable">
                                                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                        <h4>A.</h4>
                                                        <h5 class="card-title text-center">
                                                            {{ $data_quiz_detail->option1 }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3" onclick="setJawaban('B')">
                                                <div class="card h-100 card-clickable">
                                                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                        <h4>B.</h4>
                                                        <h5 class="card-title text-center">
                                                            {{ $data_quiz_detail->option2 }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3" onclick="setJawaban('C')">
                                                <div class="card h-100 card-clickable">
                                                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                        <h4>C.</h4>
                                                        <h5 class="card-title text-center">
                                                            {{ $data_quiz_detail->option3 }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3" onclick="setJawaban('D')">
                                                <div class="card h-100 card-clickable">
                                                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                                        <h4>D.</h4>
                                                        <h5 class="card-title text-center">
                                                            {{ $data_quiz_detail->option4 }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="form-controll" type="hidden" name="jawaban" id="jawaban">

                                    <!-- Placeholder for other steps -->
                                    <!-- ... Steps 2-5 ... -->

                                    <!-- Navigation buttons -->
                                    <div class="row">
                                        <div class="col-5 d-flex justify-content-start">
                                            <button type="button" class="btn btn-secondary" onclick="navigate('previous')" disabled>Previous</button>
                                        </div>
                                        <div class="col-2 w-10 d-flex justify-content-center">
                                            <h3 id="waktu" style="color: #000">60</h3>
                                        </div>
                                        <div class="col-5 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" onclick="navigate('next')">Next</button>
                                            <button type="submit" id="btn_simpan_quiz" style="display: none"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                @else
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <h3>Quis Sudah Selesai</h3>
                        </div>
                    </div>
                </div>

                @endif

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

                    .circle-number {
                        /* background-color: #fff;
                        color: #000;
                        border-radius: 50%;
                        width: 30px;
                        height: 30px;
                        text-align: center;
                        line-height: 30px;
                        display: inline-block;
                        border: 2px solid #3498db;
                        position: absolute;
                        z-index: 2; */
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
                </style>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="container mt-5">
                            <div class="row mb-5">
                                <div class="col-12 text-center">
                                    <h2>Pilih Jenis Kuis</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 card-clickable">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h5 class="card-title text-center">Short Answer</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 card-clickable">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h5 class="card-title text-center">True/False</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 card-clickable">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h5 class="card-title text-center">Drag/Drop</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 card-clickable">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h5 class="card-title text-center">Pairing</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 card-clickable">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h5 class="card-title text-center">Classification</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 card-clickable">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h5 class="card-title text-center">MCQ</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-primary btn-lg">Pilih Quiz</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        :root {
            /* set the sidebar width */
            --sidebar-width: 30vw;
        }

        body {
            overflow-x: hidden;
            background-color: #F5F7F8;
        }

        .w-sidebar {
            width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            top: 0;
            z-index: 1060;
        }

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

        .info-active {
            background-color: #2FD2DC;
            border-radius: 10px;
            color: black !important;
            padding: 5px;
        }

        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 10000;
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 57%;
            height: 67%;
        }

        /* The Close Button */
        .close {
            justify-content: end;
            display: flex;
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .card-clickable {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .card-clickable:hover,
        .card-clickable.selected {
            background-color: #FFFF00;
            /* Yellow background */
        }

        @media (max-width:768px) {

            .row.collapse,
            .row.collapsing {
                margin-left: 0 !important;
                left: 0 !important;
                overflow: visible;
            }

            .row>.sidebar.collapse {
                display: flex !important;
                margin-left: -100% !important;
                transition: all .3s ease;
                position: fixed;
                z-index: 1050;
                max-width: 0;
                min-width: 0;
                flex-basis: auto;
            }

            .row>.sidebar.collapse.show {
                margin-left: 0 !important;
                width: 100%;
                max-width: 100%;
                min-width: initial;
            }

            .row>.sidebar.collapsing {
                display: flex !important;
                margin-left: -10% !important;
                transition: all .3s ease !important;
                position: fixed;
                z-index: 1050;
                min-width: initial;
            }

        }
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
            var url = "{{ route('login.index') }}" + '?' + jQuery.param(params);

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

        function navigate(param) {
            /*var jawab = $("#jawaban").val();
            if (jawab == '') {
                alert('Silahkan Jawab');
                return false;
            }*/
            $("#btn_simpan_quiz").click();
        }

        function setJawaban(params) {
            $("#jawaban").val(params);
        }


        var waktu = 60;
        setInterval(function() {
            waktu--;
            if (waktu < 0) {
                $("#btn_simpan_quiz").click();
            } else {
                document.getElementById("waktu").innerHTML = waktu;
            }
        }, 1000);

        var modal = document.getElementById("myModal");

        var btn = document.getElementById("myBtn");

        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var cards = document.querySelectorAll('.card-clickable');

            cards.forEach(function(card) {
                card.addEventListener('click', function() {
                    cards.forEach(function(c) {
                        c.classList.remove('selected');
                    });

                    this.classList.add('selected');
                });
            });
        });
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
    <script>
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
        });
    </script>
</body>

</html>