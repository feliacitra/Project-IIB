@extends('layouts.back.app')
@section('content')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
               -webkit-appearance: none;
                margin: 0;
        }
 
        input[type=number] {
            -moz-appearance: textfield;
        }
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


{{-- @dd($components) --}}

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            Daftar Startup
        </p>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">   
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('errors'))
    <div class="alert alert-danger alert-block">   
        @foreach ($errors->all() as $error)
            <strong>{{ $error }}</strong>
            <br>
        @endforeach
    </div>
    @endif

    <form action="{{ route('startup.store') }}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="userid" value="{{ Auth::user()->id }}" />
    {{-- periode masih hard code, ambil dari respond data dashboard --}}
    {{-- @dd($components[0]->periodeProgram->mpd_id ) --}}
    <input type="hidden" name="mpdid" value="{{ $components[0]->periodeProgram->mpd_id }}" />
    {{-- @dd($components[0]->periodeProgram->mpd_id) --}}
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
                    @csrf
                    {{-- @dd($periode->masterPeriodeProgram[1]->masterProgramInkubasi) --}}
                    <div class="row p-3" >
                        <div class="col">
                            <label for="programInkubasi">Program Inkubasi</label>
                            <select id="programInkubasi" class="form-control form-select" name="programStartup">
                                <option value="" class="text-muted">Program Inkubasi</option>
                                @foreach ($periode->masterPeriodeProgram as $item)
                                    {{-- @if($item->mpd_id) --}}
                                    <option value="{{ $item->mpd_id }}">{{ $item->masterProgramInkubasi->mpi_name }}</option>
                                @endforeach
                            </select>

                            <label for="kategori">Kategori</label>
                            <select id="kategori" class="form-control form-select" name="kategori">
                                <option value="{{ old('kategori') }}" class="text-muted">Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->mc_id }}">{{ $category->mc_name }}</option>
                                @endforeach
                            </select>

                            <label for="namaStartup">Nama Startup</label>
                            <input type="text" class="form-control" id="namaStartup" name="namaStartup" placeholder="Nama Startup" value="{{ old('namaStartup') }}">

                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" cols="30" rows="3" name="deskripsi" placeholder="Deskripsi" value="{{ old('deskripsi') }}"></textarea>
                            
                            <label for="tahunDidirikan">Tahun Didirikan</label>
                            <input type="number" class="form-control" id="tahunDidirikan" name="tahunDidirikan" placeholder="YYYY" value="{{ old('tahunDidirikan') }}">

                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" cols="30" rows="3" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}"></textarea>

                            <label for="legalitas">Legalitas</label>
                            <input type="text" class="form-control" id="legalitas" name="legalitas" placeholder="Legalitas" value="{{ old('legalitas') }}">

                            <label for="sumberPendanaan">Sumber Pendanaan</label>
                            <input type="text" class="form-control" id="sumberPendanaan" name="sumberPendanaan" placeholder="Sumber Pendanaan" value="{{ old('sumberPendanaan') }}">

                            <label for="pendapatanTahunan">Pendapatan Tahunan</label>
                            <input type="number" class="form-control" id="pendapatanTahunan" name="pendapatanTahunan" placeholder="Pendapatan Tahunan" value="{{ old('pendapatanTahunan') }}">

                            <label for="areaFokusBisnis">Area Fokus Bisnis</label>
                            <textarea class="form-control" id="areaFokusBisnis" cols="30" rows="3" name="areaFokusBisnis" placeholder="Area Fokus Bisnis" value="{{ old('areaFokusBisnis') }}"></textarea>

                        </div>

                        <div class="col">
                            <label for="kontakStartup">Kontak Startup</label>

                            <input type="number" class="form-control" id="kontakStartup" name="kontakStartup" placeholder="Kontak Startup" value="{{ old('kontakStartup') }}">

                            <label for="email">Email Startup</label>
                            <input type="email" class="form-control" id="emailStartup" name="emailStartup" placeholder="Email Startup" value="{{ old('emailStartup') }}">

                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="{{ old('website') }}">

                            <label for="sosialMedia">Sosial Media</label>
                            <input type="text" class="form-control" id="sosialMedia" name="sosialMedia" placeholder="Sosial Media" value="{{ old('sosialMedia') }}">

                            <label for="pitchDeck">Unggah Pitch Deck</label>
                            <input class="form-control" type="file" id="pitchDeck" name="pitchDeck" >

                            <div class="d-flex justify-content-end">
                                <a class="btn btn-primary btnNext  mt-2">Selanjutnya</a>
                            </div>
                        </div>
                    </div>

            </div>
            {{-- Identitas --}}

            {{-- Anggota --}}
            <div class="tab-pane fade" id="nav-anggota" role="tabpanel" aria-labelledby="nav-anggota-tab">
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
                                        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap[]" placeholder="Nama Lengkap">

                                        <label for="nik">NIK</label>
                                        <input type="number" class="form-control" id="nik" name="nik[]" placeholder="NIK" >

                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan[]" placeholder="Jabatan" >

                                        <label for="nomorHP">Nomor HP</label>
                                        <input type="number" class="form-control" id="nomorHP" name="nomorHp[]" placeholder="Nomor HP" >

                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email[]" class="form-control" placeholder="Email" >

                                        <label for="mediaSosial">Media Sosial</label>
                                        <input type="text" class="form-control" id="mediaSosial" name="mediaSosial[]" placeholder="Media Sosial" required>
                                    </div>

                                    <div class="col">
                                        <label for="civitasTELU">Civitas Telkom University</label>
                                        <select id="civitasTELU" class="form-control form-select" name="civitasTelu[]" required>
                                            <option value="" class="text-muted">Civitas Telkom University</option>
                                            @foreach($societies as $society)
                                                <option value="{{ $society->mci_id }}">{{ $society->mci_name }}</option>
                                            @endforeach
                                        </select>

                                        <label for="universitas">Universitas</label>
                                        <select id="universitas-0" class="form-control form-select" name="universitas[]" onchange="onChangeDropdownUniversitas(event)">
                                            <option value="" class="text-muted">Universitas</option>
                                            @foreach($universities as $university)
                                                <option value="{{ $university->mu_id }}">{{ $university->mu_name }}</option>
                                            @endforeach
                                                <option value="lainnya">Lainnya</option>
                                        </select>

                                        <label for="fakultas">Fakultas</label>
                                        <select id="fakultas-0" class="form-control form-select" name="fakultas[]" onchange="onChangeDropdownFakultas(event)">
                                            <option value="" class="text-muted">Fakultas</option>
                                            @foreach($faculties as $faculty)
                                                {{-- <option value="{{ $faculty->mf_id }}">{{ $faculty->mf_name }}</option> --}}
                                            @endforeach
                                            <option value="lainnya">Lainnya</option>
                                        </select>

                                        <label for="prodi">Program Studi</label>
                                        <select id="prodi-0" class="form-control form-select" name="prodi[]" onchange="onChangeDropdownProdi(event)">
                                            <option value="" class="text-muted">Program Studi</option>
                                            @foreach($studyPrograms as $studyProgram)
                                                {{-- <option value="{{ $studyProgram->mps_id }}">{{ $studyProgram->mps_name }}</option> --}}
                                            @endforeach
                                            <option value="lainnya">Lainnya</option>
                                        </select>

                                        <label for="nimnip">NIM/NIP</label>
                                        <input type="number" class="form-control" id="nimnip" name="nimNip[]" placeholder="NIM/NIP" >

                                        <label for="CV">Curricullum Vitae</label>
                                        <input class="form-control" type="file" id="CV" name="cv[]" >

                                    </div>                            
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a class="btn btn-primary btnPrevious">Sebelumnya</a>
                            <a class="btn btn-primary btnNext">Selanjutnya</a>
                        </div>
                    </div>
            </div>
            {{-- Anggota --}}

            {{-- Self Assessment --}}
            <div class="tab-pane fade" id="nav-selfAssessment" role="tabpanel" aria-labelledby="nav-assessment-tab">

                    <div class="p-3">
                        <h5 class="text-center mb-3">Self Assessment</h5>
                        <div id="questions" class="card">
                         {{-- Question Here --}}
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

                            <button type="submit" class="btn btn-primary px-4">Daftar</button>

                        </div>
                    </div>
                </form>
            </div>
            {{-- Self Assessment --}}
        </div>
    </div>

    <script>

    let totalCard = 0;

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
            });

            function onChangeDropdownUniversitas(event){
                var select = event.target;
                // console.log('test');
                var lastChar = select.id.substr(select.id.length - 1)

                var selectedUniversityId = select.children[select.selectedIndex].value;
                
                if(event.target.value == "lainnya"){
                    // label
                    const element = document.createElement('label');
                        element.setAttribute('for', 'label-'+event.target.id);
                        element.setAttribute('id', 'label-'+event.target.id);
                        element.innerHTML = 'Masukan Universitas';

                        // input
                        const input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute('id', event.target.id+'-input');
                        input.setAttribute('class', 'form-control');
                        input.setAttribute('name', 'universitas-input[]');
                        
                        let element2 = event.target.id;
                        // console.log(event.target.id)
                        $('#'+element2).after(element);
                        $('#label-'+element2).after(input);
                }else{
                    if(document.getElementById(`label-${event.target.id}`) != null){
                    var label = document.getElementById(`label-${event.target.id}`);
                    var input = document.getElementById(`${event.target.id}-input`);
                    // console.log(input);
                        label.remove();
                        input.remove();
                    }
                    
                }
        
                if (selectedUniversityId && event.target.value!='lainnya') {
                    $.ajax({
                        url: '/master/prodi/' + selectedUniversityId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#fakultas-'+lastChar).empty();
                            $('#fakultas-'+lastChar).append('<option value="" class="text-muted">Nama Fakultas</option>');
                            $.each(data, function(key, value) {
                                $('#fakultas-'+lastChar).append('<option value="' + value.mf_id + '">' + value.mf_name + '</option>');
                            });
                            $('#fakultas-'+lastChar).append('<option value="' + 'lainnya' + '">' + 'lainnya' + '</option>');
                        }
                    });
                } else {
                    $('#fakultas-'+lastChar).empty();
                    $('#fakultas-'+lastChar).append('<option value="" class="text-muted">Nama Fakultas</option>');
                    $('#fakultas-'+lastChar).append('<option value="' + 'lainnya' + '">' + 'lainnya' + '</option>');
                    
                }
        };

        function onChangeDropdownFakultas(event){
            var select = event.target;

            var lastChar = select.id.substr(select.id.length - 1)

            var selectedFakultasId = select.children[select.selectedIndex].value;

            if(event.target.value == "lainnya"){
                    // label
                    const element = document.createElement('label');
                        element.setAttribute('for', 'label-'+event.target.id);
                        element.setAttribute('id', 'label-'+event.target.id);
                        element.innerHTML = 'Masukan Fakultas';

                        // input
                        const input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute('id', event.target.id+'-input');
                        input.setAttribute('class', 'form-control');
                        input.setAttribute('name', 'fakultas-input[]');
                        
                        let element2 = event.target.id;
                        $('#'+element2).after(element);
                        $('#label-'+element2).after(input);
                }else{
                    if(document.getElementById(`label-${event.target.id}`) != null){
                    var label = document.getElementById(`label-${event.target.id}`);
                    var input = document.getElementById(`${event.target.id}-input`);
                    // console.log(input);
                        label.remove();
                        input.remove();
                    }
                    
                }

            if (selectedFakultasId && event.target.value!='lainnya') {
                $.ajax({
                    url: '/master/prodi/getProdi/' + selectedFakultasId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#prodi-'+lastChar).empty();
                        $('#prodi-'+lastChar).append('<option value="" class="text-muted">Nama Prodi</option>');
                        $.each(data, function(key, value) {
                            $('#prodi-'+lastChar).append('<option value="' + value.mps_id + '">' + value.mps_name + '</option>');
                        });
                        $('#prodi-'+lastChar).append('<option value="' + 'lainnya' + '">' + 'lainnya' + '</option>');
                    }
                });
            } else {
                $('#prodi-'+lastChar).empty();
                $('#prodi-'+lastChar).append('<option value="" class="text-muted">Nama Prodi</option>');
                $('#prodi-'+lastChar).append('<option value="' + 'lainnya' + '">' + 'lainnya' + '</option>');
            }
        };

       

        function generateId(length){
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
            }
            return result;
        }

        function onChangeDropdownProdi(event){
            var select = event.target;

            var lastChar = select.id.substr(select.id.length - 1)

            var selectedFakultasId = select.children[select.selectedIndex].value;

            if(event.target.value == "lainnya"){
                    // label
                    const element = document.createElement('label');
                        element.setAttribute('for', 'label-'+event.target.id);
                        element.setAttribute('id', 'label-'+event.target.id);
                        element.innerHTML = 'Masukan Prodi';

                        // input
                        const input = document.createElement('input');
                        input.setAttribute('type', 'text');
                        input.setAttribute('id', event.target.id+'-input');
                        input.setAttribute('class', 'form-control');
                        input.setAttribute('name', 'prodi-input[]');
                        
                        let element2 = event.target.id;
                        $('#'+element2).after(element);
                        $('#label-'+element2).after(input);
                }else{
                    if(document.getElementById(`label-${event.target.id}`) != null){
                    var label = document.getElementById(`label-${event.target.id}`);
                    var input = document.getElementById(`${event.target.id}-input`);
                    // console.log(input);
                        label.remove();
                        input.remove();
                    }
                    
                }
        };

       


        $("#programInkubasi").change(function (){
            // get self assesment based by program inkubasi
            var e = document.getElementById("programInkubasi");
            var program = e.options[e.selectedIndex].value;
            // console.log(program);
            // window.location.href = '/startup/'+program;
            $.ajax({
                url:"{{ route('startup.setInkubasi') }}",
                method:'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'program_id' : program
                },
                success: function (data) {
                    // console.log(data);
                    let questionEl = document.getElementById('questions');
                    questionEl.innerHTML = '';
                    data.question.forEach((question, index) => {
                        questionEl.appendChild(addQuestion(question, index));
                    });
                }
            });
        })

        function addQuestion(question, index){
            let cardEl = document.createElement('div');
            cardEl.classList.add('card-body')

            let questionEl = document.createElement('p');
            questionEl.textContent = question['mq_question'];
            cardEl.appendChild(questionEl);

            let divEl = document.createElement('div');
            divEl.classList.add('radio');
            divEl.classList.add('mt-2');
            question['question_range'].forEach((value, questIdx) => {
                let inputEl = document.createElement('input');
                inputEl.setAttribute('type', 'radio');
                inputEl.setAttribute('id', `answers-${questIdx}-${index}`);
                inputEl.setAttribute('name', `answers[${index}]`);
                inputEl.value = value['mqr_id'];
                divEl.appendChild(inputEl);

                let labelEl = document.createElement('label');
                labelEl.setAttribute('for', `answers-${questIdx}-${index}`);
                labelEl.textContent = value['mqr_description'];
                divEl.appendChild(labelEl);

                cardEl.appendChild(divEl);
            });

            return cardEl;
        } 

        function addCard() {
            totalCard +=1
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
            if(document.getElementById(`label-universitas-${totalCard-1}`)){
                document.getElementById(`label-universitas-${totalCard-1}`).remove();
                document.getElementById(`universitas-${totalCard-1}-input`).remove();
            }
            var existingRow = document.querySelector("#nav-anggota .card .row").cloneNode(true);
            existingRow.children[1].children[3].id = "universitas-"+totalCard;
            existingRow.children[1].children[5].id = "fakultas-"+totalCard;
            existingRow.children[1].children[7].id = "prodi-"+totalCard;

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