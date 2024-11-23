<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../user/login.html');
    exit();
}

include '../db/db.php';

// Function to generate a unique booking ID
function generateBookingID() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*()';
    $bookingID = '';
    for ($i = 0; $i < 10; $i++) {
        $bookingID .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $bookingID;
}

$pickup = $_POST['pickup'];
$dropoff = $_POST['dropoff'];
$date = $_POST['date'];
$time = $_POST['time'];
$driver_id = $_POST['driver_id'];
$user_id = $_SESSION['user'];
$booking_id = generateBookingID();
$booked_at = date('Y-m-d H:i:s');

// Ensure driver_id exists in drivers table
$driver_check_sql = "SELECT id FROM drivers WHERE id = '$driver_id'";
$driver_check_result = $conn->query($driver_check_sql);

if ($driver_check_result->num_rows === 0) {
    echo "Error: Invalid driver_id.";
    $conn->close();
    exit();
} else {
    echo "Valid driver_id: $driver_id"; // Debugging line
}

$sql = "INSERT INTO bookings (user_id, driver_id, pickup, dropoff, date, time, booking_id, booked_at, status) 
        VALUES ('$user_id', '$driver_id', '$pickup', '$dropoff', '$date', '$time', '$booking_id', '$booked_at', 'pending')";

if ($conn->query($sql) === TRUE) {
    echo "Booking successful!"; // Debugging line
    header('Location: ../user/user_dashboard.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
