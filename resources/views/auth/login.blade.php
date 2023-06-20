@extends('layouts.back.app')
@section('content')
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4 pe-md-0">
                            <img style="  width: 100%; height: 100%; background-size: cover;" src="{{ asset('back/images/logo/door.png') }}" alt="door">
                        </div>
                        <div class="col-md-8 ps-md-0">
                            <div class="auth-form-wrapper px-4 py-5">
                                <h5 class="text-muted fw-normal mb-4">Selamat Datang! Silahkan masuk ke akun anda.</h5>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="userEmail" class="form-label">Alamat Surel</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userPassword" class="form-label">Kata Sandi</label>
                                        <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Password" required>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                        <label class="form-check-label" for="authCheck">
                                            Ingat Diriku
                                        </label>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Masuk</button>
                                    </div>
                                    <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Belum punya akun ? Lewat sini</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
