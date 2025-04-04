<?php
session_start();
require '../database/_dbconnect.php';

// Optional: Restrict access to admin/superadmin only
if (!isset($_SESSION['admin_user'])) {
    header("Location: ../admin_login.php");
    exit();
}

// DELETE booking
if (isset($_GET['bookid'])) {
    $bookid = intval($_GET['bookid']);
    $delete_query = "DELETE FROM bookinfo10m WHERE bookid='$bookid'";
    mysqli_query($conn, $delete_query);
    header("Location: manbook.php");
    exit();
}

// UPDATE booking
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $bookid = intval($_POST['bookid']);
    $movie = htmlspecialchars($_POST['movie']);
    $showtime = htmlspecialchars($_POST['showtime']);
    $seatType = htmlspecialchars($_POST['seatType']);
    $tickets = (int)$_POST['tickets'];

    $price_per_ticket = ($seatType == "gold") ? 200 : (($seatType == "silver") ? 150 : 300);
    $total_amount = $tickets * $price_per_ticket;

    $update_query = "UPDATE bookinfo10m SET 
                        mname='$movie', 
                        mtime='$showtime', 
                        seat_type='$seatType', 
                        mtickets='$tickets', 
                        total_amount='$total_amount' 
                    WHERE bookid='$bookid'";
    mysqli_query($conn, $update_query);
    header("Location: manbook.php");
    exit();
}

// Fetch all bookings
$query = "SELECT * FROM bookinfo10m ORDER BY booking_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../css/manbook.css">
</head>
<body>

<?php include 'adminhome.php'; ?>

<h1>Manage Bookings</h1>
<div class="container">
    <table>
        <tr>
            <th>Booking ID</th>
            <th>Username</th>
            <th>Movie</th>
            <th>Showtime</th>
            <th>Seat Type</th>
            <th>Tickets</th>
            <th>Total Amount</th>
            <th>Booking Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <form method="POST">
                <td><?php echo $row['bookid']; ?></td>
                <td><?php echo $row['uname']; ?></td>
                <td><input type="text" name="movie" value="<?php echo $row['mname']; ?>"></td>
                <td>
                    <select name="showtime">
                        <option value="10:00 AM" <?php if ($row['mtime'] == '10:00 AM') echo 'selected'; ?>>10:00 AM</option>
                        <option value="1:00 PM" <?php if ($row['mtime'] == '1:00 PM') echo 'selected'; ?>>1:00 PM</option>
                        <option value="4:00 PM" <?php if ($row['mtime'] == '4:00 PM') echo 'selected'; ?>>4:00 PM</option>
                        <option value="7:00 PM" <?php if ($row['mtime'] == '7:00 PM') echo 'selected'; ?>>7:00 PM</option>
                    </select>
                </td>
                <td>
                    <select name="seatType">
                        <option value="gold" <?php if ($row['seat_type'] == 'gold') echo 'selected'; ?>>Gold</option>
                        <option value="silver" <?php if ($row['seat_type'] == 'silver') echo 'selected'; ?>>Silver</option>
                        <option value="platinum" <?php if ($row['seat_type'] == 'platinum') echo 'selected'; ?>>Platinum</option>
                    </select>
                </td>
                <td><input type="number" name="tickets" value="<?php echo $row['mtickets']; ?>" min="1" max="10"></td>
                <td>₹<?php echo $row['total_amount']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
                <td>
                    <input type="hidden" name="bookid" value="<?php echo $row['bookid']; ?>">
                    <button type="submit" name="update" class="btn edit">Update</button>
                    <a href="manbook.php?bookid=<?php echo $row['bookid']; ?>" class="btn delete" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </form>
        </tr>
        <?php } ?>
    </table>
    <a href="../admin/adminhome.php" class="btn back">Back to Admin Panel</a>
</div>

</body>
</html>
