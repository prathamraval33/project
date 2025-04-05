<?php
require '../database/_dbconnect.php'; // adjust if needed

// Fetch feedback entries
$sql = "SELECT name, email, message FROM feedback_10 ORDER BY id DESC"; // assuming there's an id column
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Feedback</title>
    <link rel="stylesheet" href="../css/feedback.css"> <!-- optional -->
</head>
<body>
<?php include 'adminhome.php'; ?>
    <div class="feedback-display-container">
        <h2> User Feedback</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No feedback messages yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
