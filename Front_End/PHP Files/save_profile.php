<?php
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $urgent_services = isset($_POST['urgent_services']) ? 1 : 0;
    $monthly_reports = isset($_POST['monthly_reports']) ? 1 : 0;
    $maintenance_suggestions = isset($_POST['maintenance_suggestions']) ? 1 : 0;
    $user_id = 1; // this will change once we tie everything togehter by user/pass.

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', urgent_services='$urgent_services', monthly_reports='$monthly_reports', maintenance_suggestions='$maintenance_suggestions' WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully";
        header('Location: profile.html');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
