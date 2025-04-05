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
    <style>
        .book-now-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .book-now-button:hover {
            background-color: #e65c00;
        }
    </style>
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
            $movieTitle = urlencode($row['title']);
            echo '
            <div class="movie-card">
                <img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">
                <h3>' . $row['title'] . '</h3>
                <a href="/project/booking/book.php?movie=' . $movieTitle . '" class="book-now-button">Book Now</a>
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
