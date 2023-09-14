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
    <link rel="stylesheet" href="gip.css" />
    <script defer src="gip.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
    <div style="font-family:genshin; font-size: 35px; text-align: center;">
        <form method="POST" style="font-family:genshin; font-size:20px;">
            <h1 style="background: radial-gradient(circle at 20%,#e45f12, #e325fa);">REGISTRY</h1>
            <label for="name">Name (Last, Suffix, First, MI):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="name" autocomplete="off" required />
            <br><br>
            <label for="address">Address (Municipality, Province):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="address" autocomplete="off" required />
            <br><br>
            <label for="birth_date">Birthdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="birth_date" autocomplete="off" required />
            <br><br>
            <label for="gender">Gender:</label><br>
            <select style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%; border: none; border-radius: 4px; background-color: #f1f1f1;" name="gender" required >
                <option value="" selected disabled>Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select> 
            <br><br>
            <label>
            <br><h1 style="color:red;">First Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-1" style="color:red;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-1" name="office[0]" autocomplete="off" required />
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-1" name="contract_number[0]" autocomplete="off" required />
            <br><br> 
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-1" name="start_date[0]" autocomplete="off" required />
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-1" name="end_date[0]" autocomplete="off" required />
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-1"name="rendered[0]" autocomplete="off" required />
            <br><br>
            </div>
            <label>
            <br><h1 style="color:green;">Second Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-2" style="color:green;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-2" name="office[1]" autocomplete="off"/>
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-2" name="contract_number[1]" autocomplete="off"/>
            <br><br>
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-2" name="start_date[1]" autocomplete="off"/>
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-2" name="end_date[1]" autocomplete="off"/>
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-2" name="rendered[1]" autocomplete="off"/>
            <br><br>
            </div>    
            <label>     
            <br><h1 style="color:blue;">Third Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-3" style="color:blue;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-3" name="office[2]" autocomplete="off"/>
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-3" name="contract_number[2]" autocomplete="off"/>
            <br><br>
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-3" name="start_date[2]" autocomplete="off"/>
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-3" name="end_date[2]" autocomplete="off"/>
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-3" name="rendered[2]" autocomplete="off"/>
            <br><br>
            </div>
            <label>
            <br><h1 style="color:violet;">Fourth Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-4" style="color:violet;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-4" name="office[3]" autocomplete="off"/>
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-4" name="contract_number[3]" autocomplete="off"/>
            <br><br>
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-4" name="start_date[3]" autocomplete="off"/>
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-4" name="end_date[3]" autocomplete="off"/>
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-4" name="rendered[3]" autocomplete="off"/>
            <br><br>
            </div>
            <br><br>
            <label for="total">Total (in monthsmax. 12 months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="total" autocomplete="off" required />        
            <br><br>
            <label for="leftover">Leftover (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="leftover" autocomplete="off" required />  
            <br><br>
            <label for="status">Status:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="status" autocomplete="off" required /> 
            <br><br>
            <div class="button-div">
            <input style="border: 10px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:30%;" style="font-family:genshin; font-size: large;" type="submit" name="submit" value="SUBMIT" class="form-submit" />
            <br><br>
            <a style="font-family:genshin;" class="form-back" href="giptable.php">BACK</a>
            </div>  
            </div>
        </form>
    </div>
</body>
</html>