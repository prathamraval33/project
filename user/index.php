<?php

session_start();
if (!isset($_SESSION['loginn']) || $_SESSION['loginn'] !== true) {
    include '../header&footer/header.php';
} else {
    include '../header&footer/headerwithlog.php';
} 

include 'slider.php';

include '../homepage/homepage.php';


 include '../header&footer/Footer.php';

?>