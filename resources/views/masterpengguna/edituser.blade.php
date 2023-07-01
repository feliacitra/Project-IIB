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
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Sementara</label>
                            <input type="password" id="password" name="password" placeholder="Password Sementara" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="position">Posisi</label>
                            <div class="input-group">
                                <select class="form-select" id="position" name="role">
                                    <option value="" disabled>Pilih posisi</option>
                                    <option value="admin" {{ (old('position', $user->role) === 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="peserta" {{ (old('position', $user->role) === 'peserta') ? 'selected' : '' }}>Peserta</option>
                                    <option value="pemateri" {{ (old('position', $user->role) === 'pemateri') ? 'selected' : '' }}>Pemateri</option>
                                    <option value="penilai" {{ (old('position', $user->role) === 'penilai') ? 'selected' : '' }}>Penilai</option>
                                    <option value="management" {{ (old('position', $user->role) === 'management') ? 'selected' : '' }}>Management</option>
                                    <option value="mentor" {{ (old('position', $user->role) === 'mentor') ? 'selected' : '' }}>Mentor</option>
                                    <option value="dosen" {{ (old('position', $user->role) === 'dosen') ? 'selected' : '' }}>Dosen</option>
                                    <script src="path/to/bootstrap.min.js"></script>
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <div class="input-group">
                                <select class="form-select" id="gender" name="ud_gender">
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="0" {{ optional($user->user_detail)->ud_gender === 0 ? 'selected' : '' }}>Perempuan</option>
                                    <option value="1" {{ optional($user->user_detail)->ud_gender === 1 ? 'selected' : '' }}>Laki-laki</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" id="birthdate" name="ud_birthday" placeholder="Tanggal Lahir" class="form-control" 
                                   value="{{ old('birthdate', optional($user->user_detail)->ud_birthday ? date('Y-m-d', strtotime($user->user_detail->ud_birthday)) : null) }}"
                                   required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Nomor HP</label>
                            <input type="tel" id="phone" name="ud_phone" placeholder="Nomor HP" class="form-control" pattern="[0-9]+" 
                                   value="{{ old('phone', $user->user_detail->ud_phone ?? '') }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="ud_address" placeholder="Alamat" class="form-control" required>{{ old('address') ?? ($user->user_detail ? $user->user_detail->ud_address : '') }}</textarea>
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
                        <input class="form-control @error('ud_photo')
                            is-invalid
                        @enderror" type="file" id="image" name="ud_photo">
                        @error('ud_photo')
                        <div class="invalid-feedback">Must be an image</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection