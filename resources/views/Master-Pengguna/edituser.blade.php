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
            <a href="{{ route('master.pengguna') }}"><i data-feather="home" style="margin-right: 8px; margin-left: 12px;"></i></a>
            <a href="{{ route('master.pengguna') }}" style="color: black;">Master Pengguna</a> &nbsp;&gt;&nbsp; Edit Pengguna
        </p>
    </div>

    <div class="container-fluid" style="background-color: #f2f2f2">
        <div class="card-header text-center">Edit Pengguna</div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/master/pengguna/{{ $user->name }}/edit" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group" style="text-align: center" >
                                @if (optional($user->user_detail)->ud_photo)
                                    <img src="{{ url('storage/' . $user->user_detail->ud_photo) }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                                @else
                                    <img src="{{ asset('back/images/logo/user.png') }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: -5px; margin-bottom: 20px;">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Unggah Foto Profil</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group profile-icon">
                                <i class="fas fa-user-circle fa-10x"></i>
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Posisi</label>
                                <div class="input-group">
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="" disabled selected>Pilih posisi</option>
                                    <option value="1" {{ (old('role', $user->role) === 1) ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ (old('role', $user->role) === 2) ? 'selected' : '' }}>Peserta</option>
                                    <option value="3" {{ (old('role', $user->role) === 3) ? 'selected' : '' }}>Penilai</option>
                                    <option value="4" {{ (old('role', $user->role) === 4) ? 'selected' : '' }}>Pemateri</option>
                                    <option value="5" {{ (old('role', $user->role) === 5) ? 'selected' : '' }}>Mentor</option>
                                    <option value="6" {{ (old('role', $user->role) === 6) ? 'selected' : '' }}>Dosen</option>
                                    <option value="7" {{ (old('role', $user->role) === 7) ? 'selected' : '' }}>Management</option>
                                    <script src="path/to/bootstrap.min.js"></script>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <div class="input-group">
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="" disabled selected>Pilih jenis kelamin</option>
                                        <option value="0" {{ optional($user->user_detail)->ud_gender === 0 ? 'selected' : '' }}>Perempuan</option>
                                        <option value="1" {{ optional($user->user_detail)->ud_gender === 1 ? 'selected' : '' }}>Laki-laki</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="place_of_birth">Tempat Lahir</label>
                                <input type="text" id="place_of_birth" name="place_of_birth" placeholder="Tempat Lahir" class="form-control" value="{{ old('place_of_birth', optional($user->user_detail)->ud_placeofbirth) }}">
                            </div>

                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" id="birthdate" name="birthdate" placeholder="Tanggal Lahir" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate', optional($user->user_detail)->ud_birthday ? date('Y-m-d', strtotime($user->user_detail->ud_birthday)) : null) }}">
                                @error('birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Nomor HP</label>
                                <input type="tel" id="phone" name="phone" placeholder="Nomor HP" class="form-control @error('phone') is-invalid @enderror" pattern="[0-9]+" value="{{ old('phone', optional($user->user_detail)->ud_phone ?? '') }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" name="address" placeholder="Alamat" class="form-control">{{ old('address') ?? ($user->user_detail ? $user->user_detail->ud_address : '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="bank_name">Nama Bank</label>
                                <input type="text" id="bank_name" name="bank_name" placeholder="Nama Bank" class="form-control" value="{{ old('bank_name', optional($user->user_detail)->ud_bank) }}">
                            </div>

                            <div class="form-group">
                                <label for="account_number">Nomor Rekening</label>
                                <input type="text" id="account_number" name="account_number" placeholder="Nomor Rekening" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number', optional($user->user_detail)->ud_accountnumber) }}">
                                @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="education_level">Tingkat Pendidikan</label>
                                <input type="text" id="education_level" name="education_level" placeholder="Tingkat Pendidikan" class="form-control" value="{{ old('education_level', optional($user->user_detail)->ud_lasteducation) }}">
                            </div>

                            <div class="form-group">
                                <label for="university">Universitas</label>
                                <input type="text" id="university" name="university" placeholder="Universitas" class="form-control" value="{{ old('university', optional($user->user_detail)->ud_university) }}">
                            </div>

                            <div class="form-group">
                                <label for="faculty">Fakultas</label>
                                <input type="text" id="faculty" name="faculty" placeholder="Fakultas" class="form-control" value="{{ old('faculty', optional($user->user_detail)->ud_faculty) }}">
                            </div>

                            <div class="form-group">
                                <label for="major">Program Studi</label>
                                <input type="text" id="major" name="major" placeholder="Program Studi" class="form-control" value="{{ old('major', optional($user->user_detail)->ud_programstudy) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                            <button type="button" class="btn btn-primary" form="add-user-form" onclick="history.back()" style="background-color: grey; border-color: grey">Kembali</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
