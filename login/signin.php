<?php
$login = false;
$error_message = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../database/_dbconnect.php';

    $uemail = trim($_POST['email']);
    $upass = trim($_POST['psw']);

    if (empty($uemail) || empty($upass)) {
        $error_message = "Please fill all details!";
    } else {
        $sql = "SELECT * FROM `userinfo10m` WHERE `u_email` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $uemail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $stored_hashed_password = $row['u_password'];

            if (password_verify($upass, $stored_hashed_password)) {
                $login = true;
                session_start();
                $_SESSION['user'] = $row['u_name'];
                $_SESSION['email'] = $row['u_email'];
                $_SESSION['number'] = $row['u_number'];
                

                $_SESSION['loginn'] = true;
                header("Location: ../user/index.php");
                exit();
            } else {
                $error_message = "Incorrect password! Please try again.";
            }
        } else {
            $error_message = "User does not exist! Please sign up.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error-message {
            color: white;
            background-color: red;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php if (!empty($error_message)): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>

</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../css/form2.css">
    <style>
button {
    display: block;
    margin-left: 9vw;
    margin-top: 4.1vh;
    margin-bottom:5vh;
    width: 7vw;
    background-color: rgba(0, 0, 0, 0.463);
    box-shadow: inset -3px -3px rgba(0, 0, 0, 0.463);
    color: #ff6f61;
    border: none;
    outline: none;
    border-radius: 10%;
}
    </style>
    
</head>
<body>
    
 <form class="form"  method="post" > 

    <h2>Sign In<h2>
              
                    <input type="email" name="email" placeholder="Enter Your Email" class="box" required>
                   <input type="password" name="psw" placeholder="Enter Your Password" class="box"> 
                   
                   <button type="submit" id="submit" placeholder="Sign Up" name="submit">submit</button>
            <p>Don't have account?<p><a href="signup.php" style="color: #ff6f61; display: inline;"> Sign up</a> 
            </form>
   
</body>

</html>