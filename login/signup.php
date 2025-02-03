<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="sign.css">
    <script> 
    function validateForm(event) {
            var name = document.getElementsByName("name")[0].value.trim();
            var email = document.getElementsByName("email")[0].value.trim();
            var mobile = document.getElementsByName("number")[0].value.trim();
            var password = document.getElementsByName("psw")[0].value;
            var cpassword = document.getElementsByName("cpsw")[0].value;

            // Check if any field is empty
            if (name === "" || email === "" || mobile === "" || password === "" || cpassword === "") {
                alert("Please fill all details!");
                event.preventDefault(); // Stop form submission
                return false;
            }

            // Validate mobile number
            if (mobile.length !== 10 || isNaN(mobile)) {
                alert("Please enter a valid 10-digit mobile number!");
                event.preventDefault();
                return false;
            }

            // Validate password match
            if (password !== cpassword) {
                alert("Passwords do not match!");
                event.preventDefault();
                return false;
            }

            // Allow form submission if all checks pass
            alert("Sign-Up successfull!!!");
            return true;
        }
        </script>
</head>
<body>
    
        <form class="form" action="signin.php" onsubmit="return validateForm(event)" method="post">
    <h2>Sign Up<h2>
            
                    <input type="text" name="name" placeholder=" Enter Your Name" class="box">
                    <input type="number" name="number" placeholder="Enter Your Mobile number" class="box" minlength="10" maxlength="10">
                    <input type="email" name="email" placeholder="Enter Your Email" class="box">
                   <input type="password" name="psw" placeholder="Enter Your Password" class="box"> 
                   <input type="password" name="cpsw" placeholder="Re-Enter Your Password" class="box"> 
                   <input type="submit" id="submit" placeholder="Sign Up">
            <p>Already have account?<p><a href="signin.php" style="color: #ff6f61; display: inline;"> Sign In</a> 
            </form>
   
</body>
</html>