<?php
include '../db/db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Check if username or email already exists
$check_sql = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    echo "Username or Email already exists. Please try a different one.";
} else {
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
