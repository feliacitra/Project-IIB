@extends('layouts.back.app')
@section('content')
    <style>
        .table thead th {
            color: black;
        }
        a {
            color: black;
        }
        .icon {
            width: 64px;
            height: 64px;
        }
        .action-icons a + a {
            margin-left: 3px;
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
        .btn-primary:focus {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Profil Startup
        </p>
    </div>

    <div class="container-fluid mt-2">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-bs-toggle="tab" href="#nav-profil">Profil</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#nav-berkas">Berkas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#nav-mentor">Mentor</a>
                    </li>
                  </ul>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            {{-- Profil --}}
            <div class="tab-pane fade show active" id="nav-profil" role="tabpanel" aria-labelledby="nav-profil-tab">
                <section style="padding-top: 1rem">
                    <div class="card" style="margin: 1rem; margin-top:0">
                        <div class="card-body">
                            <h5 class="text-center mb-3">Deskripsi Startup</h5>
                            <div class="row">
                                <div class="col">
                                    <label for="period">Periode Inkubasi</label>
                                    <input type="date" name="period" id="period" class="form-control" disabled>
    
                                    <label for="programInkubasi">Program Inkubasi</label>
                                    <select id="programInkubasi" class="form-control form-select" disabled>
                                        <option value="" class="text-muted">Program Inkubasi</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
    
                                    <label for="namaStartup">Nama Startup</label>
                                    <input type="text" class="form-control" id="namaStartup" placeholder="Nama Startup" disabled>
    
                                    <label for="alamat">Alamat Startup</label>
                                    <textarea class="form-control" id="alamat" cols="30" rows="3" placeholder="Alamat"></textarea>
    
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" placeholder="Website">
    
                                    <label for="badanHukum">Badan Hukum</label>
                                    <input type="text" class="form-control" id="badanHukum" placeholder="Badan Hukum">
                                </div>
    
                                <div class="col">
                                    <label for="tahunDidirikan">Tahun Didirikan</label>
                                    <input type="text" class="form-control" id="tahunDidirikan" placeholder="YYYY">
    
                                    <label for="pendanaan">Pendanaan</label>
                                    <input type="text" class="form-control" id="pendanaan" placeholder="Pendanaan">
    
                                    <label for="jmlPendanaan">Jumlah Pendanaan</label>
                                    <input type="text" class="form-control" id="jmlPendanaan" placeholder="Jumlah Pendanaan">
    
                                    <label for="logo">Logo</label>
                                    <input class="form-control" type="file" id="logo" name="logo">
    
                                    <label for="sosialMedia">Sosial Media</label>
                                    <input type="text" class="form-control" id="sosialMedia" placeholder="Sosial Media">
                                
                                    <label for="progRiset">Berasal dari Program Riset</label>
                                    <input type="text" class="form-control" id="progRiset" placeholder="Berasal dari Program Riset">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="card" style="margin: 1rem;">
                    <div class="card-body">
                        <h5 class="text-center mb-3">Deskripsi Produk</h5>
                        <div class="row">
                            <div class="col">
                                <label for="namaProduk">Nama Produk</label>
                                <input type="text" class="form-control" id="namaProduk" placeholder="Nama Produk">

                                <label for="deskripsi">Deskripsi Produk</label>
                                <textarea class="form-control" id="deskripsi" cols="30" rows="5" placeholder="Deskripsi Produk"></textarea>
                                
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website" placeholder="Website">

                                <label for="sertifikasiProduk">Sertifikasi Produk</label>
                                <input type="text" class="form-control" id="sertifikasiProduk" placeholder="Sertifikasi Produk">
                            </div>

                            <div class="col">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" class="form-control form-select">
                                    <option value="" class="text-muted">Kategori</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>

                                <label for="linkAplikasi">Link Aplikasi</label>
                                <input type="url" class="form-control" id="linkAplikasi" placeholder="Link Aplikasi">

                                <label for="HKI">HKI</label>
                                <input type="text" class="form-control" id="HKI" placeholder="HKI">

                                <label for="pengujianProduk">Pengujian Produk</label>
                                <input type="text" class="form-control" id="pengujianProduk" placeholder="Pengujian Produk">

                                <label for="izinProduk">Izin Produk</label>
                                <input type="text" class="form-control" id="izinProduk" placeholder="Izin Produk">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin: 1rem;">
                    <div class="card-body">
                        <h5 class="text-center mb-3">Daftar Anggota</h5>
                        <table class="table">
                            <thead class="text-center" style="background-color: #f5f5f5">
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Media Sosial</th>
                                    <th scope="col" style="width: 11%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <th scope="row">1</th>
                                    <td style="text-align: left;">Mark</td>
                                    <td style="text-align: left;">Ketua</td>
                                    <td>080808080808</td>
                                    <td>Mark@gmail.com</td>
                                    <td>@markmark</td>
                                    <td class="action-icons">
                                        <a href="#" data-name="" data-description=""><i data-feather="eye"></i></a>
                                        <a href="#" data-id="" data-name="" data-description="" ><i data-feather="edit-2"></i></a>
                                        <a href="#" data-id=""><i data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
                                <tr class="text-center">
                                    <th scope="row">2</th>
                                    <td style="text-align: left;">Jacob</td>
                                    <td style="text-align: left;">Anggota</td>
                                    <td>080808080808</td>
                                    <td>Jacob@gmail.com</td>
                                    <td>@jacob12</td>
                                    <td class="action-icons">
                                        <a href="#" data-name="" data-description=""><i data-feather="eye"></i></a>
                                        <a href="#" data-id="" data-name="" data-description="" ><i data-feather="edit-2"></i></a>
                                        <a href="#" data-id=""><i data-feather="trash-2"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="card" style="margin-top: 1rem">
                            <form action="">
                                <div class="card-body">
                                    <div style="display: flex; justify-content: flex-end;">
                                        <button id="plus-button" class="btn btn-primary py-1 px-1" type="submit"><i data-feather="plus"></i></button>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="namaLengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="namaLengkap" name="namaLengkap[]" placeholder="Nama Lengkap">

                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik[]" placeholder="NIK">

                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan[]" placeholder="Jabatan">

                                            <label for="nomorHP">Nomor HP</label>
                                            <input type="text" class="form-control" id="nomorHP" name="nomorHp[]" placeholder="Nomor HP">

                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email[]" class="form-control" placeholder="Email">

                                            <label for="mediaSosial">Media Sosial</label>
                                            <input type="text" class="form-control" id="mediaSosial" name="mediaSosial[]" placeholder="Media Sosial">
                                        </div>

                                        <div class="col">
                                            <label for="civitasTELU">Civitas Telkom University</label>

                                            <select id="civitasTELU" class="form-control form-select" name="civitasTelu[]">
                                                <option value="" class="text-muted">Civitas Telkom University</option>
                                            </select>

                                            <label for="universitas">Universitas</label>
                                            <select id="universitas" class="form-control form-select" name="universitas[]" onchange="onChangeDropdownUniversitas(event)">
                                                <option value="" class="text-muted">Universitas</option>
                                                <option value="lainnya" class="text-muted">Lainnya</option>
                                            </select>

                                            <label for="fakultas">Fakultas</label>
                                            <select id="fakultas" class="form-control form-select" name="fakultas[]">
                                                <option value="" class="text-muted">Fakultas</option>
                                                <option value="lainnya" class="text">Lainnya</option>
                                            </select>

                                            <label for="prodi">Program Studi</label>
                                            <select id="prodi" class="form-control form-select" name="prodi[]">
                                                <option value="" class="text-muted">Program Studi</option>
                                                <option value="lainnya" class="text">Lainnya</option>
                                            </select>

                                            <label for="nimnip">NIM/NIP</label>
                                            <input type="text" class="form-control" id="nimnip" name="nimNip[]" placeholder="NIM/NIP">

                                            <label for="CV">Curricullum Vitae</label>
                                            <input class="form-control" type="file" id="CV" name="cv[]">
                                        </div>                            
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <section style="margin: 1rem">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary btnNext  mt-2">Selanjutnya</a>
                    </div>
                </section>
            </div>
            {{-- Profil --}}

            {{-- Berkas --}}
            <div class="tab-pane fade" id="nav-berkas" role="tabpanel" aria-labelledby="nav-berkas-tab" style="height: 500px">
                <section style="height: 100%; display: flex; flex-direction: column;">
                    <h5 class="text-center mt-4">Berkas</h5>
                    <div class="row" style="padding: 1rem">
                        <div class="col card" style="margin: 1rem">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>
                                        <i class="icon" data-feather="file-text"></i>
                                        Berkas PKS
                                    </h5>
                                </div>
                                <div>
                                    <button class="btn btn-outline-secondary">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="download" class="me-2"></i>
                                            Download
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col card" style="margin: 1rem">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>
                                        <i class="icon" data-feather="file-text"></i>
                                        Berkas SK
                                    </h5>
                                </div>
                                <div>
                                    <button class="btn btn-outline-secondary">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="download" class="me-2"></i>
                                            Download
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: auto;">
                        <section style="margin: 1rem">
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-primary btnPrevious">Sebelumnya</a>
                                <a class="btn btn-primary btnNext">Selanjutnya</a>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
            {{-- Berkas --}}

            {{-- Mentor --}}
            <div class="tab-pane fade pt-4" id="nav-mentor" role="tabpanel" aria-labelledby="nav-mentor-tab" style="height: 500px">
                <section style="height: 100%; display: flex; flex-direction: column;">
                    <h5 class="text-center">Mentor</h5>
                    <section style="margin: 1rem">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-3 text-center">
                                        <img src="{{ asset('back/images/logo/user.png') }}" alt="Foto Profil" class="wd-150 ht-150">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="d-flex flex-column">
                                            <p class="mb-2">Nama</p>
                                            <p class="mb-2">Email</p>
                                            <p>Nomor</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <section style="text-align: right;">
                                            <p class="mb-2">:</p>
                                            <p class="mb-2">:</p>
                                            <p>:</p>
                                        </section> 
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex flex-column">
                                            <p class="mb-2">Siti Aminah</p>
                                            <p class="mb-2">sitiaminah@gmail.com</p>
                                            <p>0823-0000-0000</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="d-flex justify-content-start" style="margin: 1rem; margin-top: auto;">
                        <a class="btn btn-primary btnPrevious">Sebelumnya</a>
                    </section>
                </section>
            </div>
            {{-- Mentor --}}
        </div>
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