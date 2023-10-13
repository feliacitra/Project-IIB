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
            Master Universitas
        </p>
    </div>

    <!-- Button Tambah -->
    @if (isFeatureInclude('universitas-tambah', session('features')))
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="#addUniversity" class="button btn-primary">
            <button id="openAddUniversity" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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
                <form action="/master/universitas" class="position-relative">
                    
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
                    <th scope="col" style="width: 35%">NAMA UNIVERSITAS</th>
                    <th scope="col" style="width: 40%">KETERANGAN</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                    @foreach ($master_universitas as $mu)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $mu->mu_name }}</td>
                    <td>{{ $mu->mu_description }}</td>
                    <td class="text-center">
                        <!-- VIEW -->
                        @if (isFeatureInclude('universitas-lihat', session('features')))
                        <a href="#viewUniversitas" data-name="{{ $mu->mu_name }}" data-description="{{ $mu->mu_description }}" class="lihat"><i data-feather="eye"></i></a>
                        @endif
                        <!-- EDIT -->
                        @if (isFeatureInclude('universitas-ubah', session('features')))
                        <a href="#editUniversitas" data-id="{{ $mu->mu_id }}" data-name="{{ $mu->mu_name }}" data-description="{{ $mu->mu_description }}" ><i data-feather="edit-2"></i></a>
                        @endif
                        <!-- DELETE -->
                        @if (isFeatureInclude('universitas-hapus', session('features')))
                        <a href="#deleteUniversitas" data-id="{{ $mu->mu_id }}"><i data-feather="trash-2"></i></a>
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
    <div class="overlay" id="addUniversity">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Tambah Universitas</h4>
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
                        <form action ="{{ route('master.universitas') }}" method="post">
                        @csrf
                            <!-- Input Nama Universitas -->
                            <input type="text" name="addNamaUniversitas" class="form-control rounded" id="namaUniversitas" placeholder="Nama Universitas" style="margin-top: 1rem; width: 100%">
                            <!-- Input Nama Universitas -->

                            <!-- Input Keterangan Universitas -->
                            <textarea class="form-control rounded" name="addDeskripsiUniversitas" id="keteranganUniversitas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem"></textarea>
                            <!-- Input Keterangan Universitas -->

                            <div class="row mt-4">
                                <!--Button Simpan -->
                                <div class="col">
                                    <button type="submit"  id="simpanTambah" class="btn btn-primary">
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
    <div class="overlay" id="viewUniversitas">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Lihat Universitas</h4>
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
                        <!-- View Nama Universitas -->
                        <input 
                        type="text" 
                        class="form-control rounded" 
                        id="viewNamaUniversitas"
                        name="viewNamaUniversitas" 
                        placeholder="Nama Universitas" 
                        style="margin-top: 1rem; width: 100%"
                        value="Current University Name"
                        readonly>
                        <!-- View Nama Universitas -->

                        <!-- View Keterangan Universitas -->
                        <textarea class="form-control rounded" id="viewDeskripsiUniversitas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;" readonly>Current university information.</textarea>
                        <!-- View Keterangan Universitas -->

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
    <div class="overlay" id="editUniversitas">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col col-lg-9 col-md-8">
                    <h4>Edit Universitas</h4>
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
                        <form action="master/universitas/" method="post" id="editForm">
                        @csrf 
                        @method('PUT')
                            <!-- Edit Nama Universitas -->
                            <input 
                                type="text" 
                                class="form-control rounded" 
                                id="editNamaUniversitas"
                                name="editNamaUniversitas" 
                                placeholder="Nama Universitas" 
                                style="margin-top: 1rem; width: 100%"
                                value="Current University Name">
                            <!-- Edit Nama Universitas -->

                            <!-- Edit Keterangan Universitas -->
                            <textarea class="form-control rounded" name="editDeskripsiUniversitas" id="editDeskripsiUniversitas" cols="20" rows="10" placeholder="Keterangan" style="margin-top: 1rem;">Current program description.</textarea>
                            <!-- Edit Keterangan Universitas -->

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
    <div class="overlay" id="deleteUniversitas">
        <div class="wrapper" style="width: 25%">
          <form action="/master/universitas/" method="post" id="deleteForm">
          @csrf
          @method('DELETE')
            <div class="content">
                <p class="text-center">
                    Hapus universitas?
                </p>

                <div class="row mt-4">
                    <!--Button Ya -->
                    <div class="col">
                        <button id="delete" type="submit" class="btn btn-primary" style="width: 50%">
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
    <script>
    function test(){
        const viewLinks = document.querySelectorAll('a[href="#viewUniversitas"]');
        // console.log(viewLinks);
    }
 const viewLinks = document.querySelectorAll('a[href="#viewUniversitas"]');
 
 viewLinks.forEach(link => {
        link.addEventListener('click', event => {
            
            const name = link.dataset.name;
            const description = link.dataset.description;
            
            document.getElementById('viewNamaUniversitas').value = name;
            document.getElementById('viewDeskripsiUniversitas').value = description;
        });
    });

    const editLinks = document.querySelectorAll('a[href="#editUniversitas"]');
    
    editLinks.forEach(link => {
        link.addEventListener('click', event => {
            
            const id = link.dataset.id;
            const name = link.dataset.name;
            const description = link.dataset.description;

            document.getElementById('editNamaUniversitas').value = name;
            document.getElementById('editDeskripsiUniversitas').value = description;
            
            editForm.action = `/master/universitas/${id}`;
        });
    });
    
    const deleteLinks = document.querySelectorAll('a[href="#deleteUniversitas"]');
    
    deleteLinks.forEach(link => {
        link.addEventListener('click', event => {
            const id = link.dataset.id;

            deleteForm.action = `/master/universitas/${id}`;
        })
    })
    
</script>
 
@endsection
