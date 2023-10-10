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
            Lihat Jadwal Presentasi
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
                    <th scope="col" style="width: 12%">PERIODE</th>
                    <th scope="col" style="width: 15%">NAMA STARTUP</th>
                    <th scope="col" style="width: 12%">TEMPAT</th>
                    <th scope="col" style="width: 12%">TANGGAL</th>
                    <th scope="col" style="width: 12%">PUKUL</th>
                    <th scope="col" style="width: 12%">NILAI PRESENTASI</th>
                    <th scope="col" style="width: 10%">STATUS</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                @foreach($presentasi as $item)
                {{-- @dd($item->masterStartup->registationStatus->srt_status) --}}
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $item->masterPeriodeProgram->masterPeriode->mpe_name }}</td>
                    <td>{{ $item->masterStartup->ms_name }}</td>
                <td>{{ $item->ps_place }}</td>
                    <td class="text-center">{{ $item->ps_date->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $item->ps_timestart }} - {{ $item->ps_timeend }}</td>
                    @if(isset($item->presentationEvaluator))
                    <td class="text-center">{{ $item->presentationEvaluator->startupComponentStatus->scs_totalscore }}</td>
                    <td class="text-center">{{ $item->masterStartup->registationStatus[1]->srt_status }}</td>
                    @else
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    @endif
                    <td class="text-center action-icons">
                        <a href="{{route ('lihatnilaipresentasi', $item->ps_id)}}"><i data-feather="eye"></i></a>
                        <a href="{{route('editnilaipresentasi', $item->ps_id) }}"><i data-feather="edit-2"></i></a>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

@endsection