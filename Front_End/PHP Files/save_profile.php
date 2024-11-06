/*******************************************************
 * File: save_profile.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTune
 *
 * Description:
 * This file handles the saving of user profile updates.
 * It processes the submitted form data, validates it, and updates 
 * the database accordingly.
 * 
 * Major Components:
 * - Session management: Ensures that the user is logged in and can only
 *   update their own profile.
 * - Database connection: Communicates with the MySQL database to update
 *   the user’s information.
 * - Data validation: Ensures that the form data is valid before being 
 *   saved.
 *
 * Revision History:
 *   [Date]: [Name]
 *      - Initial version created to handle profile updates.
 *   2024-11-06: Christian Morrow
 *      - Added session management for tracking logged-in users.
 *      - Implemented a check for user authentication by verifying 'user_id' in the session.
 *      - Redirected unauthorized users to the login page if session 'user_id' is not set.
 *      - Updated database connection process and error handling for consistency.
 *******************************************************/

 <?php
session_start();  // Start the session to access user information

// Include the database connection file, which should handle the connection
include 'db_autotune.php';

// Check if the user is logged in by verifying 'user_id' in session
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();  // Stop further execution
}

// Get the user_id from session
$user_id = $_SESSION['user_id'];

// Check if form data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve the form data
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);

    // Check if any email notification preferences are selected
    $urgent_services = isset($_POST['urgent_services']) ? 1 : 0;
    $monthly_reports = isset($_POST['monthly_reports']) ? 1 : 0;
    $maintenance_suggestions = isset($_POST['maintenance_suggestions']) ? 1 : 0;

    // SQL query to update user profile information in the database
    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', 
            urgent_services=$urgent_services, monthly_reports=$monthly_reports, 
            maintenance_suggestions=$maintenance_suggestions WHERE user_id=$user_id";

    // Execute the update query and handle errors
    if ($conn->query($sql) === TRUE) {
        // Redirect to the profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        // Output error if query fails
        echo "Error updating record: " . $conn->error;
    }
}

// No need to close the connection here as db_autotune.php handles it
?>
