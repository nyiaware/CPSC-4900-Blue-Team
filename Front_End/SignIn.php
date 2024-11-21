<?php
include 'db_autotune.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Retrieve hashed password from database
    $sql = "SELECT * FROM UserProfiles WHERE Username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the hashed password
        if (password_verify($password, $row['HashedPassword'])) {
            // Start a session if needed
            session_start();
            $_SESSION['username'] = $row['Username']; // Store username in session
            $_SESSION['full_name'] = $row['FullName']; // Store full name in session (optional)

            // Redirect to home.html
            header("Location: home.html");
            exit(); // Stop further execution to ensure the redirect happens
        } else {
            // Redirect back to sign_in.html with an error message for invalid password
            header("Location: sign_in.html?error=invalid_password");
            exit();
        }
    } else {
        // Redirect back to sign_in.html with an error message for no user found
        header("Location: sign_in.html?error=user_not_found");
        exit();
    }
}
mysqli_close($conn);
?>
