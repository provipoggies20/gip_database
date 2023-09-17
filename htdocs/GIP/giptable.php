<!DOCTYPE html>
<html lang="en">
    <title>GIP</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/gip.css">
        <script src="js/master.js"></script>
        <?php include "header.php";
        include "connection.php";?>
    </head>
    <body>
        <div class="search-box">
            <h3 style="font-family: genshin;">Filter Rows</h3>
                    <input id="filterInput" style="border: 3px solid #555; font-family: genshin; font-size: 15px; text-align: center; width:20%;" type="text" autocomplete="off" placeholder="..."   />
                    <a class="link-style" href="?sort=asc">Sort Ascending</a> |
                    <a class="link-style" href="?sort=desc">Sort Descending</a> |
                    <a class="link-style" href="?sort=id">Sort by Date Added</a> |
                    <a class="link-style" href="?sort=address">Sort by Municipality</a> |
                    <a class="link-style" href="?sort=gender">Sort by Gender</a> |
                    <a class="download-link" href="downloadcontracts.php">Download as Excel</a>
                    <div class="result">
        </div>
        <br>
        <div id="tableContainer" class="container-display">
                <h1 style="font-family: genshin; text-align: center;">TABLETRY</h1>
                <h3><i>Check Raw Beneficiaries as a basis for Past Contracts</i></h3>
                <table class="table-display">
                    <thead class="table-head"  style="font-size:20px;">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Total Months</th>
                            <th>Leftover</th>   
                            <th>Status</th>
                        </tr>
                    <thead>
                    <tbody>
                    <script>
                    $(document).ready(function(){
                    $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    var tableContainer = $('#tableContainer');
                    if (inputVal.length) {
                        $.get("backend-search.php", {term: inputVal}).done(function(data){
                            // Display the returned data in the browser
                            resultDropdown.html(data);
                            tableContainer.hide();
                        });
                    } else {
                        resultDropdown.empty();
                        tableContainer.show();
                    }
                    });
                    });
                    <?php

                    $sortOrder = "ASC";
                    $orderBy = "personal_id";
                    // Check if the sort query parameter is set and valid
                    if (isset($_GET['sort'])) {
                        switch ($_GET['sort']) {
                            case 'asc':
                                $sortOrder = "ASC";
                                $orderBy = "name";
                                break;
                            case 'desc':
                                $sortOrder = "DESC";
                                $orderBy = "name";
                                break;
                            case 'id':
                                $sortOrder = "DESC";
                                $orderBy = "personal_id";
                                break;
                            case 'address':
                                $orderBy = "SUBSTRING_INDEX(SUBSTRING_INDEX(address, ',', 2), ' ', -1), -- Second word
                                SUBSTRING_INDEX(address, ',', 1) -- First word";
                                break;
                            case 'gender':
                                $orderBy = "gender";
                                break;
                            default:
                                $sortOrder = "ASC";
                                $orderBy = "personal_id";
                                break;
                        }
                    }
                    
                    // Modify your SQL query to include the sorting order and column
                    $sql = "SELECT * FROM gip_table ORDER BY $orderBy $sortOrder";


                    $result = mysqli_query($conn, $sql);
                    ?>

                    // Rest of your JavaScript code here
                    $(document).on("click", ".result p", function(){
                        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                        $(this).parent(".result").empty();
                    });
                    </script>
                        <?php 
                        while ($row = mysqli_fetch_assoc($result)){ ?>
                        <tr class="table-body" style="font-size:15px;">
                        <td>
                        <a style="color: black; text-decoration: none;" href="gipedit.php?personal_id=<?php echo $row['personal_id']; ?>"><?php echo $row['name']; ?></a>
                        </td>
                        <td><?php echo $row["address"]; ?></td>
                        <td><?php echo $row["birth_date"]; ?></td>
                        <td><?php echo $row["gender"]; ?></td>
                        <td><?php echo $row["total"]; ?></td>
                        <td><?php echo $row["leftover"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>  
                        </tr>   
                    </tbody>
                    </div>
                        <?php
                        }
                        ?>
                </table>
    </div>
    </body>
    </html>