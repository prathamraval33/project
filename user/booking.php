 <?php
session_start();

if (!isset($_SESSION['loginn']) || $_SESSION['loginn'] !== true) {
    include '../header&footer/header.php';
} else {
    include '../header&footer/headerwithlog.php';
}

if (isset($_GET['movie'])) {
    include '../booking/book.php';
}

include '../header&footer/Footer.php';
?>
