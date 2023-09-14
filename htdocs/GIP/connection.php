<?php
$conn=new mysqli("localhost", "root", "", "gip_database");
if(!$conn){
    die(mysqli_error($conn));
}