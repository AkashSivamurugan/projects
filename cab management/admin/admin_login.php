<?php
include '../db/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admins WHERE username='$username' AND password='$password' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $admin = $result->fetch_assoc();
    $_SESSION['admin'] = $admin['id'];
    header('Location: admin_dashboard.php');
} else {
    echo "Invalid credentials";
}

$conn->close();
?>
