@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data Titik</a></li>
                        <li class="breadcrumb-item active "><a href="#">Detail Titik</a></li>
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
                <table id="tableTitik" class="table table-striped" style="width:100%">
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
                                    <a class="btn-warning-sm" data-bs-toggle="modal" data-bs-target="#modalubahpesanan">Ubah
                                        Pesanan</a>
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

    <!-- Modal -->
    <div class="modal fade" id="modalubahpesanan" tabindex="-1" aria-labelledby="modalubahpesananLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalubahpesananLabel">Ubah Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="border-radius: 5px; border: 1px solid #eee; padding: 10px " class="mb-3">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <div>
                                    <span class="fw-bold ">Kota</span> <br>
                                    <span>Kota</span>
                                </div>
                                <div>
                                    <span class="fw-bold ">Alamat</span> <br>
                                    <span>Jalan A Yani, Manahan, Banjarsari, Surakarta, Jawa Tengah</span>
                                </div>
                            </div>
                            <div>
                                <span class="pill-bg disewa">disewa</span>
                            </div>
                        </div>
                    </div>

                    <form class="mb-3">

                        <div>
                            <label for="startDate">Disewa dari tanggal</label>
                            <input id="startDate" class="form-control" type="date" />
                            <span id="startDateSelected"></span>
                        </div>
                        <div>
                            <label for="endDate">Sampai tanggal</label>
                            <input id="endDate" class="form-control" type="date" />
                            <span id="endDateSelected"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script>
        new DataTable('#tableTitik');


        let startDate = document.getElementById('startDate')
        let endDate = document.getElementById('endDate')

        startDate.addEventListener('change', (e) => {
            let startDateVal = e.target.value
            document.getElementById('startDateSelected').innerText = startDateVal
        })

        endDate.addEventListener('change', (e) => {
            let endDateVal = e.target.value
            document.getElementById('endDateSelected').innerText = endDateVal
        })
    </script>
@endsection
