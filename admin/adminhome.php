<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../database/_dbconnect.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_user']) || !isset($_SESSION['role'])) {
    header("Location: ../admin/adminlogin.php");
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($role); ?> Dashboard</title>
    <link rel="stylesheet" href="../css/ahome.css">
</head>
<body>

<div class="sidebar">
    <h2><?= $role === 'superadmin' ? 'Super-Admin Panel' : 'Admin Panel'; ?></h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>

        <?php if ($role === 'superadmin'): ?>
            <li><a href="addadmin.php">Add Admins</a></li>
            <li><a href="deleteadmin.php">Delete Admins</a></li>
        <?php endif; ?>

        <li><a href="upload_image.php">Add Movies</a></li>
        <li><a href="delete_movie.php">Delete Movies</a></li>
        <li><a href="manbook.php">Manage Bookings</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="../admin/a_logout.php" class="logout">Logout</a></li>
    </ul>
</div>

</body>
</html>
