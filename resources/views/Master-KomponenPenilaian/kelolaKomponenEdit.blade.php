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
            <p class="col">Periode: Tahun 2022</p>
            <p class="col">Tahap: Self Assessment</p>
            <p class="col">Program Inkubasi: BTPIP</p>
        </div>

        <div class="form-group">
            <form action="" class="row align-items-center" style="margin-top: 1rem">
                <div class="col-4 col-md-3 col-lg-2">
                    <select name="pilihPeriode" id="periode" class="form-control form-select">
                        <option value="select" class="text-muted">Periode</option>
                        <option value="th2022">Tahun 2022</option>
                    </select>
                </div>
    
                <div class="col-4 col-md-3 col-lg-2">
                    <p>10 Data ditemukan</p>
                </div>
    
                <div class="col">
                    <button class="btn btn-primary px-4 py-1">
                        Salin
                    </button>
                </div>
            </form>

            <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-primary add-form py-0 px-1" onclick="addCard()">
                    <i data-feather="plus"></i>
                </button>
            </div>

            <div id="cardContainer">
                <div class="card mt-2">
                    <div class="card-body">
                        <input type="text" class="form-control" id="pertanyaan" placeholder="Pertanyaan">
    
                        <div class="d-flex justify-content-end mt-2" onclick="addRow()">
                            <button class="btn btn-primary py-0 px-1">
                                <i data-feather="plus"></i>
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
                                        <tr>
                                            <td class="text-center">
                                                1
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Jawaban" value="Current jawaban">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Nilai" value="80">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button class="btn btn-primary add-form py-0 px-1" onclick="deleteRow()">
                                                        <i data-feather="minus"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </div>
                                <!-- Table Body -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center inner-bottom-button">
            <button class="btn btn-primary px-4">
                Simpan
            </button>
        </div>
    </div>

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

            /* Create input pertanyaan */
            var input = document.createElement("input");
            input.type = "text";
            input.className = "form-control";
            input.id = "pertanyaan";
            input.placeholder = "Pertanyaan";

            /* Create button container */
            var buttonContainer = document.createElement("div");
            buttonContainer.className = "d-flex justify-content-end mt-2";

            /* Create button */
            var button = document.createElement("button");
            button.className = "btn btn-primary py-0 px-1";

            /* Plus icon */
            var icon = document.createElement("i");
            icon.setAttribute("data-feather", "plus");

            /* Append plus icon */
            button.appendChild(icon);

            /* Append button */
            buttonContainer.appendChild(button);

            /* Append input pertanyaan & button container to card body */
            cardBody.appendChild(input);
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
            var newButton = card.querySelector(".btn.btn-primary.py-0.px-1");

            /* Add onclick event to the new button */
            newButton.onclick = function() {
                addRow.call(this);
            };
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
            inputJawaban.type = "text";
            inputJawaban.className = "form-control";
            inputJawaban.placeholder = "Jawaban";
            tableCell2.appendChild(inputJawaban);

            var tableCell3 = document.createElement("td");
            var inputNilai = document.createElement("input");
            inputNilai.type = "text";
            inputNilai.className = "form-control";
            inputNilai.placeholder = "Nilai";
            tableCell3.appendChild(inputNilai);

            var tableCell4 = document.createElement("td");
            var buttonContainer = document.createElement("div");
            buttonContainer.className = "d-flex justify-content-end mt-2";

            /* Create button */
            var buttonMinus = document.createElement("button");
            buttonMinus.className = "btn btn-primary add-form py-0 px-1";
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
        }


        function deleteRow() {
            // Get the table row to delete
            var tableRow = this.closest("tr");

            // Get the table body containing the row
            var tableBody = tableRow.parentNode;

            // Remove the row from the table body
            tableBody.removeChild(tableRow);
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Add onclick event handlers
            var minusButtons = document.querySelectorAll("#cardContainer .btn.btn-primary.add-form.py-0.px-1");
            for (var i = 0; i < minusButtons.length; i++) {
                var minusButton = minusButtons[i];
                minusButton.onclick = deleteRow;
            }
        });
    </script>

@endsection