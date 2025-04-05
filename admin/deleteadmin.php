<?php
require '../database/_dbconnect.php';

$success_message = "";
$error_message = "";

// Fetch all admin emails for the dropdown
$email_options = "";
$email_query = "SELECT aemail FROM admininfo10m";
$email_result = mysqli_query($conn, $email_query);
if ($email_result && mysqli_num_rows($email_result) > 0) {
    while ($row = mysqli_fetch_assoc($email_result)) {
        $email_options .= '<option value="' . htmlspecialchars($row['aemail']) . '">' . htmlspecialchars($row['aemail']) . '</option>';
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error_message = "Please select an email to delete!";
    } else {
        // Check if admin exists
        $checkQuery = "SELECT aid FROM admininfo10m WHERE aemail = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) === 0) {
            $error_message = "❌ No admin found with this email.";
        } else {
            // Delete admin
            $deleteQuery = "DELETE FROM admininfo10m WHERE aemail = ?";
            $deleteStmt = mysqli_prepare($conn, $deleteQuery);
            mysqli_stmt_bind_param($deleteStmt, "s", $email);
            if (mysqli_stmt_execute($deleteStmt)) {
                $success_message = "✅ Admin deleted successfully!";
            } else {
                $error_message = "❌ Error deleting admin: " . mysqli_error($conn);
            }
            mysqli_stmt_close($deleteStmt);
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
    <title>Delete Admin</title>
    <link rel="stylesheet" href="../css/admindelete.css">
</head>
<body>
<?php include 'adminhome.php'; ?>

<div class="admin-form-container">
    <h2>🗑️ Delete Admin</h2>

    <?php if (!empty($success_message)): ?>
        <p class="success"><?= $success_message ?></p>
    <?php elseif (!empty($error_message)): ?>
        <p class="error"><?= $error_message ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="email">Select Admin Email:</label>
        <select name="email" id="email" required>
            <option value="">-- Select Admin Email --</option>
            <?= $email_options ?>
        </select>

        <button type="submit">Delete Admin</button>
    </form>
</div>
</body>
</html>
