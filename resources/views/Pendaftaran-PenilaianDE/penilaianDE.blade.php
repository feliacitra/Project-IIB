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
        thead th {
            text-align: center;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Penilaian Desk Evaluation
        </p>
    </div>

    {{-- @dd($kategori[0]->mc_name) --}}
    <div class="row mt-4">
            <div class="col-4 col-md-3 col-lg-2">
                <select name="periode" id="periode" class="form-control form-select">
                    <option value="" class="text-muted">Periode</option>
                    @foreach($periode as $item)
                    <option value="{{ $item->mpe_id }}">{{ $item->mpe_name }} </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-4 col-md-3 col-lg-2">
                <select name="status" id="status" class="form-control form-select">
                    <option value="" class="text-muted">Status</option>
                    {{-- @foreach($startup->periodeProgram as $item) --}}
                    <option value="1">AKTIF</option>
                    <option value="2">TIDAK AKTIF</option>
                    {{-- @endforeach --}}
                </select>
            </div>
          

        <div class="col d-flex justify-content-end">
            <div class="pb-2">
                <!-- Search Bar -->
                <div class="input-group rounded">
                    <!-- Input Form -->
                    <form action="{{ route('penilaianDE') }}" method="get" class="position-relative">
                        <input name="search" type="search" class="form-control rounded" placeholder="Cari" aria-label="Search" aria-describedby="search-addon" style="width: 350px; padding-left: 2.5rem">
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
                    <th scope="col" style="width: 15%">PROGRAM INKUBASI</th>
                    <th scope="col" style="width: 15%">KATEGORI</th>
                    <th scope="col" style="width: 10%" rowspan="2">NILAI SELF <br> ASSESSMENT</th>
                    <th scope="col" style="width: 10%" rowspan="2">NILAI DESK <br> EVALUATION</th>
                    <th scope="col" style="width: 10%">STATUS</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            {{-- @dd($startup[1]->masterPeriodeProgram->masterPeriode->mpe_name) --}}
            {{-- @dd($startup[]->masterPeriodeProgram->masterPeriode->mpe_name) --}}
            <!-- Table Body -->
            <tbody>
                @foreach($startup as $item)
                {{-- @dd($item->ms_category) --}}
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $item->masterPeriodeProgram->masterPeriode->mpe_name }}</td>
                    <td>{{ $item->ms_name }}</td>
                    <td>{{ $item->masterPeriodeProgram->masterProgramInkubasi->mpi_name }}</td>
                    <td>{{ $item->masterCategory->mc_name }}</td>
                    <td class="text-center">{{ $item->startupComponentStatus[0]->scs_totalscore}}</td>
                    @if(count($item->startupComponentStatus)==1)
                    <td class="text-center">-</td>
                    @else
                    <td class="text-center">{{ $item->startupComponentStatus[1]->scs_totalscore}}</td>
                    @endif
                    @if($item->ms_status == 1)
                    <td class="text-center">AKTIF</td>
                    @else
                    <td class="text-center">TIDAK AKTIF</td>
                    @endif
                    <td class="text-center action-icons">
                        <!-- VIEW -->
                        {{-- <a href="{{ route('penilaianDE.show', $item->ms_id) }}"><i data-feather="eye"></i></a> --}}
                        <a href="{{ route('penilaianDE.edit', $item->ms_id) }}"><i data-feather="edit-2"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->
    <script>

    //    function statusFilter(id){
    //     $(id).on('change', function(e){
    //         var variable = e.target.value;
    //         console.log(e);
    //     })
    //    }
       $("#status").change(function (e){
            e.preventDefault();
            var variable = e.target.value;
            console.log(variable);
            
            document.getElementById('filter').click();
        })
       $("#periode").change(function (e){
            e.preventDefault();
            var variable = e.target.value;
            console.log(variable);
            
            document.getElementById('filter').click();
        })

    </script>
    
@endsection

