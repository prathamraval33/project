<?php
require '../database/_dbconnect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login/login.php");
    exit();
}

$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['new_name']);
    $user_email = $_SESSION['email'];

    if (empty($new_name)) {
        $error_message = "Name cannot be empty!";
    } else {
        $updateQuery = "UPDATE userinfo10m SET u_name = ? WHERE u_email = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ss", $new_name, $user_email);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['user'] = $new_name; // Update session value
            $success_message = "✅ Username updated successfully!";
        } else {
            $error_message = "❌ Failed to update username.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Username</title>
    <link rel="stylesheet" href="../css/updateuser.css">
</head>
<body>
<div class="container">
    <h2> Update Your Username</h2>

    <?php if (!empty($success_message)): ?>
        <p class="success"><?php echo $success_message; ?></p>
    <?php elseif (!empty($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="new_name">New Username:</label>
        <input type="text" name="new_name" id="new_name" placeholder="Enter new username" required>
        <button type="submit">Update</button>
    </form>

    <a href="profile.php" class="back-link"> Back to Profile</a>
</div>
</body>
</html>
