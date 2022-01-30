<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ISW Portfolios') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/ot.css') }}" rel="stylesheet">
</head>
<body class="shop">
    <div id="app" style="height:100vh; height: -webkit-fill-available;overflow-x: auto;overflow-y: hidden;">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'ISW Portfolios') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('users/') }}">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('roles/') }}">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('pages/') }}">Pages</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} • <span class="ml-2 badge badge-primary"><b>{{ auth()->user()->role->name }}</b> </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            <div class="flex-shrink-0 p-3 bg-white" style="width: 20%;float: left;">
                <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-5 fw-semibold">Admin panel</span>
                </a>
                <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Home
                    </button>
                    <div class="collapse show" id="home-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">Overview</a></li>
                        <li><a href="#" class="link-dark rounded">Updates</a></li>
                        <li><a href="#" class="link-dark rounded">Reports</a></li>
                    </ul>
                    </div>
                </li>
                <li class="mb-1" style="padding: 0.375rem 0.75rem;"><a href="/admin/users/">Users</a></li>
                <li class="mb-1" style="padding: 0.375rem 0.75rem;"><a href="/admin/roles/">Roles</a></li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                    Dashboard
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">Overview</a></li>
                        <li><a href="#" class="link-dark rounded">Weekly</a></li>
                        <li><a href="#" class="link-dark rounded">Monthly</a></li>
                        <li><a href="#" class="link-dark rounded">Annually</a></li>
                    </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Orders
                    </button>
                    <div class="collapse" id="orders-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">New</a></li>
                        <li><a href="#" class="link-dark rounded">Processed</a></li>
                        <li><a href="#" class="link-dark rounded">Shipped</a></li>
                        <li><a href="#" class="link-dark rounded">Returned</a></li>
                    </ul>
                    </div>
                </li>
                <li class="border-top my-3"></li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                    </button>
                    <div class="collapse" id="account-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">New...</a></li>
                        <li><a href="#" class="link-dark rounded">Profile</a></li>
                        <li><a href="#" class="link-dark rounded">Settings</a></li>
                        <li><a href="#" class="link-dark rounded">Sign out</a></li>
                    </ul>
                    </div>
                </li>
                </ul>
            </div>
            <main class="" style="
                                overflow-x: auto;
                                overflow-y: hidden;
                                float: right;
                                width: 80%;">
                @yield('content')
            </main>
        </section>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>-->
</body>
</html>
