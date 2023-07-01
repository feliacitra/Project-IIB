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
            <a href="/masteruser"><i data-feather="home" style="margin-right: 8px; margin-left: 12px;"></i></a>
            <a href="/masteruser" style="color: black;">Master Pengguna</a> &nbsp;&gt;&nbsp; Detail Pengguna
        </p>
    </div>



    <div class="container">
        <h1>Detail Pengguna</h1>

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">Foto Profil</h5>
                <!-- Show the profile user please change this -->
                @if (optional($user->user_detail)->ud_photo)
                    <img src="{{ url('storage/' . $user->user_detail->ud_photo) }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                @else
                    <img src="{{ asset('back/images/logo/user.png') }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                @endif

                <h5 class="card-title">Nama Lengkap</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->name }}</p>

                <h5 class="card-title">Email</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->email }}</p>

                <h5 class="card-title">Posisi</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ ucfirst($user->role) }}</p>

                <h5 class="card-title">Jenis Kelamin</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_gender === 0 ? 'Perempuan' : 'Laki-laki' }}</p>

                <h5 class="card-title">Tanggal Lahir</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_birthday }}</p>

                <h5 class="card-title">Nomor HP</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_phone }}</p>

                <h5 class="card-title">Alamat</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_address }}</p>
            </div>
        </div>
    </div>

@endsection