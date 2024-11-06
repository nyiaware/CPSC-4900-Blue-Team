<?php
/**
 * File: db_autotune.php
 * Author: Nyia Ware
 * Project: AutoTune
 * 
 * Description:
 * This PHP script establishes a connection to the AutoTune database using MySQLi.
 * The script includes:
 *   - Prompts for host, user, password, and database name for the connection
 *   - A connection attempt with error handling to ensure the database is accessible
 *   - A success message confirming the connection when successful
 * 
 * Usage Notes:
 *   - This file should be included in other PHP files that require database access.
 *   - Ensure the database connection details (host, user, password, dbname) are set correctly
 *     for the environment (e.g., development, production).
 *   - To prevent potential security risks, avoid hardcoding sensitive details in production code.
 *
 * Revision History:
 *   - 2024-11-03: Nyia Ware
 *     Initial connection script created.
 *   - 2024-11-03: Christian Morrow
 *     Updates: 
 *          * Added test to check that the connection to the database is successful, displaying
 *            a confirmation message if connected or an error message otherwise.
 *          * Added prompts to input database connection details (host, user, password, dbname) 
 *            when the script is run.
 */

// Prompt the user for database connection details in the CLI
$host = readline("Enter the database host (e.g., localhost): ");
$user = readline("Enter the database username: ");
$password = readline("Enter the database password: ");
$dbname = readline("Enter the database name: ");

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