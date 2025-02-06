<?php
if (isset($_POST['submit'])) {
    require '../database/_dbconnect.php';  // Ensure the correct path for database connection
    
    // Collect and sanitize input data
    $uname = trim($_POST['name']);
    $uemail = trim($_POST['email']);
    $unumber = trim($_POST['number']);
    $upass = $_POST['psw'];
    $cpassword = $_POST['cpsw'];
    $errors = [];

    // Check if any field is empty
    if (empty($uname) || empty($uemail) || empty($unumber) || empty($upass) || empty($cpassword)) {
        $errors[] = "Please fill all details!";
    }

    // Validate mobile number
    if (!preg_match('/^[0-9]{10}$/', $unumber)) {
        $errors[] = "Please enter a valid 10-digit mobile number!";
    }

    // Validate password match
    if ($upass !== $cpassword) {
        $errors[] = "Passwords do not match!";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // Proceed with database insertion if no errors
        $hash1 = password_hash($upass, PASSWORD_DEFAULT);

        // Insert into database
        $sql = "INSERT INTO `userinfo10m` (`u_name`, `u_number`, `u_email`, `u_password`) 
                VALUES ('$uname', '$unumber', '$uemail', '$hash1')";

        $result = mysqli_query($conn, $sql);

        // Check if insertion was successful
        if ($result) {
            echo '<script>alert("Sign-Up successful!!!");</script>';
            // Redirect after success
            header("Location: signin.php");
            exit();  // Always exit after a redirect to prevent further code execution
        } else {
            echo '<script>alert("There was an error with the database submission!");</script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="sign.css">
    
</head>
<body>
    <form class="form" action="signup.php" onsubmit="return validateForm(event)" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="name" placeholder="Enter Your Name" class="box">
        <input type="text" name="number" placeholder="Enter Your Mobile Number" class="box" minlength="10" maxlength="10" required>
        <input type="email" name="email" placeholder="Enter Your Email" class="box" required>
        <input type="password" name="psw" placeholder="Enter Your Password" class="box" required>
        <input type="password" name="cpsw" placeholder="Re-Enter Your Password" class="box" required>
        <button type="submit" name="submit">Submit</button>
        <p>Already have an account? <a href="signin.php" style="color: #ff6f61;">Sign In</a></p>
    </form>
</body>
</html>
