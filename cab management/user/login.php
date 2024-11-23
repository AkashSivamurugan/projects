<?php
include '../db/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    session_start();
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user['id'];
    header('Location: user_dashboard.php');
} else {
    echo "Invalid credentials";
}

$conn->close();
?>
