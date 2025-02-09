
<?php
// Start session only if it's not already active
if (!isset($_SESSION)) {
    session_start();
}

$name = $_SESSION['user'] ?? "Guest";
$email = $_SESSION['email'] ?? "Email@1.com";
$mob = $_SESSION['number'] ?? "134567890";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    <link rel="stylesheet" href="../css/profile.css">
   
</head>
<body>
<div class="sidebar">
        <ul>
            <li data-title="Profile">&#9733;</li>
            <li data-title="Bookings">&#128722;</li>
            <li data-title="Settings">&#9881;</li>
        </ul>
    </div>
    <div class="content">
        <div class="profile-card">
            <div class="banner">Welcome to Movify</div>
            <img src="https://cdn-icons-png.flaticon.com/512/12828/12828286.png" alt="Profile Image" class="profile-img">
            <div class="info-container">
                <h2>Profile</h2>
                <div class="info"><strong>Username:</strong>  <p> <?php echo htmlspecialchars($name); ?> </p></div>
                <div class="info"><strong>Mobile:</strong>  <p> <?php echo htmlspecialchars($mob); ?> </p></div>
                <div class="info"><strong>Email:</strong>  <p> <?php echo htmlspecialchars($email); ?> </p></div>
                <a href="../user/index.php"><button class="save-btn">Home</button></a>
            </div>
        </div>
    </div>
</body>
</html>
