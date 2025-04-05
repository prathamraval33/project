<?php
require '../database/_dbconnect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$name = $_SESSION['user'] ?? "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movify</title>
    <link rel="stylesheet" href="../css/homepage.css">
   
</head>
<body>

<!-- Now Showing Section -->
<section class="movie-display">
<a href="../user/index.php" class="home-button">← Home</a>

    <h2>Now Showing</h2>
    <div class="movie-container" id="movie">
        <?php
        $sql = "SELECT * FROM movies WHERE status = 'now_showing'";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <div class="movie-card">
                <img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">
                <h3>' . $row['title'] . '</h3>
                <button onclick="window.location.href=\'booking.php?movie=' . urlencode($row['title']) . '\'">Book Now</button>
            </div>';
        }
        ?>
    </div>
</section>

<!-- Upcoming Movies Section -->
<section class="movie-display">
    <a href="../user/index.php" class="home-button">← Home</a>
    <h2>Upcoming Movies</h2>
    <div class="movie-container" id="upcoming-movie">
        <?php
        $sql_upcoming = "SELECT * FROM movies WHERE status = 'upcoming'";
        $result_upcoming = mysqli_query($conn, $sql_upcoming);

        while ($row = mysqli_fetch_assoc($result_upcoming)) {
            echo '
            <div class="movie-card">
                <img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">
                <h3>' . $row['title'] . '</h3>
                <button disabled>Coming Soon</button>
            </div>';
        }
        ?>
    </div>
</section>

</body>
</html>
