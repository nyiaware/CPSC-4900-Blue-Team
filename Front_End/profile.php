<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: sign_in.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "AutoTuneDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedInUsername = $_SESSION['username']; // Username stored during login

// Fetch user details
$fullName = $username = $email = ""; // Initialize variables

$sql = "SELECT FullName, Username, Email FROM userprofiles WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUsername);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fullName = $user['FullName'];
        $username = $user['Username'];
        $email = $user['Email'];
    } else {
        echo "No user found.";
        exit();
    }
} else {
    echo "Database query failed: " . $conn->error;
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            background-color: #eaecef;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #333;
        }

        .message {
            color: green;
            margin-bottom: 15px;
            display: none; /* Hidden by default */
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .btn {
            background-color: #8ebefd;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #6ea2e7;
        }

        .link {
            display: block;
            margin-top: 10px;
            font-size: 0.9em;
            text-decoration: none;
            color: #333;
        }

        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h2>Update Your Profile</h2>
        
        <!-- Success Message -->
        <p id="successMessage" class="message">Your information has been updated successfully!</p>

        <form method="POST" action="save_profile.php">
            <input type="text" name="FullName" class="input-field" placeholder="Full Name" value="<?php echo htmlspecialchars($fullName); ?>" required>
            <input type="text" name="Username" class="input-field" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" readonly required>
            <input type="email" name="Email" class="input-field" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
            <input type="password" name="Password" class="input-field" placeholder="New Password (not required)">
            <button type="submit" class="btn">Save Changes</button>
        </form>
        <a href="home.html" class="link">Cancel</a>
    </div>

    <script>
        // Display success message if ?success=true is in the URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === 'true') {
            document.getElementById('successMessage').style.display = 'block';
        }
    </script>

</body>
</html>
