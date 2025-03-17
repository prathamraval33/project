<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movie = htmlspecialchars($_POST['movie']);
    $showtime = htmlspecialchars($_POST['showtime']);
    $tickets = (int)$_POST['tickets'];

    // Basic calculation for total price (example: $150 per ticket)
    $price_per_ticket = 150;
    $total_amount = $tickets * $price_per_ticket;
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
        <p><strong>Movie:</strong> <?php echo $movie; ?></p>
        <p><strong>Showtime:</strong> <?php echo $showtime; ?></p>
        <p><strong>Number of Tickets:</strong> <?php echo $tickets; ?></p>
        <p><strong>Total Amount:</strong> ₹<?php echo $total_amount; ?></p>

        <p>Thank you for booking with <strong>Movify</strong>! Proceed to payment below.</p>
        <a href="../payment/payment.php?amount=<?php echo $total_amount; ?>">Proceed to Payment</a>
    </div>
</body>
</html>

<?php
} else {
    echo "<p>Invalid request. Please go back and try again.</p>";
}
?>