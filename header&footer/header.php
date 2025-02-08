

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movify</title>
    <link rel="stylesheet" href="header.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1e1e1e;
            color: white;
            padding: 10px 20px;
        }

        .logo img {
            height: 50px;
        }

        .menu a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            padding: 5px 10px;
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: #ff6f61;
            color: #1e1e1e;
            border-radius: 5px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            padding: 10px;
            box-sizing: border-box; 
            width: 180px; 
            border-radius: 5px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 8px 10px;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .dropdown-content a:hover {
            background-color: #ff6f61;
        }

        .sign img {
            height: 40px;
            vertical-align: middle;
        }

        .signcontent a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }

        .search-bar {
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 5px ;
            border: none;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 5px 15px;
            border: none;
            background-color: #ff6f61;
            color: white;
            border-radius: 5px;
            margin-left: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #ff4c39;
        }

        .language-switcher select {
            padding: 5px;
            border: none;
            border-radius: 5px;
        }

        .theme-switcher button {
            padding: 5px 10px;
            background-color: #ff6f61;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .theme-switcher button:hover {
            background-color: #ff4c39;
        }

        .promo-banner {
            text-align: center;
            background-color: #ff6f61;
            color: white;
            padding: 5px 0;
            font-size: 14px;
        }

        .promo-banner a {
            color: #fff;
            font-weight: bold;
            text-decoration: underline;
        }

        /* Styling for the logo section */
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            height: 60px;
            width: auto;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.1);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>
    <!-- Promo Banner -->
    <div class="promo-banner">
        Get 20% off on your first booking! <a href="#">Book Now</a>
    </div>

    <nav class="navbar">
        <!-- Logo-->
        <div class="logo">
            <a href="#"><img src="https://inc42.com/wp-content/uploads/2019/04/social-1.jpg" class="logoimg" alt="Logo"></a>
        </div>

        <!-- Menu -->
        <div class="menu">
            <a href="header.html">HOME</a>
            <a href="about.html">ABOUT US</a>
            <a href="contact.html">CONTACT US</a>
            <a href="#">STORY</a>
            <div class="dropdown">
                <a href="#">MOVIE</a>
                <div class="dropdown-content">
                    <a href="#">Now Showing</a>
                    <a href="#">Upcoming</a>
                    <a href="#">Categories</a>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Search movies, Categories or theaters">
            <button>Search</button>
        </div>

        <!-- User Section -->
        <div class="sign">
            <img src="https://cdn-icons-png.flaticon.com/512/12828/12828286.png" alt="Profile" class="profile">
            <div class="signcontent">
                <div class="dropdown">
                    <a href="#">Profile</a>
                    <div class="dropdown-content">
                        <a href="#" id="signin">Sign In</a>
                        <a href="#" id="signup">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Language Switcher -->
        <div class="language-switcher">
            <select>
                <option value="en">English</option>
                <option value="hi">Hindi</option>
                <option value="gu">Gujarati</option>
            </select>
        </div>
    </nav>
</body>

</html>
