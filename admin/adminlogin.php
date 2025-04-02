<?php
session_start();
require '../database/_dbconnect.php'; // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']); // Get role from dropdown

    // Check user credentials based on selected role
    $query = "SELECT * FROM admininfo10m WHERE aemail = '$email' AND astatus = '$role'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if ($password === $row['apass']) {
            $_SESSION['admin_user'] = $row['aemail']; // Store session
            $_SESSION['role'] = $row['astatus']; // Store role

            if ($role === 'admin') {
                header("Location: adminhome.php"); // Redirect Admin
            } elseif ($role === 'superadmin') {
                header("Location: superadminhomepage.php"); // Redirect Superadmin
            }
            exit();
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "Invalid email, role, or account not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/adminlogin.css">
</head>
<body>
    <div class="login-container">
        <div class="inner-box">
            <h1>Admin Login</h1>
            <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>
            <form action="" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="role">Login As:</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="superadmin">Superadmin</option>
                </select>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
