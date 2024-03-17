<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a style="margin-left: 1rem;" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav text-right">
        <li class="nav-item">
            <img src="{{ asset('img/logorchadmin.png') }}" width="20%" />
        </li>
    </ul>
    
    <!-- Right navbar links -->
    <!--<ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('loggout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </li>
    </ul>
    <form id="loggout-form" action="{{ route('logout.index') }}" method="POST" style="display:none;">
        @csrf
    </form>-->
</nav>