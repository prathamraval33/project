<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="../css/booking.css">
</head>
<body>
    <div class="booking-container">
        <h1>Book Your Tickets</h1>
        <form action="../Booking/confirm.php" method="POST">
            <label for="movie">Movie Name:</label>
            <input type="text" id="movie" name="movie" value="<?php echo $_GET['movie']; ?>" readonly>

            <label for="showtime">Showtime:</label>
            <select id="showtime" name="showtime" required>
                <option value="10:00 AM">10:00 AM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="7:00 PM">7:00 PM</option>
            </select>

            <label for="tickets">Number of Tickets:</label>
            <input type="number" id="tickets" name="tickets" min="1" max="10" required>

            <button type="submit">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
