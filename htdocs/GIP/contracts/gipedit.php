<?php
include '../interface/connection.php';

$personal_id = $_GET['personal_id'];
$sql1 = "SELECT * FROM gip_table WHERE personal_id=$personal_id";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$name = $row1['name'];
$address = $row1['address'];
$birth_date = $row1['birth_date'];
$gender = $row1['gender'];
$office = $row1['office'];
$office = explode("/", $office);
$contract_number = $row1['contract_number'];
$contract_number = explode("/", $contract_number);
$start_date = $row1['start_date'];
$start_date = explode("/", $start_date);
$end_date = $row1['end_date'];
$end_date = explode("/", $end_date);
$rendered = $row1['rendered'];
$rendered = explode("/", $rendered);
$total = $row1['total'];
$leftover = $row1['leftover'];
$status = $row1['status'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $office = isset($_POST['office']) && is_array($_POST['office']) ? implode("/", $_POST['office']) : [];
    $contract_number = isset($_POST['contract_number']) && is_array($_POST['contract_number']) ? implode("/", $_POST['contract_number']) : [];
    $start_date = isset($_POST['start_date']) && is_array($_POST['start_date']) ? implode("/", $_POST['start_date']) : [];
    $end_date = isset($_POST['end_date']) && is_array($_POST['end_date']) ? implode("/", $_POST['end_date']) : [];
    $rendered = isset($_POST['rendered']) && is_array($_POST['rendered']) ? implode("/", $_POST['rendered']) : [];
    $total = $_POST['total'];
    $leftover = $_POST['leftover'];
    $status = $_POST['status'];
    $sql1 = "UPDATE gip_table SET personal_id=$personal_id, name='$name', address='$address', birth_date='$birth_date', gender='$gender', office='$office', start_date='$start_date', end_date='$end_date', rendered='$rendered', total='$total', leftover='$leftover', status='$status' WHERE personal_id=$personal_id ";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1) {
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
    <link rel="stylesheet" href="../css/gip.css" />
    <script defer src="../js/gip.js"></script>
    <header>
        <?php include "../interface/header.php"; ?>
    </header>
</head>
<body>
    <div class="container-display">
        <form method="POST">
            <h1>EDITRY</h1>
            <h3><i>Leave Blank if not Applicable</i></h3>   
            <h3><i>Check boxes if more than 1 contracts</i></h3>
            <!--<a class="download-link" href="certification.php?personal_id=<?php /*echo $personal_id;*/ ?> ">Certification</a><hr>-->
            <div class="form-column">
                <div class="form-group">
                    <label for="name">Name (Last, Suffix, First, MI):</label>
                    <input type="text" name="name" autocomplete="off" value="<?php echo $name; ?>" required />
                </div>
                <div class="form-group">
                    <label for="address">Address (Municipality, Province):</label>
                    <input type="text" name="address" autocomplete="off" value="<?php echo $address; ?>" required />
                </div>
                <div class="form-group">
                    <label for="birth_date">Birthdate (ex. January 1, 1970):</label>
                    <input type="text" name="birth_date" autocomplete="off" value="<?php echo $birth_date; ?>" required />
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" required>
                        <option value="M" <?php echo ($gender === "M") ? 'selected' : ''; ?>>Male</option>
                        <option value="F" <?php echo ($gender === "F") ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
            </div><hr>
            <h1 style="color:red;">First Contract</h1>
            <div class="form-column">
                <div class="form-group">
                    <label for="office">Office (Assignment):</label>
                    <input type="text" name="office[0]" value="<?php echo $office[0]; ?>" autocomplete="off" required />
                </div>
                <div class="form-group">
                    <label for="contract_number">Contract Number:</label>
                    <input type="text" name="contract_number[0]" value="<?php echo $contract_number[0]; ?>" autocomplete="off" required/>
                </div>
                <div class="form-group">
                    <label for="start_date">Startdate (ex. January 1, 1970):</label>
                    <input type="text" name="start_date[0]" value="<?php echo $start_date[0]; ?>" autocomplete="off" required/>
                </div>
                <div class="form-group">
                    <label for="end_date">Enddate (ex. January 1, 1970):</label>
                    <input type="text" name="end_date[0]" value="<?php echo $end_date[0]; ?>" autocomplete="off" required/>
                </div>
                <div class="form-group">
                    <label for="rendered">Rendered (in months):</label>
                    <input type="text" name="rendered[0]" value="<?php echo $rendered[0]; ?>" autocomplete="off" required/>
                </div>
            </div><hr>
            <div class="contract-group">
                <input type="checkbox" id="showSecondContract" name="showSecondContract"  onclick="toggleSecondContractFields(this);">
                <label for="showSecondContract">Show Second Contract</label>
            </div>
            <div id="secondContractFields" style="display: none;">
            <h1 style="color:green;">Second Contract</h1>
                <div class="form-column">
                    <div class="form-group">
                        <label for="office">Office (Assignment):</label>
                        <input type="text" name="office[1]" value="<?php echo $office[1]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="contract_number">Contract Number:</label>
                        <input type="text" name="contract_number[1]" value="<?php echo $contract_number[1]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="start_date">Startdate (ex. January 1, 1970):</label>
                        <input type="text" name="start_date[1]" value="<?php echo $start_date[1]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="end_date">Enddate (ex. January 1, 1970):</label>
                        <input type="text" name="end_date[1]" value="<?php echo $end_date[1]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="rendered">Rendered (in months):</label>
                        <input type="text" name="rendered[1]" value="<?php echo $rendered[1]; ?>" autocomplete="off" />
                    </div>
                </div>
            </div><hr>
            <div class="contract-group">
                <input type="checkbox" id="showThirdContract" name="showThirdContract" onclick="toggleThirdContractFields(this);">
                <label for="showThirdContract">Show Third Contract</label>
            </div>
            <div id="thirdContractFields" style="display: none;">
            <h1 style="color:blue;">Third Contract</h1>
                <div class="form-column">
                    <div class="form-group">
                        <label for="office">Office (Assignment):</label>
                        <input type="text" name="office[2]" value="<?php echo $office[2]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="contract_number">Contract Number:</label>
                        <input type="text" name="contract_number[2]" value="<?php echo $contract_number[2]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="start_date">Startdate (ex. January 1, 1970):</label>
                        <input type="text" name="start_date[2]" value="<?php echo $start_date[2]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="end_date">Enddate (ex. January 1, 1970):</label>
                        <input type="text" name="end_date[2]" value="<?php echo $end_date[2]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="rendered">Rendered (in months):</label>
                        <input type="text" name="rendered[2]" value="<?php echo $rendered[2]; ?>" autocomplete="off" />
                    </div>
                </div>
            </div><hr>
            <div class="contract-group">
                <input type="checkbox" id="showFourthContract" name="showFourthContract" onclick="toggleFourthContractFields(this);">
                <label for="showFourthContract">Show Fourth Contract</label>
            </div>
            <div id="fourthContractFields" style="display: none;">
            <h1 style="color:violet;">Fourth Contract</h1>
                <div class="form-column">
                    <div class="form-group">
                        <label for="office">Office (Assignment):</label>
                        <input type="text" name="office[3]" value="<?php echo $office[3]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="contract_number">Contract Number:</label>
                        <input type="text" name="contract_number[3]" value="<?php echo $contract_number[3]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="start_date">Startdate (ex. January 1, 1970):</label>
                        <input type="text" name="start_date[3]" value="<?php echo $start_date[3]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="end_date">Enddate (ex. January 1, 1970):</label>
                        <input type="text" name="end_date[3]" value="<?php echo $end_date[3]; ?>" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label for="rendered">Rendered (in months):</label>
                        <input type="text" name="rendered[3]" value="<?php echo $rendered[3]; ?>" autocomplete="off" />
                    </div>
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
        document.addEventListener("DOMContentLoaded", function () {
            const hasSecondContractData = <?php echo (!empty($office[1]) || !empty($contract_number[1]) || !empty($start_date[1]) || !empty($end_date[1]) || !empty($rendered[1])) ? 'true' : 'false'; ?>;
            const secondContractCheckbox = document.getElementById("showSecondContract");
            const secondContractFields = document.getElementById("secondContractFields");
            if (hasSecondContractData) {
                secondContractCheckbox.checked = true;
                secondContractFields.style.display = "block";
            }
            secondContractCheckbox.addEventListener("change", function () {
                if (secondContractCheckbox.checked) {
                    secondContractFields.style.display = "block";
                } else {
                    secondContractFields.style.display = "none";
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const hasThirdContractData = <?php echo (!empty($office[2]) || !empty($contract_number[2]) || !empty($start_date[2]) || !empty($end_date[2]) || !empty($rendered[2])) ? 'true' : 'false'; ?>;
            const thirdContractCheckbox = document.getElementById("showThirdContract");
            const thirdContractFields = document.getElementById("thirdContractFields");
            if (hasThirdContractData) {
                thirdContractCheckbox.checked = true;
                thirdContractFields.style.display = "block";
            }
            secondContractCheckbox.addEventListener("change", function () {
                if (thirdContractCheckbox.checked) {
                    thirdContractFields.style.display = "block";
                } else {
                    thirdContractFields.style.display = "none";
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const hasFourthContractData = <?php echo (!empty($office[3]) || !empty($contract_number[3]) || !empty($start_date[3]) || !empty($end_date[3]) || !empty($rendered[2])) ? 'true' : 'false'; ?>;
            const fourthContractCheckbox = document.getElementById("showFourthContract");
            const fourthContractFields = document.getElementById("fourthContractFields");
            if (hasFourthContractData) {
                fourthContractCheckbox.checked = true;
                fourthContractFields.style.display = "block";
            }
            secondContractCheckbox.addEventListener("change", function () {
                if (fourthContractCheckbox.checked) {
                    fourthContractFields.style.display = "block";
                } else {
                    fourthContractFields.style.display = "none";
                }
            });
        });


        function updateAll() {
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
            if (leftover < 3) {
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
    <footer>
        <?php include "../interface/footer.php"; ?>
    </footer>
</body>
</html>