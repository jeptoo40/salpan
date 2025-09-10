<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json"); 
include "connect.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $service  = trim($_POST['service'] ?? '');
    $date     = $_POST['date'] ?? '';
    $time     = $_POST['time'] ?? '';


    if (!$fullname || !$email || !$service || !$date || !$time) {
        echo json_encode(["success" => false, "message" => "All fields are required"]);
        exit;
    }

    
    $stmt = $conn->prepare("INSERT INTO bookings (fullname, email, service, date, time) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("sssss", $fullname, $email, $service, $date, $time);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Booking saved successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
