<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AutoTuneDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$fullName = $_POST['FullName'];
$username = $_POST['Username']; // Read-only in the form
$email = $_POST['Email'];
$password = isset($_POST['Password']) && !empty($_POST['Password']) ? password_hash($_POST['Password'], PASSWORD_BCRYPT) : null;

// Update query
$sql = "UPDATE userprofiles SET FullName = ?, Email = ?" . ($password ? ", HashedPassword = ?" : "") . " WHERE Username = ?";
$stmt = $conn->prepare($sql);

if ($password) {
    $stmt->bind_param("ssss", $fullName, $email, $password, $username);
} else {
    $stmt->bind_param("sss", $fullName, $email, $username);
}

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // Redirect to profile.php with success message
        header("Location: profile.php?success=true");
        exit();
    } else {
        echo "No changes made. Please ensure the provided username exists.";
    }
} else {
    echo "Error updating profile: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
