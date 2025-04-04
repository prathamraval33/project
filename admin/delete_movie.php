<?php
require '../database/_dbconnect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = "";

// Handle movie deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['movie_id'])) {
    $movie_id = intval($_POST['movie_id']);
    $sql = "DELETE FROM movies WHERE id = $movie_id";

    if (mysqli_query($conn, $sql)) {
        $message = "✅ Movie deleted successfully!";
    } else {
        $message = "❌ Error deleting movie: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Movie</title>
    <link rel="stylesheet" href="../css/delete_movie.css"> <!-- Reusing same CSS -->
</head>
<body>
    <?php
    include 'adminhome.php';
    ?>
    <div class="upload-container">
        <h2>Delete Movie</h2>

        <?php if (!empty($message)): ?>
            <p style="text-align:center; color: <?= strpos($message, '✅') !== false ? 'green' : 'red' ?>;"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="movie_id">Select Movie</label>
            <select name="movie_id" required>
                <option value="" disabled selected>Choose a movie</option>
                <?php
                $result = mysqli_query($conn, "SELECT id, title FROM movies");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</option>';
                }
                ?>
            </select>

            <button type="submit">Delete Movie</button>
        </form>
    </div>
</body>
</html>
