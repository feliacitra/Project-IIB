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
            Daftar Startup
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
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="tab" href="#nav-selfAssessment">Self Assessment</a>
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
                                @foreach ($incubations as $incubation)
                                    <option value="{{ $incubation->mpi_id }}">{{ $incubation->mpi_name }}</option>
                                @endforeach
                            </select>

                            <label for="kategori">Kategori</label>
                            <select id="kategori" class="form-control form-select">
                                <option value="" class="text-muted">Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->mc_id }}">{{ $category->mc_name }}</option>
                                @endforeach
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

                            <label for="pitchDeck">Unggah Pitch Deck</label>
                            <input class="form-control" type="file" id="pitchDeck" name="pitchDeck">

                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary btnNext  mt-2">Selanjutnya</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Identitas --}}

            {{-- Anggota --}}
            <div class="tab-pane fade" id="nav-anggota" role="tabpanel" aria-labelledby="nav-anggota-tab">
                <form>
                    <!-- + button -->
                    <div class="px-3 pt-3" style="display: flex; justify-content: flex-end;">
                        <button id="plus-button" class="btn btn-primary py-1 px-1" type="button" onclick="addCard()"><i data-feather="plus"></i></button>
                    </div>
                    <!-- + button -->
                    <div class="p-3">
                        <div class="card">
                            <div class="card-body">
                                <!-- - button -->
                                <div style="display: flex; justify-content: flex-end;">
                                    <button id="minus-button" class="btn btn-primary py-1 px-1" type="button" onclick="deleteCard(event)"><i data-feather="minus"></i></button>
                                </div>
                                <!-- - button -->
                                <div class="row">
                                    <div class="col">
                                        <label for="namaLengkap">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap" placeholder="Nama Lengkap">

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
                                            @foreach($societies as $society)
                                                <option value="{{ $society->mci_id }}">{{ $society->mci_name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="universitas">Universitas</label>
                                        <select id="universitas" class="form-control form-select">
                                            <option value="" class="text-muted">Universitas</option>
                                            @foreach($universities as $university)
                                                <option value="{{ $university->mu_id }}">{{ $university->mu_name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="fakultas">Fakultas</label>
                                        <select id="fakultas" class="form-control form-select">
                                            <option value="" class="text-muted">Fakultas</option>
                                            @foreach($faculties as $faculty)
                                                <option value="{{ $faculty->mf_id }}">{{ $faculty->mf_name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="prodi">Program Studi</label>
                                        <select id="prodi" class="form-control form-select">
                                            <option value="" class="text-muted">Program Studi</option>
                                            @foreach($studyPrograms as $studyProgram)
                                                <option value="{{ $studyProgram->mps_id }}">{{ $studyProgram->mps_name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="nimnip">NIM/NIP</label>
                                        <input type="text" class="form-control" id="nimnip" placeholder="NIM/NIP">

                                        <label for="CV">Curricullum Vitae</label>
                                        <input class="form-control" type="file" id="CV" name="CV">
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

            {{-- Self Assessment --}}
            <div class="tab-pane fade" id="nav-selfAssessment" role="tabpanel" aria-labelledby="nav-assessment-tab">
                <form action="">
                    <div class="p-3">
                        <h5 class="text-center mb-3">Self Assessment</h5>
                        <div class="card">
                            @foreach($questions as $question)
                                <div class="card-body">
                                    <p>{{ $question->mq_question }}</p>
                                    <div class="radio mt-2">
                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                        <label for="html">Lorem lorem</label>

                                        <input type="radio" id="css" name="fav_language" value="CSS">
                                        <label for="css">Lorem ipsum</label>

                                        <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                        <label for="javascript">Dolor sit amet</label>

                                        <input type="radio" id="consecteturer" name="fav_language" value="Consecteturer">
                                        <label for="consecteturer">Consecteturer</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <label for="catatanTambahan" class="col col-md-2">Catatan Tambahan</label>
                                    <textarea class="form-control col" name="catatan" id="catatanTambahan" cols="10" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <a class="btn btn-primary btnPrevious">Sebelumnya</a>
                            <button class="btn btn-primary px-4">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Self Assessment --}}
        </div>
    </div>

    <script>
        function addCard() {
            var container = document.querySelector("#nav-anggota .p-3");

            /* Create new card */
            var card = document.createElement("div");
            card.className = "card mb-3";

            /* Create card body */
            var cardBody = document.createElement("div");
            cardBody.className = "card-body";

            /* Create - button container */
            var minusButtonContainer = document.createElement("div");
            minusButtonContainer.style.display = "flex";
            minusButtonContainer.style.justifyContent = "flex-end";

            var minusButton = document.createElement("button");
            minusButton.className = "btn btn-primary py-1 px-1";
            minusButton.setAttribute("type", "button"); 
            minusButton.addEventListener("click", deleteCard);


            /* Minus icon */
            var minusIcon = document.createElement("i");
            minusIcon.setAttribute("data-feather", "minus");

            /* Append minus icon */
            minusButton.appendChild(minusIcon);

            /* Append - button to container */
            minusButtonContainer.appendChild(minusButton);

            /* Append - button container to card body */
            cardBody.appendChild(minusButtonContainer);

            /* Clone the existing row and append to card body */
            var existingRow = document.querySelector("#nav-anggota .card .row").cloneNode(true);
            cardBody.appendChild(existingRow);

            /* Reset input field values in the new card */
            var inputs = cardBody.querySelectorAll("input");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = "";
            }

            /* Append card body to card */
            card.appendChild(cardBody);

            /* Insert new card */
            container.insertBefore(card, container.firstChild);

            feather.replace();
        }

        function deleteCard(event) {
            var card = event.target.closest(".card");
            var container = document.querySelector("#nav-anggota .p-3");
            var cards = container.querySelectorAll(".card");

            if (cards.length > 1) {
                container.removeChild(card);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var minusButtons = document.querySelectorAll("#cardContainer .btn.btn-primary.add-form.py-0.px-1");
            for (var i = 0; i < minusButtons.length; i++) {
                var minusButton = minusButtons[i];
                minusButton.onclick = deleteRow;
            }

            feather.replace({ "aria-hidden": "true" });
        });

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