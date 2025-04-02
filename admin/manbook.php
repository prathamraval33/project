<?php
session_start();
require '../database/_dbconnect.php';

// Check if user is admin


// Handle DELETE request
if (isset($_GET['bookid'])) {
    $bookid = intval($_GET['bookid']); // Ensure it's an integer

    $delete_query = "DELETE FROM bookinfo10m WHERE bookid='$bookid'";
    mysqli_query($conn, $delete_query);
    header("Location: manbook.php"); // Refresh page
    exit();
}

// Handle UPDATE request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $bookid = intval($_POST['bookid']); // Ensure it's an integer
    $movie = htmlspecialchars($_POST['movie']);
    $showtime = htmlspecialchars($_POST['showtime']);
    $seatType = htmlspecialchars($_POST['seatType']);
    $tickets = (int)$_POST['tickets'];
    $price_per_ticket = ($seatType == "Gold") ? 200 : (($seatType == "Silver") ? 150 : 300);
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #001f3f;
            color: white;
            text-align: center;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            color: #001f3f;
            padding: 20px;
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background: #ff6f61;
            color: white;
        }
        form {
            display: inline;
        }
        .btn {
            padding: 6px 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
            margin: 2px;
        }
        .edit {
            background: #ffa502;
            color: white;
        }
        .delete {
            background: #ff4757;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

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
                        <option value="Gold" <?php if ($row['seat_type'] == 'Gold') echo 'selected'; ?>>Gold</option>
                        <option value="Silver" <?php if ($row['seat_type'] == 'Silver') echo 'selected'; ?>>Silver</option>
                        <option value="Platinum" <?php if ($row['seat_type'] == 'Platinum') echo 'selected'; ?>>Platinum</option>
                    </select>
                </td>
                <td><input type="number" name="tickets" value="<?php echo $row['mtickets']; ?>" min="1" max="10"></td>
                <td>₹<?php echo $row['total_amount']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
                <td>
                    <input type="hidden" name="bookid" value="<?php echo $row['bookid']; ?>">
                    <button type="submit" name="update" class="btn edit">Update</button>
                    <a href="manbook.php?bookid=<?php echo $row['bookid']; ?>" class="btn delete">Delete</a>
                </td>
            </form>
        </tr>
        <?php } ?>
    </table>
    <a href="../admin/adminhome.php" class="btn" style="background: #003366; color: white;">Back to Admin Panel</a>
</div>

</body>
</html>
