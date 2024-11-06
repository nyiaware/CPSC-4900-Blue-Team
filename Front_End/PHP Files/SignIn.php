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
 *   - [Date]: Initial version created to handle user sign-in.
 *******************************************************/

<?php

// Database connection
$conn = new mysqli('localhost', 'root', '', 'userdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Fetch the user by username
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            // Start a session and redirect to the user's dashboard or homepage
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}

$conn->close();
?>
