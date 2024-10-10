<?php
session_start();
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $part_name = $_POST['part_name'];
    $part_number = $_POST['part_number'];
    $vehicle_id = $_POST['vehicle_id'];


    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];


        $stmt = $conn->prepare("INSERT INTO services (vehicle_id, part_name, part_number) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $vehicle_id, $part_name, $part_number);

        // Execute the query
        if ($stmt->execute()) {
            header('Location: services.html');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close()
    } else {
        echo "User is not logged in.";
    }

    $conn->close();
}
?>
