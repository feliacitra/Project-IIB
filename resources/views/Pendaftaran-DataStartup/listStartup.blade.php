@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
        .form-control{
            margin-bottom: .5rem;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Data Startup
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
                <option value="status1">AKTIF</option>
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
                    <th scope="col" style="width: 13%">PROGRAM INKUBASI</th>
                    <th scope="col" style="width: 13%">KATEGORI</th>
                    <th scope="col" style="width: 12%">TANGGAL MULAI</th>
                    <th scope="col" style="width: 12%">TANGGAL AKHIR</th>
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
                    <td class="text-center">10-11-2021</td>
                    <td class="text-center">10-11-2023</td>
                    <td class="text-center">AKTIF</td>
                    <td class="text-center">
                        <a href="{{route ('editdatastartup')}}"><i data-feather="eye"></i></a>
                        <a href="#edit"><i data-feather="edit-2"></i></a>
                    </td>
                </tr>
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

    {{--Edit--}}
    <div class="overlay" id="edit">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Data</h4>
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
                        <form action="" method="post" id="editForm">
                        @csrf 
                        @method('PUT')
                            <input type="text" class="form-control" id="namaPeriode" style="margin-top: 1rem" placeholder="Nama Periode" disabled>
                            <input type="text" class="form-control" id="namaProgram" placeholder="Nama Program" disabled>
                            <input type="text" class="form-control" id="namaStartup" placeholder="Nama Startup" disabled>

                            <select id="status" class="form-control form-select">
                                <option value="" class="text-muted">Status</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>

                            <input type="date" class="form-control" id="date" placeholder="Tanggal Akhir">

                            <div class="row mt-4">
                                <!--Button Perbarui -->
                                <div class="col">
                                    <button type="submit" id="saveEdit" class="btn btn-primary">
                                        Perbarui
                                    </button>
                                </div>
                                <!--Button Perbarui -->

                                <!--Button Kembali -->
                                <div class="col d-flex justify-content-end">
                                    <a href="#" class="button-link">
                                        Kembali
                                    </a>
                                </div>
                                <!--Button Kembali -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--Edit--}}
@endsection