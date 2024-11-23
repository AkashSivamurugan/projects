<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../user/login.html');
    exit();
}

include '../db/db.php';
$user_id = $_SESSION['user'];

// Fetch the latest booking for the logged-in user
$sql = "SELECT bookings.*, drivers.lat, drivers.lng, drivers.available AS driver_status
        FROM bookings 
        JOIN drivers ON bookings.driver_id = drivers.id 
        WHERE bookings.user_id = '$user_id' AND bookings.status IN ('accepted', 'in_progress') 
        ORDER BY bookings.id DESC LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $booking = $result->fetch_assoc();
    $location = ['lat' => $booking['lat'], 'lng' => $booking['lng']];
    $cab_status = $booking['driver_status'] ? 'Available' : 'Unavailable';
} else {
    $booking = null;
    $location = ['lat' => 0, 'lng' => 0]; // Default location if no booking
    $cab_status = 'No active booking';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Your Ride</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQv7BUhgKQQRcaERnwAwn4VJ2HLXbSUAI"></script>
    <script src="js/track_script.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cab Booking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="user_dashboard.php">User Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="track_ride.php">Track Ride</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Track Your Ride</h2>
        <?php if ($booking): ?>
            <p>Pickup: <?php echo $booking['pickup']; ?>, Dropoff: <?php echo $booking['dropoff']; ?></p>
            <p>Cab Status: <?php echo $cab_status; ?></p>
            <div id="map" style="height: 500px; width: 100%;"></div>

            <script>
                var driverLocation = { lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?> };
                initMap(driverLocation);
            </script>
        <?php else: ?>
            <p>No active bookings found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
