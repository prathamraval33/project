<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../mailer/Exception.php';
require '../mailer/PHPMailer.php';
require '../mailer/SMTP.php';
require '../database/_dbconnect.php'; // Ensure correct database connection

// Function to send OTP
function sendOTP() {
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                       
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'journeymate261@gmail.com';            
        $mail->Password   = 'urixpciosipgtiax'; // Use App Password        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
        $mail->Port       = 465;                                   

        $mail->setFrom('journeymate261@gmail.com', 'Journey Mate');
        $mail->addAddress($_SESSION['uemail'], $_SESSION['uname']);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP';
        $mail->Body = '<p>Your OTP is: <strong>' . $_SESSION['otp'] . '</strong></p>';

        if ($mail->send()) {
            echo '✅ OTP sent successfully!';
        } else {
            echo '❌ OTP could not be sent.';
        }
    } catch (Exception $e) {
        echo "❌ Mailer Error: {$mail->ErrorInfo}";
    }
}

// Resend OTP if clicked
if (isset($_POST['resend'])) {
    sendOTP();
}

// Verify OTP if submitted
if (isset($_POST['submit'])) {
    if (!isset($_SESSION['otp'])) {
        echo "❌ OTP not generated yet. Please request again!";
    } elseif ($_SESSION['otp'] == $_POST['otp']) {
        // ✅ OTP Matched - Now insert user data into the database
        $uname  = $_SESSION['uname'];
        $uemail = $_SESSION['uemail'];
        $unumber = $_SESSION['unumber'];
        $upass = $_SESSION['upass']; // Already hashed during signup

        // Insert data into the database
        $sql = "INSERT INTO userinfo10m (u_name, u_number, u_email, u_password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $uname, $unumber, $uemail, $upass);

        if (mysqli_stmt_execute($stmt)) {
            echo "✅ Registration Successful!";
            unset($_SESSION['otp']); // Clear OTP after verification
            session_destroy(); // Destroy session after successful registration

            // Redirect to login page
            header("Location: signin.php");
            exit();
        } else {
            echo "❌ Database error!";
        }
    } else {
        echo "❌ OTP Not Matched. Try Again!";
    }
}

// Send OTP on first load (Only when user arrives at OTP page)
if (!isset($_POST['submit']) && !isset($_POST['resend'])) {
    sendOTP();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="../css/form3.css">

</head>
<body>
    <form action="" method="post">
        <input type="text" name="otp" placeholder="Enter OTP">
        <input type="submit" name="submit" value="Verify OTP">
        <input type="submit" name="resend" value="Resend OTP">
    </form>
</body>
</html>
