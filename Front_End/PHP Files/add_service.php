/*******************************************************
 * File: add_service.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTunes
 *
 * Description:
 * This PHP script handles the insertion of service parts for a vehicle into the 'services' table in the database.
 * It receives service part details (part name, part number) via a POST request and stores them in the database for a specific vehicle.
 * 
 * Major Components:
 * - Receives POST data (part name, part number) from a form submission.
 * - Inserts these values into the 'services' table.
 * - Redirects the user to the services page after successful insertion.
 *
 * Usage Notes:
 * - This script assumes that vehicle_id is 1 for now, but should later be tied to a specific user via authentication.
 *
 * Revision History:
 *   - [Date]: Initial version created to handle adding vehicle services.
 *******************************************************/

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
