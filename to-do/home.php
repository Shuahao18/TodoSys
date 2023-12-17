<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="includes/juqery_latest.js"></script>
    <title>Home</title>
</head>

<body>

    <div class="container">
        <!-- --------------navigation bar----------------------- -->
        <input type="checkbox" id="check">
        <div class="nav">
            <label>To-do-list</label>
            <label for="check">
                <i class="fa-sharp fa-solid fa-bars" id="bars"> Menu</i>
            </label>
            <nav>
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <!-- Add more navigation items if needed -->
                </ul>
            </nav>
        </div>

        <!-- -------------------slider------------------- -->
        <div class="slider" id="left_sidebar">
            <center>
                <img src="images/logo.png">
                <br><br>
            </center>
            <br>
            <ol>
                <div class="add" id="add_task">
                    <li> <a href="home.php" type="button" id="user_link"><i class="fa-sharp fa-solid fa-qrcode"></i><span>dashboard</span></a></li>
                </div>
                <div class="add" id="add_task" type="button">
                    <li><a href="#"><i class="fa-solid fa-plus"></i><span>Add Task</span></a></li>
                </div>
                <li><a href="#"><i class="fa-solid fa-clock-rotate-left"></i><span>History</span></a></li>
                <li><a href="#"><i class="fa-solid fa-list-check"></i><span>Current Task</span></a></li>
            </ol>
        </div>

        <div class="col-10" id="right_sidebar">
            <div class="col-1">
                <h2>Hello and Welcome to TO-DO-LIST</h2>
                <p>When efficiency meets simplicity! Say goodbye to messiness and hello to more organized task management
                </p>
            </div>

            <div class="col-2">Column</div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
