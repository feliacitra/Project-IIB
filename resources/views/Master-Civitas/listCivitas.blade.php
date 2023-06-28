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
            Master Civitas
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addCivitas" class="button btn-primary">
            <button id="openAddCivitas" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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
                    <th scope="col" style="width: 35%">NAMA</th>
                    <th scope="col" style="width: 40%">KETERANGAN</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>Mahasiswa</td>
                    <td>Mahasiswa lorem ipsum</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewCivitas"><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editCivitas"><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="#deleteCivitas"><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

    <!-- POP-UP TAMBAH, VIEW, EDIT -->
    <!-- TAMBAH -->
    <div class="overlay" id="addCivitas">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Civitas</h4>
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
                            <!-- Input Nama civitas -->
                            <input type="text" class="form-control rounded" id="namaCivitas" placeholder="Nama Civitas" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama civitas -->

                            <!-- Input Deskripsi Program -->
                            <textarea class="form-control rounded" id="deskripsiCivitas" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem"></textarea>
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
    <div class="overlay" id="viewCivitas">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Civitas</h4>
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
                        <!-- Edit Nama Program -->
                        <input 
                        type="text" 
                        class="form-control rounded" 
                        id="namaCivitas" 
                        placeholder="Nama Civitas" 
                        style="margin-top: 1rem; width: 100%"
                        value="Current Civitas Name"
                        readonly>
                        <!-- Edit Nama Program -->

                        <!-- Edit Deskripsi Program -->
                        <textarea class="form-control rounded" id="deskripsiCivitas" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;" readonly>Current program description.</textarea>
                        <!-- Edit Deskripsi Program -->

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
    <div class="overlay" id="editCivitas">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Civitas</h4>
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
                                id="namaCivitas" 
                                placeholder="Nama Civitas" 
                                style="margin-top: 1rem; width: 100%"
                                value="Current Civitas Name">
                            <!-- Edit Nama Program -->

                            <!-- Edit Deskripsi Civitas -->
                            <textarea class="form-control rounded" id="deskripsiCivitas" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;">Current program description.</textarea>
                            <!-- Edit Deskripsi Civitas -->

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
    <div class="overlay" id="deleteCivitas">
        <div class="wrapper" style="width: 25%">
            <div class="content">
                <p class="text-center">
                    Hapus civitas?
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