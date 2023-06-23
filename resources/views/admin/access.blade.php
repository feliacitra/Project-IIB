@extends('layouts.back.app')
@section('content')
<div class="pb-4">
    <p style="display: flex; align-items: flex-end;">
        <!-- Home button -->
        <a href="{{ route('dashboard') }}" style="color: black"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
        <!-- Home button -->
        Hak Akses
    </p>
</div>
<h2>Pengaturan Hak Akses</h2>
<div class="container-fluid" style="background-color: #F0F0F0; height: 90%;">
    <div class="row">
        <div class="col-md-6">
            <!-- Form ubah password -->
            <div class="auth-form-wrapper p-4">
                @csrf
                <form method="" action="">
                    <!-- Password Sekarang -->
                    <div class="mb-3">
                        <label for="current-password" class="mb-1"><b>Password Sekarang</b></label>
                        <input id="current-password" type="password" placeholder="Password Sekarang" class="form-control" required>
                    </div>
                    <!-- Password Sekarang -->

                    <!-- Password Baru -->
                    <div class="mb-3">
                        <label for="new-password" class="mb-1"><b>Password Baru</b></label>
                        <input id="new-password" type="password" placeholder="Password Baru" class="form-control" required>
                    </div>
                    <!-- Password Baru -->

                    <!-- Ketik Ulang Password Baru -->
                    <div class="mb-3">
                        <label for="new-password" class="mb-1"><b>Ketik Ulang Password</b></label>
                        <input id="new-password" type="password" placeholder="Ketik Ulang Password" class="form-control" required>
                    </div>
                    <!-- Ketik Ulang Password Baru -->

                    <!-- Button Perbarui -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4">Perbarui</button>
                    </div>
                    <!-- Button Perbarui -->
                </form>
            </div>
            <!-- Form ubah password -->
        </div>

        <!-- Kolom syarat -->
        <div class="col-md-6 p-4">
            <div class="card p-4 h-100" style="background-color: #F8E284">
                <h4>Syarat perubahan password:</h4>
                <div class="px-3 py-3">
                    <li>Minimal terdiri dari 8 karakter</li>
                    <li>Maksimal 12 karakter</li>
                    <li>Memiliki kombinasi huruf besar dan huruf kecil</li>
                    <li>Memiliki angka antara 0 s.d. 9</li>
                    <li>Memiliki karakter khusus atau simbol.</li>
                    <p style="padding-left: 1.2rem">Daftar simbol yang diperbolehkan !@$*(),.":</p>
                </div>
                <h6>Contoh: p@55Word3</h6>
            </div>
        </div>
        <!-- Kolom syarat -->
    </div>
</div>
@endsection
