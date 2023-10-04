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
    @if (isFeatureInclude('civitas-tambah', session('features')))
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addCivitas" class="button btn-primary">
            <button id="openAddCivitas" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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
                <form action="/master/civitas" class="position-relative">
                    
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
        <table class="table" id="datatable">
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
            @foreach ($civitas as $civ)
                
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $civ->mci_name }}</td>
                    <td>{{ $civ->mci_description }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        @if (isFeatureInclude('civitas-lihat', session('features')))
                        <a href="#viewCivitas" data-name="{{ $civ->mci_name }}" data-description="{{ $civ->mci_description }}"><i data-feather="eye"></i></a>
                        @endif
                        <!-- EDIT -->
                        @if (isFeatureInclude('civitas-ubah', session('features')))
                        <a href="#editCivitas" data-id="{{ $civ->mci_id }}" data-name="{{ $civ->mci_name }}" data-description="{{ $civ->mci_description }}"><i data-feather="edit-2"></i></a>
                        @endif
                        <!-- DELETE -->
                        @if (isFeatureInclude('civitas-hapus', session('features')))
                        <a href="#deleteCivitas" data-id="{{ $civ->mci_id }}"><i data-feather="trash-2"></i></a>
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
                        <form action="/master/civitas" method="POST">
                            @csrf
                            <!-- Input Nama civitas -->
                            <input type="text" class="form-control rounded" id="addNamaCivitas" name="addNamaCivitas" placeholder="Nama Civitas" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama civitas -->

                            <!-- Input Keterangan Civitas -->
                            <textarea class="form-control rounded" id="addKeteranganCivitas" name="addKeteranganCivitas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem"></textarea>
                            <!-- Input Keterangan Civitas -->

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
                        <!-- View Nama Civitas -->
                        <input type="text" class="form-control rounded" id="showNamaCivitas" placeholder="Nama Civitas" style="margin-top: 1rem; width: 100%" readonly>
                        <!-- View Nama Civitas -->

                        <!-- View Keterangan Civitas -->
                        <textarea class="form-control rounded" id="showKeteranganCivitas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;"></textarea>
                        <!-- View Keterangan Civitas -->

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
                        <form action="/master/civitas/" method="POST" id="editForm">

                            @csrf
                            @method('PUT')
                            <!-- Edit Nama Civitas -->
                            <div class="form-group">
                                <label style="margin-top: 1rem;">Nama Civitas</label>
                                <input type="text" class="form-control rounded" id="editNamaCivitas" name="editNamaCivitas" placeholder="Nama Civitas" style="margin-top: 1rem; width: 100%">
                            </div>
                            <!-- Edit Nama Civitas -->

                            <!-- Edit Keterangan Civitas -->
                            <div class="form-group">
                                <label style="margin-top: 1rem;">Keterangan</label>
                                <textarea class="form-control rounded" id="editKeteranganCivitas" name="editKeteranganCivitas" cols="20" rows="10" placeholder="Deskripsi" style="margin-top: 1rem;"></textarea>
                            </div>
                            <!-- Edit Keterangan Civitas -->

                            <div class="row mt-4">
                                <!--Button Perbarui -->
                                <div class="col">
                                    <button type="submit" id="saveEdit" class="btn btn-primary">
                                        Perbarui
                                    </button>
                                </div>
                                <!--Button Perbarui -->

                                <!--Button Back -->
                                <div class="col d-flex justify-content-end">
                                    <a href="#" class="button-link">Kembali</a>
                                </div>
                                <!--Button Back -->
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
            <form action="/master/civitas/" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="content">
                <p class="text-center">
                    Hapus civitas?
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
        const viewLinks = document.querySelectorAll('a[href="#viewCivitas"]');
    
        viewLinks.forEach(link => {
            link.addEventListener('click', event => {
    
                const name = link.dataset.name;
                const description = link.dataset.description;
    
                document.getElementById('showNamaCivitas').value = name;
                document.getElementById('showKeteranganCivitas').value = description;
            });
        });

        const editLinks = document.querySelectorAll('a[href="#editCivitas"]');
    
        editLinks.forEach(link => {
            link.addEventListener('click', event => {
    
                const id = link.dataset.id;
                const name = link.dataset.name;
                const description = link.dataset.description;
    
                document.getElementById('editNamaCivitas').value = name;
                document.getElementById('editKeteranganCivitas').value = description;

                editForm.action = `/master/civitas/${id}`;
            });
        });
        
        const deleteLinks = document.querySelectorAll('a[href="#deleteCivitas"]');

        deleteLinks.forEach(link => {
            link.addEventListener('click', event => {
                const id = link.dataset.id;

                deleteForm.action = `/master/civitas/${id}`;
            })
        })

    </script>

@endsection