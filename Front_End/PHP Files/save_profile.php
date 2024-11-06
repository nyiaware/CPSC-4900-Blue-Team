/*******************************************************
 * File: save_profile.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTunes
 *
 * Description:
 * This PHP script handles updating a user's profile information in the database.
 * It allows the user to update fields such as first name, last name, email, and preferences.
 * 
 * Major Components:
 * - Receives POST data (user information and preferences) from a form submission.
 * - Updates the user's information in the 'users' table.
 * - Redirects the user to the profile page after successful update.
 *
 * Usage Notes:
 * - The script assumes user_id is 1 for now, but this should be dynamically fetched from the session once login is implemented.
 *
 * Revision History:
 *   - [Date]: Initial version created to handle profile updates.
 *******************************************************/

<?php
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $urgent_services = isset($_POST['urgent_services']) ? 1 : 0;
    $monthly_reports = isset($_POST['monthly_reports']) ? 1 : 0;
    $maintenance_suggestions = isset($_POST['maintenance_suggestions']) ? 1 : 0;
    $user_id = 1; // this will change once we tie everything together by user/pass.

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', urgent_services='$urgent_services', monthly_reports='$monthly_reports', maintenance_suggestions='$maintenance_suggestions' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully";
        header('Location: profile.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
