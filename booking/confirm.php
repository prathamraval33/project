<?php
session_start();
require '../database/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php");
    exit();
}

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_SESSION['user'];
    $movie = htmlspecialchars($_POST['movie']);
    $showtime = htmlspecialchars($_POST['showtime']);
    $seatType = htmlspecialchars($_POST['seatType']);
    $tickets = (int)$_POST['tickets'];
    $bookingDate = date("Y-m-d H:i:s"); // Keep booking date

    // Price Calculation
    $price_per_ticket = ($seatType == "Gold") ? 200 : (($seatType == "Silver") ? 150 : 300);
    $total_amount = $tickets * $price_per_ticket;

    // Insert into Database
    $query = "INSERT INTO bookinfo10m (uname, mname, mtime, seat_type, mtickets, total_amount, booking_date) 
              VALUES ('$uname', '$movie', '$showtime', '$seatType', '$tickets', '$total_amount', '$bookingDate')";

    if (mysqli_query($conn, $query)) {
        $message = " Booking Confirmed!";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
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

        <p><?php echo $message; ?></p>

        <p><strong>Username:</strong> <?php echo htmlspecialchars($uname); ?></p>
        <p><strong>Movie:</strong> <?php echo htmlspecialchars($movie); ?></p>
        <p><strong>Showtime:</strong> <?php echo htmlspecialchars($showtime); ?></p>
        <p><strong>Seat Type:</strong> <?php echo htmlspecialchars($seatType); ?></p>
        <p><strong>Number of Tickets:</strong> <?php echo $tickets; ?></p>
        <p><strong>Total Amount:</strong> ₹<?php echo $total_amount; ?></p>

        <p>Thank you for booking with <strong>Movify</strong>!</p>
        <a href="../user/index.php">Pay At Counter To Collect Your Tickets</a>
    </div>
</body>
</html>
