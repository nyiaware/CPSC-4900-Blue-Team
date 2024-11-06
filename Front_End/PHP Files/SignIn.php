/*******************************************************
 * File: SignIn.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTunes
 *
 * Description:
 * This PHP script handles user authentication via username and password.
 * It fetches user details from the database and verifies the password using password_hash.
 * 
 * Major Components:
 * - Receives POST data (username, password) from a form submission.
 * - Fetches user details from the 'users' table.
 * - Verifies password using password_verify.
 * - Displays appropriate login status messages.
 *
 * Revision History:
 *   [Date]: Derika Rice
 *      - Initial version created to handle user sign-in.
 *   2024-11-06: Christian Morrow
 *      - Removed the redundant $conn = new mysqli(...) line.
 *      - Removed the duplicated query ($result = $conn->query("SELECT * FROM users WHERE username='$username'");).
 *      - Added session management (session_start() and setting session variables).
 *      - Handled user redirection after successful login (using header('Location: profile.html');).
 *******************************************************/

<?php
session_start();    // Start the session to track user login

// Database connection
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Check if the username exists in the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    // Fetch the user by username
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

         // Verify the password
         if (password_verify($password, $user['password'])) {
            // Start a session and store user information
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to the user's dashboard or homepage
            header('Location: profile.html');
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>
