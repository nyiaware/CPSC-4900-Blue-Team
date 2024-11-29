<?php
include 'db_autotune.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs
    $fullName = $_POST['FullName'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    $userId = $_SESSION['UserID'];

    $sql = "UPDATE userprofiles SET FullName = ?, Username = ?, Email = ?" . 
           (!empty($password) ? ", HashedPassword = ?" : "") . 
           " WHERE UserID = ?";
    $stmt = $conn->prepare($sql);

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssssi", $fullName, $username, $email, $hashedPassword, $userId);
    } else {
        $stmt->bind_param("sssi", $fullName, $username, $email, $userId);
    }

    // Execute the query
    if ($stmt->execute()) {

        header("Location: profile.html?success=true");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
