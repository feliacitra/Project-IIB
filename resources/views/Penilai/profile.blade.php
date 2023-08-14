@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
        .container-fluid{
            background-color: #ffffff;
            border-radius: 4px;
            border: 1px solid lightgrey;
            position: relative;
        }
        .inner-bottom-button {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        .form-control{
            margin-bottom: .8rem;
        }
        label{
            margin-bottom: 2px;
        }
    </style>

    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (Session::has('errors'))
    <div class="alert alert-errors" role="alert">
        {{ Session::get('errors') }}
        <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Profil Penilai
        </p>
    </div>

    <div class="container-fluid pt-4 px-4" style="height: 100%">
        <h5 class="text-center mb-3">Profil Penilai</h5>
        <form action="/penilai/profil" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-5">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email', $user->email) }}">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" value="Penilai" disabled>

                    <label for="gender">Jenis Kelamin</label>
                    <select id="gender" name="gender" class="form-control form-select">
                        <option value="" class="text-muted">Jenis Kelamin</option>
                        <option value="0" {{ optional($user->user_detail)->ud_gender === 0 ? 'selected' : '' }}>Perempuan</option>
                        <option value="1" {{ optional($user->user_detail)->ud_gender === 1 ? 'selected' : '' }}>Laki-laki</option>
                    </select>

                    <label for="place_of_birth">Tempat Lahir</label>
                    <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="Tempat Lahir" value="{{ old('place_of_birth', optional($user->user_detail)->ud_placeofbirth) }}">

                    <label for="birthdate">Tanggal Lahir</label>
                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" id="birthdate"  placeholder="Tanggal Lahir" value="{{ old('birthdate', optional($user->user_detail)->ud_birthday ? date('Y-m-d', strtotime($user->user_detail->ud_birthday)) : null) }}">
                    @error('birthdate')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <label for="education_level">Tingkat Pendidikan</label>
                    <input type="text" class="form-control" id="education_level" name="education_level" placeholder="Tingkat Pendidikan" value="{{ old('education_level', optional($user->user_detail)->ud_lasteducation) }}">

                    <label for="university">Universitas</label>
                    <input type="text" class="form-control" id="university" name="university" placeholder="Nama university" value="{{ old('university', optional($user->user_detail)->ud_university) }}">

                    <label for="faculty">Fakultas</label>
                    <input type="text" class="form-control" id="faculty" name="faculty" placeholder="faculty" value="{{ old('faculty', optional($user->user_detail)->ud_faculty) }}">

                    <label for="major">Program Studi</label>
                    <input type="text" class="form-control" id="major" name="major" placeholder="Program Studi" value="{{ old('major', optional($user->user_detail)->ud_programstudy) }}">
                </div>
    
                <div class="col-md-6 offset-md-1">
                    <div style="text-align: center" >
                        @if (optional($user->user_detail)->ud_photo)
                            <img src="{{ url('storage/' . $user->user_detail->ud_photo) }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                        @else
                            <img src="{{ asset('back/images/logo/user.png') }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                        @endif
                    </div>
    
                    <label for="image">Unggah Foto Profil</label>
                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <label for="bank_name">Nama Bank</label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Nama Bank" value="{{ old('bank_name', optional($user->user_detail)->ud_bank) }}">

                    <label for="account_number">Nomor Rekening</label>
                    <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" placeholder="Nomor Rekening" value="{{ old('account_number', optional($user->user_detail)->ud_accountnumber) }}">
                    @error('account_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <label for="phone">Nomor HP</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Nomor HP" value="{{ old('phone', optional($user->user_detail)->ud_phone) }}">
                    @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <label for="address">Alamat</label>
                    <textarea class="form-control" name="address" id="address" cols="10" rows="3" placeholder="Alamat">{{ old('address', optional($user->user_detail)->ud_address) }}</textarea>

                    <div style="text-align: right">
                        <button class="btn btn-primary" style="margin-top: 0.7rem">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @endsection