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
            margin-left: 10px;
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
            Kelola Jadwal Presentasi
        </p>
    </div>

    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#createJadwal" class="button btn-primary">
            <button id="openAddPresentasi   " class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
                <i data-feather="plus" style="margin-right: 0.3rem;"></i>
                TAMBAH
            </button>
        </a>
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
                    <th scope="col" style="width: 12%">PERIODE</th>
                    <th scope="col" style="width: 15%">NAMA STARTUP</th>
                    <th scope="col" style="width: 12%">PROGRAM INKUBASI</th>
                    <th scope="col" style="width: 12%">TEMPAT</th>
                    <th scope="col" style="width: 12%">TANGGAL</th>
                    <th scope="col" style="width: 12%">PUKUL</th>
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
                    <td>Gd. A</td>
                    <td class="text-center">03 Maret 2022</td>
                    <td class="text-center">08:00-09:00</td>
                    <td class="text-center">LULUS</td>
                    <td class="text-center action-icons">
                        <a href="#viewJadwal"><i data-feather="eye"></i></a>
                        <a href="#createJadwal"><i data-feather="edit-2"></i></a>
                    </td>
                </tr>
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

    {{-- POP UP TAMBAH/EDIT --}}
    <div class="overlay" id="createJadwal">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Jadwal Presentasi</h4>
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
                        <form action ="" method="post">
                        @csrf
                            <div class="form-group row align-items-center">
                                <label for="periode" class="col-sm-3">Nama Periode</label>
                                <div class="col-sm-9">
                                    <select id="periode" class="form-control form-select" >
                                        <option value="" class="text-muted"></option>
                                        @foreach($periode as $per)
                                            <option value="{{ $per->mpe_id }}">{{ $per->mpe_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  

                            <div class="form-group row align-items-center">
                                <label for="startup" class="col-sm-3">Nama Startup</label>
                                <div class="col-sm-9">
                                    <select id="startup" class="form-control form-select">
                                        <option value="" class="text-muted"></option>
                                        @foreach($startup as $start)
                                            <option value="{{ $start->ms_id }}">{{ $start->ms_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="penilai" class="col-sm-3">Penilai</label>
                                <div class="col-sm-9">
                                    <select id="penilai" class="form-control form-select">
                                        <option value="" class="text-muted"></option>
                                        @foreach($user as $penilai)
                                            <option value="{{ $penilai->id }}">{{ $penilai->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="date" class="col-sm-3">Tanggal</label>
                                <div class="col-sm-9">
                                    <input type="date" name="date" id="date" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="time" class="col-sm-3">Pukul</label>
                                <div class="col-sm-9">
                                    <div class="d-flex align-items-center">
                                        <input type="time" name="time" id="timeFrom" class="form-control">
                                        <span class="mx-4">s.d.</span>
                                        <input type="time" name="time" id="timeTo" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="radio" class="col-sm-3">Online</label>
                                <div class="col-sm-9 radio">
                                    <input type="radio" id="iya" name="online" value="Iya">
                                    <label for="iya">Iya</label>
            
                                    <input type="radio" id="tidak" name="online" value="Tidak">
                                    <label for="tidak">Tidak</label>
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="tempat" class="col-sm-3">Tempat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Tempat">
                                </div>
                            </div>

                            <div class="form-group row align-items-center">
                                <label for="link" class="col-sm-3">Link</label>
                                <div class="col-sm-9">
                                    <input type="url" name="link" id="link" class="form-control" placeholder="Link">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button type="submit" id="simpan" class="btn btn-primary">
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

    {{-- POP UP VIEW --}}
    <div class="overlay" id="viewJadwal">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Jadwal Presentasi</h4>
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
                        <div class="form-group row align-items-center">
                            <label for="periode" class="col-sm-3">Nama Periode</label>
                            <div class="col-sm-9">
                                <select id="periode" class="form-control form-select" disabled>
                                    <option value="" class="text-muted">Nama Periode</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>  

                        <div class="form-group row align-items-center">
                            <label for="startup" class="col-sm-3">Nama Startup</label>
                            <div class="col-sm-9">
                                <select id="startup" class="form-control form-select" disabled>
                                    <option value="" class="text-muted">Nama Startup</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="penilai" class="col-sm-3">Penilai</label>
                            <div class="col-sm-9">
                                <select id="penilai" class="form-control form-select" disabled>
                                    <option value="" class="text-muted">Penilai</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="date" class="col-sm-3">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="date" name="date" id="date" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="time" class="col-sm-3">Pukul</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <input type="time" name="time" id="timeFrom" class="form-control" disabled>
                                    <span class="mx-4">s.d.</span>
                                    <input type="time" name="time" id="timeTo" class="form-control" disabled>
                                </div>
                            </div>
                         </div>

                        <div class="form-group row align-items-center">
                            <label for="radio" class="col-sm-3">Online</label>
                            <div class="col-sm-9 radio">
                                <input type="radio" id="iya" name="online" value="Iya" disabled>
                                <label for="iya">Iya</label>
        
                                <input type="radio" id="tidak" name="online" value="Tidak" disabled>
                                <label for="tidak">Tidak</label>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tempat" class="col-sm-3">Tempat</label>
                            <div class="col-sm-9">
                                <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Tempat" disabled>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="link" class="col-sm-3">Link</label>
                            <div class="col-sm-9">
                                <input type="url" name="link" id="link" class="form-control" placeholder="Link" disabled>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col d-flex justify-content-end">
                                <a href="#" class="button-link">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection