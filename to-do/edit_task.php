<?php
session_start();

include('php/configure.php');

if (!isset($_SESSION['userLogin'])) {
    // Redirect to the login page or show an error message
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Retrieve the task information from the database
    $query = "SELECT * FROM task WHERE id = '$taskId'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the task details
        $row = mysqli_fetch_assoc($result);

        // Check if the form is submitted for updating the task
        if (isset($_POST['edit_task'])) {
            // Retrieve updated task details from the form
            $title = $_POST['Title'];
            $description = $_POST['Description'];
            $start_date = $_POST['start'];
            $end_date = $_POST['end'];

            // Update the task in the database
            $updateQuery = "UPDATE task SET title = '$title', description = '$description', start_date = '$start_date', end_date = '$end_date' WHERE id = '$taskId'";
            $verify_query = mysqli_query($con, $updateQuery);

            if ($verify_query) {
                echo "<script type='text/javascript'>
                        alert('Task updated successfully.');
                        window.location.href = 'current_task.php';
                      </script>";
                exit();
            } else {
                echo "Error updating task: " . mysqli_error($con);
            }
        }
    } else {
        echo "Task not found.";
    }
}

?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Dashboard</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="styles/add-task.css">
        </head>
        <body>

        <input type="checkbox" id="checkbox">
        <header class="header">
            <h2 class="u-name">TO-DO <b>LIST</b>
                <label for="checkbox">
                    <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
                </label>
            </h2>
            <ul>
                <a href="logout.php">Sign Out</a>
            </ul>
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
                        <a href="dashboard.php" type="button" >
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

            <section class="section-1">
                <div class="right">
                    <div class="content">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <h1>EDIT TASK</h1>
                                <input type="text" name="Title" id="title" placeholder="Summary" required value="<?php echo isset($row['title']) ? $row['title'] : ''; ?>">
                                <textarea id="description" name="Description" cols="30"  rows="4" placeholder="Description"><?php echo isset($row['description']) ? $row['description'] : ''; ?></textarea> 
                                <label>start date</label>
                                <input type="datetime-local" name="start" id="time"  required value="<?php echo isset($row['start']) ? $row['start'] : ''; ?>">
                                <label>end date</label>
                                <input type="datetime-local" name="end" id="time"  required value="<?php echo isset($row['end']) ? $row['end'] : ''; ?>">
                                <button type="submit" name="edit_task">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        </div>
        </body>
        </html>
        

