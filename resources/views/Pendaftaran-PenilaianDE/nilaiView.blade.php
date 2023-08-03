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
            <div class="col">
                <div class="info-pair">
                    <p class="info-label">Periode</p>
                    <p class="info-value">: Tahun 2022</p>
                </div>
                <div class="info-pair mt-2">
                    <p class="info-label">Nama Startup</p>
                    <p class="info-value">: GoShop</p>
                </div>
            </div>
            <div class="col"></div>
            <div class="col">
                <div class="info-pair">
                    <p class="info-label">Program Inkubasi</p>
                    <p class="info-value">: BTPIP</p>
                </div>
                <div class="info-pair mt-2">
                    <p class="info-label">Kategori</p>
                    <p class="info-value">: SmartTech</p>
                </div>
            </div>
        </div>

        <div class="form-group">
            <h5 class="text-center mt-4">Penilaian Desk Evaluation</h5>
            <form action="">
                <div class="card">
                    <div class="card-body">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aenean commodo ligula eget dolor. Aenean massa?</p>
                        <div class="radio mt-2">
                            <input type="radio" id="1" name="" value="1">
                            <label for="1">Lorem lorem</label>

                            <input type="radio" id="2" name="" value="2">
                            <label for="2">Lorem ipsum</label>

                            <input type="radio" id="3" name="" value="3">
                            <label for="3">Dolor sit amet</label>

                            <input type="radio" id="4" name="" value="4">
                            <label for="4">Consecteturer</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="container text-center inner-bottom-button">
            <button class="btn btn-primary px-4">
                Simpan
            </button>
        </div>
    </div>

@endsection