@extends('layouts.back.app')
@section('content')

    @php
    use Illuminate\Support\Optional;
    @endphp

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
            <a href="/masteruser" style="color: black;">Master Pengguna</a> &nbsp;&gt;&nbsp; Edit Pengguna
        </p>
    </div>

    <div class="container" style="background-color: #f2f2f2">
    <form method="post" action="/edituser/{{ $user->name }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card-header text-center">Edit Pengguna</div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
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
                            <label for="password">Password Sementara</label>
                            <input type="password" id="password" name="password" placeholder="Password Sementara" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Posisi</label>
                            <div class="input-group">
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="" disabled>Pilih posisi</option>
                                    <option value="admin" {{ (old('role', $user->role) === 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="peserta" {{ (old('role', $user->role) === 'peserta') ? 'selected' : '' }}>Peserta</option>
                                    <option value="pemateri" {{ (old('role', $user->role) === 'pemateri') ? 'selected' : '' }}>Pemateri</option>
                                    <option value="penilai" {{ (old('role', $user->role) === 'penilai') ? 'selected' : '' }}>Penilai</option>
                                    <option value="management" {{ (old('role', $user->role) === 'management') ? 'selected' : '' }}>Management</option>
                                    <option value="mentor" {{ (old('role', $user->role) === 'mentor') ? 'selected' : '' }}>Mentor</option>
                                    <option value="dosen" {{ (old('role', $user->role) === 'dosen') ? 'selected' : '' }}>Dosen</option>
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
                            <input type="text" id="place_of_birth" name="place_of_birth" class="form-control" value="{{ old('place_of_birth', optional($user->user_detail)->ud_placeofbirth) }}">
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
                            <input type="text" id="bank_name" name="bank_name" class="form-control" value="{{ old('bank_name', optional($user->user_detail)->ud_bank) }}">
                        </div>

                        <div class="form-group">
                            <label for="account_number">Nomor Rekening</label>
                            <input type="text" id="account_number" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number', optional($user->user_detail)->ud_accountnumber) }}">
                            @error('account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="education_level">Tingkat Pendidikan</label>
                            <input type="text" id="education_level" name="education_level" class="form-control" value="{{ old('education_level', optional($user->user_detail)->ud_lasteducation) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="university">Universitas</label>
                            <input type="text" id="university" name="university" class="form-control" value="{{ old('university', optional($user->user_detail)->ud_university) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="faculty">Fakultas</label>
                            <input type="text" id="faculty" name="faculty" class="form-control" value="{{ old('faculty', optional($user->user_detail)->ud_faculty) }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="major">Program Studi</label>
                            <input type="text" id="major" name="major" class="form-control" value="{{ old('major', optional($user->user_detail)->ud_programstudy) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card my-3">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="form-group">
                        @if (optional($user->user_detail)->ud_photo)
                            <img id="profile-image" name="profile-image" src="{{ url('storage/' . $user->user_detail->ud_photo) }}" sizes="16x16" alt="Foto Profil" class="img-thumbnail" style="width: 300px; height: 300px;">
                        @else
                            <img id="profile-image" name="profile-image" src="{{ asset('back/images/logo/user.png') }}" sizes="16x16" alt="Foto Profil" class="img-thumbnail" style="width: 300px; height: 300px;">
                        @endif
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
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection