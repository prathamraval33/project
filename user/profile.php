<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login/login.php");
    exit();
}

$name = $_SESSION['user'] ?? "Guest";
$email = $_SESSION['email'] ?? "Not Available";
$number = $_SESSION['number'] ?? "Not Available";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>

<div class="sidebar">
    <h2>Welcome</h2>
    <a href="../user/updateuser.php">Update Profile</a>
    <a href="../user/index.php">Homepage</a>
    <a href="../login/logout.php">Logout</a>
</div>

<div class="main-content">
    <h1>👤 User Profile</h1>
    <div class="profile-box">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Mobile Number:</strong> <?php echo htmlspecialchars($number); ?></p>
    </div>
</div>

</body>
</html>
