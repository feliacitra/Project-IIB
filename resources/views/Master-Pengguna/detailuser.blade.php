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
            <a href="{{ route('master.pengguna') }}"><i data-feather="home" style="margin-right: 8px; margin-left: 12px;"></i></a>
            <a href="{{ route('master.pengguna') }}" style="color: black;">Master Pengguna</a> &nbsp;&gt;&nbsp; Tambah Pengguna
        </p>
    </div>



    <div class="container">
        <h1>Detail Pengguna</h1>

        <div class="card">
            <div class="card-body">

                <h5 class="card-title" style="margin-bottom: 25px;">Foto Profil</h5>
                <!-- Show the profile user please change this -->
                @if (optional($user->user_detail)->ud_photo)
                    <img src="{{ url('storage/' . $user->user_detail->ud_photo) }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                @else
                    <img src="{{ asset('back/images/logo/user.png') }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                @endif

                <h5 class="card-title">Nama Lengkap</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->name ?? '-' }}</p>

                <h5 class="card-title">Email</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->email ?? '-' }}</p>

                <h5 class="card-title">Posisi</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ ucfirst($user->roles->name) ?? '-' }}</p>

                <h5 class="card-title">Jenis Kelamin</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">
                    {{ $user->user_detail?->ud_gender === 0 ? 'Perempuan' : ($user->user_detail?->ud_gender === 1 ? 'Laki-laki' : '-') }}
                </p>

                <h5 class="card-title">Tempat Lahir</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_placeofbirth ?? '-' }}</p>

                <h5 class="card-title">Tanggal Lahir</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_birthday ?? '-' }}</p>

                <h5 class="card-title">Nomor HP</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_phone ?? '-' }}</p>

                <h5 class="card-title">Alamat</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_address ?? '-' }}</p>

                <h5 class="card-title">Bank</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_bank ?? '-' }}</p>

                <h5 class="card-title">Nomor Rekening</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_accountnumber ?? '-' }}</p>

                <h5 class="card-title">Tingkat Pendidikan</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_lasteducation ?? '-' }}</p>

                <h5 class="card-title">Universitas</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_university ?? '-' }}</p>

                <h5 class="card-title">Fakultas</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_faculty ?? '-' }}</p>

                <h5 class="card-title">Program Studi</h5>
                <p class="card-text" style="margin-top: -10px; margin-bottom: 15px;">{{ $user->user_detail?->ud_programstudy ?? '-' }}</p>
            </div>
        </div>
    </div>

@endsection