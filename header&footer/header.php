
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movify</title>
    <link rel="stylesheet" href="../css/header.css">
    
</head>

<body>
   

<nav class="navbar">
    <div class="logo">
        <a href="#"><img src="../img/logo.png" class="logoimg" alt="Logo"></a>
    </div>

    <div class="menu">
        <a href="../user/index.php">Home</a>
       
        
        <div class="dropdown">
            <a href="#">Movies</a>
            <div class="dropdown-content">
                <a href="../homepage/homepage.php#moive">Now Showing</a>
                <a href="../homepage/homepage.php#upcoming-movie">Upcoming</a>
            </div>
        </div>
        
         <a href="../user/about.php">About Us</a>
        <a href="../user/contact.php">Contact Us</a>
        

    </div>

        <!-- User Section -->
        <div class="sign">
            
            <div class="signcontent">
                <div class="dropdown">
                <img src="https://cdn-icons-png.flaticon.com/512/12828/12828286.png" alt="Profile" class="profile">
               <p style=" margin-left : 2vw"> <?php echo "Guest"; ?></p>
                     <div class="dropdown-content">
                        <a href="../login/signin.php" id="signin">Sign In</a>
                        <a href="../login/signup.php" id="signup">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>

        
    </nav>
</body>

</html>
