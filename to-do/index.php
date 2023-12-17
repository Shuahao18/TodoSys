<?php
session_start();

if (isset($_SESSION['userLogin'])) {
    // Redirect to the login page or show an error message
    header("Location: dashboard.php");
    exit();
}
$message = ''; // Initialize an empty message variable

include("php/configure.php");


if (isset($_POST['submit'])) {
    $email  = $_POST['email'];
    $password = $_POST['Password'];

    // Use prepared statement to prevent SQL injection
    $sqlLogin = "SELECT * FROM user WHERE email = ? AND Password = ?";
    $stmt = $con->prepare($sqlLogin);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['userLogin'] = $row['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $message = "Error: Incorrect Username or Password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="Password" id="password" autocomplete="off" required>
            </div>

            <div class="btn">
                <input type="submit" name="submit" value="Login" required>
            </div>

            <div class="message">
                <?php echo $message; ?>
            </div>

            <div class="links">
                Don't have an account? <a href="register.php">Sign-up</a>
            </div>
            <p>"Embrace the beauty of your unique journey.<br> 
                Your to-do list is not just a checklist;<br>
                it's a canvas for your extraordinary story."
            </p>
        </form>
    </div>
</body>
</html>
