
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
