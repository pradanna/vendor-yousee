@extends('admin.base')

@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Profile</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada pertanyaan silahkan hubungi admin</span>
                </div>
            </div>


        </div>

        <div class="menu-container">
            <div class="menu">
                <div class="title-container">
                    <p class="title">Profile Anda</p>
                </div>

                <div class="row">
                    <input type="hidden" id="d-id" name="d-id">


                    <div class="col-md-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-namacv" name="p-namacv"
                                placeholder="Nama CV/PT" value="test">
                            <label for="p-namacv" class="form-label">Nama CV/PT</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-brand" name="p-brand" placeholder="Brand">
                            <label for="p-brand" class="form-label">Brand</label>
                        </div>
                    </div>
                </div>


                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="p-alamat" name="p-alamat" placeholder="alamat">
                    <label for="p-alamat" class="form-label">Alamat</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="p-email" name="p-email" placeholder="lokasi">
                    <label for="p-email" class="form-label">Email</label>
                </div>




                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-telpkantor" name="p-telpkantor"
                                placeholder="Nomor Telp. Kantor">
                            <label for="p-telpkantor" class="form-label">No. Telp Kantor</label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-pic" name="p-pic" placeholder="Nama PIC">
                            <label for="p-pic" class="form-label">Nama PIC</label>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="p-nomorpic" name="p-nomorpic"
                                placeholder="Nomor PIC">
                            <label for="p-nomorpic" class="form-label">Nomor PIC</label>
                        </div>
                    </div>

                    <button type="button" class="bt-primary m-2 ms-auto">Simpan Perubahan</button>
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
