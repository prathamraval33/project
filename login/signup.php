<?php
$error_message = "";
$success_message = "";

if (isset($_POST['submit'])) {
    require '../database/_dbconnect.php';

    $uname = trim($_POST['name']);
    $uemail = trim($_POST['email']);
    $unumber = trim($_POST['number']);
    $upass = $_POST['psw'];
    $cpassword = $_POST['cpsw'];

    if (empty($uname) || empty($uemail) || empty($unumber) || empty($upass) || empty($cpassword)) {
        $error_message = "Please fill all details!";
    } elseif (!preg_match('/^[0-9]{10}$/', $unumber)) {
        $error_message = "Please enter a valid 10-digit mobile number!";
    } elseif ($upass !== $cpassword) {
        $error_message = "Passwords do not match!";
    } else {
        $checkQuery = "SELECT * FROM `userinfo10m` WHERE `u_email` = ? OR `u_number` = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "ss", $uemail, $unumber);
        mysqli_stmt_execute($stmt);
        $checkResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($checkResult) > 0) {
            $error_message = "User already exists !!!!";
        } else {
            $hash1 = password_hash($upass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `userinfo10m` (`u_name`, `u_number`, `u_email`, `u_password`) 
                    VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $uname, $unumber, $uemail, $hash1);

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "Sign-Up successful! Redirecting...";
                header("refresh:2;url=signin.php");
            } else {
                $error_message = "There was an error with the database submission!";
            }
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
    <title>Sign Up</title>
    <style>
        .message {
            padding: 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }
        .error-message {
            background-color: red;
        }
        .success-message {
            background-color: green;
        }
    </style>
</head>
<body>

<?php if (!empty($error_message)): ?>
    <div class="message error-message"><?php echo $error_message; ?></div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div class="message success-message"><?php echo $success_message; ?></div>
<?php endif; ?>

</body>
</html>



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
