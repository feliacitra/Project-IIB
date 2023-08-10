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
    </style>

    <div class="pb-2">
        <p style="display: flex; align-items: flex-end;">
            <!-- Home button -->
            <a href="/dashboard"><i data-feather="home" style="margin-right: 0.5rem;"></i></a>
            <!-- Home button -->
            <a href="{{ route('master.penilaian') }}">Master Komponen Penilaian</a>&nbsp;> Kelola Komponen
        </p>
    </div>

    <div class="container-fluid py-4 px-4" style="height: 100%">
        <div class="row">
            <p class="col">Periode: {{ $component->periodeProgram->masterPeriode->mpe_name }}</p>
            @if ($component->mct_step == 1)
                <p class="col">Tahap: Self Assessment</p>
            @elseif ($component->mct_step == 2)
                <p class="col">Tahap: Presentasi</p>
            @else
                <p class="col">Tahap: Desk Evaluation</p>
            @endif
            <p class="col">Program Inkubasi: {{ $component->periodeProgram->masterProgramInkubasi->mpi_name }}</p>
        </div>

        <div class="form-group">
            <form id="component-form" method="POST" action="{{ route('quest.store', $id) }}" class="row align-items-center" style="margin-top: 1rem">
                @csrf
                <div class="col-4 col-md-3 col-lg-2">
                    <select name="pilihPeriode" id="periode" class="form-control form-select">
                        <option value="select" class="text-muted">Periode</option>
                        @foreach ($periode as $item)
                        <option value="{{ $item->mpe_id }}">{{ $item->mpe_name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-4 col-md-3 col-lg-2">
                    <p>10 Data ditemukan</p>
                </div>
    
                <div class="col">
                    <button id="salin" type="button" class="btn btn-primary px-4 py-1">
                        <input type="hidden" name="salin" >
                        Salin
                    </button>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <button type="button" class="btn btn-primary add-form py-0 px-1" onclick="addCard()">
                        <i data-feather="plus"></i>
                    </button>
                </div>
    
                <div id="cardContainer">
                    @forelse($component->question as $question)
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="container-fluid border-0">
                                <div class="row">
                                    <div class="col-11">
                                        <input type="text" class="form-control" name="pertanyaan[]" id="pertanyaan" placeholder="Pertanyaan" value="{{ $question->mq_question }}">
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn btn-primary add-form py-0 px-1 delete-card-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="num[]" class="quest-num" value="{{ count($question->questionRange )}}">
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button type="button" class="btn btn-primary py-0 px-1 add-row-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="table-responsive-md mt-2">
                                <table class="table">
                                    <!-- Table Head -->
                                    <thead class="text-center" style="background-color: #f5f5f5">
                                        <tr>
                                            <th scope="col" style="width: 5%;">#</th>
                                            <th scope="col" style="width: 75%">JAWABAN</th>
                                            <th scope="col" style="width: 15%">NILAI</th>
                                            <th scope="col" style="width: 5%"></th>
                                        </tr>
                                    </thead>
                                    <!-- Table Head -->
        
                                    <!-- Table Body INSERT-->
                                    <div id="tableContainer">
                                        <tbody>
                                            @foreach($question->questionRange as $qr)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <input class="form-control" name="jawaban[]" type="text" placeholder="Jawaban" value="{{ $qr->mqr_description }}">
                                                </td>
                                                <td>
                                                    <input class="form-control" name="nilai[]" type="text" placeholder="Nilai" value="{{ $qr->mqr_poin }}">
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end mt-2">
                                                        <button type="button" class="btn btn-primary add-form py-0 px-1 delete-row-button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </div>
                                    <!-- Table Body -->
                                </table>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </form>

        </div>

        <div class="container text-center inner-bottom-button">
            <button class="btn btn-primary px-4" onclick="submit()">
                Simpan
            </button>
        </div>
    </div>

    <form action="{{ route('quest.copy', $id) }}" id="form-salin">
    <input type="hidden" name="periode">
    </form>
    <script>
        function addCard() {

            var container = document.getElementById("cardContainer");

            var existingCard = container.querySelector(".card");

            /* Create new card */
            var card = document.createElement("div");
            card.className = "card mt-2";

            /* Create card body */
            var cardBody = document.createElement("div");
            cardBody.className = "card-body";

            var inputContainer = document.createElement("div");
            inputContainer.className = "col-8 col-md-8 col-lg-6"

            /* Create input pertanyaan */
            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.id = "pertanyaan";
            input.placeholder = "Pertanyaan";
            input.name = 'pertanyaan[]';

            var buttonDelete = document.createElement("button");
            buttonDelete.type = "button";
            buttonDelete.className = "btn btn-primary py-0 px-1 delete-card-button";

            var iconDelete = document.createElement("i");
            iconDelete.setAttribute("data-feather", "minus");

            buttonDelete.appendChild(iconDelete);

            inputContainer.appendChild(input);
            inputContainer.appendChild(buttonDelete);

            var hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.className = "quest-num";
            hiddenInput.name = "num[]";
            hiddenInput.value = "0";

            /* Create button container */
            var buttonContainer = document.createElement("div");
            buttonContainer.className = "d-flex justify-content-end mt-2";

            /* Create button */
            var button = document.createElement("button");
            button.type = "button";
            button.className = "btn btn-primary py-0 px-1 add-row-button";

            /* Plus icon */
            var icon = document.createElement("i");
            icon.setAttribute("data-feather", "plus");

            /* Append plus icon */
            button.appendChild(icon);

            /* Append button */
            buttonContainer.appendChild(button);

            /* Append input pertanyaan & button container to card body */
            cardBody.appendChild(inputContainer);
            cardBody.appendChild(hiddenInput);
            cardBody.appendChild(buttonContainer);

            /* Create table container */
            var tableContainer = document.createElement("div");
            tableContainer.className = "table-responsive-md mt-2";

            /* Create table */
            var table = document.createElement("table");
            table.className = "table";

            /* Create table head */
            var tableHead = document.createElement("thead");
            tableHead.className = "text-center";
            tableHead.style.backgroundColor = "#f5f5f5";

            /* Create table head row */
            var tableHeadRow = document.createElement("tr");

            /* Create table head cells */
            var tableHeadCell1 = document.createElement("th");
            tableHeadCell1.setAttribute("scope", "col");
            tableHeadCell1.style.width = "5%";
            tableHeadCell1.textContent = "#";

            var tableHeadCell2 = document.createElement("th");
            tableHeadCell2.setAttribute("scope", "col");
            tableHeadCell2.style.width = "75%";
            tableHeadCell2.textContent = "JAWABAN";

            var tableHeadCell3 = document.createElement("th");
            tableHeadCell3.setAttribute("scope", "col");
            tableHeadCell3.style.width = "15%";
            tableHeadCell3.textContent = "NILAI";

            var tableHeadCell4 = document.createElement("th");
            tableHeadCell4.setAttribute("scope", "col");
            tableHeadCell4.style.width = "5%";

            /* Append table head cells to table head row */
            tableHeadRow.appendChild(tableHeadCell1);
            tableHeadRow.appendChild(tableHeadCell2);
            tableHeadRow.appendChild(tableHeadCell3);
            tableHeadRow.appendChild(tableHeadCell4);

            /* Append table head row to table head */
            tableHead.appendChild(tableHeadRow);

            /* Create table body */
            var tableBody = document.createElement("tbody");

            /* Append table head and body to table */
            table.appendChild(tableHead);
            table.appendChild(tableBody);

            /* Append table to table container */
            tableContainer.appendChild(table);

            /* Append table container to card body */
            cardBody.appendChild(tableContainer);

            /* Append card body to card */
            card.appendChild(cardBody);

            /* Get existing cards */
            var existingCards = container.getElementsByClassName("card");

            /* Shift cards */
            for (var i = existingCards.length - 1; i >= 0; i--) {
                var currentCard = existingCards[i];
                currentCard.style.order = i + 1; // Update CSS property order
            }

            /* Set new card to top */
            card.style.order = 1;

            /* Insert new card */
            container.insertBefore(card, container.firstChild);

            feather.replace();

            /* Retrieve the newly added button */
            var newButton = card.querySelector(".add-row-button");
            var delButton = card.querySelector(".delete-card-button");

            /* Add onclick event to the new button */
            newButton.onclick = function() {
                addRow.call(this);
            };

            delButton.onclick = function() {
                deleteCard.call(this);
            }
        }

        var rowCount = 1; // Initialize the row count variable

        function addRow() {
            // Get the table body where you want to insert the new row
            var tableBody = this.closest(".card-body").querySelector("tbody");

            /* Create table row */
            var tableRow = document.createElement("tr");

            /* Create table cells */
            var tableCell1 = document.createElement("td");
            tableCell1.className = "text-center";
            tableCell1.textContent = "#" //numbering

            var tableCell2 = document.createElement("td");
            var inputJawaban = document.createElement("input");
            inputJawaban.name = "jawaban[]";
            inputJawaban.type = "text";
            inputJawaban.className = "form-control";
            inputJawaban.placeholder = "Jawaban";
            tableCell2.appendChild(inputJawaban);

            var tableCell3 = document.createElement("td");
            var inputNilai = document.createElement("input");
            inputNilai.name = "nilai[]";
            inputNilai.type = "text";
            inputNilai.className = "form-control";
            inputNilai.placeholder = "Nilai";
            tableCell3.appendChild(inputNilai);

            var tableCell4 = document.createElement("td");
            var buttonContainer = document.createElement("div");
            buttonContainer.className = "d-flex justify-content-end mt-2";

            /* Create button */
            var buttonMinus = document.createElement("button");
            buttonMinus.className = "btn btn-primary add-form py-0 px-1 delete-row-button";
            buttonMinus.onclick = deleteRow;

            /* Minus icon */
            var minusIcon = document.createElement("i");
            minusIcon.setAttribute("data-feather", "minus");

            /* Append minus icon */
            buttonMinus.appendChild(minusIcon);

            /* Append button */
            buttonContainer.appendChild(buttonMinus);
            tableCell4.appendChild(buttonContainer);

            /* Append table cells to table row */
            tableRow.appendChild(tableCell1);
            tableRow.appendChild(tableCell2);
            tableRow.appendChild(tableCell3);
            tableRow.appendChild(tableCell4);

            /* Append table row to table body */
            tableBody.appendChild(tableRow);

            feather.replace();

            var questNumInput = this.closest('.card-body').querySelector('.quest-num');
            
            var currentValue = parseInt(questNumInput.value);
            var newValue = currentValue + 1;

            questNumInput.value = newValue;
        }


        function deleteRow() {
            var questNumInput = this.closest('.card-body').querySelector('.quest-num');
            
            var currentValue = parseInt(questNumInput.value);
            var newValue = currentValue - 1;

            questNumInput.value = newValue;
            // Get the table row to delete
            var tableRow = this.closest("tr");

            // Get the table body containing the row
            var tableBody = tableRow.parentNode;

            // Remove the row from the table body
            tableBody.removeChild(tableRow);

        }

        function deleteCard() {
            var card = this.closest('.card.mt-2');
            console.log(card);
            var cardContainer = card.parentNode;
            cardContainer.removeChild(card);
        }

        function submit() {
            document.getElementById('component-form').submit();
        }



        document.addEventListener("DOMContentLoaded", function() {
            var deleteRowButton = document.getElementsByClassName('delete-row-button');
            for (var i = 0; i < deleteRowButton.length; i++) {
                deleteRowButton[i].addEventListener("click", deleteRow);
            }
            
            var cards = document.getElementsByClassName("card mt-2");
            for (var i = 0; i < cards.length; i++) {
                var button = cards[i].querySelector(".add-row-button");
                button.onclick = function() {
                    addRow.call(this);
                };

                var deleteButton = cards[i].querySelector(".delete-card-button");
                deleteButton.onclick = function() {
                    deleteCard.call(this);
                }
            }

            var salinButton = document.getElementById('salin');
            salinButton.addEventListener("click", function() {

            });
            

            // var deleteCardButton = document.getElementsByClassName('delete-card-button');
            // for (var i = 0; i < deleteCardButton.length; i++) {
            //     deleteCardButton[i].addEventListener("click", deleteCard);
            // }

        });


    </script>

@endsection