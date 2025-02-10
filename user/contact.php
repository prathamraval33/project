<?php
if(isset($_POST['submit']))
{
   require '../database/_dbconnect.php';

   $_name=$_POST['name'];
   $_email=$_POST['email'];
}
?>
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
        <form class="contact-form" method="post">
            <input type="text" placeholder="Your Name" required name='name'>
            <input type="email" placeholder="Your Email" required name='email'>
            <textarea placeholder="Your Message" rows="4" required maxlength="200"></textarea>
            <button type="submit" name="submit">Send Message</button>
        </form>
        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html><?php
include '../header&footer/Footer.php';
?>