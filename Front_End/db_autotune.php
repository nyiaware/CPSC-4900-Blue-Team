<?php

$servername = "localhost";
$username = "root";
$password = "password"; // enter your personal password until we get everything settled.
$dbname = "autotune";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
