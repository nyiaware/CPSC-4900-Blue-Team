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
