<?php
session_start();
if (!isset($_SESSION['driver'])) {
    header('Location: driver_login.html');
    exit();
}

include '../db/db.php';
$driver_id = $_SESSION['driver'];
$available = isset($_POST['available']) ? 1 : 0;

$sql = "UPDATE drivers SET available='$available' WHERE id='$driver_id'";
if ($conn->query($sql) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error updating status: " . $conn->error;
}

$conn->close();
?>
