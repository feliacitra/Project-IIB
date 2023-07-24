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
            <a href="{{ route('penilaian') }}">Master Komponen Penilaian</a>&nbsp;> Kelola Komponen
        </p>
    </div>

    <div class="container-fluid py-4 px-4" style="height: 100%">
        <div class="row">
            <p class="col">Periode: Tahun 2022</p>
            <p class="col">Tahap: Self Assessment</p>
            <p class="col">Program Inkubasi: BTPIP</p>
        </div>

        <div class="form-group">
            <div id="cardContainer">
                <div class="card mt-2">
                    <div class="card-body">
                        <input type="text" class="form-control" id="pertanyaan" placeholder="Pertanyaan" disabled>

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
                                        <tr>
                                            <td class="text-center">
                                                1
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Jawaban" value="Current jawaban" disabled>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Nilai" value="80" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </div>
                                <!-- Table Body -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center inner-bottom-button">
            <a href="{{ route('penilaian') }}" class="btn btn-secondary px-4">
                Kembali
            </a>
        </div>
    </div>

@endsection