<?php
session_start();
include('php/configure.php');

if (!isset($_SESSION['userLogin'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['userLogin'];

// Fetch Done tasks
$doneQuery = "SELECT * FROM history WHERE user_id = '$userId' AND status = 'Done'";
$doneResult = mysqli_query($con, $doneQuery);

// Fetch Missing tasks
$missingQuery = "SELECT * FROM history WHERE user_id = '$userId' AND status = 'Missing'";
$missingResult = mysqli_query($con, $missingQuery);

// Check if the form is submitted
if (isset($_POST['delete_history'])) {
    // Perform the deletion of all history
    $deleteAllQuery = "DELETE FROM history WHERE user_id = '$userId'";
    mysqli_query($con, $deleteAllQuery);

    // Redirect to the same page to refresh the content
    header("Location: history.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>History</title>
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
            <?php
            // Fetch user data from the database based on the user's session ID
            $id = $_SESSION['userLogin'];
            $query = mysqli_query($con, "SELECT * FROM user WHERE Id = $id");

            // Check if the query was successful and retrieve user data
            if ($query && mysqli_num_rows($query) > 0) {
                $userData = mysqli_fetch_assoc($query);
                $username = $userData['Username'];
            }
            ?>
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
                    <a href="current_task.php" type="button" id="add_task">
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
                    <a href="about.php">
                        <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                        <span>About Us</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="center">
            <div class="content">
                <h1>HISTORY</h1>
                <h4>_________________</h4>
                <h3>_______</h3>

                <!-- Done Tasks Form -->
                <section>
                    <h2>Done Tasks</h2>
                       <!-- Add this section for the delete button -->
                <section>
                    <form method="post" action="">
                        <button type="submit" name="delete_history" style="width:100px; height: 5vh; color: black;margin-bottom: 20px; margin-left:20px; background:skyblue; border:none">Delete All</button>
                    </form>
                </section>

                    <table class="table" style="background-color: #637E76; width: 88vw; margin-left: 5px; margin-right:5px;">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th> <!-- Added this column -->
                        </tr>

                        <?php
                        while ($doneRow = mysqli_fetch_assoc($doneResult)) {
                        ?>
                            <tr>
                                <td><?php echo $doneRow['title']; ?></td>
                                <td><?php echo $doneRow['description']; ?></td>
                                <td><?php echo $doneRow['start_date']; ?></td>
                                <td><?php echo $doneRow['end_date']; ?></td>
                                <td><?php echo $doneRow['status']; ?></td> <!-- Added this column -->
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </section>

                <!-- Missing Tasks Form -->
                <section>
                    <h2>Missing Tasks</h2>
                    <table class="table" style="background-color: #637E76; width: 88vw; margin-left: 5px; margin-right:5px;">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Status</th> <!-- Added this column -->
                        </tr>

                        <?php
                        while ($missingRow = mysqli_fetch_assoc($missingResult)) {
                        ?>
                            <tr>
                                <td><?php echo $missingRow['title']; ?></td>
                                <td><?php echo $missingRow['description']; ?></td>
                                <td><?php echo $missingRow['start_date']; ?></td>
                                <td><?php echo $missingRow['end_date']; ?></td>
                                <td><?php echo $missingRow['status']; ?></td> <!-- Added this column -->
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </section>

            </div>
        </div>
    </div>
    </section>

</body>

</html>
