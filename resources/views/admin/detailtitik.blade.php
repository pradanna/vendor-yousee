@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item active "><a href="#">Data Titik</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada titik yang belum tercatat di system, silahkan hubungi admin</span>
                </div>
            </div>


        </div>

        <div class="menu-container">
            <div class="menu">
                <div class="title-container">
                    <p class="title">Data Titik Anda</p>
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
                            <td><span class="d-flex gap-1"><a class="btn-primary-sm">Detail</a>
                                    <a class="btn-warning-sm">Ubah Pesanan</a>
                                </span>
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
