<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "org_collab_and_events_data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $user_type = sanitizeInput($_POST['user_type']);

    $sql = "SELECT * FROM users WHERE email = :email AND user_type = :user_type";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':user_type', $user_type);

    oci_execute($stmt);
    $user = oci_fetch_assoc($stmt);

    if ($user && password_verify($password, $user['PASSWORD'])) {
        echo "Login successful!";

        if ($user_type === 'student') {
            header("Location: homepage.html");
        } elseif ($user_type === 'admin') {
            header("Location: admin_dashboard.html");
        } elseif ($user_type === 'organization') {
            header("Location: org_dashboard.html");
        }
        exit;
    } else {
        echo "Invalid email, password, or user type.";
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>
