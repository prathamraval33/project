<?php
if (isset($_POST['submit'])) {
    require '../database/_dbconnect.php';  // Ensure the correct path for database connection
    
    $uname = $_POST['name'];
    $unumber = $_POST['number'];
    $uemail = $_POST['email'];
    $upass = $_POST['psw'];

    // Insert into database
    $sql = "INSERT INTO `userinfo10m` (`u_name`, `u_number`, `u_email`, `u_password`) 
            VALUES ('$uname', '$unumber', '$uemail', '$upass')";
    
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="sign.css">
    <script>
        function validateForm(event) {
    var name = document.getElementsByName("name")[0].value.trim();
    var email = document.getElementsByName("email")[0].value.trim();
    var mobile = document.getElementsByName("number")[0].value.trim();
    var password = document.getElementsByName("psw")[0].value;
    var cpassword = document.getElementsByName("cpsw")[0].value;

    // Check if any field is empty
    if (name === "" || email === "" || mobile === "" || password === "" || cpassword === "") {
        alert("Please fill all details!");
        event.preventDefault(); // Stop form submission
        return false;
    }

    // Validate mobile number
    if (mobile.length !== 10 || isNaN(mobile)) {
        alert("Please enter a valid 10-digit mobile number!");
        event.preventDefault();
        return false;
    }

    // Validate password match
    if (password !== cpassword) {
        alert("Passwords do not match!");
        event.preventDefault();
        return false;
    }

    // If everything is fine, show alert and proceed to submit the form
    alert("Sign-Up successful!!!");
    return true; // Form will be submitted and redirected
}

    </script>
</head>
<body>
    <form class="form" action="signup.php" onsubmit="return validateForm(event)" method="post">
        <h2>Sign Up</h2>
        <input type="text" name="name" placeholder="Enter Your Name" class="box">
        <input type="number" name="number" placeholder="Enter Your Mobile Number" class="box" minlength="10" maxlength="10" required>
        <input type="email" name="email" placeholder="Enter Your Email" class="box" required>
        <input type="password" name="psw" placeholder="Enter Your Password" class="box" required>
        <input type="password" name="cpsw" placeholder="Re-Enter Your Password" class="box" required>
        <button type="submit" name="submit">Submit</button>
        <p>Already have an account? <a href="signin.php" style="color: #ff6f61;">Sign In</a></p>
    </form>
</body>
</html>
