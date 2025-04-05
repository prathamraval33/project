<?php
require '../database/_dbconnect.php';

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if (empty($email) || empty($password)) {
        $error_message = "Both fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } else {
        // Check if admin email already exists
        $checkQuery = "SELECT aid FROM admininfo10m WHERE aemail = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error_message = "❌ This email is already registered as an admin.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert new admin
            $insertQuery = "INSERT INTO admininfo10m (aemail, apass, astatus) VALUES (?, ?, 'admin')";
            $insertStmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($insertStmt, "ss", $email, $hashedPassword);
            if (mysqli_stmt_execute($insertStmt)) {
                $success_message = "✅ New admin added successfully!";
            } else {
                $error_message = "❌ Error: " . mysqli_error($conn);
            }
            mysqli_stmt_close($insertStmt);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admin</title>
    <link rel="stylesheet" href="../css/addadmin.css">
</head>
<body>
<?php include 'adminhome.php'; ?>

<div class="admin-form-container">
    <h2>➕ Add New Admin</h2>

    <?php if (!empty($success_message)): ?>
        <p class="success"><?= $success_message ?></p>
    <?php elseif (!empty($error_message)): ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Admin Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Add Admin</button>
    </form>
</div>
</body>
</html>
