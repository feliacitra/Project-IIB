@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Data Pendaftar
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
                    <th scope="col" style="width: 10%">PERIODE</th>
                    <th scope="col" style="width: 15%">NAMA STARTUP</th>
                    <th scope="col" style="width: 15%">PROGRAM INKUBASI</th>
                    <th scope="col" style="width: 15%">KATEGORI</th>
                    <th scope="col" style="width: 10%">DESK EVALUATION</th>
                    <th scope="col" style="width: 10%">PRESENTASI</th>
                    <th scope="col" style="width: 10%">STATUS</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>Tahun 2022</td>
                    <td>GoShop</td>
                    <td>BTPIP</td>
                    <td>SmartTech</td>
                    <td class="text-center"><i data-feather="check"></i></td>
                    <td class="text-center"><i data-feather="minus"></i></td>
                    <td class="text-center">On Progress</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewData"><i data-feather="eye"></i></a>
                    </td>
                </tr>
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

<!-- POP-UP VIEW-->
    <div class="overlay" id="viewData">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Data</h4>
                </div>
                <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                    <!-- X button -->
                    <a href="#" class="close">&times;</a>
                    <!-- X button -->
                </div>
            </div>
            <div class="content">
                <div class="container-fluid p-0">
                    <div class="input-group-lg rounded">
                        <form>
                            <!-- Nama Periode -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Periode</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="Tahun 2022" disabled>
                                </div>
                            </div>
                            <!-- Nama Periode -->

                            <!-- Nama Startup -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Nama Startup</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="GoShop" disabled>
                                </div>
                            </div>
                            <!-- Nama Startup -->

                            <!-- Program Inkubasi -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Program Inkubasi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="BTPIP" disabled>
                                </div>
                            </div>
                            <!-- Program Inkubasi -->

                            <!-- Kategori -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Kategori</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="SmartTech" disabled>
                                </div>
                            </div>
                            <!-- Kategori -->

                            <!-- DE -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Desk Evaluation</label>
                                <div class="col-sm-8">
                                    <i data-feather="check"></i>
                                </div>
                            </div>
                            <!-- DE -->

                            <!-- Presentasi -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Presentasi</label>
                                <div class="col-sm-8">
                                    <i data-feather="minus"></i>
                                </div>
                            </div>
                            <!-- Presentasi -->

                            <!-- Status -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Status</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="On Progress" disabled>
                                </div>
                            </div>
                            <!-- Status -->
                            
                            <div class="row mt-4">
                                <!--Button Kembali -->
                                <div class="col d-flex justify-content-end">
                                    <a href="#" class="button-link">Kembali</a>
                                </div>
                                <!--Button Kembali -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- VIEW -->
@endsection