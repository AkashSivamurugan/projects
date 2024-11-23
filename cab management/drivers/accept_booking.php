<?php
session_start();
if (!isset($_SESSION['driver'])) {
    header('Location: driver_login.html');
    exit();
}

include '../db/db.php';

$driver_id = $_SESSION['driver'];
$booking_id = $_POST['booking_id'];

// Verify the driver ID exists
$driver_check_sql = "SELECT id FROM drivers WHERE id='$driver_id'";
$driver_check_result = $conn->query($driver_check_sql);
if ($driver_check_result->num_rows == 0) {
    die("Invalid driver ID");
}

// Verify the booking ID exists
$booking_check_sql = "SELECT id FROM bookings WHERE id='$booking_id'";
$booking_check_result = $conn->query($booking_check_sql);
if ($booking_check_result->num_rows == 0) {
    die("Invalid booking ID");
}

// Update the booking status to accepted and set the driver ID
$update_sql = "UPDATE bookings SET status='accepted', id='$driver_id' WHERE id='$booking_id'";
if ($conn->query($update_sql) === TRUE) {
    // Notify the user about the accepted booking
    $user_sql = "SELECT users.email FROM bookings JOIN users ON bookings.user_id = users.id WHERE bookings.id='$booking_id'";
    $user_result = $conn->query($user_sql);
    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        mail($user['email'], "Booking Accepted", "Your booking has been accepted by a driver.");
    }
    header('Location: driver_dashboard.php');
    exit();
} else {
    echo "Error updating booking: " . $conn->error;
}

$conn->close();
?>