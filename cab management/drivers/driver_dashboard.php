<?php
session_start();
if (!isset($_SESSION['driver'])) {
    header('Location: ../driver/driver_login.html');
    exit();
}

include '../db/db.php';
$driver_id = $_SESSION['driver'];

// Fetch the driver's name
$driver_sql = "SELECT name FROM drivers WHERE id='$driver_id'";
$driver_result = $conn->query($driver_sql);
$driver_name = '';
if ($driver_result->num_rows > 0) {
    $driver = $driver_result->fetch_assoc();
    $driver_name = $driver['name'];
}

// Fetch driver's location
$location_sql = "SELECT location FROM drivers WHERE id='$driver_id'";
$location_result = $conn->query($location_sql);
$driver_location = '';
if ($location_result->num_rows > 0) {
    $location = $location_result->fetch_assoc();
    $driver_location = $location['location'];
}

// Fetch pending bookings matching driver's location
$sql = "SELECT bookings.*, users.username FROM bookings 
        JOIN users ON bookings.user_id = users.id 
        WHERE ('$driver_location' IN (bookings.pickup, bookings.dropoff)) 
        AND bookings.status='pending'";
$result = $conn->query($sql);
$bookings = [];
while ($booking = $result->fetch_assoc()) {
    $bookings[] = $booking;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cab Booking</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="driver_dashboard.php">Driver Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Welcome, <?php echo $driver_name; ?></h2>
        <h3 class="mb-3">Pending Bookings:</h3>

        <?php if (!empty($bookings)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Booking ID</th>
                            <th>User</th>
                            <th>Pickup</th>
                            <th>Dropoff</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Booked At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo $booking['booking_id']; ?></td>
                                <td><?php echo $booking['username']; ?></td>
                                <td><?php echo $booking['pickup']; ?></td>
                                <td><?php echo $booking['dropoff']; ?></td>
                                <td><?php echo $booking['date']; ?></td>
                                <td><?php echo $booking['time']; ?></td>
                                <td><?php echo $booking['booked_at']; ?></td>
                                <td>
                                    <form action="accept_booking.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Accept</button>
                                    </form>
                                    <form action="cancel_booking.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">No pending bookings.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
