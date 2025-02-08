<?php
session_start();
if (!isset($_SESSION['loginn']) || $_SESSION['loginn'] !== true) {
    include '../header&footer/header.php';
} else {
    include '../header&footer/headerwithlog.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Movify</title>
    <link rel="stylesheet" href="../css/contact.css">
    
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p>Have any questions? Fill out the form below.</p>
        <form class="contact-form">
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Your Email" required>
            <textarea placeholder="Your Message" rows="4" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html><?php
include '../header&footer/Footer.php';
?>