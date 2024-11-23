<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cab Booking</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h2>Book a Cab</h2>
    <form action="book_ride.php" method="POST">
        <label for="pickup">Pickup Location:</label>
        <select id="pickup" name="pickup" required>
            <option value="" disabled selected>Select Pickup Location</option>
            <?php
            include '../db/db.php';
            $result = $conn->query("SELECT name FROM Location");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>

        <label for="dropoff">Dropoff Location:</label>
        <select id="dropoff" name="dropoff" required>
            <option value="" disabled selected>Select Dropoff Location</option>
            <?php
            $result = $conn->query("SELECT name FROM Location");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
            }
            $conn->close();
            ?>
        </select>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <button type="submit">Book Cab</button>
    </form>
</body>
</html>