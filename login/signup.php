<?php
session_start();
require '../database/_dbconnect.php';

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = trim($_POST['name']);
    $uemail = trim($_POST['email']);
    $unumber = trim($_POST['number']);
    $upass = $_POST['psw'];
    $cpassword = $_POST['cpsw'];

    // Validation
    if (empty($uname) || empty($uemail) || empty($unumber) || empty($upass) || empty($cpassword)) {
        $error_message = "All fields are required!";
    } elseif (!preg_match('/^[0-9]{10}$/', $unumber)) {
        $error_message = "Please enter a valid 10-digit mobile number!";
    } elseif (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } elseif (strlen($upass) < 6) {
        $error_message = "Password must be at least 6 characters!";
    } elseif ($upass !== $cpassword) {
        $error_message = "Passwords do not match!";
    } else {
        // Check if email or mobile number already exists
        $checkQuery = "SELECT * FROM userinfo10m WHERE u_email = ? OR u_number = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $uemail, $unumber);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error_message = "User already exists with this email or mobile number!";
            } else {
                // Generate OTP
                $otp = rand(100000, 999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['uname'] = $uname;
                $_SESSION['uemail'] = $uemail;
                $_SESSION['unumber'] = $unumber;
                $_SESSION['upass'] = password_hash($upass, PASSWORD_DEFAULT);

                // Redirect to send.php for sending OTP
                header("Location: send.php");
                exit();
            }

            mysqli_stmt_close($stmt); // ✅ safely close if prepared
        } else {
            $error_message = "Something went wrong. Please try again later.";
        }
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
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>

<form method="post">
    <h2>Sign Up</h2>

    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <input type="text" name="name" placeholder="Enter Your Name" required>
    <input type="text" name="number" placeholder="Enter Your Mobile Number" required>
    <input type="text" name="email" placeholder="Enter Your Email" required>
    <input type="password" name="psw" placeholder="Enter Your Password" required>
    <input type="password" name="cpsw" placeholder="Re-Enter Your Password" required>
    <button type="submit">Submit</button>
</form>

</body>
</html>
