<?php
session_start();
require '../database/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php");
    exit();
}

// Initialize variables
$uname = $_SESSION['user'] ?? "Guest";
$movie = $showtime = "";
$tickets = $total_amount = 0;
$bookingConfirmed = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie = htmlspecialchars($_POST['movie'] ?? "");
    $showtime = htmlspecialchars($_POST['showtime'] ?? "");
    $tickets = isset($_POST['tickets']) ? (int)$_POST['tickets'] : 0;
    $bookingDate = date("Y-m-d H:i:s");

    // Basic calculation for total price
    $price_per_ticket = 150;
    $total_amount = $tickets * $price_per_ticket;

    // Insert booking details into the database
    $query = "INSERT INTO bookinfo10m (uname, mname, mtime, mtickets, total_amount, booking_date) 
              VALUES ('$uname', '$movie', '$showtime', '$tickets', '$total_amount', '$bookingDate')";

    if (mysqli_query($conn, $query)) {
        $bookingConfirmed = true;
    } else {
        $errorMessage = "❌ Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="../css/confirm.css">
</head>
<body>
    <div class="confirmation-container">
        <h1>Booking Confirmation</h1>
        <?php if ($bookingConfirmed): ?>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($uname); ?></p>
            <p><strong>Movie:</strong> <?php echo htmlspecialchars($movie); ?></p>
            <p><strong>Showtime:</strong> <?php echo htmlspecialchars($showtime); ?></p>
            <p><strong>Number of Tickets:</strong> <?php echo $tickets; ?></p>
            <p><strong>Total Amount:</strong> ₹<?php echo $total_amount; ?></p>

            <p>Thank you for booking with <strong>Movify</strong>!</p>
            <a href="../user/index.php">Pay At Counter To Collect Your Tickets</a>
        <?php else: ?>
            <p style="color: red;"><?php echo $errorMessage ?: "Invalid request. Please go back and try again."; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
