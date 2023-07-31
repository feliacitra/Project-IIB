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
            Master Komponen Penilaian
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addData" class="button btn-primary">
            <button id="openAdd" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
                <i data-feather="plus" style="margin-right: 0.3rem;"></i>
                TAMBAH
            </button>
        </a>
    </div>
    <!-- Button Tambah -->

    <div class="row">
        <div class="col-4 col-md-3 col-lg-2">
            <select name="pilihPeriode" id="periode" class="form-control form-select">
                <option value="select" class="text-muted">Periode</option>
                @foreach ($periode as $item)
                    <option value="{{ $item->mpe_id }}">{{ $item->mpe_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <select name="pilihPeriode" id="periode" class="form-control form-select">
                <option value="select" class="text-muted">Program Inkubasi</option>
                @foreach ($programInkubasi as $item)
                    <option value="{{ $item->mpi_id }}">{{ $item->mpi_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-4 col-md-3 col-lg-2">
            <select name="pilihPeriode" id="periode" class="form-control form-select">
                <option value="select" class="text-muted">Tahap Seleksi</option>
                <option value="assess">Self Assessment</option>
                <option value="present">Presentasi</option>
                <option value="eval">Desk Evaluation</option>
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
                    <th scope="col" style="width: 20%">PERIODE</th>
                    <th scope="col" style="width: 30%">PROGRAM INKUBASI</th>
                    <th scope="col" style="width: 35%">TAHAP</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                @foreach ($components as $item)
                    <tr>
                        <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                        <td>{{ $item->periodeProgram->masterPeriode->mpe_name }}</td>
                        <td>{{ $item->periodeProgram->masterProgramInkubasi->mpi_name }}</td>
                        @if ($item->mct_step == 1)
                            <td>Self Assessment</td>
                        @elseif ($item->mct_step == 2)
                            <td>Presentasi</td>
                        @else
                            <td>Desk Evaluation</td>
                        @endif
                        <td class="text-center">
                            <!-- VIEW -->
                            <a href="{{ route('viewComponent') }}/{{ $item->mct_id}}"><i data-feather="eye"></i></a>
                            <!-- EDIT -->
                            <a href="{{ route('editComponent') }}"><i data-feather="plus-circle"></i></a>
                            <!-- DELETE -->
                            <a href="#deletePeriod"><i data-feather="trash-2"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

<!-- POP-UP TAMBAH & DELETE -->
    <!-- TAMBAH -->
    <div class="overlay" id="addData">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Data</h4>
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
                        <form method="POST" action="{{ route('penilaian.store') }}">
                            @csrf
                            <!-- Nama Periode -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Nama Periode</label>
                                <div class="col-sm-8">
                                    <select name="pilihNamaPeriode" id="namaPeriode" class="form-control form-select">
                                        <option value="select" class="text-muted">Nama Periode</option>
                                        @foreach ($periode as $item)
                                            <option value="{{ $item->mpe_id }}">{{ $item->mpe_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Nama Periode -->

                            <!-- Program Inkubasi -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Program Inkubasi</label>
                                <div class="col-sm-8">
                                    <select name="pilihProgramInkubasi" id="programInkubasi" class="form-control form-select">
                                        <option value="select" class="text-muted">Program Inkubasi</option>
                                        @foreach ($programInkubasi as $item)
                                            <option value="{{ $item->mpi_id }}">{{ $item->mpi_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Program Inkubasi -->

                            <!-- Tahapan Seleksi -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="namaPeriode" class="col-sm-4">Tahapan Seleksi</label>
                                <div class="col-sm-8">
                                    <select name="pilihTahapanSeleksi" id="tahapanSeleksi" class="form-control form-select">
                                        <option value="select" class="text-muted">Tahapan Seleksi</option>
                                        <option value="1">Self Assessment</option>
                                        <option value="2">Presentasi</option>
                                        <option value="3">Desk Evaluation</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Tahapan Seleksi -->

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button id="simpanTambah" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                                <!--Button Simpan -->

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
    <!-- TAMBAH -->
    

    <!-- DELETE -->
    <div class="overlay" id="deletePeriod">
        <div class="wrapper" style="width: 25%">
            <div class="content">
                <p class="text-center">
                    Hapus komponen penilaian?
                </p>

                <div class="row mt-4">
                    <!--Button Ya -->
                    <div class="col">
                        <button id="delete" class="btn btn-primary" style="width: 50%">
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
        </div>
    </div>
    <!-- DELETE -->
@endsection