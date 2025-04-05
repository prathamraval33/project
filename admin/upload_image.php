<?php
require '../database/_dbconnect.php';

$message = ''; // Initialize message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $status = strtolower(mysqli_real_escape_string($conn, $_POST['status'])); // Ensure lowercase

    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $uploadPath = '../homeimg/' . $imageName;

    if (move_uploaded_file($imageTmp, $uploadPath)) {
        $sql = "INSERT INTO movies (title, image_url, status) VALUES ('$title', '$uploadPath', '$status')";
        if (mysqli_query($conn, $sql)) {
            $message = "✅ Movie uploaded successfully!";
        } else {
            $message = "❌ Database Error: " . mysqli_error($conn);
        }
    } else {
        $message = "❌ Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Movie</title>
    <link rel="stylesheet" href="../css/upload_movie.css">
</head>
<body>
    <?php include 'adminhome.php'; ?>

    <div class="upload-container">
        <h2>Upload New Movie</h2>

        <?php if (!empty($message)) : ?>
            <div class="upload-message"><?= $message ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Movie Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="image">Select Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="status">Movie Status:</label>
            <select name="status" id="status" required>
                <option value="now_showing">Now Showing</option>
                <option value="upcoming">Upcoming</option>
            </select>

            <button type="submit">Upload Movie</button>
        </form>
    </div>
</body>
</html>
