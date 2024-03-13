@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between notification">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data Titik</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center ">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada titik yang belum tercatat di system, silahkan hubungi admin</span>
                </div>
            </div>


        </div>

        <div class="menu-container table-titik">
            <div class="menu overflow-hidden">
                <div class="title-container">
                    <p class="title">Data Titik Anda</p>
                </div>
                <table id="tableTitik" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Area</th>
                            <th>Alamat</th>
                            <th>Panjang / Tinggi</th>
                            <th>lebar</th>
                            <th>type</th>
                            <th>Status</th>
                            {{-- status: sedang disewa / akan disewa / tersedia --}}
                            <th>disewa tanggal</th>
                            {{-- diisi jika status sedang disewa / nullable --}}
                            <th>Action</th>
                            {{-- detail, ubah status pesanan --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{--                        <tr> --}}
                        {{--                            <td>Kota Surakarta</td> --}}
                        {{--                            <td>Jalan A Yani, Manahan, Banjarsari, Surakarta, Jawa Tengah</td> --}}
                        {{--                            <td>5</td> --}}
                        {{--                            <td>10</td> --}}
                        {{--                            <td>Billboard</td> --}}
                        {{--                            <td><span class="pill-bg disewa">disewa</span></td> --}}
                        {{--                            <td>16 Januari 2023 - 30 februari 2025</td> --}}
                        {{--                            <td><span class="d-flex gap-1"><a class="btn-primary-sm" data-bs-toggle="modal" --}}
                        {{--                                        data-bs-target="#modaldetail">Detail</a> --}}
                        {{--                                    <a class="btn-warning-sm" data-bs-toggle="modal" data-bs-target="#modalubahpesanan">Ubah --}}
                        {{--                                        Pesanan</a> --}}
                        {{--                                </span> --}}
                        {{--                            </td> --}}
                        {{--                        </tr> --}}

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Area</th>
                            <th>Alamat</th>
                            <th>Panjang / Tinggi</th>
                            <th>lebar</th>
                            <th>type</th>
                            <th>Status</th>
                            {{-- status: sedang disewa / akan disewa / tersedia --}}
                            <th>disewa tanggal</th>
                            {{-- diisi jika status sedang disewa / nullable --}}
                            <th>
                                Action
                            </th>
                            {{-- detail, ubah status pesanan --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="card-container">
            <div class="search-wrapper">
                <div class="search-field">
                    <span class="material-symbols-outlined text-grey">
                        search
                    </span>
                    <input type="text" placeholder="Pencarian Titik" id="txt-search" />

                </div>
                <div class="filter-wrapper">
                    <select class="filter" aria-label="Default select example">
                        <option selected>Kota</option>
                        <option value="1">Surakarta</option>
                        <option value="2">Jakarta</option>
                        <option value="3">Bali</option>
                    </select>
                    <select class="filter" aria-label="Default select example">
                        <option selected>Status Sewa</option>
                        <option value="1">Tersedia</option>
                        <option value="2">Disewa</option>
                        <option value="3">Akan Disewa</option>
                    </select>
                    <select class="filter" aria-label="Default select example">
                        <option selected>Jenis Iklan</option>
                        <option value="1">Billboard</option>
                        <option value="2">Videotron</option>
                        <option value="3">Baliho</option>
                    </select>
                </div>
            </div>
            <div id="result-wrapper" class="w-100 row">
            </div>
        </div>


    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalubahpesanan" tabindex="-1" aria-labelledby="modalubahpesananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalubahpesananLabel">Tanggal Pemakaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="txt-id" value="">
                    {{--                    <div style="border-radius: 5px; border: 1px solid #eee; padding: 10px " class="mb-3"> --}}
                    {{--                        <div class="d-flex justify-content-between "> --}}
                    {{--                            <div class="info-titik"> --}}
                    {{--                                <div class="mb-2"> --}}
                    {{--                                    <span class="title">Kota</span> <br> --}}
                    {{--                                    <span id="lbl-city">-</span> --}}
                    {{--                                </div> --}}
                    {{--                                <div> --}}
                    {{--                                    <span class="title">Alamat</span> <br> --}}
                    {{--                                    <span id="lbl-address">-</span> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                            <div> --}}
                    {{--                                <span class="pill-bg disewa" id="lbl-status">Kosong</span> --}}
                    {{--                            </div> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}

                    <form class="mb-3">
                        {{--                        <div class="mb-3"> --}}
                        {{--                            <label for="startDate" class="label-input">Disewa dari tanggal</label> --}}
                        {{--                            <input id="startDate" class="form-control" type="date"/> --}}
                        {{--                            <span id="startDateSelected"></span> --}}
                        {{--                        </div> --}}
                        <div class="mb-3">
                            <label for="endDate" class="label-input">Sampai tanggal</label>
                            <input id="endDate" class="form-control" type="date" />
                            {{--                            <span id="endDateSelected"></span> --}}
                        </div>
                        <div>
                            <a href="#" id="btn-save-order" class="bt-primary full">Submit</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="modaldetail" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Titik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul class="nav nav-pills mb-3" id="pills-tab-detail" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link genostab active" id="pills-detail-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-detail" type="button" role="tab" aria-controls="pills-detail"
                                aria-selected="true">Detail
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link genostab" id="pills-maps-tab-detail" data-bs-toggle="pill"
                                data-bs-target="#pills-maps" type="button" role="tab" aria-controls="pills-maps"
                                aria-selected="false">Maps
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link genostab" id="pills-gambar1-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-gambar1" type="button" role="tab"
                                aria-controls="pills-gambar1" aria-selected="false">Gambar
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-detail" role="tabpanel"
                            aria-labelledby="pills-detail-tab">
                            <div class="row">
                                <input type="hidden" id="d-id" name="d-id">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-provinsi" name="d-provinsi"
                                            readonly placeholder="Provinsi" value="test">
                                        <label for="d-provinsi" class="form-label">Provinsi</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-kota" name="d-kota"
                                            readonly placeholder="Kota">
                                        <label for="d-kota" class="form-label">Kota</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="d-alamat" name="d-alamat" readonly
                                    placeholder="alamat">
                                <label for="d-alamat" class="form-label">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="d-lokasi" name="d-lokasi" readonly
                                    placeholder="lokasi">
                                <label for="d-lokasi" class="form-label">Lokasi</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="d-urlstreetview" name="d-urlstreetview"
                                    readonly placeholder="urlstreetview">
                                <label for="d-urlstreetview" class="form-label">URL Street View</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-tipe" name="d-tipe"
                                            readonly placeholder="tipe">
                                        <label for="d-tipe" class="form-label">Tipe</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-posisi" name="d-posisi"
                                            readonly placeholder="posisi">
                                        <label for="d-posisi" class="form-label">Posisi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-panjang" readonly
                                            name="d-panjang" placeholder="0">
                                        <label for="d-panjang" class="form-label">Panjang/Tinggi</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-lebar" name="d-lebar"
                                            readonly placeholder="0">
                                        <label for="d-lebar" class="form-label">Lebar</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-sisi" readonly
                                            name="d-sisi" placeholder="0">
                                        <label for="d-sisi" class="form-label">Sisi</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="d-trafik" name="d-trafik"
                                            readonly placeholder="0">
                                        <label for="d-trafik" class="form-label">Trafik</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-maps" role="tabpanel" aria-labelledby="pills-maps-tab">
                            <div class="panel-peta mb-3" id="map-detail">
                                <div class="maps" id="main-map">
                                </div>
                                <div class="street" id="streetview-wrapper">
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="pills-gambar1" role="tabpanel"
                            aria-labelledby="pills-gambar1-tab">
                            <div class="panel-gambar">
                                <img src="" alt="item-image" id="vendor-image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <script src="{{ asset('js/map-control.js?v=2') }}"></script>
    <style>
        .table-titik {
            display: none !important;
        }

        .card-container {
            display: block !important;
            cursor: pointer;
        }
    </style>
@endsection
@section('morejs')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&v=weekly"
        async></script>
    <script src="{{ asset('/js/item-control.js') }}"></script>
    <script>
        var itemPath = '/{{ request()->path() }}';
        var table;
        // var modalChangeOrder = new bootstrap.Modal(document.getElementById('modalubahpesanan'));
        // var modalDetail = new bootstrap.Modal(document.getElementById('modaldetail'));

        function generateTable() {
            table = $('#tableTitik').DataTable({
                paging: true,
                processing: true,
                "aaSorting": [],
                "order": [],
                scrollX: true,
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function(d) {
                        // d.area = $('#area').val();
                        // d.name = $('#name').val();
                    }
                },
                responsive: true,
                columns: [{
                        data: 'city.name',
                        name: 'city.name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'height',
                        name: 'height'
                    },
                    {
                        data: 'width',
                        name: 'width'
                    },
                    {
                        data: 'type.name',
                        name: 'type.name',
                    }, {
                        data: null,
                        render: function(data) {

                            if (data['rent'] !== null) {
                                let dateStart = new Date(data['rent']['start']);
                                let dateEnd = new Date(data['rent']['end']);
                                let now = new Date();
                                if (now > dateStart && now < dateEnd) {
                                    return '<span class="pill-disewa">Disewa</span>';
                                }

                                if (now < dateStart) {
                                    return '<span class="pill-akandisewa">Akan disewa</span>';
                                }
                            }
                            return '<span class="pill-tersedia">Tersedia</span>';
                        }
                    }, {
                        data: null,
                        render: function(data) {
                            if (data['rent'] !== null) {
                                let dateStart = new Date(data['rent']['start']);
                                let dateEnd = new Date(data['rent']['end']);
                                let dateStartString = dateStart.toLocaleString('id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: '2-digit'
                                });
                                let dateEndString = dateEnd.toLocaleString('id-ID', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: '2-digit'
                                });
                                return dateStartString + '-' + dateEndString;
                            }
                            return '-'
                        }
                    }, {
                        data: null,
                        render: function(data) {
                            const id = data['id'];
                            return '<span class="d-flex gap-1">' +
                                '<a class="btn-primary-sm btn-detail" data-id="' + id + '">Detail</a>' +
                                '<a href="#" class="btn-danger-sm btn-change-order" data-id="' + id +
                                '">Disewa</a>\n' +
                                '<a href="#" class="btn-warning-sm btn-change-order" data-id="' + id +
                                '">Akan Disewa</a>\n' +
                                '<a href="#" class="btn-success-sm btn-change-order" data-id="' + id +
                                '">Tersedia</a>\n' +
                                '</span>'
                        }
                    },
                ],
                "fnDrawCallback": function() {
                    changeOrderEvent();
                    showDetailEvent();
                }
            });
        }

        let startDate = document.getElementById('startDate')
        let endDate = document.getElementById('endDate')

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });



        $(document).ready(function() {
            // generateTable();
            // saveOrderEvent();
            getItemsData();
            saveOrderEvent();
            eventSearchHandler();
        });
    </script>
@endsection
