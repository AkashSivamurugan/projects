<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../user/login.html');
    exit();
}

include '../db/db.php';

$pickup = $_POST['pickup'];
$dropoff = $_POST['dropoff'];
$date = $_POST['date'];
$time = $_POST['time'];

// Fetch available cabs for the selected locations
$sql = "SELECT d.id, d.name, d.available, l.price 
        FROM drivers d 
        JOIN cab_locations l ON d.location_id = l.location_id 
        WHERE l.pickup_location = '$pickup' AND l.dropoff_location = '$dropoff' AND d.available = 1";
$result = $conn->query($sql);
$cabs = [];
while ($cab = $result->fetch_assoc()) {
    $cabs[] = $cab;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Cab</title>
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
                <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../user/user_dashboard.php">User Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../bookings/track_ride.php">Track Ride</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Select Your Cab</h2>
        <p>Pickup: <?php echo $pickup; ?> | Dropoff: <?php echo $dropoff; ?></p>

        <?php if (!empty($cabs)): ?>
            <div class="card-columns">
                <?php foreach ($cabs as $cab): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Driver: <?php echo $cab['name']; ?></h5>
                            <p class="card-text"><strong>Price:</strong> ₹<?php echo $cab['price']; ?></p>
                            <p class="card-text"><strong>Availability:</strong> <?php echo $cab['available'] ? 'Available' : 'Not Available'; ?></p>
                            <form action="book_ride.php" method="POST">
                                <input type="hidden" name="pickup" value="<?php echo $pickup; ?>">
                                <input type="hidden" name="dropoff" value="<?php echo $dropoff; ?>">
                                <input type="hidden" name="date" value="<?php echo $date; ?>">
                                <input type="hidden" name="time" value="<?php echo $time; ?>">
                                <input type="hidden" name="driver_id" value="<?php echo $cab['id']; ?>">
                                <button type="submit" class="btn btn-primary">Select Cab</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">No cabs available for the selected locations and time.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
