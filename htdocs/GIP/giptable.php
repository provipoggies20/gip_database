<!DOCTYPE html>
<html lang="en">
    <title>GIP</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/gip.css">
        <?php include "header.php";
        include "connection.php";?>
    </head>
    <body>
        <div class="search-box">
            <h3 style="font-family: genshin;">Filter Rows</h3>
                    <input type="text" autocomplete="off" placeholder="..." />
                    <div class="result">
        </div>
        <br>
        <div class="container-display">
                <h1 style="font-family: genshin; text-align: center;">TABLETRY</h1>
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
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                    <script>
                    $(document).ready(function(){
                    $('.search-box input[type="text"]').on("keyup input", function(){
                    /* Get input value on change */
                    var inputVal = $(this).val();
                    var resultDropdown = $(this).siblings(".result");
                    if(inputVal.length){
                    $.get("backend-search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                    });
                    } else{
                    resultDropdown.empty();
                    }
                    });
    
                     // Set search input value on click of result item
                    $(document).on("click", ".result p", function(){
                    $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                    $(this).parent(".result").empty();
                    });
                    });
                    </script>
                        <?php 
                        $sql="SELECT * FROM gip_table";
                        $result=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_assoc($result)){
                        ?>
                        <tr class="table-body" style="font-size:15px;">
                        <td>
                        <a style="color: #gray; text-decoration: none;" href="gipedit.php?personal_id=<?php echo $row['personal_id']; ?>"><?php echo $row['name']; ?></a>
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