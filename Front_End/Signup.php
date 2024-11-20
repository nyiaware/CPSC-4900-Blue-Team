<?php
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST); // Display the entire $_POST array for debugging
    echo "</pre>";

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name_test']);
    $username = mysqli_real_escape_string($conn, $_POST['username_test']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO UserProfiles (FullName, Username, HashedPassword, Email) VALUES ('$full_name', '$username', '$hashed_password', '$email')";

        if (mysqli_query($conn, $sql)) {
            echo "Registration successful. <a href='sign_in.html'>Sign In</a>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Passwords do not match.";
    }
}
mysqli_close($conn);
?>
