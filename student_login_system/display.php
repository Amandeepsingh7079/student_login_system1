<?php 
include 'db-connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Display Data</h1>
    <a href="index.php">Back</a>
    
    <table border="1">
        <thead>
            <tr>
                <th>Sno</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Password</th>
                <th>Gender</th>
                <th>Email Address</th>
                <th>Phone No.</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch data from the database
            $display_data = mysqli_query($conn, "SELECT * FROM `form`");
            
            if(mysqli_num_rows($display_data) > 0) {
                $sno = 1; // Initialize serial number counter
                while($row = mysqli_fetch_assoc($display_data)) {
                    ?>
                    <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['lname']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                      
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
</body>
</html>