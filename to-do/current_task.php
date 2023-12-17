<?php
session_start();

if (!isset($_SESSION['userLogin'])) {
    // Redirect to the login page or show an error message
    header("Location: index.php");
    exit();
}

include('php/configure.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
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


        <div class="center">
            <div class="content">
                <h1>CURRENT TASK</h1>
                <h4>___________________________</h4>
                <h3>_____________</h3>
                <table class="table" style="background-color: #637E76; width:88vw; margin-left: 5px; margin-right:5px;">
                    <tr>
                        <th>Title|</th>
                        <th>Description|</th>
                        <th>Start|</th>
                        <th>End|</th>
                        <th>Status|</th>
                        <th>Action|</th>
                    </tr>

                    <?php
                    $id = $_SESSION['userLogin'];

                    $query = "SELECT * FROM task WHERE user_id = '$id'";
                    $verify_query = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($verify_query)) {
                        ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['start_date']; ?></td>
                            <td><?php echo $row['end_date']; ?></td>
                            <td>
                                <select class="form-select" aria-label="Task Status" id="taskStatus_<?php echo $row['id']; ?>">
                                    <option value="Todo" <?php echo ($row['status'] == 1) ? 'selected' : ''; ?>>To Do</option>
                                    <option value="In Progress" <?php echo ($row['status'] == 2) ? 'selected' : ''; ?>>IN PROGRESS</option>
                                    <option value="Done" <?php echo ($row['status'] == 3) ? 'selected' : ''; ?>>DONE</option>
                                </select>
                            </td>
                            <td>
                                <a href="edit_task.php?id=<?php echo $row['id']; ?>">edit</a> | 
                                <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">delete</a>
                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                </table>

                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('.form-select').change(function () {
                            var taskId = $(this).attr('id').split('_')[1];
                            var newStatus = $(this).val();
                            updateTaskStatus(taskId, newStatus);
                        });
                    });

                    function updateTaskStatus(taskId, newStatus) {
                        $.ajax({
                            type: 'POST',
                            url: 'update_status.php',
                            data: { id: taskId, status: newStatus },
                            success: function (response) {
                                console.log('Task status updated successfully.');
                            },
                            error: function (error) {
                                console.error('Error updating task status:', error);
                            }
                        });
                    }

                    function confirmDelete(taskId) {
                        var confirmDelete = confirm("Are you sure you want to delete this task?");
                        if (confirmDelete) {
                            window.location.href = "delete_task.php?id=" + taskId;
                        }
                    }
                </script>


            </div>
        </div>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
