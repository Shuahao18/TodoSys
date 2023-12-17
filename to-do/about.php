<?php
session_start();

include('php/configure.php'); // Include your database configuration file

if (!isset($_SESSION['userLogin'])) {
    // Redirect to the login page or show an error message
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
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
	</header>
	<div class="body">
		<nav class="side-bar">
			<?php
			$id = $_SESSION['userLogin'];
			$query = mysqli_query($con, "SELECT * FROM user WHERE Id=$id");
			$userData = mysqli_fetch_assoc($query);
			$username = $userData['Username'];
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

		<section class="about">
			<div class="main">
				<img src="images/about.png">
				<div class="all-text">
					<h4>About Us</h4>
					<h1>House of Working & Listing Task</h1>
					<p>In summary, incorporating note-taking into your daily work
						routine can significantly contribute to your professional success
						by promoting organization, aiding memory, enhancing communication,
						and facilitating personal and professional development.</p>
					<div class="btn">
						<button type="button">Our Team</button>
						<button type="button">Learn More</button>
					</div>
				</div>
			</div>
		</section>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

	</body>
	</html>
