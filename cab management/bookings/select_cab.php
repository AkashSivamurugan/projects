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

// Fetch available cabs that match the selected pickup location
$sql = "SELECT c.id, d.name AS driver_name, c.model, c.license_plate, c.capacity, l.price
        FROM cabs c
        JOIN drivers d ON c.driver_id = d.id
        JOIN cab_locations l ON d.id = l.driver_id
        WHERE ('$pickup' = d.location OR '$pickup' = l.pickup_location)
        AND d.available = 1
        AND c.available = 1";

$result = $conn->query($sql);

if ($result === FALSE) {
    echo "Error in SQL query: " . $conn->error;
} else {
    $cabs = [];
    while ($cab = $result->fetch_assoc()) {
        $cabs[] = $cab;
    }
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
                <li class="nav-item"><a class="nav-link" href="track_ride.php">Track Ride</a></li>
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
                            <h5 class="card-title">Driver: <?php echo $cab['driver_name']; ?></h5>
                            <p class="card-text"><strong>Model:</strong> <?php echo $cab['model']; ?></p>
                            <p class="card-text"><strong>License Plate:</strong> <?php echo $cab['license_plate']; ?></p>
                            <p class="card-text"><strong>Capacity:</strong> <?php echo $cab['capacity']; ?> passengers</p>
                            <p class="card-text"><strong>Price:</strong> ₹<?php echo $cab['price']; ?></p>
                            <p class="card-text"><strong>Info:</strong> Available for pickup at <?php echo $pickup; ?></p>
                            <form action="book_ride.php" method="POST">
                                <input type="hidden" name="pickup" value="<?php echo $pickup; ?>">
                                <input type="hidden" name="dropoff" value="<?php echo $dropoff; ?>">
                                <input type="hidden" name="date" value="<?php echo $date; ?>">
                                <input type="hidden" name="time" value="<?php echo $time; ?>">
                                <input type="hidden" name="driver_id" value="<?php echo $cab['id']; ?>">
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">No cabs available for the selected pickup location.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
