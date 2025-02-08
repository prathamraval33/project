<?php
session_start();
if (!isset($_SESSION['loginn']) || $_SESSION['loginn'] !== true) {
    include '../header&footer/header.php';
} else {
    include '../header&footer/headerwithlog.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Movify</title>
    <link rel="stylesheet" href="../css/about.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">
    <style>
        h1 {
              color: #ff6f61;
          }
          h3
          {
            margin-left: 3vw;
            font-weight: 500;
            margin-bottom: 4vh;
          }
  
          p {
            
              color: #333;
              line-height: 1.6;
          }
        </style>
    
</head>
<body>
    <div class="container">
        
        <div class="img">

        </div>
        
        <div class="story">
            <h3 >-Our Message</h3>
        <p>Welcome to Movify, your one-stop destination for movie tickets, latest releases, and exclusive offers. We aim to provide a seamless booking experience with the best deals available.</p>
        <p>At Movify, we believe in the power of technology to transform ideas into reality. Founded with a passion for innovation, our team of dedicated developers, designers, and strategists work together to build dynamic, user-friendly digital experiences. Whether it's crafting sleek websites, developing robust applications, or enhancing online presence, we are committed to delivering solutions that drive success.</p>
        <p>What sets us apart is our people. Our team is made up of problem-solvers who are always exploring the latest trends, tools, and best practices in web development. We take pride in our ability to adapt, innovate, and provide custom solutions tailored to the unique needs of our clients.
            </p>
            <p>At Movify, we don’t just build websites—we create digital experiences that leave a lasting impact. Our goal is to empower businesses, startups, and entrepreneurs with cutting-edge technology that enhances growth and engagement.
                </p>
                <p>As we continue our journey, we remain dedicated to pushing boundaries, embracing new challenges, and shaping the future of web development. Join us as we move forward, one innovation at a time.
                    </p>
        </div>
        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>
<?php
include '../header&footer/Footer.php';
?>
