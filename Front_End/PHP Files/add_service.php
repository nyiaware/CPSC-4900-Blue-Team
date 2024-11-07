<?php
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $part_name = $_POST['part_name'];
    $part_number = $_POST['part_number'];
    $vehicle_id = 1;  // this will change once we tie everything together by user/pass.

    $sql = "INSERT INTO services (vehicle_id, part_name, part_number) 
            VALUES ('$vehicle_id', '$part_name', '$part_number')";

    if ($conn->query($sql) === TRUE) {
        echo "Service added successfully";
        header('Location: services.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
