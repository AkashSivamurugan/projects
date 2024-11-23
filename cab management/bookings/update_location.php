<?php
session_start();
if (!isset($_SESSION['driver'])) {
    header('Location: ../drivers/driver_login.html');
    exit();
}

include '../db/db.php';
$driver_id = $_SESSION['driver'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$sql = "UPDATE drivers SET lat='$lat', lng='$lng' WHERE id='$driver_id'";
if ($conn->query($sql) === TRUE) {
    echo "Location updated successfully";
} else {
    echo "Error updating location: " . $conn->error;
}

$conn->close();
?>
