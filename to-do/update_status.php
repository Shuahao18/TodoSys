<?php
include('php/configure.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['id'];
    $newStatus = $_POST['status'];

    // Update task status in the database
    $updateQuery = "UPDATE task SET status = '$newStatus' WHERE id = '$taskId'";
    mysqli_query($con, $updateQuery);

    // Return a success message
    echo json_encode(['success' => true]);
    exit;
}
?>
