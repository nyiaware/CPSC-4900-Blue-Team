<?php
session_start();
 
include 'db_autotune.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);

    $urgent_services = isset($_POST['urgent_services']) ? 1 : 0;
    $monthly_reports = isset($_POST['monthly_reports']) ? 1 : 0;
    $maintenance_suggestions = isset($_POST['maintenance_suggestions']) ? 1 : 0;

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', 
            urgent_services=$urgent_services, monthly_reports=$monthly_reports, 
            maintenance_suggestions=$maintenance_suggestions WHERE user_id=$user_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>