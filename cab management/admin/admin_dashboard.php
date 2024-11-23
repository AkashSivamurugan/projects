<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: admin_login.html');
    exit();
}

include '../db/db.php';

// Fetch all users
$users_sql = "SELECT * FROM users";
$users_result = $conn->query($users_sql);

// Fetch all drivers
$drivers_sql = "SELECT * FROM drivers";
$drivers_result = $conn->query($drivers_sql);

// Fetch all bookings
$bookings_sql = "SELECT * FROM bookings";
$bookings_result = $conn->query($bookings_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
            <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Admin Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Admin Dashboard</h2>

        <!-- Manage Users -->
        <h3>Manage Users</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Manage Drivers -->
        <h3>Manage Drivers</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($driver = $drivers_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $driver['name']; ?></td>
                        <td><?php echo $driver['email']; ?></td>
                        <td><?php echo $driver['available'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="edit_driver.php?id=<?php echo $driver['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_driver.php?id=<?php echo $driver['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Manage Bookings -->
        <h3>Manage Bookings</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pickup</th>
                    <th>Dropoff</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Driver</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $bookings_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $booking['pickup']; ?></td>
                        <td><?php echo $booking['dropoff']; ?></td>
                        <td><?php echo $booking['date']; ?></td>
                        <td><?php echo $booking['time']; ?></td>
                        <td><?php echo $booking['status']; ?></td>
                        <td><?php echo $booking['driver_id']; ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?php echo $booking['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_booking.php?id=<?php echo $booking['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
