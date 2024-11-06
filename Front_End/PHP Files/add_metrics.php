/*******************************************************
 * File: add.metrics.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTunes
 *
 * Description:
 * This PHP script handles the insertion of vehicle performance metrics (fuel efficiency, engine health, and tire pressure)
 * into the database. It receives these values via a POST request and stores them in the 'metrics' table for a specific vehicle.
 * 
 * Major Components:
 * - Receives POST data (fuel efficiency, engine health, tire pressure) from a form submission.
 * - Inserts these values into the 'metrics' table in the database.
 * - Redirects the user to the vehicle history page after successful insertion.
 *
 * Usage Notes:
 * - This script assumes that vehicle_id is 1 for now, but should later be tied to a specific user via authentication.
 *
 * Revision History:
 *   - [Date]: Initial version created to handle adding vehicle metrics.
 *******************************************************/

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
