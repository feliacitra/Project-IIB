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
            Master Fakultas
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addFaculty" class="button btn-primary">
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

                    <input type="text" name="search" class="form-control rounded" placeholder="Cari" aria-label="Search" aria-describedby="search-addon" style="width: 350px; padding-left: 2.5rem">

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
                    <th scope="col" style="width: 25%">UNIVERSITAS</th>
                    <th scope="col" style="width: 25%">FAKULTAS</th>
                    <th scope="col" style="width: 35%">KETERANGAN</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
            @foreach ($faculties as $faculty)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $faculty->university->mu_name }}</td>
                    <td>{{ $faculty->mf_name }}</td>
                    <td>{{ $faculty->mf_description }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewFaculty" data-university="{{ $faculty->university->mu_name }}" data-faculty="{{ $faculty->mf_name }}" data-description="{{ $faculty->mf_description }}"><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editFaculty" data-id="{{ $faculty->mf_id }}" data-university="{{ $faculty->university->mu_name }}" data-faculty="{{ $faculty->mf_name }}" data-description="{{ $faculty->mf_description }}"><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="#deleteFaculty"><i data-feather="trash-2"></i></a>
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
    <div class="overlay" id="addFaculty">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Fakultas</h4>
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
                        <form action="{{ route('faculty.store') }}" method="post">
                            @csrf
                            <!-- Select Nama Universitas -->
                            <select class="form-control form-select" name="addSelectedUniversity" id="university" style="margin-top: 1rem">
                                <option value="select" class="text-muted">Nama Universitas</option>
                                @foreach ($universities as $university)
                                    <option value="{{ $university->mu_id }}">{{ $university->mu_name }}</option>
                                @endforeach
                            </select>
                            <!-- Select Nama Universitas -->

                            <!-- Input Nama Fakultas -->
                            <input type="text" class="form-control rounded" id="addNamaFakultas" name="addNamaFakultas" placeholder="Nama Fakultas" style="margin-top: 1rem">
                            <!-- Input Nama Fakultas -->

                            <!-- Input Keterangan Fakultas -->
                            <textarea class="form-control rounded" id="addKeteranganFakultas" name="addKeteranganFakultas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem"></textarea>
                            <!-- Input Keterangan Fakultas -->

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
    <div class="overlay" id="viewFaculty">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Fakultas</h4>
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
                        <select class="form-control form-select" name="selectUniversity" id="viewUniversity" style="margin-top: 1rem" disabled>
                            <option value="select" class="text-muted">Nama Universitas</option>
                            @foreach ($universities as $university)
                                <option value="{{ $university->mu_id }}" {{ $faculty->university->mu_name == $university->mu_name ? 'selected' : '' }}>
                                    {{ $university->mu_name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Nama Universitas -->

                        <!-- View Nama Fakultas -->
                        <input
                                type="text"
                                class="form-control rounded"
                                id="viewNamaFakultas"
                                placeholder="Nama Fakultas"
                                style="margin-top: 1rem"
                                value="Current Faculty Name"
                                readonly>
                        <!-- View Nama Fakultas -->

                        <!-- View Keterangan Fakultas -->
                        <textarea class="form-control rounded" id="viewKeteranganFakultas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;" readonly>Current faculty information.</textarea>
                        <!-- View Keterangan Fakultas -->

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
    <div class="overlay" id="editFaculty">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Fakultas</h4>
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
                        <form action="/fakultas/{{ $faculty->mf_id }}" method="post" id="editForm">
                            @csrf
                            @method('PUT')
                            <!-- Select Nama Universitas -->
                            <select class="form-control form-select" name="editSelectUniversity" id="university" style="margin-top: 1rem">
                                <option value="select" class="text-muted">Nama Universitas</option>
                                @foreach ($universities as $university)
                                    <option value="{{ $university->mu_id }}" {{ $faculty->university->mu_name == $university->mu_name ? 'selected' : '' }}>
                                        {{ $university->mu_name }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- Select Nama Universitas -->

                            <!-- Edit Nama Fakultas -->
                            <input
                                    type="text"
                                    class="form-control rounded"
                                    id="editNamaFakultas"
                                    name="editNamaFakultas"
                                    placeholder="Nama Fakultas"
                                    style="margin-top: 1rem"
                                    value="Current Faculty Name">
                            <!-- Edit Nama Fakultas -->

                            <!-- Edit Keterangan Fakultas -->
                            <textarea class="form-control rounded" id="editKeteranganFakultas" name="editKeteranganFakultas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;">Current faculty information.</textarea>
                            <!-- Edit Keterangan Fakultas -->

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
    <div class="overlay" id="deleteFaculty">
        <div class="wrapper" style="width: 25%">
            <form action="/fakultas/{{ $faculty->mf_id }}" method="POST" id="deleteForm">
                @csrf
                @method('DELETE')
            <div class="content">
                <p class="text-center">
                    Hapus fakultas?
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
        const viewLinks = document.querySelectorAll('a[href="#viewFaculty"]');
        viewLinks.forEach(link => {
            link.addEventListener('click', event => {

                const faculty = link.dataset.faculty;
                const description = link.dataset.description;

                document.getElementById('viewNamaFakultas').value = faculty;
                document.getElementById('viewKeteranganFakultas').value = description;
            });
        });

        const editLinks = document.querySelectorAll('a[href="#editFaculty"]');
        editLinks.forEach(link => {
            link.addEventListener('click', event => {

                const id = link.dataset.id;
                const faculty = link.dataset.faculty;
                const description = link.dataset.description;

                document.getElementById('editNamaFakultas').value = faculty;
                document.getElementById('editKeteranganFakultas').value = description;

                editForm.action = `/fakultas/${id}`;
            })
        })

        const deleteLink = document.querySelectorAll('a[href="#deleteFakultas"]')
        deleteLinks.forEach(link => {
            link.addEventListener('click', event => {
                const id = link.dataset.id;

                deleteForm.action = `/fakultas/${id}`;
            })
        })
    </script>

@endsection