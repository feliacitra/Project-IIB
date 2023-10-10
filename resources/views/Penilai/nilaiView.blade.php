@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
        .container-fluid{
            background-color: #ffffff;
            border-radius: 4px;
            border: 1px solid lightgrey;
            position: relative;
        }
        .inner-bottom-button {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .card{
            margin-top:1rem;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            <a href="{{ route('lihatjadwalpresentasi') }}">Lihat Jadwal Presentasi</a>&nbsp;> Lihat Nilai
        </p>
    </div>

    <div class="container-fluid py-4 px-4" style="height: 100%">
        <div class="row">
            <div class="col">
                <div class="info-pair">
                    <p class="info-label">Periode</p>
                    <p class="info-value">: {{ $presentasi->masterPeriodeProgram->masterPeriode->mpe_name }}</p>
                </div>
                <div class="info-pair mt-2">
                    <p class="info-label">Nama Startup</p>
                    <p class="info-value">: {{ $presentasi->masterStartup->ms_name }}</p>
                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="info-pair">
                    <p class="info-label">Program Inkubasi</p>
                    <p class="info-value">: {{ $presentasi->masterPeriodeProgram->masterProgramInkubasi->mpi_name }}</p>
                </div>
                <div class="info-pair mt-2">
                    <p class="info-label">Kategori</p>
                    <p class="info-value">: {{ $presentasi->masterStartup->masterCategory->mc_name }}</p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <form action="">
                <h5 class="text-center mt-4">Penilaian Presentasi</h5>
                <div class="card">
                    {{-- @dd($componentDesk) --}}
                    @foreach($componentDesk->question as $questIdx => $q)
                    <div class="card-body">
                        <p>{{ $q->mq_question }}</p>
                        <div class="radio mt-2">
                            @foreach($q->questionRange as $index => $qr)
                            @if(isset($mqDesk[2]))
                            <input type="radio" disabled id="{{ $qr->mqr_id }}" name="deskAnswer[{{ $loop->parent->index }}]" value="{{ $qr->mqr_id }}" {{ ($qr->mqr_id == $mqDesk[2]->registationAnswer[$questIdx]->mqr_id) ? "checked" : "" }}>
                            @else
                            <input type="radio" disabled id="{{ $qr->mqr_id }}" name="deskAnswer[{{ $loop->parent->index }}]" value="{{ $qr->mqr_id }}">
                            @endif
                            <label for="{{ $qr->mqr_id }}">{{ $qr->mqr_description }}</label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if(isset($mqDesk[2]))
                <h5 class="text-center mt-4">NILAI AKHIR: - {{ $mqDesk[2]->scs_totalscore }}</h5>
                @else
                <h5 class="text-center mt-4">NILAI AKHIR: -  </h5>
                @endif
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <label for="catatanTambahan" class="col col-md-2">Catatan Tambahan</label>
                            @if(isset($mqDesk[2]))
                            <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4" disabled>{{ $mqDesk[2]->scs_notes }}</textarea>
                            @else
                            <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4" disabled></textarea>
                            @endif
                        </div>

                        <div class="radio mt-4">
                            @if(isset($presentasi->masterStartup->registationStatus[1]))
                                @if($presentasi->masterStartup->registationStatus[1]->srt_status == 'Lulus')
                                    <input type="radio" id="lulus" name="kelulusan" value="Lulus" disabled checked>
                                    <label for="lulus">Lulus</label>
                                    <input type="radio" id="tidakLulus" name="kelulusan" disabled value="Tidak Lulus">
                                    <label for="tidakLulus">Tidak Lulus</label>
                                @else
                                    <input type="radio" id="lulus" name="kelulusan" disabled value="Lulus">
                                    <label for="lulus">Lulus</label>
                                    <input type="radio" id="tidakLulus" name="kelulusan" disabled value="Tidak Lulus" checked>
                                    <label for="tidakLulus">Tidak Lulus</label>
                                @endif
                            @else
                            <input type="radio" id="lulus" name="kelulusan" value="Lulus" disabled>
                            <label for="lulus">Lulus</label>
                            <input type="radio" id="tidakLulus" name="kelulusan" disabled value="Tidak Lulus">
                            <label for="tidakLulus">Tidak Lulus</label>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-center inner-bottom-button">
                    <a href="{{route ('lihatjadwalpresentasi')}}" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection