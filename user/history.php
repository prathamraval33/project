<?php
session_start();
require '../database/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php");
    exit();
}

$uname = $_SESSION['user'];

// Fetch booking history
$query = "SELECT mname, mtime, seat_type, mtickets, total_amount, booking_date FROM bookinfo10m WHERE uname='$uname' ORDER BY booking_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="../css/history.css">
</head>
<body>
    <div class="history-container">
        <h1>Your Booking History</h1>

        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Movie</th>
                        <th>Showtime</th>
                        <th>Seat Type</th>
                        <th>Tickets</th>
                        <th>Total Amount</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['mname']); ?></td>
                            <td><?php echo htmlspecialchars($row['mtime']); ?></td>
                            <td><?php echo htmlspecialchars($row['seat_type']); ?></td>
                            <td><?php echo $row['mtickets']; ?></td>
                            <td>₹<?php echo $row['total_amount']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No past bookings found.</p>
        <?php endif; ?>

        <a href="../user/index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
