<?php
session_start(); // Ensure session is started at the very top

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AutoTuneDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch user
    $sql = "SELECT UserID, Username, HashedPassword FROM userprofiles WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['HashedPassword'])) {
            // Set user_id in session
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];
            error_log("User ID set in session: " . $_SESSION['user_id']); // Debugging log

            // Set vehicle_id in session (you could select the first vehicle for now or get this from a vehicle selection page)
            // Assuming you have a list of vehicles that the user can choose from or a default vehicle
            $_SESSION['vehicle_id'] = 1;  // This is just an example; you can change this based on your logic

            header("Location: home.html"); // Redirect to homepage
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with the provided username.";
    }
    $stmt->close();
}

$conn->close();
?>
