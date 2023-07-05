{{-- @dd($master_programinkubasi) --}}

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
            Master Program Inkubasi
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addIncubationProgram" class="button btn-primary">
            <button id="openAddProgram" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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
                <form action="" class="position-relative">
                    
                    <input type="search" class="form-control rounded" placeholder="Cari" aria-label="Search" aria-describedby="search-addon" style="width: 350px; padding-left: 2.5rem">
                    
                    <span class="position-absolute" style="top: 50%; left: 0.5rem; transform: translateY(-50%);">
                        <i data-feather="search"></i>
                    </span>
                </form>
                <!-- Input Form -->
            </div>
        </div>
    </div>
    <!-- Search Bar -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">   
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('errors'))
    <div class="alert alert-danger alert-block">   
        @foreach ($errors->all() as $error)
            <strong>{{ $error }}</strong>
            <br>
        @endforeach
    </div>
    @endif

    <!-- Users Table -->
    <div class="table-responsive-md">
        <table class="table">
            <!-- Table Head -->
            <thead class="text-center" style="background-color: #f5f5f5">
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col" style="width: 25%">NAMA PROGRAM</th>
                    <th scope="col" style="width: 40%">KETERANGAN</th>
                    <th scope="col" style="width: 20%">STATUS</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                @foreach ($master_programinkubasi as $mpi)
                <tr>
                    <th scope="row" class="text-center">{{ $mpi->id }}</th>
                    <td>{{ $mpi->mpi_name }}</td>
                    <td>{{ $mpi->mpi_description }}</td>
                    <td class="text-center">{{ $mpi->mpi_type }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewIncubationProgram" onClick="oldData({{ json_encode($mpi) }})" class="lihat"><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editIncubationProgram" onClick="oldData({{ json_encode($mpi) }})"><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="{{ route('incubation-delete', $mpi->id) }}" onClick="return confirm('Delete Incubation Program {{ $mpi->mpi_name }} ?')"><i data-feather="trash-2"></i></a>
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
    <div class="overlay" id="addIncubationProgram">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Program</h4>
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
                        <form action="{{ route('incubation-create') }}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                            <!-- Input Nama Program -->
                            <input type="text" name="mpi_name" class="form-control rounded" id="namaProgram" placeholder="Nama Program" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama Program -->

                            <!-- Input Deskripsi Program -->
                            <textarea class="form-control rounded" name="mpi_description" id="deskripsiProgram" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem"></textarea>
                            <!-- Input Deskripsi Program -->

                            {{-- Select Active Button --}}
                            <select class="form-select" name="mpi_type" id="status" style="margin-top: 1rem">
                                <option value="AKTIF">AKTIF</option>
                                <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                              </select>

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
    <div class="overlay" id="viewIncubationProgram">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Program</h4>
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
                        <!-- View Nama Program -->
                        <input 
                        type="text" 
                        class="form-control rounded" 
                        id="detailNamaProgram" 
                        placeholder="Nama Program" 
                        style="margin-top: 1rem; width: 100%"
                        value=""
                        readonly>
                        <!-- Edit Deskripsi Program -->
                        <textarea class="form-control rounded" id="detailDeskripsiProgram" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;" readonly></textarea>

                        {{-- Select Active Button --}}
                        <input type="text" class="form-control rounded" id="detailStatus" placeholder="Nama Program" style="margin-top: 1rem; width: 100%" value="" readonly>

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
    <div class="overlay" id="editIncubationProgram">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Program</h4>
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
                        <!-- Edit Nama Program -->
                        <form action="{{ route('incubation-update', $mpi->id ?? '') }}" method="POST">
                        @csrf <!-- {{ csrf_field() }} -->
                            <input 
                            type="text" 
                            name="mpi_name"
                            class="form-control rounded" 
                            id="editNamaProgram" 
                            placeholder="Nama Program" 
                            style="margin-top: 1rem; width: 100%"
                            value="">
                            <!-- Edit Nama Program -->
                            
                            <!-- Edit Deskripsi Program -->
                            <textarea class="form-control rounded" name="mpi_description" id="editDeskripsiProgram" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;">Current program description.</textarea>
                            <!-- Edit Deskripsi Program -->


                            {{-- Select Active Button --}}
                            <select class="form-select" name="mpi_type" id="editStatus" style="margin-top: 1rem">
                                <option value="AKTIF">AKTIF</option>
                                <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                              </select>
                            
                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">
                                        Perbarui
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
    <!-- EDIT -->

    <!-- DELETE -->
    {{-- <form action="{{ route('incubation-delete', $mpi->mpi_id) }}" method="post">
    @csrf <!-- {{ csrf_field() }} --> --}}
    <div class="overlay" id="deleteIncubationProgram">
            <div class="wrapper" style="width: 25%">
                <div class="content">
                    <p class="text-center">
                        Hapus program?
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
            </div>
        </div>
    {{-- </form> --}}
    <!-- DELETE -->
    <!-- POP-UP TAMBAH, VIEW, EDIT -->
    @endsection

<script>

    function oldData(data){
        document.querySelector('#detailNamaProgram').value = data.mpi_name;
        document.querySelector('#editNamaProgram').value = data.mpi_name;
        document.querySelector('#detailDeskripsiProgram').value = data.mpi_description;
        document.querySelector('#editDeskripsiProgram').value = data.mpi_description;
        document.querySelector('#detailStatus').value = data.mpi_type;
        document.querySelector('#editStatus').value = data.mpi_type;
    }

</script>