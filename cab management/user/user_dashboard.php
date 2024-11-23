<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit();
}

include '../db/db.php';
$user_id = $_SESSION['user'];

// Fetch the user's booking history in descending order
$sql = "SELECT bookings.*, drivers.name AS driver_name FROM bookings 
        JOIN drivers ON bookings.driver_id = drivers.id 
        WHERE bookings.user_id='$user_id' ORDER BY bookings.booked_at DESC";
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
    <title>User Dashboard</title>
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
                <li class="nav-item"><a class="nav-link" href="user_dashboard.php">User Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../bookings/track_ride.php">Track Ride</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Welcome, User</h2>

        <!-- Booking Form -->
        <h3>Book a Cab</h3>
        <form action="../bookings/select_cab.php" method="POST">
            <div class="form-group">
                <label for="pickup">Pickup Location:</label>
                <select class="form-control" id="pickup" name="pickup" required>
                    <option value="" disabled selected>Select Pickup Location</option>
                    <?php
                    include '../db/db.php';
                    $result = $conn->query("SELECT DISTINCT name FROM Location");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dropoff">Dropoff Location:</label>
                <select class="form-control" id="dropoff" name="dropoff" required>
                    <option value="" disabled selected>Select Dropoff Location</option>
                    <?php
                    $result = $conn->query("SELECT DISTINCT name FROM Location");
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" class="form-control" id="time" name="time" required>
            </div>
            <button type="submit" class="btn btn-primary">Next</button>
        </form>

        <!-- Ride History -->
        <h3>Your Ride History:</h3>
        <?php if (!empty($bookings)): ?>
            <div class="list-group">
                <?php foreach ($bookings as $booking): ?>
                    <div class="list-group-item">
                        <h5 class="mb-1">Booking ID: <?php echo $booking['booking_id']; ?></h5>
                        <p class="mb-1"><strong>Driver:</strong> <?php echo $booking['driver_name']; ?></p>
                        <p class="mb-1"><strong>Pickup:</strong> <?php echo $booking['pickup']; ?></p>
                        <p class="mb-1"><strong>Dropoff:</strong> <?php echo $booking['dropoff']; ?></p>
                        <p class="mb-1"><strong>Date:</strong> <?php echo $booking['date']; ?></p>
                        <p class="mb-1"><strong>Time:</strong> <?php echo $booking['time']; ?></p>
                        <p class="mb-1"><strong>Status:</strong> <?php echo ucfirst($booking['status']); ?></p>
                        <p class="mb-1"><small class="text-muted">Booked At: <?php echo $booking['booked_at']; ?></small></p>
                        <?php if ($booking['status'] == 'pending'): ?>
                            <form action="../bookings/cancel_booking.php" method="POST" style="display:inline;">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">No ride history available.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
