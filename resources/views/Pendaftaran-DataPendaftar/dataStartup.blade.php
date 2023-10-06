@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
        .tab-content{
            background-color: white;
            border: 1px solid #dee2e6;
            border-top: none;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
        }
        .form-control{
            margin-bottom: .5rem;
        }
        label{
            margin-bottom: 2px;
        }
        .card{
            margin-bottom: 1rem;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            <a href="{{ route('pendaftar') }}">Data Pendaftar</a>&nbsp;> Data Startup
        </p>
    </div>

    
        <div class="tab-content" id="nav-tabContent">
             {{-- Anggota --}}
                    <div class="p-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" value="{{ $member->mm_name }}" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" disabled>

                                        <label for="nik">NIK</label>
                                        <input type="text" value="{{ $member->mm_nik }}" class="form-control" id="nik" placeholder="NIK" disabled>

                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" value="{{ $member->mm_position }}" class="form-control" id="jabatan" placeholder="Jabatan" disabled>

                                        <label for="nomorHP">Nomor HP</label>
                                        <input type="text" value="{{ $member->mm_phone }}" class="form-control" id="nomorHP" placeholder="Nomor HP" disabled>

                                        <label for="email">Email</label>
                                        <input type="email" value="{{ $member->mm_email }}" id="email" name="email" class="form-control" placeholder="Email" disabled>

                                        <label for="mediaSosial">Media Sosial</label>
                                        <input type="text" value="{{ $member->mm_socialmedia }}" class="form-control" id="mediaSosial" placeholder="Media Sosial" disabled>
                                    </div>

                                    <div class="col">
                                        <label for="civitasTELU">Civitas Telkom University</label>
                                        <select id="civitasTELU" class="form-control form-select" disabled>
                                            <option value="" class="text-muted">Civitas Telkom University</option>
                                            <option selected>{{ $member->civitas->mci_name }}</option>
                                        </select>

                                        <label for="universitas">Universitas</label>
                                        <select id="universitas" class="form-control form-select" disabled>
                                            <option value="" class="text-muted">Universitas</option>
                                            <option selected>{{ $member->universitas->mu_name }}</option>
                                        </select>

                                        <label for="fakultas">Fakultas</label>
                                        <select id="fakultas" class="form-control form-select" disabled>
                                            <option value="" class="text-muted">Fakultas</option>
                                            <option selected>{{ $member->fakultas->mf_name }}</option>
                                        </select>

                                        <label for="prodi">Program Studi</label>
                                        <select id="prodi" class="form-control form-select" disabled>
                                            <option value="" class="text-muted">Program Studi</option>
                                            <option selected>{{ $member->prodi->mps_name }}</option>
                                        </select>

                                        <label for="nimnip">NIM/NIP</label>
                                        <input type="text" value="{{ $member->mm_nim_nip }}" class="form-control" id="nimnip" placeholder="NIM/NIP" disabled>

                                        <label for="CV">Curricullum Vitae</label> <br>
                                        <a href="{{ url('storage/' . $member->mm_cv) }}" target="_blank" class="btn btn-secondary" style="height: 2.3rem; width: 7rem; display: flex; align-items: center;">
                                            <i data-feather="download" style="margin-right: 8px;"></i>
                                            Download
                                        </a>
                                    </div>                            
                                </div>
                            </div>
                        </div>
            </div>
            {{-- Anggota --}}
    </div>

    <script>
        $('.btnNext').click(function() {
            const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
            const nextTab = new bootstrap.Tab(nextTabLinkEl);
            nextTab.show();
        });

        $('.btnPrevious').click(function() {
            const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
            const prevTab = new bootstrap.Tab(prevTabLinkEl);
            prevTab.show();
        });
    </script>
@endsection