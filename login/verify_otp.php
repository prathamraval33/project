<?php
session_start();
require '../database/_dbconnect.php';

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = trim($_POST['otp']);

    if (empty($entered_otp)) {
        $error_message = "Please enter the OTP!";
    } elseif ($entered_otp == $_SESSION['otp']) {
        // OTP is correct, insert user into database
        $uname = $_SESSION['uname'];
        $uemail = $_SESSION['uemail'];
        $unumber = $_SESSION['unumber'];
        $upass = $_SESSION['upass'];

        $sql = "INSERT INTO userinfo10m (u_name, u_number, u_email, u_password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $uname, $unumber, $uemail, $upass);

        if (mysqli_stmt_execute($stmt)) {
            $success_message = "Registration successful! Redirecting...";
            session_unset();
            session_destroy();
            header("refresh:2;url=signin.php");
            exit();
        } else {
            $error_message = "Database error! Please try again.";
        }
    } else {
        $error_message = "Invalid OTP! Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>

<?php if (!empty($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <p style="color: green;"><?php echo $success_message; ?></p>
<?php endif; ?>

<form method="post">
    <h2>Enter OTP</h2>
    <input type="text" name="otp" placeholder="Enter OTP" required>
    <button type="submit">Verify OTP</button>
</form>

</body>
</html>
