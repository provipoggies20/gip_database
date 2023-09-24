<!DOCTYPE html>
<html lang="en">
    <title>GIP</title>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/gip.css">
        <?php include "../interface/connection.php";?>
    </head>
    <body>
        <br>
        <div class="container-display">
                <table class="table-display" style="font-size:20px;">
                    <thead class="table-head">
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
                        <?php
                        $link = mysqli_connect("localhost", "root", "", "gip_database");
 
                        // Check connection
                        if($link === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }
                         
                        $searchTerm = $_REQUEST["term"]; // Replace this with your input source

                        // Prepare a select statement
                        $sql = "SELECT * FROM gip_table WHERE name LIKE ? OR address LIKE ?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        $param_term = "%" . $searchTerm . "%"; // Add wildcards before and after the term
                        mysqli_stmt_bind_param($stmt, "ss", $param_term, $param_term);

                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                         $result = mysqli_stmt_get_result($stmt);

                        // Check number of rows in the result set
                        if (mysqli_num_rows($result) > 0) {
                        // Fetch result rows as an associative array
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            ?>
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
                        <?php
                        }
                    } else{
                        echo "<p style='font-family: genshin';>No matches found</p>";?>>
                    </div>
                    <?php
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        // close connection
        mysqli_close($link);
                        ?>
                </table>
    </div>
        </div>
    </body>
</html>