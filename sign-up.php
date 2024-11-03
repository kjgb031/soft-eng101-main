<?php
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

// Get form data with error handling
$firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$contact_number = isset($_POST['contact_number']) ? $_POST['contact_number'] : '';
$campus = isset($_POST['campus']) ? $_POST['campus'] : '';
$college = isset($_POST['college']) ? $_POST['college'] : '';
$program = isset($_POST['program']) ? $_POST['program'] : '';
$major = isset($_POST['major']) ? $_POST['major'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into users table
$sql_users = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
$sql_users->bind_param("ssss", $firstName, $lastName, $email, $hashed_password);

if ($sql_users->execute() === TRUE) {
    // Get the last inserted user ID
    $user_id = $conn->insert_id;

    // Insert into student_data table
    $sql_student_data = $conn->prepare("INSERT INTO student_data (campus, college, program, major, contact_number, user_id) VALUES (?, ?, ?, ?, ?, ?)");
    $sql_student_data->bind_param("sssssi", $campus, $college, $program, $major, $contact_number, $user_id);

    if ($sql_student_data->execute()) {
        // Successful sign-up, redirect to log-in page
        header("Location: log-in_students.html");
        exit();
    } else {
        echo "Error: " . $sql_student_data->error;
    }

    $sql_student_data->close(); // Close the student data statement
} else {
    echo "Error: " . $sql_users->error; // Show any errors with the user insert
}

$sql_users->close(); // Close the users statement
$conn->close(); // Close the database connection
?>