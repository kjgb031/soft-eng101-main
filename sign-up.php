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

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign-up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style_signup.css">
</head>
<body>
    <div class="form-container">
        <img src="images/BPSU-weblogo.png" alt="BPSU Student Organization Collaboration and Events Management">
        <form method="POST" action="sign-up.php" onsubmit="return validateForm()">
            <div class="form-row">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="first_name" required> <!-- Updated to match PHP variable -->
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="last_name" required> <!-- Updated to match PHP variable -->
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact_no">Contact Number</label>
                    <input type="text" id="contact_no" name="contact_number" required> <!-- Updated to match PHP variable -->
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="campus">Campus</label>
                    <select class="dropdown-signup" id="campus" name="campus" onchange="updateColleges()">
                        <option value="">Select Campus</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="college">College</label>
                    <select class="dropdown-signup" id="college" name="college" onchange="updatePrograms()">
                        <option value="">Select College</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="program">Program</label>
                    <select class="dropdown-signup" id="program" name="program" onchange="updateMajors()">
                        <option value="">Select Program</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="major">Major</label>
                    <select class="dropdown-signup" id="major" name="major">
                        <option value="">Select Major</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" required>
                </div>
            </div>
            <span id="passwordError" style="color: red; display: none;">Passwords do not match.</span>

            <button type="submit" class="submit-btn">Sign Up</button>
            <p>Already have an account? <a href="login_students.php" class="log-text">Log-in</a></p>
        </form>
    </div>
    <script src="sign_up.js" async defer></script>
</body>
</html>