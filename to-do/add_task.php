<!DOCTYPE html>
<html>
<head>
	<title>Add Task</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="styles/add-task.css">
</head>
<body>

<?php
session_start();

include('php/configure.php');

if (!isset($_SESSION['userLogin'])) {
    // Redirect to the login page or show an error message
    header("Location: index.php");
    exit();
}

if(isset($_POST['submit'])){
	$title = $_POST['Title'];
	$description = $_POST['Description'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$status = "todo";
	$id = $_SESSION['userLogin'];

	mysqli_query($con, "INSERT INTO task(title,description,start_date,end_date,user_id,status) VALUES('$title','$description','$start','$end', '$id','$status')") or die("Error Occured");
	echo "<script> alert('successfully created!') </script>";	
}

?>
 
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

	<section class="section-1">

        <div class="right">
            <div class="content">
                <div class="col-md-6">
                    <form action="" method="post">
                        <h1>ADD TASK</h1>
						<input type="text" name="Title" id="title" placeholder="Title" required>
						<textarea id="description" name="Description" cols="30"  rows="4" placeholder="Description"></textarea> 
						<label style="font-family: Garamond; font-size:20px; font-weight: 500; color: #5CD2E6">Start Date</label>
						<input type="datetime-local" name="start" id="time"  required>
						<label style="font-family: Garamond; font-size:20px; font-weight: 500; color: #5CD2E6">End Date</label>
						<input type="datetime-local" name="end" id="time"  required>
						<button type="submit" name="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </div>
</body>
</html>
