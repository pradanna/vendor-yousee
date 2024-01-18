@extends('admin.base')

@section('content')
    <div class="dashboard">
        {{-- STATUS --}}
        <div class="status-container icon-circle">
            <div class="card-status color1">
                <div class="content">
                    <div class="stat">
                        <p class="title">Jumlah Titik</p>
                        <p class="val">580</p>
                    </div>

                    <div class="report">
                        <p> <span class="down">580</span> Titik anda yang tercatat.</p>
                    </div>
                </div>

                <div class="icon-container">
                    <span class="material-symbols-outlined">
                        assignment
                    </span>
                </div>
            </div>

            <div class="card-status color2">
                <div class="content">
                    <div class="stat">
                        <p class="title">Titik Masih Tersedia</p>
                        <p class="val">120</p>
                    </div>

                    <div class="report">
                        <p> <span class="down">120</span> Titik anda yang Masih Tersedia</p>
                    </div>
                </div>

                <div class="icon-container">
                    <span class="material-symbols-outlined">
                        event_available
                    </span>
                </div>
            </div>

            <div class="card-status color3">
                <div class="content">
                    <div class="stat">
                        <p class="title">Titik Perpakai</p>
                        <p class="val">460</p>
                    </div>

                    <div class="report">
                        <p> <span class="down">460</span> Titik yang sedang disewa.</p>
                    </div>
                </div>

                <div class="icon-container">
                    <span class="material-symbols-outlined">
                        cast
                    </span>
                </div>
            </div>


        </div>

        {{-- portfolio --}}
        <div class="menu-container">
            <div class="menu">
                <div class="title-container">
                    <p class="title">Portfolio</p>
                </div>

                <div class="portfolio-container">
                    <div class="portfolio">
                        <img
                            src="https://internal.yousee-indonesia.com/images/type/3b0b46f2-0974-11ed-8622-f538f29e0354.png" />
                        <div class="isi">
                            <p class="nama">Baliho</p>
                            <p class="jumlah">360 Titik</p>
                        </div>
                    </div>

                    <div class="portfolio">
                        <img
                            src="https://internal.yousee-indonesia.com/images/type/3b0b46f2-0974-11ed-8622-f538f29e0354.png" />
                        <div class="isi">
                            <p class="nama">Billboard</p>
                            <p class="jumlah">360 Titik</p>
                        </div>
                    </div>

                    <div class="portfolio">
                        <img
                            src="https://internal.yousee-indonesia.com/images/type/3b0b46f2-0974-11ed-8622-f538f29e0354.png" />
                        <div class="isi">
                            <p class="nama">Baliho</p>
                            <p class="jumlah">360 Titik</p>
                        </div>
                    </div>

                    <div class="portfolio">
                        <img
                            src="https://internal.yousee-indonesia.com/images/type/3b0b46f2-0974-11ed-8622-f538f29e0354.png" />
                        <div class="isi">
                            <p class="nama">Baliho</p>
                            <p class="jumlah">360 Titik</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Titik disewa --}}
        <div class="menu-container">
            <div class="menu">
                <div class="title-container">
                    <p class="title">Titik yang sedang disewa</p>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
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
                        <tr>
                            <td>Kota Surakarta</td>
                            <td>Jalan A Yani, Manahan, Banjarsari, Surakarta, Jawa Tengah</td>
                            <td>5</td>
                            <td>10</td>
                            <td>Billboard</td>
                            <td><span class="pill-bg disewa">disewa</span></td>
                            <td>16 Januari 2023 - 30 februari 2025</td>
                            <td>M<span class="d-flex gap-1"><a class="btn-primary-sm">Detail</a>
                                    <a class="btn-warning-sm">Ubah Pesanan</a></span>
                            </td>
                        </tr>

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
    </div>
@endsection

@section('morejs')
    <script>
        new DataTable('#example');
    </script>
@endsection
