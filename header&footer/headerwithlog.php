<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$name = $_SESSION['user'] ?? "Guest"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movify</title>
    <link rel="stylesheet" href="../css/header.css">
</head>
<body>
<nav class="navbar">
    <div class="logo">
        <a href="#"><img src="../img/logo.png" class="logoimg" alt="Logo"></a>
    </div>

    <div class="menu">
        <a href="../user/index.php">Home</a>
        <a href="../user/about.php">About Us</a>
        <a href="../user/contact.php">Contact Us</a>
        
        <div class="dropdown">
            <a href="#">Movies</a>
            <div class="dropdown-content">
                <a href="#">Now Showing</a>
                <a href="#">Upcoming</a>
            </div>
        </div>
        <a href="#">Categories</a>
    </div>

    <div class="search-bar">
        <input type="text" placeholder="Search movies, Categories or theaters">
        <button>Search</button>
    </div>

    <!-- User Section -->
    <div class="sign">
        <div class="signcontent">
            <div class="dropdown">
                <img src="https://cdn-icons-png.flaticon.com/512/12828/12828286.png" alt="Profile" class="profile">
                
                <!-- Display username from session -->
                <p> <?php echo htmlspecialchars($name); ?> </p>

                <div class="dropdown-content">
                    <a href="../login/signup.php" id="signup">Profile</a>
                    <a href="../login/logout.php" id="signin">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
</body>
</html>
