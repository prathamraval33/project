
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
        <!-- Logo-->
        <div class="logo">
            <a href="../user/index.php"><img src="../img/logo.png" class="logoimg" alt="Logo"></a>
        </div>

        <!-- Menu -->
        <div class="menu">
            <a href="../user/index.php">HOME</a>
            <div class="dropdown">
                <a href="#">MOVIE</a>
                <div class="dropdown-content">
                    <a href="#">Now Showing</a>
                    <a href="#">Upcoming</a>
                    
                </div>
            </div>
            <a href="../user/about.php">ABOUT US</a>
            <a href="../user/contact.php">CONTACT US</a>
            
           
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Search movies, Categories or theaters">
            <button>Search</button>
        </div>

        <!-- User Section -->
        <div class="sign">
            
            <div class="signcontent">
                <div class="dropdown">
                <img src="https://cdn-icons-png.flaticon.com/512/12828/12828286.png" alt="Profile" class="profile">
               <p> <?php echo "Guest"; ?></p>
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
