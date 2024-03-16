<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin || Genos Template</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('images/local/favicon.ico') }}" title="Favicon" />

    {{-- BOOTSTRAP --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- CSS --}}
    <link href="{{ asset('css/admin-genosstyle.css') }}" rel="stylesheet" />

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap"
        rel="stylesheet">


    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />


    {{-- ICON --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    @yield('css')
</head>

<body>


    <div class="d-flex admin ">
        {{-- SIDEBAR --}}
        <div class="sidebar ">
            <div class="logo-container">
                <img class="company-logos" src="{{ asset('images/local/logo-yousee-panjang.png') }}" alt="img-logo" />
                <img class="company-logos-minimize" src="{{ asset('images/local/logo-yousee.png') }}" alt="img-logo" />
            </div>
            <div class="menu-container">
                <ul>
                    <li>
                        <a class=" menu {{ request()->is('dashboard') ? 'active' : '' }} tooltip"
                            href="{{ route('dashboard') }}"><span class="material-symbols-outlined">
                                dashboard
                            </span>
                            <span class="text-menu"> Beranda</span>
                            <span class="tooltiptext">Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu tooltip {{ request()->is('titik-iklan') ? 'active' : '' }}"
                            href="{{ route('item') }}">
                            <span class="material-symbols-outlined">
                                desktop_windows
                            </span>
                            <span class="text-menu"> Data Titik</span>
                            <span class="tooltiptext">Data Titik</span>
                        </a>
                    </li>


                    <li>
                        <a class="menu tooltip {{ Request::is('profile') ? 'active' : '' }}"
                            href="{{ route('profile') }}"><span class="material-symbols-outlined">
                                account_circle
                            </span>
                            <span class="text-menu"> Profile</span>
                            <span class="tooltiptext">Profile</span>
                        </a>
                    </li>

                </ul>

                <div class="footer">
                    <p class="top">Login Sebagai</p>
                    <p class="bot">Admin</p>
                </div>
            </div>
        </div>
        {{-- BODY --}}
        <div class="gen-body  ">

            {{-- BOTTOMBAR --}}
            <div class="bottombar">
                <a href="{{ route('dashboard') }}"
                    class="nav-button {{ request()->is('dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined ">
                        dashboard
                    </span>
                    <span class="text-menu"> Beranda</span>
                </a>
                <a href="{{ route('item') }}" class="nav-button {{ request()->is('titik-iklan') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">
                        desktop_windows
                    </span>
                    <span class="text-menu"> Data Titik</span>
                </a>

                <a href="{{ route('profile') }}" class="nav-button {{ Request::is('profile') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">
                        account_circle
                    </span>
                    <span class="text-menu"> Profile</span>
                </a>

            </div>
            {{-- NAVBAR --}}
            <div class="gen-nav">
                <div class="start">
                    <a class="nav-button">
                        <span class="iconfwd material-symbols-outlined">
                            arrow_forward
                        </span>
                        <span class="iconback material-symbols-outlined">
                            arrow_back
                        </span>
                    </a>
                </div>
                <div class="end">


                    <div class="dropdown">

                        <div class="profile-button">
                            <div class="content">

                                <a id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img
                                        src="https://static.vecteezy.com/system/resources/previews/000/420/940/original/avatar-icon-vector-illustration.jpg" />
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <p class="user">{{ auth()->user()->name }}</p>
                                    <p class="email">{{ auth()->user()->email }}</p>
                                    <hr>
                                    <a class="logout" href="{{ route('logout') }}">Logout</a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            {{-- CONTENT --}}

            <div class="gen-content">
                @yield('content')
            </div>

            <div class="bottom-mobile">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script src="{{ asset('js/admin-genosstyle.js') }}"></script>

    @yield('morejs')

</body>

</html>
