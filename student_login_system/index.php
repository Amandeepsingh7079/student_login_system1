<?php include 'db-connect.php';

$fname = $lname = $password = $cpassword = $gender = $email = $phone = $address = "";
$fnameErr = $lnameErr = $passwordErr = $cpasswordErr = $genderErr = $emailErr = $phoneErr = $addressErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    if (empty($_POST["fname"])) {
        $fnameErr = "First Name is required";
    } else {
        $fname = test_input($_POST["fname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fname)) {
            $fnameErr = "Only letters and white space allowed";
        }
    }

    // Validate Last Name
    if (empty($_POST["lname"])) {
        $lnameErr = "Last Name is required";
    } else {
        $lname = test_input($_POST["lname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lname)) {
            $lnameErr = "Only letters and white space allowed";
        }
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/", $password)) {
            $passwordErr = "Password must be at least 8 characters long, contain at least one uppercase letter, one digit, and one special character.";
        }
    }

    // Validate Confirm Password
    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required";
    } else {
        $cpassword = test_input($_POST["cpassword"]);
        if ($password !== $cpassword) {
            $cpasswordErr = "Passwords do not match.";
        }
    }

    // Validate Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Phone
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $phoneErr = "Invalid phone number format";
        }
    }

    // Validate Address
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = test_input($_POST["address"]);
    }

    // If there are no validation errors, insert the data into the database
    if (empty($fnameErr) && empty($lnameErr) && empty($passwordErr) && empty($cpasswordErr) && empty($genderErr) && empty($emailErr) && empty($phoneErr) && empty($addressErr)) {
        $sql = "INSERT INTO form (fname, lname, password, gender, email, phone, address) VALUES ('$fname', '$lname', '$password', '$gender', '$email', '$phone', '$address')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location:display.php');
        } else {
            echo "Not inserted";
        }
    }
}

// Function to sanitize and trim the input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login System</title>
    <style>
        .error {color: #FF0000;}
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="myform">
            <div class="title">Registration Form</div>
            <div class="form">
                <div class="input_field">
                    <label>First Name</label>
                    <input type="text" class="input" name="fname" value="<?php echo $fname; ?>">
                    <span class="error">* <?php echo $fnameErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Last Name</label>
                    <input type="text" class="input" name="lname" value="<?php echo $lname; ?>">
                    <span class="error">* <?php echo $lnameErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Password</label>
                    <input type="password" class="input" name="password" value="<?php echo $password; ?>">
                    <span class="error">* <?php echo $passwordErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Confirm Password</label>
                    <input type="password" class="input" name="cpassword" value="<?php echo $cpassword; ?>">
                    <span class="error">* <?php echo $cpasswordErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Gender</label>
                    <div class="custom_select">
                        <select name="gender">
                            <option value="">Select</option>
                            <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
                            <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
                        </select>
                    </div>
                    <span class="error">* <?php echo $genderErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Email Address</label>
                    <input type="text" class="input" name="email" value="<?php echo $email; ?>">
                    <span class="error">* <?php echo $emailErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Phone Number</label>
                    <input type="text" class="input" name="phone" value="<?php echo $phone; ?>">
                    <span class="error">* <?php echo $phoneErr; ?></span><br>
                </div>
                <div class="input_field">
                    <label>Address</label>
                    <textarea class="textarea" name="address"><?php echo $address; ?></textarea>
                    <span class="error">* <?php echo $addressErr; ?></span><br>
                </div>
                <div class="input_field">
                    <input type="submit" value="Register" class="btn" name="submit">
                </div>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>