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
    <form method="post" action="/edituser/{{ $user->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="card-header text-center">Edit Pengguna</div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password Sementara</label>
                            <input type="password" id="password" name="password" placeholder="Password Sementara" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Posisi</label>
                            <div class="input-group">
                                <select class="form-select" id="role" name="role">
                                    <option value="" disabled>Pilih posisi</option>
                                    <option value="1" {{ (old('role', $user->role) == '1') ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ (old('role', $user->role) == '2') ? 'selected' : '' }}>Peserta</option>
                                    <option value="3" {{ (old('role', $user->role) == '3') ? 'selected' : '' }}>Penilai</option>
                                    <option value="4" {{ (old('role', $user->role) == '4') ? 'selected' : '' }}>Pemateri</option>
                                    <option value="5" {{ (old('role', $user->role) == '5') ? 'selected' : '' }}>Mentor</option>
                                    <option value="6" {{ (old('role', $user->role) == '6') ? 'selected' : '' }}>Dosen</option>
                                    <option value="7" {{ (old('role', $user->role) == '7') ? 'selected' : '' }}>Management</option>
                                    <script src="path/to/bootstrap.min.js"></script>
                                </select>
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
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" id="birthdate" name="birthdate" placeholder="Tanggal Lahir" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate', optional($user->user_detail)->ud_birthday ? date('Y-m-d', strtotime($user->user_detail->ud_birthday)) : null) }}" required>
                            @error('birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Nomor HP</label>
                            <input type="tel" id="phone" name="phone" placeholder="Nomor HP" class="form-control @error('phone') is-invalid @enderror" pattern="[0-9]+" value="{{ old('phone', $user->user_detail->ud_phone ?? '') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" placeholder="Alamat" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') ?? ($user->user_detail ? $user->user_detail->ud_address : '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                        <input class="form-control @error('image')
                            is-invalid
                        @enderror" type="file" id="image" name="image">
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