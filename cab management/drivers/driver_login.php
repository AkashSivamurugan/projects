<?php
include '../db/db.php';

$name = $_POST['name'];

$sql = "SELECT * FROM drivers WHERE name='$name' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $driver = $result->fetch_assoc();
    $_SESSION['driver'] = $driver['id'];
    header('Location: driver_dashboard.php');
} else {
    echo "Invalid driver name";
}

$conn->close();
?>

