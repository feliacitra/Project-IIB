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
            <a href="{{ route('datastartup') }}">Data Startup</a>&nbsp;> Edit Data Startup
        </p>
    </div>

    <div class="container-fluid mt-2">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" data-bs-toggle="tab" href="#nav-identitas">Identitas</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#nav-anggota">Anggota</a>
                    </li>
                  </ul>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            {{-- Identitas --}}
            <div class="tab-pane fade show active" id="nav-identitas" role="tabpanel" aria-labelledby="nav-identitas-tab">
                <form class="p-3">
                    <div class="row">
                        <div class="col">
                            <label for="programInkubasi">Program Inkubasi</label>
                            <select id="programInkubasi" class="form-control form-select">
                                <option value="" class="text-muted">Program Inkubasi</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>

                            <label for="kategori">Kategori</label>
                            <select id="kategori" class="form-control form-select">
                                <option value="" class="text-muted">Kategori</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>

                            <label for="namaStartup">Nama Startup</label>
                            <input type="text" class="form-control" id="namaStartup" placeholder="Nama Startup">

                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" cols="30" rows="3" placeholder="Deskripsi"></textarea>
                            
                            <label for="tahunDidirikan">Tahun Didirikan</label>
                            <input type="text" class="form-control" id="tahunDidirikan" placeholder="YYYY">

                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" cols="30" rows="3" placeholder="Alamat"></textarea>

                            <label for="legalitas">Legalitas</label>
                            <input type="text" class="form-control" id="legalitas" placeholder="Legalitas">

                            <label for="sumberPendanaan">Sumber Pendanaan</label>
                            <input type="text" class="form-control" id="sumberPendanaan" placeholder="Sumber Pendanaan">

                            <label for="pendapatanTahunan">Pendapatan Tahunan</label>
                            <input type="text" class="form-control" id="pendapatanTahunan" placeholder="Pendapatan Tahunan">

                            <label for="areaFokusBisnis">Area Fokus Bisnis</label>
                            <textarea class="form-control" id="areaFokusBisnis" cols="30" rows="3" placeholder="Area Fokus Bisnis"></textarea>
                        </div>

                        <div class="col">
                            <label for="kontakStartup">Kontak Startup</label>
                            <input type="text" class="form-control" id="kontakStartup" placeholder="Kontak Startup">

                            <label for="emailStartup">Email Startup</label>
                            <input type="email" class="form-control" id="emailStartup" name="emailStartup" placeholder="EmailStartup">

                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" placeholder="Website">

                            <label for="sosialMedia">Sosial Media</label>
                            <input type="text" class="form-control" id="sosialMedia" placeholder="Sosial Media">

                            <label for="pitchDeck">Pitch Deck</label> <br>
                            <input type="file" class="form-control" id="pitch">

                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary btnNext mt-2">Selanjutnya</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Identitas --}}

            {{-- Anggota --}}
            <div class="tab-pane fade" id="nav-anggota" role="tabpanel" aria-labelledby="nav-anggota-tab" disabled>
                <form>
                    <div class="p-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" d>

                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" placeholder="NIK">

                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" placeholder="Jabatan">

                                        <label for="nomorHP">Nomor HP</label>
                                        <input type="text" class="form-control" id="nomorHP" placeholder="Nomor HP">

                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">

                                        <label for="mediaSosial">Media Sosial</label>
                                        <input type="text" class="form-control" id="mediaSosial" placeholder="Media Sosial">
                                    </div>

                                    <div class="col">
                                        <label for="civitasTELU">Civitas Telkom University</label>
                                        <select id="civitasTELU" class="form-control form-select">
                                            <option value="" class="text-muted">Civitas Telkom University</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>

                                        <label for="universitas">Universitas</label>
                                        <select id="universitas" class="form-control form-select">
                                            <option value="" class="text-muted">Universitas</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>

                                        <label for="fakultas">Fakultas</label>
                                        <select id="fakultas" class="form-control form-select">
                                            <option value="" class="text-muted">Fakultas</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>

                                        <label for="prodi">Program Studi</label>
                                        <select id="prodi" class="form-control form-select">
                                            <option value="" class="text-muted">Program Studi</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>

                                        <label for="nimnip">NIM/NIP</label>
                                        <input type="text" class="form-control" id="nimnip" placeholder="NIM/NIP">

                                        <label for="CV">Curricullum Vitae</label> <br>
                                        <input type="file" class="form-control" id="cv">
                                    </div>                            
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a class="btn btn-primary btnPrevious">Sebelumnya</a>
                            <a class="btn btn-primary btnNext">Selanjutnya</a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Anggota --}}
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