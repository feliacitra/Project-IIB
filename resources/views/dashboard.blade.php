@extends('layouts.back.app')
@section('content')
    @if(Auth::user()->role == 2)
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
    </style>
    {{-- @dd($presentasi) --}}
    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Dashboard
        </p>
    </div>

    {{-- @dd($startup->presentationSchedule) --}}
    @if(isset($startup->presentationSchedule) && !isset($startup->presentationSchedule->presentationEvaluator))
    <div class="container-fluid mt-4">
        <div class="alert alert-warning text-dark" role="alert">
            <h6><i data-feather="alert-triangle"></i>Jadwal Presentasi</h6>
            <p class="mt-2" style="margin-left: 1.7rem">Presentasi akan dilakukan pada tanggal <span style="font-weight: 600">{{ $startup->presentationSchedule->ps_date->format('D M Y') }}</span>.</p>
            <p class="mt-2" style="margin-left: 1.7rem">Pukul {{ $startup->presentationSchedule->ps_timestart }} sampai {{ $startup->presentationSchedule->ps_timeend }}</p>
            @if($startup->presentationSchedule->ps_online == 1)
            <p class="mt-2" style="margin-left: 1.7rem">Dilakukan secara Online</p>
            <a class="mt-2" style="margin-left: 1.7rem; font-weight: 600" href="{{ $startup->presentationSchedule->ps_link }}">Link Meeting</a>
            @else
            <p class="mt-2" style="margin-left: 1.7rem">Dilakukan secara Offline di {{ $startup->presentationSchedule->ps_place }}</p>
            @endif
        </div>
    </div>
    @endif

    @if(isset($periode) && !isset($startup))
    <div class="container-fluid mt-4">
        <div class="alert alert-warning text-dark" role="alert">
            <h6><i data-feather="alert-triangle"></i>Info Pendaftaran Startup</h6>
            {{-- @dd($periode) --}}
            <p class="mt-2" style="margin-left: 1.7rem">Pendaftaran startup telah dibuka, batas akhir pendaftaran <span style="font-weight: 600">{{ $periode->mpe_enddate }}</span>.</p>
            <p class="mt-2" style="margin-left: 1.7rem">Ayo segera daftarkan startup anda!</p>

            <div class="text-center mt-4">
                {{-- @dd($status) --}}
                @if($status == 1 && !isset($startup))
                <a href="{{ route('startup.index') }}"><button class="btn btn-primary px-4">Daftar<i data-feather="send" class="m-0"></i></button></a>
                @endif
            </div>
        </div>
    </div>
    @elseif(!isset($startup))
    <div class="container-fluid mt-4">
        <div class="alert alert-warning text-dark" role="alert">
            <h6><i data-feather="alert-triangle"></i>Info Pendaftaran Startup</h6>
            {{-- @dd($periode) --}}
            <p class="mt-2" style="margin-left: 1.7rem">Pendaftaran telah ditutup untuk periode ini<span style="font-weight: 600"></span>.</p>
        </div>
    </div>
    @endif
    
    {{-- @dd($history); --}}
    @if(isset($startup) && $startup->masterPeriodeProgram->masterPeriode->mpe_status == 1 || $check == 1)
    @if($check == 1)
    @endif
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5>{{ $startup->ms_name }}</h5>
                        <p class="mt-2">Tanggal Daftar: {{ $startDate }}</p>
                    </div>
                    <div class="col">
                        {{-- @dd($startup) --}}
                        @if($startup->registationStatus[0]->srt_status == "Tidak Lulus")
                        <div class="alert alert-info text-dark" role="alert">
                            <h6><i data-feather="info"></i>Informasi</h6>
                            <p class="mt-2" style="margin-left: 1.7rem">Maaf kamu belum dapat mengikuti tahap seleksi selanjutnya.</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="progressbar-container">
                    <ul class="progressbar">
                        <li class="success">
                            <p>Daftar Startup</p>
                            <p class="date">{{ $startDate }}</p>
                            <div class="status success">LOLOS</div>
                        </li>
                        <li class="success">
                            <p>Seleksi Administrasi</p>
                            <p class="date">{{ $startDate }}</p>
                            <div class="status success">LOLOS</div>
                        </li>
                        @if($startup->registationStatus[0]->srt_status == "Tidak Lulus")
                        <li class="fail">
                            <p>Penilaian Desk Evaluation</p>
                            <p class="date">{{ $penilaianDate }}</p>
                            <div class="status fail">TIDAK LOLOS</div>
                        </li>
                        <li>
                            Presentasi
                        </li>
                        @elseif($startup->registationStatus[0]->srt_status == 'Lulus')
                        <li class="success">
                            <p>Penilaian Desk Evaluation</p>
                            <p class="date">{{ $penilaianDate }}</p>
                            <div class="status success">LOLOS</div>
                        </li>
                        @if(isset($startup->registationStatus[1]))
                            @if($startup->registationStatus[1]->srt_status == 'Lulus')
                                <li class="success">
                                    <p>Presentasi</p>
                                    <p class="date">{{ $presentasiDate->format('d-M-y') }}</p>
                                    <div class="status success">LOLOS</div>
                                </li>
                            @elseif($startup->registationStatus[1]->srt_status == 'Tidak Lulus')
                                <li class="fail" >
                                    <p>Presentasi</p>
                                    <p class="date">{{ $presentasiDate->format('d-M-y') }}</p>
                                    <div class="status fail">TIDAK LOLOS</div>
                                </li>
                            @endif
                        @else
                        <li class="" style="color:orange">
                            <p style="color: orange">Presentasi</p>
                            <div class="status" style="background-color: orange; color:white">Dalam Proses</div>
                        </li>
                        @endif
                        {{-- presentasi --}}
                        @else
                        <li class="" style="color:orange">
                            <p>Penilaian Desk Evaluation</p>
                            {{-- <p class="date">{{ $penilaianDate }}</p> --}}
                            <div class="status" style="background-color: orange; color:white">Dalam Proses</div>
                        </li>
                        <li>
                            Presentasi
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
    {{-- @endif --}}
@endsection
