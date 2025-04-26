<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Yousee Indonesia || Sewa Billboard, Media Iklan</title>

    @yield('header')


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://unpkg.com/scrollreveal@4.0.9/dist/scrollreveal.js"></script>
    {{-- BOOTSTRAP --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- CSS --}}
    <link href="{{ asset('css/genosstyle.v.06.css?v=1.5.1') }}" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@400;500;700;800&display=swap"
        rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />


    {{-- ICON --}}


    {{-- SWEEET ALERT --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css"
        integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('morecss')


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16906346745"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-16906346745');
    </script>
</head>

<body>


    <!-- List Keranjang yang Expand dari Kanan -->


    <nav class="text-center mt-5 mb-3">
        <a href="/titik-kami">
            <img src="{{ asset('images/local/logo-yousee-panjang.png') }}" class="img-fluid"
                style="max-width: 200px;" />
        </a>
    </nav>



    @yield('content')

    {{-- ONE TIME --}}
    <div class="onetime-services">

        {{--
        <div class="content">

            <p class="title"> {{ trans('messages.dapatkan_harga_sewa') }}
            </p>
            <p class="text">{{ trans('messages.dapatkan_harga_sewa_description') }}</p>
            <a class="btn-pasangiklan"
                href="https://api.whatsapp.com/send?phone={{ preg_replace('/^0/', '62', $profiles[0]->whatsapp) }}&text=Halo%2C%20Yousee-indonesia.com"
                target="_blank">
                {{ trans('messages.dapatkan_harga_sewa_button') }}
            </a>
        </div>

        <img class="imagefooter2" src="{{ asset('images/local/footerimage3.png') }}" /> --}}


    </div>


    {{-- <footer class="footer">
        <div class="row gx-3 ">
            <div class="col-lg-4 col-sm-12 ">
                <img class="footer-logo" src="{{ asset('images/local/logo-yousee2.png') }}" />

                <p class="footer-tag">{{ trans('messages.pasang_iklan_seluruh_indonesia') }}</p>
            </div>
            <div class="col-lg-4 col-sm-12">
                <p class="header">Contact Us</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/home-address.png') }}" /></span>{{ $profiles[0]->head_office_address }}
                </p>
                <p class="text"> <span style="min-width: 50px"></span>{{ $profiles[0]->address }}</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/phone.png') }}" /></span>{{ $profiles[0]->phone }}</p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/whatsapp.png') }}" /></span><a class="d-block"
                        style="color: grey;"
                        href="https://api.whatsapp.com/send?phone={{ preg_replace('/^0/', '62', $profiles[0]->whatsapp) }}&text=Halo%2C%20Yousee-indonesia.com"
                        target="_blank">
                        {{ preg_replace('/^0/', '62', $profiles[0]->whatsapp) }}</a>
                </p>
                <p class="text"><span><img class="icon-text"
                            src="{{ asset('images/local/icon/email.png') }}" /></span>{{ $profiles[0]->email }}
                </p>
            </div>

            <div class="col-lg-4 col-sm-12">
                <p class="header">Social Media</p>
                <div class="g-nav-social d-flex ">
                    <a href="{{ $profiles[0]->instagram }}" target="_blank">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="1.5" width="20" height="20">
                            <defs>
                                <style>
                                    .cls-637b8512f95e86b59c57a11c-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }

                                    .cls-637b8512f95e86b59c57a11c-2 {
                                        fill: currentColor;
                                    }
                                </style>
                            </defs>
                            <rect class="cls-637b8512f95e86b59c57a11c-1" x="1.5" y="1.5" width="21" height="21"
                                rx="3.82"></rect>
                            <circle class="cls-637b8512f95e86b59c57a11c-1" cx="12" cy="12" r="4.77">
                            </circle>
                            <circle class="cls-637b8512f95e86b59c57a11c-2" cx="18.2" cy="5.8" r="1.43">
                            </circle>
                        </svg>
                    </a>
                    <a href="{{ $profiles[0]->facebook }}" target="_blank">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            stroke-width="1.5" width="20" height="20">
                            <defs>
                                <style>
                                    .cls-637b8512f95e86b59c57a116-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }
                                </style>
                            </defs>
                            <path class="cls-637b8512f95e86b59c57a116-1"
                                d="M17.73,6.27V1.5h-1A7.64,7.64,0,0,0,9.14,9.14v.95H6.27v3.82H9.14V22.5h4.77V13.91h2.86V10.09H13.91V9.14a2.86,2.86,0,0,1,2.86-2.87Z">
                            </path>
                        </svg></a>
                    <a href="{{ $profiles[0]->tiktok }}" target="_blank">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke-width="1.5" width="20" height="20">
                            <defs>
                                <style>
                                    .cls-637b8512f95e86b59c57a137-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }
                                </style>
                            </defs>
                            <path class="cls-637b8512f95e86b59c57a137-1"
                                d="M12.94,1.61V15.78a2.83,2.83,0,0,1-2.83,2.83h0a2.83,2.83,0,0,1-2.83-2.83h0a2.84,2.84,0,0,1,2.83-2.84h0V9.17h0A6.61,6.61,0,0,0,3.5,15.78h0a6.61,6.61,0,0,0,6.61,6.61h0a6.61,6.61,0,0,0,6.61-6.61V9.17l.2.1a8.08,8.08,0,0,0,3.58.84h0V6.33l-.11,0a4.84,4.84,0,0,1-3.67-4.7H12.94Z">
                            </path>
                        </svg>
                    </a>

                    <a href="https://www.youtube.com/@Yousee-Indonesia-Official" target="_blank">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke-width="1.5" width="30" height="20">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: none;
                                        stroke: currentColor;
                                        stroke-miterlimit: 10;
                                    }

                                    .cls-2 {
                                        fill: currentColor;
                                    }
                                </style>
                            </defs>
                            <!-- Kotak dasar dengan sudut melengkung -->
                            <rect class="cls-1" x="1.5" y="1.5" width="21" height="21" rx="3.82">
                            </rect>
                            <!-- Segitiga simbol play -->
                            <polygon class="cls-2" points="10 8 16 12 10 16 10 8"></polygon>
                        </svg>

                    </a>
                </div>
            </div>

        </div>
        <hr>
        <div class="d-flex justify-content-between  ">
            <p>
                © 2025 PT SUKMA SETIAWAN INDONESIA - Yousee Indonesia
            </p>


        </div>
    </footer> --}}

    <script>
        window.translations = {
            tanya_ketersediaan_titik: @json(trans('tanya ketersediaan titik')),
            keranjang_kosong: @json(trans('keranjang kosong')),
            semua_provinsi: @json(trans('semua provinsi')),
            semua_kota: @json(trans('semua kota')),
            semua_tipe: @json(trans('semua tipe')),
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('css/dropify/js/dropify.js') }}"></script>
    <script src="{{ asset('js/wookmark.js') }}"></script>
    <script src="{{ asset('js/dialog.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ambil locale dari URL atau localStorage
            var currentLang = getLocaleFromURL() || localStorage.getItem("lang") || "id";
            updateSelectedLang(currentLang);

            // Klik untuk menampilkan dropdown bahasa (tidak bentrok dengan Bootstrap)
            $(".lang-dropdown").click(function(event) {
                $(".lang-dropdown-menu").toggle();
                event.stopPropagation();
            });

            // Klik opsi bahasa
            $(".lang-dropdown-menu div").click(function() {
                var selectedLang = $(this).attr("data-lang");
                updateSelectedLang(selectedLang);
                localStorage.setItem("lang", selectedLang);
                $(".lang-dropdown-menu").hide();
                updateURLLocale(selectedLang);
            });

            // Klik di luar dropdown untuk menutup
            $(document).click(function() {
                $(".lang-dropdown-menu").hide();
            });

            // Fungsi update tampilan teks
            function updateSelectedLang(lang) {
                var langText = lang === "id" ? "ID" : "EN";
                $(".selected-lang").text(langText);
            }

            // Fungsi ambil locale dari URL
            function getLocaleFromURL() {
                var path = window.location.pathname.split('/');
                return (path[1] === "id" || path[1] === "en") ? path[1] : null;
            }

            // Fungsi update locale di URL tanpa double
            function updateURLLocale(lang) {
                var pathArray = window.location.pathname.split('/');
                if (pathArray[1] === "id" || pathArray[1] === "en") {
                    pathArray[1] = lang;
                } else {
                    pathArray.splice(1, 0, lang);
                }

                var newPath = pathArray.join('/');
                var newURL = window.location.origin + newPath;
                window.location.href = newURL;
            }
        });
    </script>



    @yield('morejs')
</body>

</html>
