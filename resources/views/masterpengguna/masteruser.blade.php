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

    <div class="pb-4">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Master Pengguna
        </p>
    </div>

    <!-- Button Tambah -->
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <button class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;"">
            <i data-feather="plus" style="margin-right: 0.3rem;"></i>
            TAMBAH
        </button>
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
                    <th scope="col" style="width: 30%">NAMA</th>
                    <th scope="col" style="width: 30%">EMAIL</th>
                    <th scope="col" style="width: 25%">POSISI</th>
                    <th scope="col" style="width: 10%">AKSI</th>
                </tr>
            </thead>
            <!-- Table Head -->

            <!-- Table Body -->
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->name }}</td>
                    <td class="text-center">
                        <a href=""><i data-feather="eye"></i></a>
                        <a href=""><i data-feather="edit-2"></i></a>
                        <a href=""><i data-feather="trash-2"></i></a>
                    </td>
                </tr>
                @endforeach
                {{-- @foreach ($roles as $role)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $role }}</td>
                </tr>
                @endforeach --}}
                {{-- <tr>
                    <th scope="row" class="text-center">1</th>
                    <td>User</td>
                    <td>user@email.com</td>
                    <td>Peserta</td>
                    <td class="text-center">
                        <a href=""><i data-feather="eye"></i></a>
                        <a href=""><i data-feather="edit-2"></i></a>
                        <a href=""><i data-feather="trash-2"></i></a>
                    </td>
                </tr> --}}
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

@endsection