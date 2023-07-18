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
            Master Program Studi
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addStudyProgram" class="button btn-primary">
            <button id="openAddFaculty" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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

    <!-- Flash Message -->
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif ($errors->any())
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
                    <th scope="col" style="width: 18%">UNIVERSITAS</th>
                    <th scope="col" style="width: 18%">FAKULTAS</th>
                    <th scope="col" style="width: 18%">PROGRAM STUDI</th>
                    <th scope="col" style="width: 31%">KETERANGAN</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                @foreach ($programStudi as $prodi)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $prodi->faculty->university->mu_name }}</td>
                    <td>{{ $prodi->faculty->mf_name }}</td>
                    <td>{{ $prodi->mps_name }}</td>
                    <td>{{ $prodi->mps_description }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewStudyProgram"
                            data-university="{{ $prodi->faculty->university->mu_name }}"
                            data-faculty="{{ $prodi->faculty->mf_name }}"
                            data-name="{{ $prodi->mps_name }}"
                            data-description="{{ $prodi->mps_description }}"
                        ><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editStudyProgram"
                            data-id="{{ $prodi->mps_id }}"
                            data-university="{{ $prodi->faculty->university->mu_name }}"
                            data-univid="{{ $prodi->faculty->university->mu_id }}"
                            data-faculty="{{ $prodi->faculty->mf_name }}"
                            data-name="{{ $prodi->mps_name }}"
                            data-description="{{ $prodi->mps_description }}"
                        ><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="#deleteStudyProgram"><i data-feather="trash-2"></i></a>
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
    <div class="overlay" id="addStudyProgram">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Program Studi</h4>
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
                        <form action="/master/prodi" method="POST">
                            @csrf
                            <!-- Select Nama Universitas -->
                            <select class="form-control form-select" name="addUniversity" id="addUniversity" style="margin-top: 1rem">
                                <option value="select" class="text-muted">Nama Universitas</option>
                                @foreach ($universities as $univ)
                                    <option value="{{ $univ->mu_id }}">{{ $univ->mu_name }}</option>
                                @endforeach
                            </select>
                            <!-- Select Nama Universitas -->

                            <!-- Select Nama Fakultas -->
                            <select class="form-control form-select" name="addFaculty" id="addFaculty" style="margin-top: 1rem">
                                <option value="select" class="text-muted">Nama Fakultas</option>
                            </select>
                            <!-- Select Nama Fakultas -->

                            <!-- Input Nama Prodi -->
                            <input type="text" class="form-control rounded" name="addNamaProdi" id="addNamaProdi" placeholder="Nama Program Studi" style="margin-top: 1rem">
                            <!-- Input Nama Prodi -->

                            <!-- Input Keterangan Prodi -->
                            <textarea class="form-control rounded" name="addKeteranganProdi" id="addKeteranganProdi" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem"></textarea>
                            <!-- Input Keterangan Prodi -->

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
    <div class="overlay" id="viewStudyProgram">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Program Studi</h4>
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
                        <!-- Nama Universitas -->
                        <input type="text" class="form-control rounded" name="viewUniversitas" id="viewUniversitas" placeholder="Nama Universitas" style="margin-top: 1rem" readonly>
                        <!-- Nama Universitas -->

                        <!-- Select Nama Fakultas -->
                        <input type="text" class="form-control rounded" name="viewFakultas" id="viewFakultas" placeholder="Nama Fakultas" style="margin-top: 1rem" readonly>
                        <!-- Select Nama Fakultas -->
                        
                        <!-- View Nama Prodi -->
                        <input type="text" class="form-control rounded" name="viewNamaProdi" id="viewNamaProdi" placeholder="Nama Program Studi" style="margin-top: 1rem" readonly>
                        <!-- View Nama Prodi -->

                        <!-- View Keterangan Prodi -->
                        <textarea class="form-control rounded" name="viewKeteranganProdi" id="viewKeteranganProdi" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;" readonly></textarea>
                        <!-- View Keterangan Prodi -->

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
    <div class="overlay" id="editStudyProgram">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Program Studi</h4>
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
                        <form action="/master/prodi" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <!-- Select Nama Universitas -->
                            <select class="form-control form-select" name="editUniversitas" id="editUniversitas" style="margin-top: 1rem">
                                <option value="" class="text-muted">Nama Universitas</option>
                                @foreach ($universities as $univ)
                                    <option value="{{ $univ->mu_id }}">{{ $univ->mu_name }}</option>
                                @endforeach
                            </select>
                            <!-- Select Nama Universitas -->

                            <!-- Select Nama Fakultas -->
                            <select class="form-control form-select" name="editFakultas" id="editFakultas" style="margin-top: 1rem">
                                <option value="" class="text-muted">Nama Fakultas</option>
                            </select>
                            <!-- Select Nama Fakultas -->

                            <!-- Edit Nama Prodi -->
                            <input type="text" class="form-control rounded" name="editNamaProdi" id="editNamaProdi" placeholder="Nama Program Studi" style="margin-top: 1rem" value="Current Study Program">
                            <!-- Edit Nama Prodi -->

                            <!-- Edit Keterangan Prodi -->
                            <textarea class="form-control rounded" name="editKeteranganProdi" id="editKeteranganProdi" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;">Current faculty information.</textarea>
                            <!-- Edit Keterangan Prodi -->

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
    <div class="overlay" id="deleteStudyProgram">
        <div class="wrapper" style="width: 25%">
            <div class="content">
                <p class="text-center">
                    Hapus program studi?
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addUniversity').on('change', function() {
                var universityId = $(this).val();
                if (universityId) {
                    $.ajax({
                        url: '/master/prodi/' + universityId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#addFaculty').empty();
                            $('#addFaculty').append('<option value="" class="text-muted">Nama Fakultas</option>');
                            $.each(data, function(key, value) {
                                $('#addFaculty').append('<option value="' + value.mf_id + '">' + value.mf_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#addFaculty').empty();
                }
            });
        });

        $(document).ready(function() {
            $('#editUniversitas').on('change', function() {
                var universityId = $(this).val();
                if (universityId) {
                    $.ajax({
                        url: '/master/prodi/' + universityId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#editFakultas').empty();
                            $('#editFakultas').append('<option value="" class="text-muted">Nama Fakultas</option>');
                            $.each(data, function(key, value) {
                                $('#editFakultas').append('<option value="' + value.mf_id + '">' + value.mf_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#editFakultas').empty();
                }
            });
        });

        const viewLinks = document.querySelectorAll('a[href="#viewStudyProgram"]');
    
        viewLinks.forEach(link => {
            link.addEventListener('click', event => {
                const name = link.dataset.name;
                const description = link.dataset.description;
                const university = link.dataset.university;
                const faculty = link.dataset.faculty;
                const enddate = link.dataset.enddate;
                document.getElementById('viewNamaProdi').value = name;
                document.getElementById('viewKeteranganProdi').value = description;
                document.getElementById('viewUniversitas').value = university;
                document.getElementById('viewFakultas').value = faculty;
            });
        });

        const editLinks = document.querySelectorAll('a[href="#editStudyProgram"]');
    
        editLinks.forEach(link => {
            link.addEventListener('click', event => {
                $('#editFakultas').empty();
                const id = link.dataset.id;
                const name = link.dataset.name;
                const description = link.dataset.description;
                const university = link.dataset.university;
                const univid = link.dataset.univid;
                const faculty = link.dataset.faculty;
                document.getElementById('editNamaProdi').value = name;
                document.getElementById('editKeteranganProdi').value = description;

                const universitySelect = document.getElementById('editUniversitas');
                for (let i = 0; i < universitySelect.options.length; i++) {
                    if (universitySelect.options[i].text === university) {
                        universitySelect.options[i].selected = true;
                        break;
                    }
                }

                if (univid) {
                    $.ajax({
                        url: '/master/prodi/' + univid,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#editFakultas').append('<option value="" class="text-muted">Nama Fakultas</option>');
                            $.each(data, function(key, value) {
                                if (value.mf_name == faculty) {
                                    $('#editFakultas').append('<option value="' + value.mf_id + '" selected>' + value.mf_name + '</option>');
                                } else {
                                    $('#editFakultas').append('<option value="' + value.mf_id + '">' + value.mf_name + '</option>');
                                }
                            });
                        }
                    });
                } else {
                    $('#editFakultas').empty();
                }

                editForm.action = `/master/prodi/${id}`;
            });
        });
    </script>
@endsection