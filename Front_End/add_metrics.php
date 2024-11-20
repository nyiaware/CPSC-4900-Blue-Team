<?php
include 'db_autotune.php';
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fuel_efficiency = $_POST['fuel_efficiency'];
    $engine_health = $_POST['engine_health'];
    $tire_pressure = $_POST['tire_pressure'];
    $vehicle_id = 1;  // this will change once we tie everything together by user/pass.

    $sql = "INSERT INTO metrics (vehicle_id, fuel_efficiency, engine_health, tire_pressure, metric_date) 
            VALUES ('$vehicle_id', '$fuel_efficiency', '$engine_health', '$tire_pressure', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Metrics added successfully";
        header('Location: vehicle_history.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
