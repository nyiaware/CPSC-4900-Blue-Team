/*******************************************************
 * File: add_vehicle.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTunes
 *
 * Description:
 * This PHP script handles the insertion of a new service part for a specific vehicle. It checks if the user is logged in,
 * retrieves the necessary vehicle and part details, and inserts them into the 'services' table.
 * 
 * Major Components:
 * - Receives POST data (part name, part number, vehicle id) from a form submission.
 * - Inserts these values into the 'services' table.
 * - Redirects the user to the services page after successful insertion.
 * - Ensures the user is logged in via session management.
 *
 * Usage Notes:
 * - This script should be updated to handle vehicle_id dynamically based on user login.
 *
 * Revision History:
 *   - [Date]: Initial version created to handle adding service parts.
 *******************************************************/

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

        $stmt->close();
    } else {
        echo "User is not logged in.";
    }

    $conn->close();
}
?>