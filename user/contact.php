<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require '../database/_dbconnect.php';

    // Check if form fields exist before accessing them
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $mess = isset($_POST['mess']) ? trim($_POST['mess']) : "";

    if (!empty($name) && !empty($email) && !empty($mess)) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $mess = mysqli_real_escape_string($conn, $mess);

        $sql = "INSERT INTO feedback_10 (name, email, message) VALUES ('$name', '$email', '$mess')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('We will look forward to your message!');</script>";
        } else {
            echo "<script>alert('Oops! Something went wrong. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
    mysqli_close($conn);
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
    <title>Movify</title>
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p>Have any questions? Fill out the form below.</p>
        <form class="contact-form" method="post">
            <input type="text" placeholder="Your Name" required name="name">
            <input type="email" placeholder="Your Email" required name="email">
            <textarea placeholder="Your Message" rows="4" required maxlength="200" name="mess"></textarea>
            <button type="submit" name="submit">Send Message</button>
        </form>
        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>

<?php include '../header&footer/Footer.php'; ?>
