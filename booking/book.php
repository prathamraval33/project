<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require '../database/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to sign-in page
    header("Location: ../login/signin.php");
    exit();
}

// Get movie name from URL
$movie = isset($_GET['movie']) ? htmlspecialchars($_GET['movie']) : "Unknown Movie";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Movie Tickets</title>
    <link rel="stylesheet" href="../css/booking.css">
    <script>
        function updatePrice() {
            var seatType = document.getElementById("seatType").value;
            var tickets = document.getElementById("tickets").value;
            var price = 0;

            if (seatType === "Gold") price = 200;
            else if (seatType === "Silver") price = 150;
            else if (seatType === "Platinum") price = 300;

            var totalPrice = price * tickets;
            document.getElementById("totalPrice").innerText = "Total Price: ₹" + totalPrice;
        }
    </script>
</head>
<body>
    <div class="booking-container">
        <h1>Book Your Tickets</h1>
        <form action="../booking/confirm.php" method="POST">
            
            <label for="movie">Movie Name:</label>
            <input type="text" id="movie" name="movie" value="<?php echo $movie; ?>" readonly>

            <label for="showtime">Showtime:</label>
            <select id="showtime" name="showtime" required>
                <option value="10:00 AM">10:00 AM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="7:00 PM">7:00 PM</option>
            </select>

            <label for="seatType">Seat Type:</label>
            <select id="seatType" name="seatType" onchange="updatePrice()" required>
                <option value="Gold">Gold (₹200)</option>
                <option value="Silver">Silver (₹150)</option>
                <option value="Platinum">Platinum (₹300)</option>
            </select>

            <label for="tickets">Number of Tickets:</label>
            <input type="number" id="tickets" name="tickets" min="1" max="10" value="1" onchange="updatePrice()" required>

            <p id="totalPrice">Total Price: ₹200</p>

            <button type="submit">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
