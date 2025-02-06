<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../database/_dbconnect.php';  // Ensure the correct path for database connection

    $uemail = trim($_POST['email']);
    $upass = trim($_POST['psw']); // Trim spaces to avoid mismatch issues
    
    // Check if any field is empty
    if (empty($uemail) || empty($upass)) {
        echo '<script>alert("Please fill all details!");</script>';
    } else {
        // Check if user exists in the database
        $sql = "SELECT u_name, u_password FROM `userinfo10m` WHERE `u_email` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $uemail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $stored_hashed_password = $row['u_password'];
            
            // Debugging: Log retrieved hash and input password
            error_log("Stored Hash: " . $stored_hashed_password);
            error_log("Entered Password: " . $upass);
            
            // Verify password
            if (password_verify($upass, $stored_hashed_password)) {
                $_SESSION['user'] = $row['u_name']; // Store user session
                header("Location: ../user/index.php"); // Redirect to dashboard
                exit();
            } else {
                error_log("Password verification failed.");
                echo '<script>alert("Incorrect password! Please try again.");</script>';
            }
        } else {
            error_log("User does not exist.");
            echo '<script>alert("User does not exist! Please sign up.");</script>';
        }
        
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="sign.css">
    <style>
button {
    display: block;
    margin-left: 7vw;
    margin-top: 4.1vh;
    width: 7vw;
    background-color: rgba(0, 0, 0, 0.463);
    box-shadow: inset -3px -3px rgba(0, 0, 0, 0.463);
    color: #ff6f61;
    border: none;
    outline: none;
    border-radius: 10%;
}
    </style>
    
</head>
<body>
    
 <form class="form"  method="post" > 

    <h2>Sign In<h2>
              
                    <input type="email" name="email" placeholder="Enter Your Email" class="box" required>
                   <input type="password" name="psw" placeholder="Enter Your Password" class="box"> 
                   
                   <button type="submit" id="submit" placeholder="Sign Up" name="submit">submit</button>
            <p>Don't have account?<p><a href="signup.php" style="color: #ff6f61; display: inline;"> Sign up</a> 
            </form>
   
</body>

</html>