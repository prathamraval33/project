<?php
session_start();
require '../database/_dbconnect.php';

// Fetch Total Users (excluding admin and superadmin)
$query_users = "SELECT COUNT(*) AS total_users FROM userinfo10m";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);
$total_users = $row_users['total_users'];

// Fetch Total Bookings
$query_bookings = "SELECT COUNT(*) AS total_bookings FROM bookinfo10m";
$result_bookings = mysqli_query($conn, $query_bookings);
$row_bookings = mysqli_fetch_assoc($result_bookings);
$total_bookings = $row_bookings['total_bookings'];

// Fetch Total Movies (Now Showing)
$query_movies_now = "SELECT COUNT(*) AS total_now_showing FROM movies WHERE status = 'now_showing'";
$result_movies_now = mysqli_query($conn, $query_movies_now);
$row_movies_now = mysqli_fetch_assoc($result_movies_now);
$total_now_showing = $row_movies_now['total_now_showing'];

// Fetch Total Movies (Upcoming)
$query_movies_upcoming = "SELECT COUNT(*) AS total_upcoming FROM movies WHERE status = 'upcoming'";
$result_movies_upcoming = mysqli_query($conn, $query_movies_upcoming);
$row_movies_upcoming = mysqli_fetch_assoc($result_movies_upcoming);
$total_upcoming = $row_movies_upcoming['total_upcoming'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php
    include 'adminhome.php';
?>
    <div class="main-content">
        <h1>Welcome to the Dashboard</h1>
        <div class="card-container">
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
            <div class="card">
                <h3>Total Bookings</h3>
                <p><?php echo $total_bookings; ?></p>
            </div>
            <div class="card">
                <h3>Now Showing</h3>
                <p><?php echo $total_now_showing; ?></p>
            </div>
            <div class="card">
                <h3>Upcoming Movies</h3>
                <p><?php echo $total_upcoming; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
