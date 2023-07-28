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
            Dashboard
        </p>
    </div>

    <div class="container-fluid mt-4">
        <div class="alert alert-warning text-dark" role="alert">
            <h6><i data-feather="alert-triangle"></i>Info Pendaftaran Startup</h6>
            <p class="mt-2" style="margin-left: 1.7rem">Pendaftaran startup telah dibuka, batas akhir pendaftaran <span style="font-weight: 600">31 Juli 2023</span>.</p>
            <p class="mt-2" style="margin-left: 1.7rem">Ayo segera daftarkan startup anda!</p>

            <div class="text-center mt-4">
                <a href="{{ route('daftar') }}"><button class="btn btn-primary px-4">Daftar<i data-feather="send" class="m-0"></i></button></a>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5>GoShop (Nama Startup)</h5>
                        <p class="mt-2">Tanggal Daftar: 31-03-2022</p>
                    </div>
                    <div class="col">
                        <div class="alert alert-info text-dark" role="alert">
                            <h6><i data-feather="info"></i>Informasi</h6>
                            <p class="mt-2" style="margin-left: 1.7rem">Maaf kamu belum dapat mengikuti tahap seleksi selanjutnya.</p>
                        </div>
                    </div>
                </div>

                <div class="progressbar-container">
                    <ul class="progressbar">
                        <li class="success">
                            <p>Daftar Startup</p>
                            <p class="date">26 Juni 2023</p>
                            <div class="status success">LOLOS</div>
                        </li>
                        <li class="success">
                            <p>Seleksi Administrasi</p>
                            <p class="date">27 Juni 2023</p>
                            <div class="status success">LOLOS</div>
                        </li>
                        <li class="fail">
                            <p>Penilaian Desk Evaluation</p>
                            <p class="date">28 Juni 2023</p>
                            <div class="status fail">TIDAK LOLOS</div>
                        </li>
                        <li>
                            Presentasi
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
