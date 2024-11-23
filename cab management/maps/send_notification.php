<?php
include 'db.php';

$user_id = 1; // Assuming user ID is 1 for simplicity
$driver_id = 1; // Assuming driver ID is 1 for simplicity

// Check driver location and notify user
$sql = "SELECT users.email, drivers.lat, drivers.lng 
        FROM users 
        JOIN bookings ON users.id = bookings.user_id 
        JOIN drivers ON bookings.driver_id = drivers.id 
        WHERE users.id = '$user_id' AND drivers.id = '$driver_id'";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

// Calculate distance to user's location (assuming user location is known)
$user_location = ['lat' => 12.9716, 'lng' => 77.5946]; // Example location
$driver_location = ['lat' => $data['lat'], 'lng' => $data['lng']];
$distance = calculateDistance($user_location, $driver_location);

if ($distance < 1) { // If driver is within 1 km
    mail($data['email'], "Your Cab is Nearby", "Your cab is almost at your pickup location!");
}

$conn->close();

function calculateDistance($loc1, $loc2) {
    $earth_radius = 6371; // in km
    $dLat = deg2rad($loc2['lat'] - $loc1['lat']);
    $dLng = deg2rad($loc2['lng'] - $loc1['lng']);
    $a = sin($dLat/2) * sin($dLat/2) +
        cos(deg2rad($loc1['lat'])) * cos(deg2rad($loc2['lat'])) *
        sin($dLng/2) * sin($dLng/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distance = $earth_radius * $c;
    return $distance;
}
?>
