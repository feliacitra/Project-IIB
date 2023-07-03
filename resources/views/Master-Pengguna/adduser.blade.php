@extends('layouts.back.app')
@section('content')
    <style>
        .card-header {
            font-family: Verdana, Arial, sans-serif;
            font-size: 24px;
        }
        .card-header-center {
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
            height: 1px;
        }
        .profile-icon img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    <div class="pb-4">
        <p style="display: flex; align-items: flex-end;">
            <a href="/masteruser"><i data-feather="home" style="margin-right: 8px; margin-left: 12px;"></i></a>
            <a href="/masteruser" style="color: black;">Master Pengguna</a> &nbsp;&gt;&nbsp; Tambah Pengguna
        </p>
    </div>

    <div class="container-fluid" style="background-color: #f2f2f2">
        <div class="card-header text-center">Tambah Pengguna</div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <form id="add-user-form" method="POST" action="{{ route('adduser') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="text-align: center" >
                                <img id="profile-image" src="{{ asset('back/images/logo/user.png') }}" sizes="16x16" alt="Foto Profil" class="img-thumbnail" >
                            </div>
                            <div class="form-group profile-icon">
                                <i class="fas fa-user-circle fa-10x"></i>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Unggah Foto Profil</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password Sementara</label>
                                <input type="password" id="password" name="password" placeholder="Password Sementara" class="form-control @error('password') is-invalid @enderror" >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="position">Posisi</label>
                                <select class="form-control" id="position" name="position">
                                    <option value="" disabled selected>Pilih posisi</option>
                                    <option value="admin">Admin</option>
                                    <option value="peserta">Peserta</option>
                                    <option value="penilai">Penilai</option>
                                    <option value="pemateri">Pemateri</option>
                                    <option value="management">Management</option>
                                    <option value="mentor">Mentor</option>
                                    <option value="dosen">Dosen</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="perempuan">Perempuan</option>
                                    <option value="laki-laki">Laki-laki</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="place_of_birth">Tempat Lahir</label>
                                <input type="text" id="place_of_birth" name="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror" value="{{ old('place_of_birth') }}">
                                @error('place_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" id="birthdate" name="birthdate" placeholder="Tanggal Lahir" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}">
                                @error('birthdate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor HP</label>
                                <input type="tel" id="phone" name="phone" placeholder="Nomor HP" class="form-control @error('phone') is-invalid @enderror" pattern="[0-9]+" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" name="address" placeholder="Alamat" class="form-control @error('address') is-invalid @enderror" >{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bank_name">Nama Bank</label>
                                <input type="text" id="bank_name" name="bank_name" class="form-control @error('bank_name') is-invalid @enderror" value="{{ old('bank_name') }}">
                                @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="account_number">Nomor Rekening</label>
                                <input type="text" id="account_number" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number') }}">
                                @error('account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="education_level">Tingkat Pendidikan</label>
                                <input type="text" id="education_level" name="education_level" class="form-control @error('education_level') is-invalid @enderror" value="{{ old('education_level') }}">
                                @error('education_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="university">Universitas</label>
                                <input type="text" id="university" name="university" class="form-control @error('university') is-invalid @enderror" value="{{ old('university') }}">
                                @error('university')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="faculty">Fakultas</label>
                                <input type="text" id="faculty" name="faculty" class="form-control @error('faculty') is-invalid @enderror" value="{{ old('faculty') }}">
                                @error('faculty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="major">Program Studi</label>
                                <input type="text" id="major" name="major" class="form-control @error('major') is-invalid @enderror" value="{{ old('major') }}">
                                @error('major')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" form="add-user-form">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
