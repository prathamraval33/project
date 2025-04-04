<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../database/_dbconnect.php';

// Check if logged-in user is a Superadmin
if (!isset($_SESSION['admin_user']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: ../admin_login.php");
    exit();
}

// Fetch all Admins from database
$query = "SELECT aid, aemail, astatus FROM admininfo10m WHERE astatus = 'admin'";
$result = mysqli_query($conn, $query);

// Handle Admin Creation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_admin_email = mysqli_real_escape_string($conn, $_POST['new_admin_email']);
    $new_admin_pass = mysqli_real_escape_string($conn, $_POST['new_admin_pass']);

    // Check if email already exists
    $check_query = "SELECT * FROM admininfo10m WHERE aemail = '$new_admin_email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "❌ This email is already registered as an admin.";
    } else {
        $insert_query = "INSERT INTO admininfo10m (aemail, apass, astatus) VALUES ('$new_admin_email', '$new_admin_pass', 'admin')";
        if (mysqli_query($conn, $insert_query)) {
            $message = "✅ New Admin Added Successfully!";
        } else {
            $message = "❌ Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Dashboard</title>
    <link rel="stylesheet" href="../css/sahome.css">
</head>
<body>
<div class="sidebar">
        <h2>Super-Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php"> Dashboard</a></li>
            <li><a href="manbook.php">Manage Admins</a></li>
            <li><a href="manbook.php">Manage Bookings</a></li>
            <li><a href="upload_image.php">Add Movies</a></li>
            <li><a href="delete_movie.php">Delete Movies</a></li>
            
            <li><a href="../logout.php" class="logout"> Logout</a></li>
        </ul>
</div>
</body>
</html>
