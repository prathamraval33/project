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
    <link rel="stylesheet" href="homepage.css">
</head>

<body>

<section class="movie-display">
    <h2>Movies</h2>
    <div class="movie-container">
        <div class="movie-card">
            <img src="https://indianfilmhistory.com/admin_panel_new_dev/media/movies/6642101d4c4f7cd59f04d5d4/chhava-2024-2024-hindi-review2.jpg" alt="Movie 1">
            <h3>CHHAAVA</h3>
            <button>Book Now</button>
        </div>
        <div class="movie-card">
            <img src="https://img.indiaforums.com/movie/350x525/7/306-sky-force.jpg?c=6mN077" alt="Movie 2">
            <h3>SKY FORCE</h3>
            <button>Book Now</button>
        </div>
        <div class="movie-card">
            <img src="https://assetscdn1.paytm.com/images/cinema/Umbarro--30a7bcf0-b7a9-11ef-b2e6-3b922ebbcf80.jpg?format=webp" alt="Movie 3">
            <h3>UMBARRO</h3>
            <button>Book Now</button>
        </div>
        <div class="movie-card">
            <img src="https://m.media-amazon.com/images/M/MV5BNDRjY2E0ZmEtN2QwNi00NTEwLWI3MWItODNkMGYwYWFjNGE0XkEyXkFqcGc@.V1.jpg" alt="Movie 4">
            <h3>BRAVE NEW WORLD</h3>
            <button>Book Now</button>
        </div>
        <div class="movie-card">
            <img src="https://m.media-amazon.com/images/M/MV5BMWQ2Mzc3OTItYzIzMi00ZDhhLTg2MjktMzhlNGQ4ZmI1MjIzXkEyXkFqcGc@.V1.jpg" alt="Movie 5">
            <h3>DEVA</h3>
            <button>Book Now</button>
        </div>
    </div>
</section>

</body>

</html>