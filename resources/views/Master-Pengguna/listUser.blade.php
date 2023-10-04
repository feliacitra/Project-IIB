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
            Master Pengguna
        </p>
    </div>

    <!-- Button Tambah -->
    @if (isFeatureInclude('pengguna-tambah', session('features')))
    <div class="pb-2" style="display: flex; justify-content: flex-end;">
        <a href="{{route('master.pengguna.add')}}" class="button btn-primary">
            <button id="openAdd" class="btn btn-primary py-1 px-2" style="display: flex; align-items: center;">
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
            <form action="/master/pengguna" class="position-relative">
                @csrf
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
    <!-- Flash messages -->
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
            @foreach ($users as $user)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->roles->name) }}</td>
                    <td class="text-center">
                        @if (isFeatureInclude('pengguna-lihat', session('features')))
                            <a href="{{route('master.pengguna.detail',$user->name)}}"><i data-feather="eye"></i></a>
                        @endif
                        @if (isFeatureInclude('pengguna-ubah', session('features')))
                            <a href="{{route('master.pengguna.edit',$user->name)}}"><i data-feather="edit-2"></i></a>
                        @endif
                        @if (isFeatureInclude('pengguna-hapus', session('features')))
                            <a href="{{ route('master.pengguna.delete', $user->name) }}" onclick="return confirm('Are you sure you want to delete this user?')"><i data-feather="trash-2"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <!-- Table Body -->
        </table>
    </div>
    <!-- Users Table -->

@endsection