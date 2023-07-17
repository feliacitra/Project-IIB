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
    @if (isFeatureInclude('program-inkubasi-tambah', session('features')))
        <div class="pb-2" style="display: flex; justify-content: flex-end;">
            <a href="#addIncubationProgram" class="button btn-primary">
                <button id="openAddProgram" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
                    <i data-feather="plus" style="margin-right: 0.3rem;"></i>
                    TAMBAH
                </button>
            </a>
        </div>
    @endif
    <!-- Button Tambah -->

    <!-- Search Bar -->
    <div class="d-flex justify-content-end">
        <div class="pb-2">
            <div class="input-group rounded">
                <!-- Input Form -->
                <form action="/master/inkubasi" class="position-relative">
                    
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

    {{-- flash message --}}
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
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $mpi->mpi_name }}</td>
                    <td>{{ $mpi->mpi_description }}</td>
                    <td class="text-center">{{ $mpi->mpi_type }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        @if (isFeatureInclude('program-inkubasi-lihat', session('features')))
                            <a href="#viewIncubationProgram" data-name="{{ $mpi->mpi_name }}" data-description="{{ $mpi->mpi_description }}" data-type="{{ $mpi->mpi_type }}" class="lihat"><i data-feather="eye"></i></a>
                        @endif
                        <!-- EDIT -->
                        @if (isFeatureInclude('program-inkubasi-ubah', session('features')))
                            <a href="#editIncubationProgram" data-id="{{ $mpi->mpi_id }}" data-name="{{ $mpi->mpi_name }}" data-description="{{ $mpi->mpi_description }}" data-type="{{ $mpi->mpi_type }}"><i data-feather="edit-2"></i></a>
                        @endif
                        <!-- DELETE -->
                        @if (isFeatureInclude('program-inkubasi-hapus', session('features')))
                            <a href="#deleteIncubationProgram" data-id="{{ $mpi->mpi_id }}"><i data-feather="trash-2"></i></a>
                        @endif
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
                        <form action="{{ route('master.inkubasi') }}" method="POST">
                            @csrf <!-- {{ csrf_field() }} -->
                            <!-- Input Nama Program -->
                            <input type="text" name="addNamaInkubasi" class="form-control rounded" id="addNamaInkubasi" placeholder="Nama Program" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama Program -->

                            <!-- Input Deskripsi Program -->
                            <textarea class="form-control rounded" name="addDeskripsiInkubasi" id="addDeskripsiInkubasi" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem"></textarea>
                            <!-- Input Deskripsi Program -->

                            {{-- Select Active Button --}}
                            <select class="form-select" name="addStatus" id="addStatus" style="margin-top: 1rem">
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
                        id="detailNamaInkubasi" 
                        placeholder="Nama Program" 
                        style="margin-top: 1rem; width: 100%"
                        value=""
                        readonly>
                        <!-- Edit Deskripsi Program -->
                        <textarea class="form-control rounded" id="detailDeskripsiInkubasi" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;" readonly></textarea>

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
                        <form action="/master/inkubasi/" method="POST" id="editForm">
                        @csrf <!-- {{ csrf_field() }} -->
                        @method('PUT')
                            <input 
                            type="text" 
                            name="editNamaInkubasi"
                            class="form-control rounded" 
                            id="editNamaInkubasi" 
                            placeholder="Nama Program" 
                            style="margin-top: 1rem; width: 100%"
                            value="">
                            <!-- Edit Nama Program -->
                            
                            <!-- Edit Deskripsi Program -->
                            <textarea class="form-control rounded" name="editDeskripsiInkubasi" id="editDeskripsiInkubasi" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;">Current program description.</textarea>
                            <!-- Edit Deskripsi Program -->


                            {{-- Select Active Button --}}
                            <select class="form-select" name="editStatus" id="editStatus" style="margin-top: 1rem">
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
     <div class="overlay" id="deleteIncubationProgram">
        <div class="wrapper" style="width: 25%">
            <form action="/master/inkubasi/" method="POST" id="deleteForm">
                @csrf <!-- {{ csrf_field() }} -->
                @method('DELETE')
            <div class="content">
                <p class="text-center">
                    Hapus Program?
                </p>

                <input type="hidden" name="_method" value="DELETE">

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
    function test(){
        const viewLinks = document.querySelectorAll('a[href="#viewIncubationProgram"]');
        console.log(viewLinks);
    }
 const viewLinks = document.querySelectorAll('a[href="#viewIncubationProgram"]');
 
 viewLinks.forEach(link => {
        link.addEventListener('click', event => {
            
            const name = link.dataset.name;
            const description = link.dataset.description;
            const type = link.dataset.type;
            
            document.getElementById('detailNamaInkubasi').value = name;
            document.getElementById('detailDeskripsiInkubasi').value = description;
            document.getElementById('detailStatus').value = type;
        });
    });

    const editLinks = document.querySelectorAll('a[href="#editIncubationProgram"]');
    
    editLinks.forEach(link => {
        link.addEventListener('click', event => {
            
            const id = link.dataset.id;
            const name = link.dataset.name;
            const description = link.dataset.description;
            const type = link.dataset.type;

            document.getElementById('editNamaInkubasi').value = name;
            document.getElementById('editDeskripsiInkubasi').value = description;
            document.getElementById('editStatus').value = type;
            
            editForm.action = `/master/inkubasi/${id}`;
        });
    });
    
    const deleteLinks = document.querySelectorAll('a[href="#deleteIncubationProgram"]');
    
    deleteLinks.forEach(link => {
        link.addEventListener('click', event => {
            const id = link.dataset.id;

            deleteForm.action = `/master/inkubasi/${id}`;
        })
    })
    
</script>
    @endsection