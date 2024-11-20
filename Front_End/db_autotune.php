<?php

// Prompt the user for database connection details in the CLI
$host = "localhost";
$user = "root";
$password = "";
$dbname = "AutoTuneDB";

// Create a new connection instance using MySQLi
$conn = new mysqli($host, $user, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) { // If there is a connection error
    // Display error message and stop further script execution
    die("Connection failed: " . $conn->connect_error);
}

// If connection is successful, display confirmation message
echo "Connected successfully\n";
?>