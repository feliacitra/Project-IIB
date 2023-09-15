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
    {{-- @dd($component) --}}

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            <a href="{{ route('penilaianDE') }}">Penilaian Desk Evaluation</a>&nbsp;> Lihat Nilai
        </p>
    </div>

    <div class="container-fluid py-4 px-4" style="height: 100%">
        <div class="row">
            <div class="col">
                <div class="info-pair">
                    <p class="info-label">Periode</p>
                    <p class="info-value">: {{ $component->masterPeriodeProgram->masterPeriode->mpe_name }}</p>
                </div>
                <div class="info-pair mt-2">
                    <p class="info-label">Nama Startup</p>
                    <p class="info-value">: {{ $component->ms_name }}</p>
                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="info-pair">
                    <p class="info-label">Program Inkubasi</p>
                    <p class="info-value">: {{ $component->masterPeriodeProgram->masterProgramInkubasi->mpi_name }}</p>
                </div>
                <div class="info-pair mt-2">
                    <p class="info-label">Kategori</p>
                    <p class="info-value">: {{ $component->masterCategory->mc_name }}</p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <form action="">
                <h5 class="text-center mt-4">Penilaian Desk Evaluation</h5>
                <div class="card">
                    @foreach($question as $questIdx => $q)
                    <div class="card-body">
                        <p>{{ $q->mq_question }}</p>
                        <div class="radio mt-2">
                            @foreach($q->questionRange as $index => $qr)
                            <input type="radio" disabled id="{{ $qr->mqr_id }}" name="answer[{{ $loop->parent->index }}]" value="{{ $qr->mqr_id }}" {{ ($qr->mqr_id == $component->startupComponentStatus->registationAnswer[$questIdx]->mqr_id) ? "checked" : "" }}>
                            <label for="{{ $qr->mqr_id }}">{{ $qr->mqr_description }}</label>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                {{-- @dd($component) --}}
                <h5 class="text-center mt-4">NILAI AKHIR: {{$component->startupComponentStatus->scs_totalscore}}</h5>
                
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <label for="catatanTambahan" class="col col-md-2">Catatan Tambahan</label>
                            <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4" disabled>{{ $component->startupComponentStatus->scs_notes }}</textarea>
                        </div>
                        @if($component->registationStatus->srt_status == "Lulus")
                        <div class="radio mt-4">
                            <input type="radio" id="lulus" name="kelulusan" value="Lulus" checked disabled>
                            <label for="lulus">Lulus</label>

                            <input type="radio" id="tidakLulus" name="kelulusan" value="Tidak Lulus" disabled>
                            <label for="tidakLulus">Tidak Lulus</label>
                        </div>
                        @else
                        <div class="radio mt-4">
                            <input type="radio" id="lulus" name="kelulusan" value="Lulus" disabled>
                            <label for="lulus">Lulus</label>
                            
                            <input type="radio" id="tidakLulus" name="kelulusan" value="Tidak Lulus" checked disabled>
                            <label for="tidakLulus">Tidak Lulus</label>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="text-center inner-bottom-button">
                    <a href="{{route ('penilaianDE')}}" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection