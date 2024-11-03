<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; // Update if you have a different password
$dbname = "org_collab_and_events_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['email'] = $email; // Store user session
        header("Location: homepage.html"); // Redirect to a dashboard page
        exit();
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "Invalid email or password.";
}

$stmt->close();
$conn->close();
?>