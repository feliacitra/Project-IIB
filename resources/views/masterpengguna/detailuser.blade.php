@extends('layouts.back.app')
@section('content')
    <style>
        .card-header {
            font-family: Verdana, Arial, sans-serif;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .profile-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 5px;
        }
    </style>

    <div class="pb-4">
        <p style="display: flex; align-items: flex-end;">
            <a href="/masterpengguna"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            Master Pengguna > Detail Pengguna
        </p>
    </div>

    <div class="container">
        <h1>Detail Pengguna</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama Lengkap</h5>
                <p class="card-text">{{ $user->name }}</p>

                <h5 class="card-title">Email</h5>
                <p class="card-text">{{ $user->email }}</p>

                <h5 class="card-title">Posisi</h5>
                <p class="card-text">{{ $user->position }}</p>

                <h5 class="card-title">Jenis Kelamin</h5>
                <p class="card-text">{{ $user->user_detail?->ud_gender }}</p>

                <h5 class="card-title">Tanggal Lahir</h5>
                <p class="card-text">{{ $user->user_detail?->ud_birthday }}</p>

                <h5 class="card-title">Nomor HP</h5>
                <p class="card-text">{{ $user->user_detail?->ud_phone }}</p>

                <h5 class="card-title">Alamat</h5>
                <p class="card-text">{{ $user->user_detail?->ud_address }}</p>

                <h5 class="card-title">Foto Profil</h5>
                <!-- Show the profile user please change this -->
                <img src="{{ asset($user->user_detail?->ud_photo) }}" alt="Foto Profil" class="img-fluid">
            </div>
        </div>
    </div>

@endsection