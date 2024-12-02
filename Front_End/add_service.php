<?php
// Include the database connection
include 'db_autotune.php';

// Start the session to access session variables
session_start();

// Function to load service names from .txt files
function loadServicesFromFiles() {
    $services = [];
    
    // Define the service files
    $serviceFiles = [
        'Silverado_oilchange.txt',
        'Silverado_tirerotation.txt',
        'Silverado_batteryreplacement.txt',
        'Camaro_oilchange.txt',
        'Camaro_tirerotation.txt',
        'Camaro_batteryreplacement.txt',
        'Equinox_oilchange.txt',
        'Equinox_tirerotation.txt',
        'Equinox_batteryreplacement.txt',
        'Accord_oilchange.txt',
        'Accord_tirerotation.txt',
        'Accord_batteryreplacement.txt',
        'Civic_oilchange.txt',
        'Civic_tirerotation.txt',
        'Civic_batteryreplacement.txt',
        'CRV_oilchange.txt',
        'CRV_tirerotation.txt',
        'CRV_batteryreplacement.txt',
        'Camry_oilchange.txt',
        'Camry_tirerotation.txt',
        'Camry_batteryreplacement.txt',
        'Corolla_oilchange.txt',
        'Corolla_tirerotation.txt',
        'Corolla_batteryreplacement.txt',
        'Highlander_oilchange.txt',
        'Highlander_tirerotation.txt',
        'Highlander_batteryreplacement.txt'
    ];

    // Loop through the files and load service names
    foreach ($serviceFiles as $file) {
        if (file_exists($file)) {
            $fileContent = file_get_contents($file);
            // Trim any extra whitespace and add it to the services array
            $services[] = trim($fileContent);
        } else {
            echo "Error: File $file not found.<br>";
        }
    }

    return $services;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $service_name = $_POST['service_name'];
    $part_name = $_POST['part_name'];
    $part_number = $_POST['part_number'];

    // Check if the user is logged in and their vehicle_id is available in the session
    if (isset($_SESSION['vehicle_id'])) {
        $vehicle_id = $_SESSION['vehicle_id'];
    } else {
        // Fallback if no vehicle_id is available (e.g., redirect to login or error page)
        echo "Error: Vehicle ID is not set.";
        exit();
    }

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
