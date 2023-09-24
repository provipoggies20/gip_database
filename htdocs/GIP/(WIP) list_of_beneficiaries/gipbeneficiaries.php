<!DOCTYPE html>
<html>
<head>
    <title>List of Beneficiaries</title>
    <link rel="stylesheet" href="../css/gip.css"/>
    <header>
        <?php include "../interface/header.php"; ?>
    </header>
</head>
<body>
    <h1>List of Beneficiaries</h1>
    <a class="link-style" id="filterJanuaryButton">January</a> |
    <a class="link-style" id="filterFebruaryButton">February</a> |
    <a class="link-style" id="filterMarchButton">March</a> |
    <a class="link-style" id="filterAprilButton">April</a> |
    <a class="link-style" id="filterMayButton">May</a> |
    <a class="link-style" id="filterJuneButton">June</a> |
    <a class="link-style" id="filterJulyButton">July</a> |
    <a class="link-style" id="filterAugustButton">August</a> |
    <a class="link-style" id="filterSeptemberButton">September</a> |
    <a class="link-style" id="filterOctoberButton">October</a> |
    <a class="link-style" id="filterNovemberButton">November</a> |
    <a class="link-style" id="filterDecemberButton">December</a> |
    <a class="link-style" id="showAllButton">Show All</a> |
    <a class="download-link" href="downloadbeneficiary.php">Download as Excel</a><br><br>
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
            include "../interface/connection.php";
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

        const editableCells = document.querySelectorAll("#editableTable td[contenteditable='true']");

        editableCells.forEach(cell => {
            cell.addEventListener("input", () => {
                const personalId = cell.closest("tr").querySelector("td:first-child").textContent;
                const columnName = cell.getAttribute("data-column-name");
                const newValue = cell.textContent;

                // Perform an AJAX request here to update the database with the new value
                // Use the personalId, columnName, and newValue in the request
                fetch("update_database.php", {
                    method: "POST",
                    body: JSON.stringify({ personalId, columnName, newValue }),
                    headers: {
                        "Content-Type": "application/json"
                    }
                })
                .then(response => {
                    if (response.ok) {
                        console.log("Data updated successfully");
                    } else {
                        console.error("Error updating data");
                    }
                })
                .catch(error => {
                    console.error("Network error:", error);
                });
            });
        });

        function filterMonth(month) {
            const rows = Array.from(tbody.querySelectorAll("tr"));
            rows.forEach(row => {
                const startDate = row.cells[11].textContent;
                const startDateDate = new Date(startDate);
                if (startDateDate.getMonth() === month) {
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
        
        // Add event listeners for month filters
        const filterJanuaryButton = document.getElementById("filterJanuaryButton");
        filterJanuaryButton.addEventListener("click", () => filterMonth(0));

        const filterFebruaryButton = document.getElementById("filterFebruaryButton");
        filterFebruaryButton.addEventListener("click", () => filterMonth(1));

        const filterMarchButton = document.getElementById("filterMarchButton");
        filterMarchButton.addEventListener("click", () => filterMonth(2));

        const filterAprilButton = document.getElementById("filterAprilButton");
        filterAprilButton.addEventListener("click", () => filterMonth(3));

        const filterMayButton = document.getElementById("filterMayButton");
        filterMayButton.addEventListener("click", () => filterMonth(4));

        const filterJuneButton = document.getElementById("filterJuneButton");
        filterJuneButton.addEventListener("click", () => filterMonth(5));

        const filterJulyButton = document.getElementById("filterJulyButton");
        filterJulyButton.addEventListener("click", () => filterMonth(6));

        const filterAugustButton = document.getElementById("filterAugustButton");
        filterAugustButton.addEventListener("click", () => filterMonth(7));

        const filterSeptemberButton = document.getElementById("filterSeptemberButton");
        filterSeptemberButton.addEventListener("click", () => filterMonth(8));

        const filterOctoberButton = document.getElementById("filterOctoberButton");
        filterOctoberButton.addEventListener("click", () => filterMonth(9));

        const filterNovemberButton = document.getElementById("filterNovemberButton");
        filterNovemberButton.addEventListener("click", () => filterMonth(10));

        const filterDecemberButton = document.getElementById("filterDecemberButton");
        filterDecemberButton.addEventListener("click", () => filterMonth(11));

        const showAllButton = document.getElementById("showAllButton");
        showAllButton.addEventListener("click", showAll);

    </script>
    <footer>
        <?php include "../interface/footer.php"; ?>
    </footer>
</body>
</html>
