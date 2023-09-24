<?php
include "../interface/connection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$personalId = $_POST['personalId'];
$columnName = $_POST['columnName'];
$newValue = $_POST['newValue'];

$sql = "UPDATE gip_beneficiaries SET $columnName = ? WHERE personal_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "si", $newValue, $personalId);
    if (mysqli_stmt_execute($stmt)) {
        echo "Data updated successfully";
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
} else {
    echo "Error in the SQL query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
