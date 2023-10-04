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
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            <a href="{{ route('master.penilaian') }}">Master Komponen Penilaian</a>&nbsp;> Kelola Komponen
        </p>
    </div>

    <div class="container-fluid py-4 px-4" style="height: 100%">
        <div class="row">
            {{-- @dd($component) --}}
            <p class="col">Periode: {{ $component->periodeProgram->masterPeriode->mpe_name }}</p>
            @if ($component->mct_step == 1)
                <td>Tahap: Self Assessment</td>
            @elseif ($component->mct_step == 2)
                <td>Tahap: Presentasi</td>
            @else
                <td>Tahap: Desk Evaluation</td>
            @endif
            <p class="col">Program Inkubasi: {{ $component->periodeProgram->masterProgramInkubasi->mpi_name }}</p>
        </div>

        <div class="form-group">
            <div id="cardContainer">
                @foreach($component->question as $question)
                <div class="card mt-2">
                    <div class="card-body">
                        <input type="text" class="form-control" id="pertanyaan" placeholder="{{ $question->mq_question }}" disabled>

                        <div class="table-responsive-md mt-2">
                            <table class="table">
                                <!-- Table Head -->
                                <thead class="text-center" style="background-color: #f5f5f5">
                                    <tr>
                                        <th scope="col" style="width: 5%;">#</th>
                                        <th scope="col" style="width: 75%">JAWABAN</th>
                                        <th scope="col" style="width: 15%">NILAI</th>
                                        <th scope="col" style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <!-- Table Head -->
    
                                <!-- Table Body INSERT-->
                                <div id="tableContainer">
                                    <tbody>
                                        @foreach($question->questionRange as $qr)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Jawaban" value="{{ $qr->mqr_description }}" disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Nilai" value="{{ $qr->mqr_poin }}" disabled>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </div>
                                <!-- Table Body -->
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="container text-center inner-bottom-button">
            <a href="{{ route('master.penilaian') }}" class="btn btn-secondary px-4">
                Kembali
            </a>
        </div>
    </div>

@endsection