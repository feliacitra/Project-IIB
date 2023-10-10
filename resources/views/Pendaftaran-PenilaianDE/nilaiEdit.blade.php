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
        .card{
            margin-top:1rem;
        }
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            <a href="{{ route('penilaianDE') }}">Penilaian Desk Evaluation</a>&nbsp;> Nilai
        </p>
    </div>

    {{-- Data Pendaftar --}}
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
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#nav-selfAssessment">Self Assessment</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#nav-deskEvaluation">Desk Evaluation</a>
                    </li>
                  </ul>
            </div>
        </nav>
        {{-- @dd(response(file_get_contents(Storage::disk('public')->path($component->ms_pitchdeck)))->withHeaders([
            'Content-Type'=>mime_content_type(Storage::disk('public')->path($component->ms_pitchdeck))
        ])) --}}
        {{-- @dd(url('storage/' . $component->ms_pitchdeck)) --}}
        <div class="tab-content" id="nav-tabContent">
            {{-- Identitas --}}
            <div class="tab-pane fade show active" id="nav-identitas" role="tabpanel" aria-labelledby="nav-identitas-tab">
                <form action="{{route ('penilaianDE.update', $component->ms_id)}}" class="p-3" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="programInkubasi">Program Inkubasi</label>
                            <select id="programInkubasi" name="programInkubasi" class="form-control form-select" disabled>
                                <option value="" class="text-muted">Program Inkubasi</option>
                                @foreach($components as $item)
                                @if($mc->periodeProgram->masterProgramInkubasi->mpi_id == $item->periodeProgram->masterProgramInkubasi->mpi_id)
                                <option value="{{ $item->periodeProgram->masterProgramInkubasi->mpi_id }}" selected>{{ $item->periodeProgram->masterProgramInkubasi->mpi_name }}</option>
                                @else
                                <option value="{{ $item->periodeProgram->masterProgramInkubasi->mpi_id }}">{{ $item->periodeProgram->masterProgramInkubasi->mpi_name }}</option>
                                @endif
                                @endforeach
                            </select>

                            <label for="kategori">Kategori</label>
                            <select id="kategori" class="form-control form-select" disabled>
                                <option value="" class="text-muted">Kategori</option>
                                @foreach($masterKategori as $item)
                                @if($component->mc_id == $item->mc_id)
                                <option value="{{ $item->mc_id }}" selected>{{ $item->mc_name }}</option>
                                @else
                                <option value="{{ $item->mc_id }}">{{ $item->mc_name }}</option>
                                @endif
                                @endforeach
                            </select>

                            <label for="namaStartup">Nama Startup</label>
                            <input type="text" class="form-control" id="namaStartup" placeholder="Nama Startup" value="{{ $component->ms_name }}" disabled>

                            {{-- <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" cols="30" rows="3" placeholder="Deskripsi" disabled>{{ $component->ms_description }}</textarea> --}}
                            
                            <label for="tahunDidirikan">Tahun Didirikan</label>
                            <input type="text" class="form-control" id="tahunDidirikan" placeholder="YYYY" value="{{ $component->ms_year_founded }}" disabled>

                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" cols="30" rows="3" placeholder="Alamat" disabled>{{ $component->ms_address }}</textarea>

                            <label for="legalitas">Legalitas</label>
                            <input type="text" class="form-control" id="legalitas" placeholder="Legalitas" value="{{ $component->ms_legal }}"disabled>

                            <label for="sumberPendanaan">Sumber Pendanaan</label>
                            <input type="text" class="form-control" id="sumberPendanaan" placeholder="Sumber Pendanaan" value="{{ $component->ms_funding_sources }}" disabled>

                            <label for="pendapatanTahunan">Pendapatan Tahunan</label>
                            <input type="text" class="form-control" id="pendapatanTahunan" placeholder="Pendapatan Tahunan" value="{{ $component->ms_yearly_income }}" disabled>

                            <label for="areaFokusBisnis">Area Fokus Bisnis</label>
                            <textarea class="form-control" id="areaFokusBisnis" cols="30" rows="3" placeholder="Area Fokus Bisnis" disabled>{{ $component->ms_focus_area }}</textarea>
                        </div>

                        <div class="col">
                            <label for="kontakStartup">Kontak Startup</label>
                            <input type="text" class="form-control" id="kontakStartup" placeholder="Kontak Startup" value="{{ $component->ms_phone }}" disabled>

                            <label for="emailStartup">Email Startup</label>
                            <input type="email" class="form-control" id="emailStartup" name="emailStartup" placeholder="EmailStartup" value="{{ $component->ms_email}}" disabled>

                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" placeholder="Website" value="{{ $component->ms_website}}" disabled>

                            <label for="sosialMedia">Sosial Media</label>
                            <input type="text" class="form-control" id="sosialMedia" placeholder="Sosial Media" value="{{ $component->ms_socialmedia}}" disabled>

                            <label for="pitchDeck">Pitch Deck</label> <br>
                            <a href="{{ url('storage/' . $component->ms_pitchdeck) }}" target="_blank" class="btn btn-secondary" style="height: 2.3rem; width: 7rem; display: flex; align-items: center;" >
                                <i data-feather="download" style="margin-right: 8px;"></i>
                                Download
                            </a>

                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary btnNext mt-2">Selanjutnya</a>
                            </div>
                        </div>
                    </div>
            </div>
            {{-- Identitas --}}
{{-- @dd($component->masterMember) --}}
            {{-- Anggota --}}
            <div class="tab-pane fade" id="nav-anggota" role="tabpanel" aria-labelledby="nav-anggota-tab" >
                    <div class="p-3">
                        {{-- @dd($component->masterMember) --}}
                        @foreach($component->masterMember as $member)
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap" value="{{ $member->mm_name }}" disabled>

                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" placeholder="NIK" value="{{ $member->mm_nik }}" disabled>

                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" value="{{ $member->mm_position }}" disabled>

                                        <label for="nomorHP">Nomor HP</label>
                                        <input type="text" class="form-control" id="nomorHP" placeholder="Nomor HP" value="{{ $member->mm_phone }}" disabled>

                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ $member->mm_email }}" disabled>

                                        <label for="mediaSosial">Media Sosial</label>
                                        <input type="text" class="form-control" id="mediaSosial" placeholder="Media Sosial" value="{{ $member->mm_socialmedia }}" disabled>
                                    </div>
                                    {{-- @dd($member) --}}
                                    {{-- @dd($member) --}}
                                    <div class="col">
                                        <label for="civitasTELU">Civitas Telkom University</label>
                                        <select id="civitasTELU" class="form-control form-select" disabled>
                                            <option value="" class="text-muted">Civitas Telkom University</option>
                                            <option selected value="{{ $member->civitas->mci_id }}">{{ $member->civitas->mci_name }}</option>
                                        </select>

                                        <label for="universitas">Universitas</label>
                                        <select id="universitas" class="form-control form-select" disabled>
                                            <option value="" class="text-muted">Universitas</option>
                                            <option selected value="{{ $member->universitas->mu_id }}">{{ $member->universitas->mu_name }}</option>
                                        </select>
                                        <label for="fakultas">Fakultas</label>
                                        <select id="fakultas" class="form-control form-select" disabled>
                                            <option selected value="{{ $member->fakultas->mf_id }}" class="text-muted">{{ $member->fakultas->mf_name }}</option>
                                        </select>

                                        <label for="prodi">Program Studi</label>
                                        <select id="prodi" class="form-control form-select" disabled>
                                            <option selected value="{{ $member->prodi->mps_id }}" class="text-muted">{{ $member->prodi->mps_name }}</option>
                                        </select>

                                        <label for="nimnip">NIM/NIP</label>
                                        <input type="text" class="form-control" id="nimnip" placeholder="NIM/NIP" value="{{ $member->mm_nim_nip }}" disabled>

                                        <label for="CV">Curricullum Vitae</label> <br>
                                        <a href="{{ url('storage/' . $member->mm_cv) }}" target="_blank" class="btn btn-secondary" style="height: 2.3rem; width: 7rem; display: flex; align-items: center;">
                                            <i data-feather="download" style="margin-right: 8px;"></i>
                                            Download
                                        </a>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-between mt-4">
                            <a class="btn btn-primary btnPrevious">Sebelumnya</a>
                            <a class="btn btn-primary btnNext">Selanjutnya</a>
                        </div>
                    </div>
            </div>
            {{-- Anggota --}}

            {{-- Self Assessment --}}
            <div class="tab-pane fade" id="nav-selfAssessment" role="tabpanel" aria-lab elledby="nav-assessment-tab">
                <div class="container-fluid py-4 px-4" style="height: 100%">
                    <div class="row">
                        <div class="col">
                            <div class="info-pair">
                                <p class="info-label">Periode</p>
                                <p class="info-value">: {{ $component->masterPeriodeProgram->masterPeriode->mpe_name }}</p>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="form-group">
                        @csrf
                        <h5 class="text-center mt-4">Self Assessment</h5>
                        <div class="card">
                            @foreach($mc->question as $questIdx => $q)
                            <div class="card-body">
                                <p>{{ $q->mq_question }}</p>
                                <div class="radio mt-2">
                                    @foreach($q->questionRange as $index => $qr)
                                    {{-- @dd($component->startupComponentStatus[0]->registationAnswer[0]->mqr_id) --}}
                                        <input type="radio" id="{{ $qr->mqr_id }}" name="answer[{{ $loop->parent->index }}]" value="{{ $qr->mqr_id }}" {{ ($qr->mqr_id == $component->startupComponentStatus[0]->registationAnswer[$questIdx]->mqr_id) ? "checked" : "" }} disabled>
                                        <label for="{{ $qr->mqr_id }}">{{ $qr->mqr_description }}</label>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <h5 class="text-center mt-4">NILAI AKHIR: {{$component->startupComponentStatus[0]->scs_totalscore}}</h5>
                            
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <label for="catatanTambahan" class="col col-md-2">Catatan Tambahan</label>
                                        <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4" disabled>{{ $component->startupComponentStatus[0]->scs_notes }}</textarea>
                                    </div>
            
                                    {{-- <div class="radio mt-4">
                                        @if($component->registationStatus->srt_status == "Lulus")
                                        <input type="radio" id="lulus" name="kelulusan" value="Lulus" checked>
                                        <label for="lulus">Lulus</label>
                                        <input type="radio" id="tidakLulus" name="kelulusan" value="Tidak Lulus">
                                        <label for="tidakLulus">Tidak Lulus</label>
                                        @else
                                        <input type="radio" id="lulus" name="kelulusan" value="Lulus">
                                        <label for="lulus">Lulus</label>
                                        <input type="radio" id="tidakLulus" name="kelulusan" value="Tidak Lulus" checked>
                                        <label for="tidakLulus">Tidak Lulus</label>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="text-center inner-bottom-button">
                                <button type="submit" class="btn btn-primary px-4" style="margin-right: 1rem;">
                                    Simpan
                                </button>
                                <a href="{{route ('penilaianDE')}}" class="btn btn-secondary px-4">Kembali</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- Self Assessment --}}

                @if(isset($componentDesk))
                {{-- Desk Evaluation --}}
                <div class="tab-pane fade" id="nav-deskEvaluation" role="tabpanel" aria-lab elledby="nav-assessment-tab">
                    <div class="container-fluid py-4 px-4" style="height: 100%">
                        <div class="row">
                            <div class="col">
                                <div class="info-pair">
                                    <p class="info-label">Periode</p>
                                    <p class="info-value">: {{ $component->masterPeriodeProgram->masterPeriode->mpe_name }}</p>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                
                        {{-- @dd($mqDesk) --}}
                        <div class="form-group">
                            {{-- @dd($componentDesk->question) --}}
                            {{-- @if(isset($mqDesk)) --}}
                                @csrf
                                <h5 class="text-center mt-4">Desk Evaluation</h5>
                                <div class="card">
                                    @foreach($componentDesk->question as $questIdx => $q)
                                    <div class="card-body">
                                        <p>{{ $q->mq_question }}</p>
                                        <div class="radio mt-2">
                                            @foreach($q->questionRange as $index => $qr)
                                            @if(isset($mqDesk[1]))
                                            <input type="radio" id="{{ $qr->mqr_id }}" name="deskAnswer[{{ $loop->parent->index }}]" value="{{ $qr->mqr_id }}" {{ ($qr->mqr_id == $mqDesk[1]->registationAnswer[$questIdx]->mqr_id) ? "checked" : "" }}>
                                            @else
                                            <input type="radio" id="{{ $qr->mqr_id }}" name="deskAnswer[{{ $loop->parent->index }}]" value="{{ $qr->mqr_id }}">
                                            @endif
                                            <label for="{{ $qr->mqr_id }}">{{ $qr->mqr_description }}</label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                {{-- @dd($mqDesk) --}}
                                @if(isset($mqDesk) && isset($mqDesk[1]->registationAnswer[0]->mqr_id))
                                <h5 class="text-center mt-4">NILAI AKHIR: {{$mqDesk[0]->scs_totalscore}}</h5>
                                @endif
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <label for="catatanTambahan" class="col col-md-2">Catatan Tambahan</label>
                                            @if(isset($mqDesk[1]))
                                            {{-- @dd($mqDesk) --}}
                                            <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4">{{ $mqDesk[1]->scs_notes }}</textarea>
                                            @else
                                            <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4"></textarea>
                                            @endif
                                        </div>
                
                                        <div class="radio mt-4">
                                            @if($component->registationStatus->srt_status == "Lulus")
                                            <input type="radio" id="lulus" name="kelulusan" value="Lulus" checked>
                                            <label for="lulus">Lulus</label>
                                            <input type="radio" id="tidakLulus" name="kelulusan" value="Tidak Lulus">
                                            <label for="tidakLulus">Tidak Lulus</label>
                                            @else
                                            <input type="radio" id="lulus" name="kelulusan" value="Lulus">
                                            <label for="lulus">Lulus</label>
                                            <input type="radio" id="tidakLulus" name="kelulusan" value="Tidak Lulus" checked>
                                            <label for="tidakLulus">Tidak Lulus</label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center inner-bottom-button">
                                    <button type="submit" class="btn btn-primary px-4" style="margin-right: 1rem;">
                                        Simpan
                                    </button>
                                    <a href="{{route ('penilaianDE')}}" class="btn btn-secondary px-4">Kembali</a>
                                </div>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                    @endif
                {{-- Desk Evaluation --}}
            </div>
        </form>
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

        $(document).ready(function() {
            $('#universitas').on('change', function() {
                var universityId = $(this).val();
                if (universityId) {
                    $.ajax({
                        url: '/master/prodi/' + universityId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#fakultas').empty();
                            $('#fakultas').append('<option value="" class="text-muted">Nama Fakultas</option>');
                            $.each(data, function(key, value) {
                                $('#fakultas').append('<option value="' + value.mf_id + '">' + value.mf_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#fakultas').empty();
                }
            });
        });


        $(document).ready(function() {
            $('#fakultas').on('change', function() {
                var fakultasId = $(this).val();
                if (fakultasId) {
                    $.ajax({
                        url: '/master/prodi/getProdi/' + fakultasId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#prodi').empty();
                            $('#prodi').append('<option value="" class="text-muted">Nama Prodi</option>');
                            $.each(data, function(key, value) {
                                $('#prodi').append('<option value="' + value.mps_id + '">' + value.mps_name + '</option>');
                            });
                        }
                    });
                } else {
                    console.log('test');
                    $('#prodi').empty();
                }
            });
        });
    </script>

@endsection