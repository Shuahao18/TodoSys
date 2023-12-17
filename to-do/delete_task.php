<?php
session_start();

if (!isset($_SESSION['userLogin'])) {
    // Redirect to the login page or show an error message
    header("Location: index.php");
    exit();
}

include('php/configure.php');

if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Fetch the task details
    $taskQuery = "SELECT * FROM task WHERE id = '$taskId'";
    $taskResult = mysqli_query($con, $taskQuery);

    if ($taskRow = mysqli_fetch_assoc($taskResult)) {
        $title = $taskRow['title'];
        $description = $taskRow['description'];
        $start_date = $taskRow['start_date'];
        $end_date = $taskRow['end_date'];
        $status = $taskRow['status'];

        // Move the task to the history table
        $historyStatus = ($status == 'Done') ? 'Done' : 'Missing';
        $historyQuery = "INSERT INTO history (user_id, title, description, start_date, end_date, status) VALUES ('".$_SESSION['userLogin']."', '$title', '$description', '$start_date', '$end_date', '$historyStatus')";
        mysqli_query($con, $historyQuery);

        // Delete the task from the task table
        $deleteQuery = "DELETE FROM task WHERE id = '$taskId'";
        mysqli_query($con, $deleteQuery);

        header("Location: current_task.php");
        exit();
    } else {
        // Task not found
        echo "Task not found.";
    }
} else {
    // Task ID not provided
    echo "Task ID not provided.";
}
?>
