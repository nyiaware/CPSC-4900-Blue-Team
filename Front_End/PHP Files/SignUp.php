/*******************************************************
 * File: SignUp.php
 * Author: [Your Name]
 * Co-Author(s): [List any other contributors]
 * Project: AutoTunes
 *
 * Description:
 * This PHP script handles user registration by accepting username, email, and password.
 * It checks if the username or email already exists in the database, and inserts a new user record if they do not.
 * 
 * Major Components:
 * - Receives POST data (username, email, password) from a form submission.
 * - Checks if the username or email already exists in the 'users' table.
 * - Inserts a new user into the 'users' table if username and email are unique.
 *
 * Revision History:
 *   - [Date]: Initial version created to handle user sign-up.
 *******************************************************/

<?php

// Database connection
$conn = new mysqli('localhost', 'root', '', 'db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username or email already exists
    $check_user = $conn->query("SELECT * FROM users WHERE username='$username' OR email='$email'");

    if ($check_user->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        // Insert the new user
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
