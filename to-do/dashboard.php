<?php
session_start();
include('php/configure.php');

if (!isset($_SESSION['userLogin'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['userLogin'];
$query = mysqli_query($con, "SELECT * FROM user WHERE Id = $id");

if ($query && mysqli_num_rows($query) > 0) {
    $userData = mysqli_fetch_assoc($query);
    $username = $userData['Username'];
} else {
    // Handle the case where user data is not retrieved
    $username = 'Guest';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="shit.css">
</head>
<body>
    <input type="checkbox" id="checkbox">
    <header class="header">
        <h2 class="u-name">TO-DO <b>LIST</b>
            <label for="checkbox">
                <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
            </label>
        </h2>
        <div class="signO">
            <ul>
                <a href="logout.php">Sign Out</a>
            </ul>
        </div>
    </header>
    <div class="body">
        <nav class="side-bar">
            <div class="user-p">
                <img src="images/use.png">
                <h4><?php echo $username; ?></h4>
            </div>
            <ul>
                <li>
                    <a href="dashboard.php" type="button">
                        <i class="fa-sharp fa-solid fa-qrcode" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="add_task.php" type="button" id="add_task">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i>
                        <span>Add Task</span>
                    </a>
                </li>
                <li>
                    <a href="current_task.php" type="button" id="current_task">
                        <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                        <span>Current Task</span>
                    </a>
                </li>
                <li>
                    <a href="history.php" type="button">
                        <i class="fa-solid fa-clock-rotate-left" aria-hidden="true"></i>
                        <span>History</span>
                    </a>
                </li>
                <li>
                    <a href="about.php" type="button" id="about">
                        <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                        <span>About Us</span>
                    </a>
                </li>
            </ul>
        </nav>

        <section class="section-1">
            <div class="row">
                <div class="left">
                    <img src="images/logo.png">
                </div>
                <div class="right">
                    <div class="content">
                        <p>
                      <span>Hello and welcome to TO-DO-LIST</span>
					  		When efficiency meets simplicity! Say
                            goodbye to messiness and hello to more 
                            organized task management. Our Online
                            software has an easy-to-use User Interface (U.I),Customized
							activities, and compatibility across devices.
							Maintain organization, meet deadlines and cooperate with ease.
							Try TO-DO-LIST now to experience productivity personified!
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3
