@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
        .action-icons a + a {
            margin-left: 3px;
        }
        .form-group{
            margin-top: 1rem;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Unduh dan Unggah Berkas
        </p>
    </div>

    <div class="row mt-4">
        <div class="col-4 col-md-3 col-lg-2">
            <select name="pilihPeriode" id="periode" class="form-control form-select">
                <option value="select" class="text-muted">Periode</option>
                <option value="th2022">Tahun 2022</option>
            </select>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <select name="pilihStatus" id="periode" class="form-control form-select">
                <option value="select" class="text-muted">Status</option>
                <option value="status1">On Progress</option>
            </select>
        </div>

        <div class="col d-flex justify-content-end">
            <div class="pb-2">
                <!-- Search Bar -->
                <div class="input-group rounded">
                    <!-- Input Form -->
                    <form action="" class="position-relative">
                        <input type="search" class="form-control rounded" placeholder="Cari" aria-label="Search" aria-describedby="search-addon" style="width: 350px; padding-left: 2.5rem">
                        <span class="position-absolute" style="top: 50%; left: 0.5rem; transform: translateY(-50%);">
                            <i data-feather="search"></i>
                        </span>
                    </form>
                    <!-- Input Form -->
                </div>
                <!-- Search Bar -->
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="table-responsive-md">
        <table class="table">
            <!-- Table Head -->
            <thead class="text-center" style="background-color: #f5f5f5">
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col">PERIODE</th>
                    <th scope="col">NAMA STARTUP</th>
                    <th scope="col">PROGRAM INKUBASI</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col" style="width: 11%">PKS</th>
                    <th scope="col" style="width: 11%">SK</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>Tahun 2022</td>
                    <td>GoShop</td>
                    <td>FJIP</td>
                    <td>SmartTech</td>
                    <td class="text-center action-icons">
                        <a href="#editPKS"><i data-feather="edit-2"></i></a>
                        <a href="" download="filename"><i data-feather="download"></i></a>
                        <a href="#deleteBerkas"><i data-feather="trash-2"></i></a>
                    </td>
                    <td class="text-center action-icons">
                        <a href="#editSK"><i data-feather="edit-2"></i></a>
                        <a href="" download="filename"><i data-feather="download"></i></a>
                        <a href="#deleteBerkas"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>

                <tr>
                    <th scope="row" class="text-center">2</th>
                    <td>Tahun 2022</td>
                    <td>EXample</td>
                    <td>BTPIP</td>
                    <td>SmartTech</td>
                    <td class="text-center action-icons">
                        <a href="#uploadPKS"><i data-feather="upload"></i></a>
                    </td>
                    <td class="text-center action-icons">
                        <a href="#uploadSK"><i data-feather="upload"></i></a>
                    </td>
                </tr>
            </tbody>
            <!-- Table Body -->
        </table>

        {{-- EDIT PKS --}}
        <div class="overlay" id="editPKS">
            <div class="wrapper" style="width: 25%">
                <div class="row align-items-center">
                    <div class="col col-lg-9 col-md-8">
                        <h4>Edit PKS</h4>
                    </div>
                    <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>

                <div class="content">
                    <form action="#" method="" id="">
                        <div class="input-group-lg rounded my-4">
                            {{--
                            <a href="#" class="text-center" style="display: flex; flex-direction: column; align-items: center; gap: 5px; text-align: center;">
                                <i data-feather="file"></i>
                                Nama File
                            </a>
                            --}}
                            <input type="file" class="form-control" id="pks" name="pks">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <button type="submit" id="delete" class="btn btn-primary" style="width: 50%">
                                    Simpan
                                </button>
                            </div>
            
                            <div class="col d-flex justify-content-end">
                                <a href="#" class="btn btn-secondary button-link px-0" style="width: 50%">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- EDIT PKS --}}

        {{-- EDIT SK --}}
        <div class="overlay" id="editSK">
            <div class="wrapper" style="width: 25%">
                <div class="row align-items-center">
                    <div class="col col-lg-9 col-md-8">
                        <h4>Edit SK</h4>
                    </div>
                    <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>

                <div class="content">
                    <form action="#" method="" id="">
                        <div class="input-group-lg rounded my-4">
                            <input type="file" class="form-control" id="sk" name="sk">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <button type="submit" id="delete" class="btn btn-primary" style="width: 50%">
                                    Simpan
                                </button>
                            </div>
            
                            <div class="col d-flex justify-content-end">
                                <a href="#" class="btn btn-secondary button-link px-0" style="width: 50%">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- EDIT SK --}}

        {{-- UPLOAD PKS --}}
        <div class="overlay" id="uploadPKS">
            <div class="wrapper" style="width: 25%">
                <div class="row align-items-center">
                    <div class="col col-lg-9 col-md-8">
                        <h4>Upload PKS</h4>
                    </div>
                    <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>

                <div class="content">
                    <form action="#" method="" id="">
                        <div class="input-group-lg rounded my-4">
                            <input type="file" class="form-control" id="sk" name="sk">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <button type="submit" id="delete" class="btn btn-primary" style="width: 50%">
                                    Simpan
                                </button>
                            </div>
            
                            <div class="col d-flex justify-content-end">
                                <a href="#" class="btn btn-secondary button-link px-0" style="width: 50%">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- UPLOAD PKS --}}

        {{-- UPLOAD SK --}}
        <div class="overlay" id="uploadSK">
            <div class="wrapper" style="width: 25%">
                <div class="row align-items-center">
                    <div class="col col-lg-9 col-md-8">
                        <h4>Upload SK</h4>
                    </div>
                    <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                        <a href="#" class="close">&times;</a>
                    </div>
                </div>

                <div class="content">
                    <form action="#" method="" id="">
                        <div class="input-group-lg rounded my-4">
                            <input type="file" class="form-control" id="sk" name="sk">
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <button type="submit" id="delete" class="btn btn-primary" style="width: 50%">
                                    Simpan
                                </button>
                            </div>
            
                            <div class="col d-flex justify-content-end">
                                <a href="#" class="btn btn-secondary button-link px-0" style="width: 50%">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- UPLOAD SK --}}

        {{-- DELETE --}}
        <div class="overlay" id="deleteBerkas">
            <div class="wrapper" style="width: 25%">
                <form action="#" method="" id="">
                    @csrf
                    @method('DELETE')
                    <div class="content">
                        <p class="text-center">
                            Hapus berkas?
                        </p>
        
                        <input type="hidden" name="_method" value="DELETE">
        
                        <div class="row mt-4">
                            <!--Button Ya -->
                            <div class="col">
                                <button type="submit" id="delete" class="btn btn-primary" style="width: 50%">
                                    Ya
                                </button>
                            </div>
                            <!--Button Ya -->
        
                            <!--Button Tidak -->
                            <div class="col d-flex justify-content-end">
                                <a href="#" class="button-link text-center" style="width: 50%">Tidak</a>
                            </div>
                            <!--Button Tidak -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- DELETE --}}
    </div>
    <!-- Users Table -->

@endsection