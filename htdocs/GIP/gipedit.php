<?php
include 'connection.php';

    $personal_id = $_GET['personal_id'];
    $sql1 = "SELECT * FROM gip_table WHERE personal_id=$personal_id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);

    $name = $row1['name'];
    $address = $row1['address'];
    $birth_date = $row1['birth_date'];
    $gender = $row1['gender'];
    $office = $row1['office'];
    $office=explode("/", $office);
    $contract_number = $row1['contract_number'];
    $contract_number=explode("/", $contract_number);
    $start_date = $row1['start_date'];
    $start_date=explode("/", $start_date);
    $end_date = $row1['end_date'];
    $end_date=explode("/", $end_date);
    $rendered = $row1['rendered'];
    $rendered=explode("/", $rendered);
    $total = $row1['total'];
    $leftover = $row1['leftover'];
    $status = $row1['status'];

    if(isset($_POST['submit'])){
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

        if($result1)
        {
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
    <title>Edit Form</title>
    <link rel="stylesheet" href="gip.css" />
    <script defer src="gip.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<div style="font-family:genshin; font-size: 35px; text-align: center;" class="div-input">
        <form method="POST" style="font-family:genshin; font-size:20px;" class="form-input">
            <h1 style="background: radial-gradient(circle at 20%,#e45f12, #e325fa);">EDITRY</h1>
            <p style="font-size: 20px; color:green;"><i>Note: Do not Check / Uncheck checkboxes for contracts as data will be lost. If done so click Back.</i></p>
            <label for="name">Name (Last, Suffix, First, MI):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="name" value="<?php echo $name; ?>" required />
            <br><br>
            <label for="address">Address (Municipality, Province):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="address" value="<?php echo $address; ?>" required />
            <br><br>
            <label for="birth_date">Birthdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="birth_date" value="<?php echo $birth_date; ?>" required />
            <br><br>
            <label for="gender">Gender:</label><br>
            <select style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%; border: none; border-radius: 4px; background-color: #f1f1f1;" name="gender" required>
            <option value="M" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
            <option value="F" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
            </select>
            <br><br>
            <label>
            <p style="font-size: 20px; color:green;"><i>Note: Leave Blank if Not Applicable</i></p>
            <br><h1 style="color:red;">First Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-1" style="color:red;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-1" name="office[0]" autocomplete="off" value="<?php echo $office[0]; ?>" required />
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-1" name="contract_number[0]" autocomplete="off" value="<?php echo $contract_number[0]; ?>" required />
            <br><br> 
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-1" name="start_date[0]" autocomplete="off" value="<?php echo $start_date[0]; ?>" required />
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-1" name="end_date[0]" autocomplete="off" value="<?php echo $end_date[0]; ?>" required />
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-1"name="rendered[0]" autocomplete="off" value="<?php echo $rendered[0]; ?>" required />
            <br><br>
            </div>
            <br><h1 style="color:green;">Second Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-2" style="color:green;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-2" name="office[1]" autocomplete="off" value="<?php echo $office[1]; ?>"/>
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-2" name="contract_number[1]" autocomplete="off" value="<?php echo $contract_number[1]; ?>"/>
            <br><br>
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-2" name="start_date[1]" autocomplete="off" value="<?php echo $start_date[1]; ?>"/>
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-2" name="end_date[1]" autocomplete="off" value="<?php echo $end_date[1]; ?>"/>
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-2" name="rendered[1]" autocomplete="off" value="<?php echo $rendered[1]; ?>"/>
            <br><br>
            </div>         
            <br><h1 style="color:blue;">Third Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-3" style="color:blue;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-3" name="office[2]" autocomplete="off" value="<?php echo $office[2]; ?>"/>
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-3" name="contract_number[2]" autocomplete="off" value="<?php echo $contract_number[2]; ?>"/>
            <br><br>
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-3" name="start_date[2]" autocomplete="off" value="<?php echo $start_date[2]; ?>"/>
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-3" name="end_date[2]" autocomplete="off" value="<?php echo $end_date[2]; ?>"/>
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-3" name="rendered[2]" autocomplete="off" value="<?php echo $rendered[2]; ?>"/>
            <br><br>
            </div>
            <br><h1 style="color:violet;">Fourth Contract</h1>
            </label>
            <br><br>
            <div id="additional-fields-4" style="color:violet;">
            <label for="office">Office (Assignment):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="office-4" name="office[3]" autocomplete="off" value="<?php echo $office[3]; ?>"/>
            <br><br>
            <label for="contract_number">Contract Number:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="num-4" name="contract_number[3]" autocomplete="off" value="<?php echo $contract_number[3]; ?>"/>
            <br><br>
            <label for="start_date">Startdate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="start-4" name="start_date[3]" autocomplete="off" value="<?php echo $start_date[3]; ?>"/>
            <br><br>
            <label for="end_date">Enddate (ex. January 1, 1970):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="end-4" name="end_date[3]" autocomplete="off" value="<?php echo $end_date[3]; ?>"/>
            <br><br>
            <label for="rendered">Rendered (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" id="rendered-4" name="rendered[3]" autocomplete="off" value="<?php echo $rendered[3]; ?>"/>
            <br><br>
            </div>
            </script> 
            <br><br>
            <label for="total">Total (in monthsmax. 12 months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="total" value="<?php echo $total; ?>" required />        
            <br><br>
            <label for="leftover">Leftover (in months):</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="leftover" value="<?php echo $leftover; ?>" required />
            <br><br>
            <label for="status">Status:</label><br>
            <input style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" name="status" value="<?php echo $status; ?>" required />
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