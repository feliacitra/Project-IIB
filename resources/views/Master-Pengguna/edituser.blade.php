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
            Master Pengguna > Edit
        </p>
    </div>

    <div class="container" style="background-color: #f2f2f2">
        <div class="card-header text-center">Edit Pengguna</div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Sementara</label>
                            <input type="password" id="password" name="password" placeholder="Password Sementara" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="posisition">Posisi</label>
                            <div class="input-group">
                                <select class="form-control" id="position" name="position">
                                    <option value="" disabled selected>Pilih posisi</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Penilai">Penilai</option>
                                    <option value="Management">Management</option>
                                    <option value="Peserta">Peserta</option>
                                    <option value="Mentor">Mentor</option>
                                    <script src="path/to/bootstrap.min.js"></script>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Admin</a>
                                        <a class="dropdown-item" href="#">Dosen</a>
                                        <a class="dropdown-item" href="#">Penilai</a>
                                        <a class="dropdown-item" href="#">Management</a>
                                        <a class="dropdown-item" href="#">Peserta</a>
                                        <a class="dropdown-item" href="#">Mentor</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <div class="input-group">
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="perempuan">Perempuan</option>
                                    <option value="laki-laki">Laki-laki</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Perempuan</a>
                                        <a class="dropdown-item" href="#">Laki-laki</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" id="birthdate" name="birthdate" placeholder="Tanggal Lahir" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Nomor HP</label>
                            <input type="tel" id="phone" name="phone" placeholder="Nomor HP" class="form-control" pattern="[0-9]+" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" placeholder="Alamat" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Edit</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="form-group">
                        <img id="profile-image" src="{{ asset('back/images/logo/user.png') }}" sizes="16x16" alt="Foto Profil" class="img-thumbnail">
                    </div>
                    <div class="form-group profile-icon">
                        <i class="fas fa-user-circle fa-10x"></i>
                    </div>
                    <div class="form-group">
                        <label for="profile-photo">Unggah Foto Profil</label>
                        <input type="file" id="profile-photo" name="profile-photo" class="form-control-file">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection