<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning elevation-4" style="background-color: #444040">
    <!-- Brand Logo -->
    <div class="text-center">
        <a href="{{ url('/') }}" class="brand-link">
            <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
            <!--<img src="{{ asset('img/jperform-logo.png') }}" alt="Logo" class="" width="90%">-->
            ECG
            <!-- <span class="brand-text font-weight">{{ env('APP_NAME') }}</span>-->
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ url('/') }}" class="d-block">{{ \Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                id="mainMenuTreeview" data-accordion="true">
                <li class="nav-item">
                    <a href="{{ route('admin.beranda') }}"
                        class="nav-link {{ Route::is('admin.beranda') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-university"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('master*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('master*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('master.kategori.index') }}"
                                class="nav-link {{ Route::is('master.kategori.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('master.klasifikasi.index') }}"
                                class="nav-link {{ Route::is('master.klasifikasi.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Klasifikasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('user*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Users
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.instruktur') }}"
                                class="nav-link {{ Route::is('user.instruktur') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Instruktur</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.participant') }}"
                                class="nav-link {{ Route::is('user.participant') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Participant</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('courses*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{ route('courses.list') }}"
                        class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                        <i class="nav-icon mdi mdi-pine-tree"></i>
                        <p>Courses</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('payment*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{ route('payment.index') }}"
                        class="nav-link {{ request()->is('payment*') ? 'active' : '' }}">
                        <i class="nav-icon mdi mdi-wallet"></i>
                        <p>Payment</p>
                    </a>
                </li>
                <!--<li class="nav-item {{ request()->is('cms*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('cms*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-globe"></i>
                        <p>CMS
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('cms.banner.index') }}"
                                class="nav-link {{ Route::is('cms.banner.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cms.tentangkami') }}"
                                class="nav-link {{ Route::is('cms.tentangkami') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Tentang Kami</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cms.help') }}"
                                class="nav-link {{ Route::is('cms.help') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Pusat Bantuan</p>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!--<li class="nav-item {{ request()->is('courses*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('courses*') ? 'active' : '' }}">
                        <i class="nav-icon mdi mdi-wallet"></i>
                        <p>Courses
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('courses.list') }}"
                                class="nav-link {{ Route::is('courses.list') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('courses.module') }}"
                                class="nav-link {{ Route::is('courses.module') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Module</p>
                            </a>
                        </li>
                    </ul>
                </li>-->
           <!--     <li class="nav-item {{ request()->is('master*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('master*') ? 'active' : '' }}">
                        <i class="nav-icon mdi mdi-wallet"></i>
                        <p>Courses
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Route::is('instruktur.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Courses Listing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#erta.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Modules Listing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Route::is('peserta.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Quiz Listing</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->is('master*') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('master*') ? 'active' : '' }}">
                        <i class="nav-icon mdi mdi-wallet"></i>
                        <p>CMS
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Route::is('instruktur.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#
                                class="nav-link {{ Route::is('peserta.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>About</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Route::is('peserta.index') ? 'active' : '' }}">
                                <i class="mdi mdi-square-edit-outline nav-icon"></i>
                                <p>Help</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
               <!-- <li class="nav-item">
                    <a href="#"
                        class="nav-link {{ Route::is('treasury.index') ? 'active' : '' }}">
                        <i class="nav-icon mdi mdi-pine-tree"></i>
                        <p>Treasury</p>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a href="{{ route('logout.index') }}"
                        class="nav-link">
                        <i class="nav-icon mdi mdi-power"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
