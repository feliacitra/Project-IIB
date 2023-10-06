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
                    <th scope="col" style="width: 15%">NAMA PENGGUNA</th>
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
                {{-- @dd($member) --}}
                @foreach($member as $item)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $item->masterStartup->masterPeriodeProgram->masterPeriode->mpe_name }}</td>
                    <td>{{ $item->masterStartup->ms_name }}</td>
                    <td>{{ $item->mm_name }}</td>
                    <td>{{ $item->masterStartup->masterPeriodeProgram->masterProgramInkubasi->mpi_name }}</td>
                    <td>{{ $item->masterStartup->masterCategory->mc_name }}</td>
                    @if($item->masterStartup->registationStatus->srt_step >= 3)
                    <td class="text-center"><i data-feather="check"></i></td>
                    @else
                    <td class="text-center"><i data-feather="minus"></i></td>
                    @endif
                    <td class="text-center"><i data-feather="minus"></i></td>
                    @if($item->masterStartup->registationStatus->srt_status)
                    <td class="text-center">{{ $item->masterStartup->registationStatus->srt_status }}</td>
                    @else
                    <td class="text-center">-</td>
                    @endif
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="{{ route('pendaftar.show', $item->mm_id) }}"><i data-feather="eye"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->
@endsection