<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../user/login.html');
    exit();
}

include '../db/db.php';
$booking_id = $_POST['booking_id'];

$sql = "UPDATE bookings SET status='cancelled' WHERE id='$booking_id' AND user_id='{$_SESSION['user']}'";
if ($conn->query($sql) === TRUE) {
    header('Location: ../user/user_dashboard.php');
} else {
    echo "Error cancelling booking: " . $conn->error;
}

$conn->close();
?>
