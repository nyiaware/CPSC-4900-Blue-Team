<?php
session_start();
header('Content-Type: application/json');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Debug session data
if (!isset($_SESSION['user_id'])) {
    error_log("Session data: " . print_r($_SESSION, true)); // Log session data
    echo json_encode(["success" => false, "message" => "User not logged in."]);
    exit();
}

$userId = $_SESSION['user_id']; // Get user_id from session

// Database connection
$conn = new mysqli("localhost", "root", "", "AutoTuneDB");
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Handle POST request
$data = json_decode(file_get_contents('php://input'), true);
$year = $data['year'] ?? null;
$make = $data['make'] ?? null;
$model = $data['model'] ?? null;

if ($year && $make && $model) {
    // Check if a vehicle already exists for the user
    $sql = "SELECT * FROM vehicle_info WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update existing vehicle
        $sql = "UPDATE vehicle_info SET year = ?, make = ?, model = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $year, $make, $model, $userId);
    } else {
        // Insert new vehicle
        $sql = "INSERT INTO vehicle_info (user_id, year, make, model) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $userId, $year, $make, $model);
    }

    $success = $stmt->execute();
    echo json_encode(["success" => $success, "message" => $success ? "Vehicle saved/updated successfully." : $stmt->error]);
} else {
    echo json_encode(["success" => false, "message" => "Invalid data provided."]);
}
 
$conn->close();
?>
