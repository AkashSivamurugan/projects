<?php
include '../db/db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$location = $_POST['location'];
$model = $_POST['model'];
$license_plate = $_POST['license_plate'];
$capacity = $_POST['capacity'];

// Check if email already exists
$email_check_sql = "SELECT * FROM drivers WHERE email='$email'";
$email_check_result = $conn->query($email_check_sql);
if ($email_check_result->num_rows > 0) {
    echo "Email already registered. Please use a different email.";
    $conn->close();
    exit();
}

// Insert driver details into drivers table
$sql_driver = "INSERT INTO drivers (name, email, password, location, available) 
               VALUES ('$name', '$email', '$password', '$location', 1)";

if ($conn->query($sql_driver) === TRUE) {
    $driver_id = $conn->insert_id;
    // Insert cab details into cabs table
    $sql_cab = "INSERT INTO cabs (driver_id, model, license_plate, capacity, available) 
                VALUES ('$driver_id', '$model', '$license_plate', '$capacity', 1)";
    
    if ($conn->query($sql_cab) === TRUE) {
        // Insert pickup and dropoff locations into cab_locations table
        $pickup_location = $location; // Assuming pickup location is the driver's location
        $dropoff_location = $location; // Assuming dropoff location is the driver's location
        $price = 100; // Set a default price or calculate as needed
        $sql_cab_location = "INSERT INTO cab_locations (driver_id, pickup_location, dropoff_location, price) 
                             VALUES ('$driver_id', '$pickup_location', '$dropoff_location', '$price')";
        
        if ($conn->query($sql_cab_location) === TRUE) {
            echo "Driver and Cab registered successfully.";
            header('Location: driver_login.html');
            exit();
        } else {
            echo "Error: " . $sql_cab_location . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_cab . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql_driver . "<br>" . $conn->error;
}

$conn->close();
?>
