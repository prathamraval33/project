<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../database/_dbconnect.php';

// Check if logged-in user exists
if (!isset($_SESSION['admin_user']) || !isset($_SESSION['role'])) {
    header("Location: ../admin/adminlogin.php");
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($role); ?> Dashboard</title>
<link rel="stylesheet" href="../css/ahome.css">
</head>
<body>

<?php if ($role === 'superadmin'): ?>
    <?php
    // Handle Admin Creation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_admin_email = isset($_POST['new_admin_email']) ? mysqli_real_escape_string($conn, $_POST['new_admin_email']) : '';
        $new_admin_pass = isset($_POST['new_admin_pass']) ? mysqli_real_escape_string($conn, $_POST['new_admin_pass']) : '';
        
        // Check if email already exists
        $check_query = "SELECT * FROM admininfo10m WHERE aemail = '$new_admin_email'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "❌ This email is already registered as an admin.";
        } else {
            $insert_query = "INSERT INTO admininfo10m (aemail, apass, astatus) VALUES ('$new_admin_email', '$new_admin_pass', 'admin')";
            if (mysqli_query($conn, $insert_query)) {
                $message = "✅ New Admin Added Successfully!";
            } else {
                $message = "❌ Error: " . mysqli_error($conn);
            }
        }
    }
    ?>

    <div class="sidebar">
        <h2>Super-Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php"> Dashboard</a></li>
            <li><a href="addadmin.php"> Add Admins</a></li>
            <li><a href="deleteadmin.php"> Delete Admins</a></li>
            <li><a href="manbook.php"> Manage Bookings</a></li>
            <li><a href="upload_image.php"> Add Movies</a></li>
            <li><a href="delete_movie.php"> Delete Movies</a></li>
            <li><a href="feedback.php"> Feedback</a></li>

            <li><a href="../admin/a_logout.php" class="logout"> Logout</a></li>
        </ul>
    </div>

<?php else: ?>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php"> Dashboard</a></li>
            <li><a href="upload_image.php"> Add Movies</a></li>
            <li><a href="delete_movie.php"> Delete Movies</a></li>
            <li><a href="manbook.php"> Manage Bookings</a></li>
            <li><a href="feedback.php"> Feedback</a></li>
            
            <li><a href="../admin/a_logout.php" class="logout"> Logout</a></li>
        </ul>
    </div>
<?php endif; ?>

</body>
</html>
