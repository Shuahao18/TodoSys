<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
    <?php
    session_start();

    if (isset($_SESSION['userLogin'])) {
        // Redirect to the login page or show an error message
        header("Location: dashboard.php");
        exit();
    }
        $message = '';
        include("php/configure.php");
        if(isset($_POST['submit'])){
            $username = $_POST['Username'];
            $email = $_POST['Email'];
            $age = $_POST['Age'];
            $password = $_POST['Password'];

        // EMAIL VERIFICATION
        $verify_query = mysqli_query($con, "SELECT Email FROM user WHERE Email='$email'");
        if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='mess'>
                <p>This email is used, try another one!</p>
                 </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btnLog' >Go back</button>";
        }
        else{
            mysqli_query($con, "INSERT INTO user(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die("Error Occured");
            echo "<script> alert('successfully created!') </script>";
            echo "<a href='index.php'><button class='btnReg'>Login Now</button>";

            // echo header('Location: index.php');

            
        }
        }else{
    ?>
    <div class="container">
            <form action="" method="post">
                <h1>Sign Up</h1>
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="Text" name="Username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="Text" name="Email" id="email" autoomplete="off"c required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="Age" id="age" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="Password" id="password" autocomplete="off" required>
                </div>

                <div class="btn">
                    <input type="submit" name="submit" value="Sign Up" required>
                </div>

                <div class="links">
                    Already have an account? <a href="index.php">Login</a>
                </div>
            </form>
           
        </div>
       <?php } ?>
     </div>
    
</body>
</html>