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
            <a href=""><i data-feather="home" style="margin-right: 8px; margin-left: 12px;"></i></a>
            <a href="" style="color: black;">Profile</a>
        </p>
    </div>

    <div class="container-fluid" style="background-color: #f2f2f2">
        <div class="card-header text-center">Profile</div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="add-user-form" method="" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" style="text-align: center" >
                                <img id="profile-image" src="{{ asset('back/images/logo/user.png') }}" sizes="16x16" alt="Foto Profil" class="img-thumbnail" >
                            </div>
                            {{-- <div class="form-group profile-icon">
                                <i class="fas fa-user-circle fa-10x"></i>
                            </div> --}}


                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" placeholder="Nama Lengkap" readonly class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email" readonly class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password Sementara</label>
                                <input type="password" id="password" name="password" readonly placeholder="Password Sementara" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="position">Posisi</label>
                                <input type="text" id="position" name="position" readonly placeholder="Posisi" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <input type="text" id="gender" name="gender" readonly placeholder="Jenis Kelamin" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="place_of_birth">Tempat Lahir</label>
                                <input type="text" readonly id="place_of_birth" name="place_of_birth" class="form-control" placeholder="Tempat Lahir">
                            </div>
                            
                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" id="birthdate" readonly name="birthdate" placeholder="Tanggal Lahir" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone">Nomor HP</label>
                                <input type="tel" id="phone" name="phone" readonly placeholder="Nomor HP" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" name="address" readonly placeholder="Alamat" class="form-control" ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="bank_name">Nama Bank</label>
                                <input type="text" id="bank_name" name="bank_name" readonly class="form-control" placeholder="Nama Bank">
                            </div>

                            <div class="form-group">
                                <label for="account_number">Nomor Rekening</label>
                                <input type="text" id="account_number" name="account_number" readonly class="form-control" placeholder="Nomor Rekening">
                            </div>

                            <div class="form-group">
                                <label for="education_level">Tingkat Pendidikan</label>
                                <input type="text" id="education_level" name="education_level" readonly class="form-control" placeholder="Tingkat Pendidikan">
                            </div>
                            
                            <div class="form-group">
                                <label for="university">Universitas</label>
                                <input type="text" id="university" name="university" readonly class="form-control" placeholder="Universitas">
                            </div>
                            
                            <div class="form-group">
                                <label for="faculty">Fakultas</label>
                                <input type="text" id="faculty" name="faculty" readonly class="form-control" placeholder="Fakultas">
                            </div>
                            
                            <div class="form-group">
                                <label for="major">Program Studi</label>
                                <input type="text" id="major" readonly name="major" class="form-control" placeholder="Program Studi">
                            </div>

                            <button type="submit" class="btn btn-primary" form="add-user-form">Tambah</button>
                            <button type="button" class="btn btn-primary" form="add-user-form" onclick="history.back()" style="background-color: grey; border-color: grey">Kembali</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
