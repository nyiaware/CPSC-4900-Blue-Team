<?php
include 'db_autotune.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['full_name_test'];
    $username = $_POST['username_test'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password === $confirmPassword) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data into the 'userprofiles' table
        $sql = "INSERT INTO userprofiles (FullName, Username, Email, HashedPassword, RegistrationDate) 
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fullName, $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Redirect back to sign_up_new.html with success message
            header("Location: sign_up_new.html?success=true");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Passwords do not match.";
    }
}

$conn->close();
?>
