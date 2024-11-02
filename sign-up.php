<?php
$db_username = 'your_db_username';
$db_password = 'your_db_password';
$db_connection_string = 'your_db_connection_string';

try {
    $conn = oci_connect($db_username, $db_password, $db_connection_string);
    if (!$conn) {
        throw new Exception("Connection to database failed.");
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = sanitizeInput($_POST['firstName']);
    $lastName = sanitizeInput($_POST['lastName']);
    $email = sanitizeInput($_POST['email']);
    $contact_no = sanitizeInput($_POST['contact_no']);
    $campus = sanitizeInput($_POST['campus']);
    $college = sanitizeInput($_POST['college']);
    $program = sanitizeInput($_POST['program']);
    $major = sanitizeInput($_POST['major']);
    $password = sanitizeInput($_POST['password']);
    $confirmPassword = sanitizeInput($_POST['confirmPassword']);
    
    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, contact_no, campus, college, program, major, password)
            VALUES (:first_name, :last_name, :email, :contact_no, :campus, :college, :program, :major, :password)";

    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':first_name', $firstName);
    oci_bind_by_name($stmt, ':last_name', $lastName);
    oci_bind_by_name($stmt, ':email', $email);
    oci_bind_by_name($stmt, ':contact_no', $contact_no);
    oci_bind_by_name($stmt, ':campus', $campus);
    oci_bind_by_name($stmt, ':college', $college);
    oci_bind_by_name($stmt, ':program', $program);
    oci_bind_by_name($stmt, ':major', $major);
    oci_bind_by_name($stmt, ':password', $hashedPassword);

    if (oci_execute($stmt)) {
        echo "Signup successful!";
    } else {
        echo "Signup failed. Please try again.";
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>