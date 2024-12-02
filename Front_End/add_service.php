<?php
// Include the database connection
include 'db_autotune.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $service_name = $_POST['service_name'];
    $part_name = $_POST['part_name'];
    $part_number = $_POST['part_number'];
    $vehicle_id = 1;  // Placeholder, this should be dynamically set based on the user's vehicle

    // Prepare the SQL query to insert service data into the database
    $sql = "INSERT INTO services (vehicle_id, service_name, part_name, part_number) 
            VALUES ('$vehicle_id', '$service_name', '$part_name', '$part_number')";

    // Execute the query and check if the insertion was successful
    if ($conn->query($sql) === TRUE) {
        // If successful, redirect to services.html
        header('Location: services.html');
        exit();
    } else {
        // If there was an error, display the error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
