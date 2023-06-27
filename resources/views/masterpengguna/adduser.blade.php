@extends('layouts.back.app')
@section('content')
    <style>
        .card-header {
            font-family: Verdana, Arial, sans-serif;
            font-size: 24px;
        }
    </style>

    <div class="pb-4">
        <p style="display: flex; align-items: flex-end;">
            <a href="/masterpengguna"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            Master Pengguna > Tambah
        </p>
    </div>

    <div class="container" style="background-color: #f2f2f2">
        <div class="card-header text-center">Tambah Pengguna</div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password Sementara</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="position">Posisi</label>
                            <select id="position" name="position" class="form-control" required>
                                <option value="posisi1">Posisi 1</option>
                                <option value="posisi2">Posisi 2</option>
                                <!-- Tambahkan pilihan posisi lainnya sesuai kebutuhan -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Tanggal Lahir</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Nomor HP</label>
                            <input type="tel" id="phone" name="phone" class="form-control" pattern="[0-9]+" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" class="form-control" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="form-group">
                        <img id="profile-image" src="{{ asset('resources/views/masterpengguna/icon.png') }}" alt="Foto Profil" class="img-thumbnail">
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