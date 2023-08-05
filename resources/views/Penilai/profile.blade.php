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
        <form action="">
            <div class="row">
                <div class="col-md-5">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" value="">
    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="">

                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" value="Penilai" disabled>

                    <label for="jenisKelamin">Jenis Kelamin</label>
                    <select id="jenisKelamin" class="form-control form-select">
                        <option value="" class="text-muted">Jenis Kelamin</option>
                        <option value="1">Attack</option>
                        <option value="2">Helicopter</option>
                    </select>

                    <label for="tempatLahir">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="">

                    <label for="tanggalLahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggalLahir" id="tanggalLahir"  placeholder="Tanggal Lahir" value="">

                    <label for="tingkatpendidikan">Tingkat Pendidikan</label>
                    <input type="text" class="form-control" id="tingkatpendidikan" placeholder="Tingkat Pendidikan" value="">

                    <label for="universitas">Universitas</label>
                    <input type="text" class="form-control" id="universitas" placeholder="Nama Universitas" value="">

                    <label for="fakultas">Fakultas</label>
                    <input type="text" class="form-control" id="universitas" placeholder="Fakultas" value="">
    
                    <label for="prodiP">Program Studi</label>
                    <input type="text" class="form-control" id="prodi" placeholder="Program Studi" value="">     
                </div>
    
                <div class="col-md-6 offset-md-1">
                    <div style="text-align: center" >
                        <img src="{{ asset('back/images/logo/user.png') }}" alt="Foto Profil" class="wd-200 ht-200 rounded-circle" style="margin-top: 2rem; margin-bottom: 2rem;">
                    </div>
    
                    <label for="foto">Unggah Foto Profil</label>
                    <input type="file" id="foto" name="foto" class="form-control">

                    <label for="namaBank">Nama Bank</label>
                    <input type="text" class="form-control" id="namaBank" placeholder="Nama Bank" value="">
    
                    <label for="noRek">Nomor Rekening</label>
                    <input type="text" class="form-control" id="noRek" placeholder="Nomor Rekening" value="">
    
                    <label for="noHP">Nomor HP</label>
                    <input type="text" class="form-control" id="noHP" placeholder="Nomor HP" value="">
    
                    <label for="addr">Alamat</label>
                    <textarea class="form-control" name="addr" id="addr" cols="10" rows="3" placeholder="Alamat"></textarea>

                    <div style="text-align: right">
                        <button class="btn btn-primary" style="margin-top: 0.7rem">Simpan</button>
                    </div>
                </div>                            
            </div>
        </form>
    </div>

    @endsection