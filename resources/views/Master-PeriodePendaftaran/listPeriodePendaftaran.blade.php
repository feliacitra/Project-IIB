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
            Master Periode Pendaftaran
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addPeriod" class="button btn-primary">
            <button id="openAdd" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
                <i data-feather="plus" style="margin-right: 0.3rem;"></i>
                TAMBAH
            </button>
        </a>
    </div>
    <!-- Button Tambah -->

    <!-- Search Bar -->
    <div class="d-flex justify-content-end">
        <div class="pb-2">
            <div class="input-group rounded">
                <!-- Input Form -->
                <form action="/master/periode" class="position-relative">
                    @csrf
                    <input type="search" name="search" class="form-control rounded" placeholder="Cari" aria-label="Search" aria-describedby="search-addon" style="width: 350px; padding-left: 2.5rem">
                    
                    <span class="position-absolute" style="top: 50%; left: 0.5rem; transform: translateY(-50%);">
                        <i data-feather="search"></i>
                    </span>
                </form>
                <!-- Input Form -->
            </div>
        </div>
    </div>
    <!-- Search Bar -->

    <!-- Flash Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Flash Message -->

    <!-- Users Table -->
    <div class="table-responsive-md">
        <table class="table">
            <!-- Table Head -->
            <thead class="text-center" style="background-color: #f5f5f5">
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col" style="width: 22%">NAMA PERIODE</th>
                    <th scope="col" style="width: 22%">TANGGAL MULAI</th>
                    <th scope="col" style="width: 22%">TANGGAL AKHIR</th>
                    <th scope="col" style="width: 19%">STATUS</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                <?php
                    use Carbon\Carbon;
                    setlocale(LC_TIME, 'id_ID');
                    Carbon::setLocale('id');
                ?>
                @foreach ($periods as $period)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $period->mpe_name }}</td>
                    <td>{{ Carbon::parse($period->mpe_startdate)->isoFormat('D MMMM Y') }}</td>
                    <td>{{ Carbon::parse($period->mpe_enddate)->isoFormat('D MMMM Y') }}</td>
                    <td class="text-center">{{ $period->mpe_status == 0 ? 'TIDAK AKTIF' : ($period->mpe_status == 1 ? 'AKTIF' : 'INVALID') }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewPeriod"
                            data-name="{{ $period->mpe_name }}"
                            data-startdate="{{ Carbon::parse($period->mpe_startdate)->isoFormat('D MMMM Y') }}"
                            data-enddate="{{ Carbon::parse($period->mpe_enddate)->isoFormat('D MMMM Y') }}"
                            data-status="{{ $period->mpe_status == 0 ? 'TIDAK AKTIF' : ($period->mpe_status == 1 ? 'AKTIF' : 'INVALID') }}"
                            data-description="{{ $period->mpe_description }}"
                        ><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editPeriod"
                            data-id="{{ $period->mpe_id }}"
                            data-name="{{ $period->mpe_name }}"
                            data-startdate="{{ $period->mpe_startdate }}"
                            data-enddate="{{ $period->mpe_enddate }}"
                            data-status="{{ $period->mpe_status }}"
                            data-description="{{ $period->mpe_description }}"
                        ><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="#deletePeriod"
                            data-id="{{ $period->mpe_id }}"
                        ><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

<!-- POP-UP TAMBAH, VIEW, EDIT -->
    <!-- TAMBAH -->
    <div class="overlay" id="addPeriod">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Periode</h4>
                </div>
                <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                    <!-- X button -->
                    <a href="#" class="close">&times;</a>
                    <!-- X button -->
                </div>
            </div>
            <div class="content">
                <div class="container-fluid p-0">
                    <div class="input-group-lg rounded">
                        <form action="/master/periode" method="POST">
                            @csrf
                            <!-- Nama Periode -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="addNamaPeriode" class="col-sm-3">Nama Periode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="addNamaPeriode" name="addNamaPeriode" placeholder="Nama Periode">
                                </div>
                            </div>
                            <!-- Nama Periode -->

                            <!-- Tanggal Mulai -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="addTanggalMulai" class="col-sm-3">Tanggal Mulai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="addTanggalMulai" name="addTanggalMulai">
                                </div>
                            </div>
                            <!-- Tanggal Mulai -->

                            <!-- Tanggal Akhir -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="addTanggalSelesai" class="col-sm-3">Tanggal Akhir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="addTanggalSelesai" name="addTanggalSelesai">
                                </div>
                            </div>
                            <!-- Tanggal Akhir -->

                            <!-- Keterangan -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="addKeteranganPeriode" class="col-sm-3">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="addKeteranganPeriode" name="addKeteranganPeriode" cols="20" rows="5" placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <!-- Keterangan -->

                            <!-- Status -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="addStatusPeriode" class="col-sm-3">Status</label>
                                <div class="col-sm-9">
                                    <select name="addStatusPeriode" id="addStatusPeriode" class="form-control form-select">
                                        <option value="" class="text-muted">Pilih status</option>
                                        <option value="1">AKTIF</option>
                                        <option value="0">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Status -->

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button type="submit" id="simpanTambah" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                                <!--Button Simpan -->

                                <!--Button Kembali -->
                                <div class="col d-flex justify-content-end">
                                    <a href="#" class="button-link">Kembali</a>
                                </div>
                                <!--Button Kembali -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TAMBAH -->

    <!-- VIEW -->
    <div class="overlay" id="viewPeriod">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Periode</h4>
                </div>
                <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                    <!-- X button -->
                    <a href="#" class="close">&times;</a>
                    <!-- X button -->
                </div>
            </div>
            <div class="content">
                <div class="container-fluid p-0">
                    <div>
                        <!-- Nama Periode -->
                        <div class="form-group row align-items-center" style="margin-top: 1rem">
                            <label for="viewNamaPeriode" class="col-sm-3">Nama Periode</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="viewNamaPeriode" name="viewNamaPeriode" placeholder="Nama Periode" readonly>
                            </div>
                        </div>
                        <!-- Nama Periode -->

                        <!-- Tanggal Mulai -->
                        <div class="form-group row align-items-center" style="margin-top: 1rem">
                            <label for="viewTanggalMulai" class="col-sm-3">Tanggal Mulai</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="viewTanggalMulai" name="viewTanggalMulai" placeholder="Tanggal Mulai" readonly>
                            </div>
                        </div>
                        <!-- Tanggal Mulai -->

                        <!-- Tanggal Akhir -->
                        <div class="form-group row align-items-center" style="margin-top: 1rem">
                            <label for="viewTanggalAkhir" class="col-sm-3">Tanggal Akhir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="viewTanggalAkhir" name="viewTanggalAkhir" placeholder="Tanggal Akhir" readonly>
                            </div>
                        </div>
                        <!-- Tanggal Akhir -->

                        <!-- Keterangan -->
                        <div class="form-group row align-items-center" style="margin-top: 1rem">
                            <label for="viewKeteranganPeriode" class="col-sm-3">Keterangan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="viewKeteranganPeriode" name="viewKeteranganPeriode" cols="20" rows="5" placeholder="Keterangan" readonly></textarea>
                            </div>
                        </div>
                        <!-- Keterangan -->

                        <!-- Status -->
                        <div class="form-group row align-items-center" style="margin-top: 1rem">
                            <label for="viewStatusPeriode" class="col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="viewStatusPeriode" name="viewStatusPeriode" placeholder="Tanggal Akhir" readonly>
                            </div>
                        </div>
                        <!-- Status -->

                        <!--Button Kembali -->
                        <div class="col d-flex justify-content-end mt-4">
                            <a href="#" class="button-link">Kembali</a>
                        </div>
                        <!--Button Kembali -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- VIEW -->

    <!-- EDIT -->
    <div class="overlay" id="editPeriod">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Periode</h4>
                </div>
                <div class="col col-lg-3 col-md-4 d-flex justify-content-end">
                    <!-- X button -->
                    <a href="#" class="close">&times;</a>
                    <!-- X button -->
                </div>
            </div>
            <div class="content">
                <div class="container-fluid p-0">
                    <div class="input-group-lg rounded">
                        <form action="/master/periode" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <!-- Nama Periode -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="editNamaPeriode" class="col-sm-3">Nama Periode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="editNamaPeriode" name="editNamaPeriode" placeholder="Nama Periode"required>
                                </div>
                            </div>
                            <!-- Nama Periode -->

                            <!-- Tanggal Mulai -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="editTanggalMulai" class="col-sm-3">Tanggal Mulai</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editTanggalMulai" name="editTanggalMulai">
                                </div>
                            </div>
                            <!-- Tanggal Mulai -->

                            <!-- Tanggal Akhir -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="editTanggalAkhir" class="col-sm-3">Tanggal Akhir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="editTanggalAkhir" name="editTanggalAkhir">
                                </div>
                            </div>
                            <!-- Tanggal Akhir -->

                            <!-- Keterangan -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="editKeteranganPeriode" class="col-sm-3">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="editKeteranganPeriode" name="editKeteranganPeriode" cols="20" rows="5" placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <!-- Keterangan -->

                            <!-- Status -->
                            <div class="form-group row align-items-center" style="margin-top: 1rem">
                                <label for="editStatusPeriode" class="col-sm-3">Status</label>
                                <div class="col-sm-9">
                                    <select id="editStatusPeriode" name="editStatusPeriode" class="form-control form-select">
                                        <option value="" class="text-muted">Pilih status</option>
                                        <option value="1">AKTIF</option>
                                        <option value="0">TIDAK AKTIF</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Status -->

                            <div class="row mt-4">
                                <!--Button Perbarui -->
                                <div class="col">
                                    <button type="submit" id="saveEdit" class="btn btn-primary">
                                        Perbarui
                                    </button>
                                </div>
                                <!--Button Perbarui -->

                                <!--Button Kembali -->
                                <div class="col d-flex justify-content-end">
                                    <a href="#" class="button-link">Kembali</a>
                                </div>
                                <!--Button Kembali -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- EDIT -->

    <!-- DELETE -->
    <div class="overlay" id="deletePeriod">
        <div class="wrapper" style="width: 25%">
            <form action="/master/periode" method="POST" id=deleteForm>
            @csrf
            @method('DELETE')
            <div class="content">
                <p class="text-center">
                    Hapus periode?
                </p>

                <div class="row mt-4">
                    <!--Button Ya -->
                    <div class="col">
                        <button type="submit" id="delete" class="btn btn-primary" style="width: 50%">
                            Ya
                        </button>
                    </div>
                    <!--Button Ya -->

                    <!--Button Tidak -->
                    <div class="col d-flex justify-content-end">
                        <a href="#" class="button-link text-center" style="width: 50%">Tidak</a>
                    </div>
                    <!--Button Tidak -->
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- DELETE -->
<!-- POP-UP TAMBAH, VIEW, EDIT -->

<script>
    const viewLinks = document.querySelectorAll('a[href="#viewPeriod"]');
    
    viewLinks.forEach(link => {
        link.addEventListener('click', event => {

            const name = link.dataset.name;
            const description = link.dataset.description;
            const status = link.dataset.status;
            const startdate = link.dataset.startdate;
            const enddate = link.dataset.enddate;

            document.getElementById('viewNamaPeriode').value = name;
            document.getElementById('viewKeteranganPeriode').value = description;
            document.getElementById('viewStatusPeriode').value = status;
            document.getElementById('viewTanggalMulai').value = startdate;
            document.getElementById('viewTanggalAkhir').value = enddate;
        });
    });

    const editLinks = document.querySelectorAll('a[href="#editPeriod"]');
    
    editLinks.forEach(link => {
        link.addEventListener('click', event => {

            const id = link.dataset.id;
            const name = link.dataset.name;
            const description = link.dataset.description;
            const status = link.dataset.status;
            const startdate = link.dataset.startdate;
            const enddate = link.dataset.enddate;

            document.getElementById('editNamaPeriode').value = name;
            document.getElementById('editKeteranganPeriode').value = description;
            document.getElementById('editStatusPeriode').value = status;
            document.getElementById('editTanggalMulai').value = startdate;
            document.getElementById('editTanggalAkhir').value = enddate;

            editForm.action = `/master/periode/${id}`;
        });
    });

    const deleteLinks = document.querySelectorAll('a[href="#deletePeriod"]');
    
    deleteLinks.forEach(link => {
        link.addEventListener('click', event => {
            const id = link.dataset.id;
            deleteForm.action = `/master/periode/${id}`;
        })
    })
</script>

@endsection