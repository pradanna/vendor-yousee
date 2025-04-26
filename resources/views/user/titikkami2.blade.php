@extends('user.base')

@section('morecss')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <style>
        .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container .select2-selection--single {
            height: 36px !important;
            border: 1px solid #ddd;
        }

        .select2-selection__arrow {
            height: 36px !important;
        }

        /*.leaflet-container {*/
        /*    height: 400px;*/
        /*    width: 600px;*/
        /*    max-width: 100%;*/
        /*    max-height: 100%;*/
        /*}*/
        #map {
            height: 500px;
            width: 100%
        }

        #main-map {
            height: 500px;
            width: 100%
        }

        #single-map-container {
            height: 450px;
            width: 50%
        }

        .marker-position {
            top: -25px;
            left: 0;
            position: relative;
            color: aqua;
            font-weight: bold;
        }
    </style>


    <script src="{{ asset('js/map-control4.js?v=3') }}"></script>
@endsection
@section('content')
    <div class="g-hero">
        <div class="hero-text">
            {{-- <img src="{{ asset('images/local/carititik' . (app()->getLocale() === 'en' ? '_engver' : '') . '.png') }}"
                class="img-titikseluruhindonesia" /> --}}
        </div>
        <div class="pencarian-container peta" style="margin-top: 0 !important">
            <div class="pencarian-content w-100">
                <div class="pencarian-wrapper ">
                    <p class="title">{{ trans('Tersedia Titik diseluruh Indonesia') }}</p>
                    <!-- Progress Bar dan Pesan Loading -->
                    <div id="loading" class="loading-overlay" style="display: none;">
                        <div class="progress-container">
                            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                style="height: 20px; width: 250px;">
                                0%
                            </div>
                            <p class="loading-text mt-2">{{ trans('Mohon Tunggu Sebentar') }}</p>
                        </div>
                    </div>

                    <div>

                        <div class="d-flex justify-content-center ">
                            <a class="btn-utama mb-3 mt-3" href="#" role="button" id="dropSearch"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ trans('Cari Billboard disini') }}
                                <i class="material-symbols-outlined menu-icon ms-2 text-white">search</i>
                            </a>

                            <ul id="dropSearchList" class="dropdown-menu custom" aria-labelledby="dropSearch">
                                <div class="filter-panel">
                                    <div class="form-group">
                                        <label for="f-provinsi" class="form-label">{{ trans('provinsi') }}</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="f-provinsi"
                                            name="f-provinsi">
                                            <option selected value="">
                                                {{ trans('semua_provinsi') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="f-kota" class="form-label">{{ trans('kota') }}</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="f-kota"
                                            name="f-kota">
                                            <option selected value="">{{ trans('semua_kota') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="f-tipe" class="form-label">{{ trans('tipe') }}</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="f-tipe"
                                            name="f-tipe">
                                            <option selected value="">{{ trans('semua_tipe') }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="f-posisi" class="form-label">{{ trans('.posisi') }}</label>
                                        <select class="form-select mb-3" aria-label="Default select example" id="f-posisi"
                                            name="f-posisi">
                                            <option selected value="">{{ trans('semua_posisi') }}
                                            </option>
                                            <option value="Horizontal">Horizontal</option>
                                            <option value="Vertical">Vertical</option>
                                        </select>
                                    </div>

                                </div>
                            </ul>

                        </div>
                    </div>
                    <div class="mb-2 pillsearch" id="pillSearch">
                        {{-- <span id="pillProvince" class="badge bg-primary " style="border-radius: 200px; align-items: center"><span id="text" class="text">asdasd</span>  <a role="button"><i class="material-symbols-outlined" style="font-size: 12px">close</i></a></span> --}}

                    </div>


                    {{-- @include('admin.map', ['data' => 'content']) --}}
                    <div id="main-map" style="width: 100%; height: 500px; height: calc(100vh - 70px)"></div>

                    <!-- Modal -->
                    @include('user.item-modal')

                </div>

                <div class="mx-4">
                    <p style="text-align: left" class="fw-bold mt-3"> {{ trans('keterangan') }} :</p>
                    <div class="row">
                        @foreach ($type as $d)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6 mb-3" style="text-align: left">
                                <img src="{{ $dom . $d->icon }}" />
                                <span class="ms-3"> {{ $d->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



        </div>

    </div>

    <p class="title-content text-center"> Titik Kami</p>
    <div class="section-description ">
        <p>Kami bangga memiliki jaringan yang luas diseluruh Indonesia
        </p>


    </div>
    <div class="w-100">
        <div class="list-titik">

            {{-- @foreach ($titik as $d)
            <a class="card-article" href="/listing/{{ $d->slug }}">

                <img src="{{ $dom . $d->image2 }}" />
                <div
                    style="position: absolute; top: 50%; right: 0; transform: translateY(-50%); background-color: green; padding: 2px 10px; border-radius: 5px 0 0 5px; font-size: 0.8rem; color: white;">
                    {{ $titik[0]->type->name }}</div>
                <div class="article-content">
                    <div class="article-wrapper">
                        <p class="title mt-2"> {{ $d->city->province->name }}</p>
                        <p class="time">{{ $d->city->name }}</p>
                        <p class="alamat">{{ $d->address }}</p>
                        <hr>


                    </div>
                </div>
            </a>
        @endforeach --}}



        </div>
    </div>
    <div id="list-container"></div>
    <div id="pagination"></div>

    {{-- <div class="d-flex justify-content-center mt-4">
        {{ $titik->links() }}
    </div> --}}
@endsection

@section('morejs')
    <script>
        var slideUp = {
            distance: '50%',
            origin: 'bottom',
            delay: 300,
        };
        document.addEventListener('DOMContentLoaded', function() {
            ScrollReveal().reveal('.list-titik', slideUp);
            ScrollReveal().reveal('.g-hero', slideUp);
            // Tambahkan lebih banyak elemen sesuai kebutuhan
        });
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&v=weekly"
        async></script>
    {{--    <script src="{{ asset('js/number_formater.js') }}"></script> --}}
    <script src="{{ asset('js/currency.js') }}"></script>

    {{--    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" --}}
    {{--            integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" --}}
    {{--            crossorigin=""></script> --}}

    {{-- @include('admin.map', ['data' => 'script']) --}}

    {{-- <script src="{{ asset('js/map-control.js') }}"></script> --}}
    <script src="{{ asset('js/item3.js?v=5') }}"></script>

    <script>
        $("#simple-modal-detail").on("shown.bs.modal", function() {

        });
        // datatableItem();
        getSelect('f-provinsi', '/data/province', 'name', 's_provinsi', window.translations.semua_provinsi);
        getSelect('f-kota', '/data/city', 'name', 's_kota', window.translations.semua_kota);
        getSelect('f-tipe', '/data/type', 'name', 's_tipe', window.translations.semua_tipe);
        // getSelect('f-posisi', '/data/position', 'name', 'posisi', "All Position");


        setImgDropify('image1');
        setImgDropify('image2');
        setImgDropify('image3');
        saveItem();
        currency('height');
        currency('width');
        $('#province').select2({
            dropdownParent: $("#modaltambahtitik")
        });
        $('#city').select2({
            dropdownParent: $("#modaltambahtitik")
        });

        $('#vendor').select2({
            dropdownParent: $("#modaltambahtitik")
        });
    </script>

    <script>
        $(document).ready(function() {

            let t_posisi = localStorage.getItem('t_posisi');
            let t_tipe = localStorage.getItem('t_tipe');
            let t_kota = localStorage.getItem('t_kota');
            let t_provinsi = localStorage.getItem('t_provinsi');

            if (t_posisi !== null && t_posisi !== 'null' && t_posisi.trim() !== '') {
                pillSearch("posisi", t_posisi);
            }
            if (t_tipe !== null && t_tipe !== 'null' && t_tipe.trim() !== '') {
                pillSearch("tipe", t_tipe);
            }
            if (t_kota !== null && t_kota !== 'null' && t_kota.trim() !== '') {
                pillSearch("kota", t_kota);
            }
            if (t_provinsi !== null && t_provinsi !== 'null' && t_provinsi.trim() !== '') {
                pillSearch("provinsi", t_provinsi);
            }
        });
    </script>
@endsection
