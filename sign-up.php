<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "org_collab_and_events_data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $campus = $_POST['campus'];
    $college = $_POST['college'];
    $program = $_POST['program'];
    $major = $_POST['major'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($firstName) || empty($lastName) || empty($email) || empty($contact_no) || empty($campus) || empty($college) || empty($program) || empty($major) || empty($password) || empty($confirmPassword)) {
        die("All fields are required. Please fill out all fields.");
    }

    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, contact_no, campus, college, program, major, password, role)
            VALUES ('$firstName', '$lastName', '$email', '$contact_no', '$campus', '$college', '$program', '$major', '$hashedPassword', 'student')";

    if ($conn->query($sql) === TRUE) {
        echo "Sign-up successful! Redirecting to login...";
        header("Location: log-in_students.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>