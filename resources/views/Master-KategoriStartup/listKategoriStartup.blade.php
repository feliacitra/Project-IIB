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
            Master Kategori Startup
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addStartupCategory" class="button btn-primary">
            <button id="openAddStartUpCategory" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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
                <form action="{{ route('master.kategori.startup')}}" class="position-relative">
                    @csrf
                    <input value="{{ $keyword ?? '' }}" type="search" name="search" class="form-control rounded" placeholder="Cari" aria-label="Search" aria-describedby="search-addon" style="width: 350px; padding-left: 2.5rem">
                    
                    <span class="position-absolute" style="top: 50%; left: 0.5rem; transform: translateY(-50%);">
                        <i data-feather="search"></i>
                    </span>
                </form>
                <!-- Input Form -->
            </div>
        </div>
        <div class="pb-2">
            <a href="{{ route('master.kategori.startup') }}" class="button btn-primary">
                <button class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
                    <i data-feather="plus" style="margin-right: 0.3rem;"></i>
                    RESET PENCARIAN
                </button>
            </a>
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
                    <th scope="col" style="width: 25%">NAMA KATEGORI</th>
                    <th scope="col" style="width: 40%">KETERANGAN</th>
                    <th scope="col" style="width: 20%">STATUS</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
            @foreach ($categories as $category)
                
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $category->mc_name }}</td>
                    <td>{{ $category->mc_description }}</td>
                    <td class="text-center">{{ $category->mc_status }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        <a href="#viewStartupCategory" data-name="{{ $category->mc_name }}" data-description="{{ $category->mc_description }}" data-status="{{ $category->mc_status }}"><i data-feather="eye"></i></a>
                        <!-- EDIT -->
                        <a href="#editStartupCategory" data-id="{{ $category->mc_id }}" data-name="{{ $category->mc_name }}" data-description="{{ $category->mc_description }}" data-status="{{ $category->mc_status }}"><i data-feather="edit-2"></i></a>
                        <!-- DELETE -->
                        <a href="#deleteStartupCategory" data-id="{{ $category->mc_id }}"><i data-feather="trash-2"></i></a>
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
    <div class="overlay" id="addStartupCategory">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Kategori</h4>
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
                        <form action="/master/kategori/startup" method="POST">
                            @csrf
                            <!-- Input Nama Kategori -->
                            <input type="text" class="form-control rounded" id="addNamaKategori" name="addNamaKategori" placeholder="Nama Kategori" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama Kategori -->

                            <!-- Input Keterangan Kategori -->
                            <textarea class="form-control rounded" id="addKeteranganKategori" name="addKeteranganKategori" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem"></textarea>
                            <!-- Input Keterangan Kategori -->

                            <!-- Select Status -->
                            <select name="addStatusKategori" id="addStatusKategori" class="form-control form-select" style="margin-top: 1rem;">
                                <option value="" class="text-muted">Status</option>
                                <option value="AKTIF">AKTIF</option>
                                <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                            </select>
                            <!-- Select Status -->

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
    <div class="overlay" id="viewStartupCategory">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Kategori</h4>
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
                        <!-- View Nama Kategori -->
                        <input  type="text" class="form-control rounded"  id="viewNamaKategori" name="viewNamaKategori" placeholder="Nama Program"  style="margin-top: 1rem; width: 100%" readonly>
                        <!-- View Nama Kategori -->

                        <!-- View Keterangan Kategori -->
                        <textarea class="form-control rounded" id="viewKeteranganKategori" name="viewKeteranganKategori" cols="20" rows="10" style="margin-top: 1rem;" readonly></textarea>
                        <!-- View Keterangan Kategori -->

                        <!-- Select Status -->
                        <input  type="text" class="form-control rounded"  id="viewStatusKategori" name="viewStatusKategori" placeholder="Status Program"  style="margin-top: 1rem; width: 100%" readonly>
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
    <div class="overlay" id="editStartupCategory">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Kategori</h4>
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
                        <form action="/master/kategori/startup" method="POST" id="editForm">
                            @csrf
                            @method('PUT')
                            <!-- Edit Nama Kategori -->
                            <input type="text" class="form-control rounded" id="editNamaKategori" name="editNamaKategori" placeholder="Nama Program" style="margin-top: 1rem; width: 100%">
                            <!-- Edit Nama Kategori -->

                            <!-- Edit Keterangan Kategori -->
                            <textarea class="form-control rounded" id="editKeteranganKategori" name="editKeteranganKategori" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;"></textarea>
                            <!-- Edit Keterangan Kategori -->

                            <!-- Select Status -->
                            <select name="editStatusKategori" id="editStatusKategori" class="form-control form-select" style="margin-top: 1rem;">
                                <option value="" class="text-muted">Pilih status</option>
                                <option value="AKTIF">AKTIF</option>
                                <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                            </select>
                            <!-- Select Status -->

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button type="submit" id="saveEdit" class="btn btn-primary">
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
    <div class="overlay" id="deleteStartupCategory">
        <div class="wrapper" style="width: 25%">
            <form action="/master/kategori/startup" method="POST" id=deleteForm>
            @csrf
            @method('DELETE')
            <div class="content">
                <p class="text-center">
                    Hapus kategori?
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
        const viewLinks = document.querySelectorAll('a[href="#viewStartupCategory"]');
    
        viewLinks.forEach(link => {
            link.addEventListener('click', event => {
    
                const name = link.dataset.name;
                const description = link.dataset.description;
                const status = link.dataset.status;
    
                document.getElementById('viewNamaKategori').value = name;
                document.getElementById('viewKeteranganKategori').value = description;
                document.getElementById('viewStatusKategori').value = status;
            });
        });
        
        const editLinks = document.querySelectorAll('a[href="#editStartupCategory"]');
    
        editLinks.forEach(link => {
            link.addEventListener('click', event => {
    
                const id = link.dataset.id;
                const name = link.dataset.name;
                const description = link.dataset.description;
                const status = link.dataset.status;
    
                document.getElementById('editNamaKategori').value = name;
                document.getElementById('editKeteranganKategori').value = description;
                document.getElementById('editStatusKategori').value = status;
                editForm.action = `/master/kategori/startup/${id}`;
            });
        });

        const deleteLinks = document.querySelectorAll('a[href="#deleteStartupCategory"]');
        deleteLinks.forEach(link => {
            link.addEventListener('click', event => {
                const id = link.dataset.id;
                deleteForm.action = `/master/kategori/startup/${id}`;
            })
        })
    </script>
@endsection