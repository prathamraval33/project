<?php
session_start();
require '../database/_dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../signin.php");
    exit();
}

$uname = $_SESSION['user']; // Get logged-in user's name

// Fetch booking history for the logged-in user
$query = "SELECT mname, mtime, mtickets, total_amount, booking_date FROM bookinfo10m WHERE uname = '$uname' ORDER BY booking_date DESC";
$result = mysqli_query($conn, $query);

mysqli_close($conn);
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
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Movie Name</th>
                        <th>Showtime</th>
                        <th>Tickets</th>
                        <th>Total Amount</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['mname']); ?></td>
                            <td><?php echo htmlspecialchars($row['mtime']); ?></td>
                            <td><?php echo $row['mtickets']; ?></td>
                            <td>₹<?php echo $row['total_amount']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No previous bookings found.</p>
        <?php endif; ?>

        <!-- Back to Home Button -->
        <div class="back-button">
            <a href="../user/index.php">⬅️ Back to Home</a>
        </div>
    </div>
</body>
</html>
