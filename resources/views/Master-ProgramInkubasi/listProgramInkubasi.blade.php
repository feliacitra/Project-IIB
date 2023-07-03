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
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>BTIP</td>
                    <td>Bandung Techno Park Incubation Program</td>
                    <td class="text-center">TIDAK AKTIF</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewIncubationProgram"><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editIncubationProgram"><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="#deleteIncubationProgram"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
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
                        <form>
                            <!-- Input Nama Program -->
                            <input type="text" class="form-control rounded" id="namaProgramInkubasi" placeholder="Nama Program" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama Program -->

                            <!-- Input Deskripsi Program -->
                            <textarea class="form-control rounded" id="deskripsiProgramInkubasi" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem"></textarea>
                            <!-- Input Deskripsi Program -->

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button id="simpanTambah" class="btn btn-primary">
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
                        id="namaProgram" 
                        placeholder="Nama Program" 
                        style="margin-top: 1rem; width: 100%"
                        value="Current Program Name"
                        readonly>
                        <!-- View Nama Program -->

                        <!-- View Deskripsi Program -->
                        <textarea class="form-control rounded" id="deskripsiProgram" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;" readonly>Current program description.</textarea>
                        <!-- View Deskripsi Program -->

                        <!-- Select Status -->
                        <select disabled class="form-control rounded" style="margin-top: 1rem;">
                            <option value="aktif">AKTIF</option>
                            <option value="tidakAktif">TIDAK AKTIF</option>
                        </select>
                        <!-- Select Status -->

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
                        <form>
                            <!-- Edit Nama Program -->
                            <input 
                                type="text" 
                                class="form-control rounded" 
                                id="namaProgram" 
                                placeholder="Nama Program" 
                                style="margin-top: 1rem; width: 100%"
                                value="Current Program Name">
                            <!-- Edit Nama Program -->

                            <!-- Edit Deskripsi Program -->
                            <textarea class="form-control rounded" id="deskripsiProgram" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;">Current program description.</textarea>
                            <!-- Edit Deskripsi Program -->

                            <!-- Select Status -->
                            <select name="statusSelect" id="status" class="form-control rounded" style="margin-top: 1rem;">
                                <option value="aktif">AKTIF</option>
                                <option value="tidakAktif">TIDAK AKTIF</option>
                            </select>
                            <!-- Select Status -->

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button id="saveEdit" class="btn btn-primary">
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
            <div class="content">
                <p class="text-center">
                    Hapus program?
                </p>

                <div class="row mt-4">
                    <!--Button Ya -->
                    <div class="col">
                        <button id="delete" class="btn btn-primary" style="width: 50%">
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
    <!-- DELETE -->
    <!-- POP-UP TAMBAH, VIEW, EDIT -->

    
@endsection