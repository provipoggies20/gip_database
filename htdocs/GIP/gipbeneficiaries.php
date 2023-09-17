<!DOCTYPE html>
<html>
<head>
    <title>List of Beneficiaries</title>
    <link rel="stylesheet" href="css/gip.css"/>
    <?php include "header.php" ?>
</head>
<body>
    <h1>List of Beneficiaries</h1>
    <button id="filterJanuaryButton">January</button>
    <button id="filterFebruaryButton">February</button>
    <button id="filterMarchButton">March</button>
    <button id="filterAprilButton">April</button>
    <button id="filterMayButton">May</button>
    <button id="filterJuneButton">June</button>
    <button id="filterJulyButton">July</button>
    <button id="filterAugustButton">August</button>
    <button id="filterSeptemberButton">September</button>
    <button id="filterOctoberButton">October</button>
    <button id="filterNovemberButton">November</button>
    <button id="filterDecemberButton">December</button>
    <button id="showAllButton">Show All</button><br>
    <table id="editableTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Surname</th>
                <th>Firstname</th>
                <th>Middle Initial</th>
                <th>Age</th>
                <th>Birthdate</th>
                <th>Sex</th>
                <th>Barangay</th>
                <th>Municipality</th>
                <th>Province</th>
                <th>Educational Attainment</th>
                <th>Start</th>
                <th>End</th>
                <th>Office</th>
                <th>Proponent</th>
                <th>ADL</th>
                <th>Contact</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "connection.php";

            $sql = "SELECT * FROM gip_beneficiaries";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['personal_id'] . '</td>';
                    echo '<td contenteditable="true">' . $row['sur_name'] . '</td>';
                    echo '<td contenteditable="true">' . $row['first_name'] . '</td>';
                    echo '<td contenteditable="true">' . $row['middle_name'] . '</td>';
                    echo '<td contenteditable="true">' . $row['age'] . '</td>';
                    echo '<td contenteditable="true">' . $row['birth_date'] . '</td>';
                    echo '<td contenteditable="true">' . $row['sex'] . '</td>';
                    echo '<td contenteditable="true">' . $row['barangay'] . '</td>';
                    echo '<td contenteditable="true">' . $row['municipality'] . '</td>';
                    echo '<td contenteditable="true">' . $row['province'] . '</td>';
                    echo '<td contenteditable="true">' . $row['educational_attainment'] . '</td>';
                    echo '<td contenteditable="true">' . $row['start_date'] . '</td>';
                    echo '<td contenteditable="true">' . $row['end_date'] . '</td>';
                    echo '<td contenteditable="true">' . $row['office'] . '</td>';
                    echo '<td contenteditable="true">' . $row['proponent'] . '</td>';
                    echo '<td contenteditable="true">' . $row['adl'] . '</td>';
                    echo '<td contenteditable="true">' . $row['contact'] . '</td>';
                    echo '<td contenteditable="true">' . $row['remarks'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <script>
        const table = document.getElementById("editableTable");
        const tbody = table.querySelector("tbody");

        function filterJanuary() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 0) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterFebruary() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 1) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterMarch() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 2) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterApril() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 3) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterMay() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 4) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterJune() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 5) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterJuly() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 6) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterAugust() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 7) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterSeptember() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 8) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterOctober() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 9) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterNovember() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 10) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function filterDecember() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === 11) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function showAll() {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                row.style.display = "table-row";
            });
        }

        const filterJanuaryButton = document.getElementById("filterJanuaryButton");
        filterJanuaryButton.addEventListener("click", filterJanuary);

        const filterFebruaryButton = document.getElementById("filterFebruaryButton");
        filterFebruaryButton.addEventListener("click", filterFebruary);

        const filterMarchButton = document.getElementById("filterMarchButton");
        filterMarchButton.addEventListener("click", filterMarch);

        const filterAprilButton = document.getElementById("filterAprilButton");
        filterAprilButton.addEventListener("click", filterApril);

        const filterMayButton = document.getElementById("filterMayButton");
        filterMayButton.addEventListener("click", filterMay);

        const filterJuneButton = document.getElementById("filterJuneButton");
        filterJuneButton.addEventListener("click", filterJune);

        const filterJulyButton = document.getElementById("filterJulyButton");
        filterJulyButton.addEventListener("click", filterJuly);

        const filterAugustButton = document.getElementById("filterAugustButton");
        filterAugustButton.addEventListener("click", filterAugust);

        const filterSeptemberButton = document.getElementById("filterSeptemberButton");
        filterSeptemberButton.addEventListener("click", filterSeptember);

        const filterOctoberButton = document.getElementById("filterOctoberButton");
        filterOctoberButton.addEventListener("click", filterOctober);

        const filterNovemberButton = document.getElementById("filterNovemberButton");
        filterNovemberButton.addEventListener("click", filterNovember);

        const filterDecemberButton = document.getElementById("filterDecemberButton");
        filterDecemberButton.addEventListener("click", filterDecember);

        const showAllButton = document.getElementById("showAllButton");
        showAllButton.addEventListener("click", showAll);
    </script>
</body>
</html>
