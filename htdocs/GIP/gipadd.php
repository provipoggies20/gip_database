<?php
include 'connection.php';
    if(isset($_POST['submit'])){
        $contractcheck = isset($_POST['contractcheck']) ? $_POST['contractcheck'] : [];
        $contractcheck = implode("/", $contractcheck);
        $name = $_POST['name'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $birth_date = $_POST['birth_date'];
        $office = isset($_POST['office']) && is_array($_POST['office']) ? implode("/", $_POST['office']) : [];
        $contract_number = isset($_POST['contract_number']) && is_array($_POST['contract_number']) ? implode("/", $_POST['contract_number']) : [];
        $start_date = isset($_POST['start_date']) && is_array($_POST['start_date']) ? implode("/", $_POST['start_date']) : [];
        $end_date = isset($_POST['end_date']) && is_array($_POST['end_date']) ? implode("/", $_POST['end_date']) : [];
        $rendered = isset($_POST['rendered']) && is_array($_POST['rendered']) ? implode("/", $_POST['rendered']) : [];
        $total = $_POST['total'];
        $leftover = $_POST['leftover'];
        $status = $_POST['status'];

        $sql1 = "INSERT INTO gip_table (name, address, gender, birth_date, office, contract_number, start_date, end_date, rendered, total, leftover, status)
        VALUES ('$name', '$address', '$gender', '$birth_date', '$office', '$contract_number', '$start_date', '$end_date', '$rendered', '$total', '$leftover', '$status')";

        $result1 = mysqli_query($conn, $sql1);

        if($result1){
            header('location:giptable.php');
        } else {
            die(mysqli_error($conn));
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiary</title>
    <link rel="stylesheet" href="css/gip.css" />
    <script defer src="js/gip.js"></script>
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container-display">
        <form method="POST">
            <h1>REGISTRY</h1>
            <h3><i>Leave Blank if not Applicable<i></h3>
            <div class="form-column">
                <div class="form-group">
                    <label for="name">Name (Last, Suffix, First, MI):</label>
                    <input type="text" name="name" autocomplete="off" required />
                </div>
                <div class="form-group">
                    <label for="address">Address (Municipality, Province):</label>
                    <input type="text" name="address" autocomplete="off" required />
                </div>
                <div class="form-group">
                    <label for="birth_date">Birthdate (ex. January 1, 1970):</label>
                    <input type="text" name="birth_date" autocomplete="off" required />
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" required>
                        <option value="" selected disabled>Select Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
            </div><hr>
            <h1 style="color:red;">First Contract</h1>
            <div class="form-column">
                <div class="form-group">
                    <label for="office">Office (Assignment):</label>
                    <input type="text" name="office[0]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="contract_number">Contract Number:</label>
                    <input type="text" name="contract_number[0]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="start_date">Startdate (ex. January 1, 1970):</label>
                    <input type="text" name="start_date[0]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="end_date">Enddate (ex. January 1, 1970):</label>
                    <input type="text" name="end_date[0]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="rendered">Rendered (in months):</label>
                    <input type="text" name="rendered[0]" autocomplete="off" />
                </div>
            </div><hr>
            <h1 style="color:green;">Second Contract</h1>
            <div class="form-column">
                <div class="form-group">
                    <label for="office">Office (Assignment):</label>
                    <input type="text" name="office[1]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="contract_number">Contract Number:</label>
                    <input type="text" name="contract_number[1]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="start_date">Startdate (ex. January 1, 1970):</label>
                    <input type="text" name="start_date[1]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="end_date">Enddate (ex. January 1, 1970):</label>
                    <input type="text" name="end_date[1]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="rendered">Rendered (in months):</label>
                    <input type="text" name="rendered[1]" autocomplete="off" />
                </div>
            </div><hr>
            <h1 style="color:blue;">Third Contract</h1>
            <div class="form-column">
                <div class="form-group">
                    <label for="office">Office (Assignment):</label>
                    <input type="text" name="office[2]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="contract_number">Contract Number:</label>
                    <input type="text" name="contract_number[2]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="start_date">Startdate (ex. January 1, 1970):</label>
                    <input type="text" name="start_date[2]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="end_date">Enddate (ex. January 1, 1970):</label>
                    <input type="text" name="end_date[2]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="rendered">Rendered (in months):</label>
                    <input type="text" name="rendered[2]" autocomplete="off" />
                </div>
            </div><hr>
            <h1 style="color:violet;">Fourth Contract</h1>
            <div class="form-column">
                <div class="form-group">
                    <label for="office">Office (Assignment):</label>
                    <input type="text" name="office[3]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="contract_number">Contract Number:</label>
                    <input type="text" name="contract_number[3]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="start_date">Startdate (ex. January 1, 1970):</label>
                    <input type="text" name="start_date[3]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="end_date">Enddate (ex. January 1, 1970):</label>
                    <input type="text" name="end_date[3]" autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="rendered">Rendered (in months):</label>
                    <input type="text" name="rendered[3]" autocomplete="off" />
                </div>
            </div><hr><br>
            <div class="form-column">
                <div class="form-group">
                    <label for="total">Total (in months, max. 12 months):</label>
                    <input type="text" id="total" name="total" autocomplete="off" required />
                </div>
                <div class="form-group">
                    <label for="leftover">Leftover (in months):</label>
                    <input type="text" id="leftover" name="leftover" autocomplete="off" required />
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" autocomplete="off" required />
                </div>
            </div>
            <div class="button-div">
                <input type="submit" name="submit" value="SUBMIT" class="form-submit" />
                <a class="form-back" href="giptable.php">BACK</a>
            </div>
        </form>
    </div>
    <script>
    function updateAll(){
            const renderedFields = document.querySelectorAll('input[name^="rendered["]');
            let total = 0;
            renderedFields.forEach(function (field) {
                const renderedValue = parseInt(field.value) || 0;
                total += renderedValue;
            });
            const totalField = document.getElementById('total');
            totalField.value = total;
            const leftover = 12 - total;
            const leftoverInput = document.getElementById('leftover');
            const statusInput = document.getElementById('status');
            if (leftover <= 0) {
                leftoverInput.value = 'N/A';
            } else {
                leftoverInput.value = leftover;
            }
            if (leftover < 3){
                statusInput.value = 'Not Applicable';
            }
            else {
                statusInput.value = 'Applicable';
            }
        }
        const renderedFields = document.querySelectorAll('input[name^="rendered["]');
        renderedFields.forEach(function (field) {
            field.addEventListener('input', updateAll);
        });
        updateAll();
    </script>
</body>
</html>
