<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.html');
    exit();
}

include '../db/db.php';
$booking_id = $_GET['id'];

// Prepare and bind
$stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
$stmt->bind_param("i", $booking_id);

// Execute the statement
if ($stmt->execute()) {
    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
