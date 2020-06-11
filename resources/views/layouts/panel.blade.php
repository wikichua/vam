<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Vue Admin Manager') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                    class="fas fa-bars"></i></button>

            <div class="d-none d-md-inline-block ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <ul class="navbar-nav ml-auto ml-md-0 right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fas fa-user fa-fw"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            {{-- <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                            <div class="dropdown-divider"></div> --}}
                            <router-link :to="{ name: 'profile.edit' }" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i>Profile
                            </router-link>
                            <router-link :to="{ name: 'profile.editPassword' }" class="dropdown-item">
                                <i class="fas fa-lock mr-2"></i>Change Password
                            </router-link>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i
                                    class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <sidebar user-name="hello world"></sidebar>
                            {{-- user-name="hello world" this is just testing to pass the props to the vue component --}}
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ auth()->user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <transition>
                        <router-view></router-view>
                    </transition>
                    <vue-progress-bar></vue-progress-bar>
                </main>
                @include('vam::layouts.footer')
            </div>
        </div>
    </div>
    <script>
        @auth
        window.Permissions = @json(auth()->user()->allPermissions());
        window.Settings = @json(app(config('vam.models.setting'))->getAllSettings());
      @else
        window.Permissions = [];
        window.Settings = [];
      @endauth
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    {{-- <script src="//use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script> --}}
</body>

</html>
