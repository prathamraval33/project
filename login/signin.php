<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="sign.css">
    <script> 
    function validateForm(event) {
            
            var email = document.getElementsByName("email")[0].value.trim();
           
            var password = document.getElementsByName("psw")[0].value;
            

            // Check if any field is empty
            if ( email === "" || password === "" ) {
                alert("Please fill all details!");
                event.preventDefault(); // Stop form submission
                return false;
            }

           
            // Allow form submission if all checks pass
            alert("Signed In successfully");
            return true;
        }
        </script>
</head>
<body>
    
        <form class="form" action="#" onsubmit="return validateForm(event)">
    <h2>Sign Up<h2>
            
            <?php
            $a=$_POST['']
            ?>
                   
                    <input type="email" name="email" placeholder="Enter Your Email" class="box">
                   <input type="password" name="psw" placeholder="Enter Your Password" class="box"> 
                   
                   <input type="submit" id="submit" placeholder="Sign Up">
            <p>Don't have account?<p><a href="signup.php" style="color: #F5D2D2; display: inline;"> Sign up</a> 
            </form>
   
</body>
</html>