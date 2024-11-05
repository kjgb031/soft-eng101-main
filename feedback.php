<?php
// Include your database connection
$dbname = "org_collab_and_events_data";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] === 'submit') {
    $user_id = $_POST['user_id']; // Ensure user_id is provided by the form or session
    $event_id = $_POST['event_id']; // Ensure event_id is provided by the form

    // Capture all question ratings and comments
    $question_01 = $_POST['question_01'];
    $question_02 = $_POST['question_02'];
    $question_03 = $_POST['question_03'];
    $question_04 = $_POST['question_04'];
    $question_05 = $_POST['question_05'];
    $question_06 = $_POST['question_06'];
    $question_07 = $_POST['question_07'];
    $question_08 = $_POST['question_08'];
    $question_09 = $_POST['question_09'];
    $question_10 = $_POST['question_10'];
    $question_11 = $_POST['question_11'];
    $question_12 = $_POST['question_12'];
    $question_13 = $_POST['question_13'];
    $question_14 = $_POST['question_14'];
    $question_15 = $_POST['question_15'];
    $comments = $_POST['comments'];

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO feedbacks (
            user_id, event_id, question_01, question_02, question_03, question_04, question_05, question_06, question_07, question_08,
            question_09, question_10, question_11, question_12, question_13, question_14, question_15, comments
        ) VALUES (
            :user_id, :event_id, :question_01, :question_02, :question_03, :question_04, :question_05, :question_06, :question_07, :question_08,
            :question_09, :question_10, :question_11, :question_12, :question_13, :question_14, :question_15, :comments
        )");

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':question_01', $question_01, PDO::PARAM_INT);
        $stmt->bindParam(':question_02', $question_02, PDO::PARAM_INT);
        $stmt->bindParam(':question_03', $question_03, PDO::PARAM_INT);
        $stmt->bindParam(':question_04', $question_04, PDO::PARAM_INT);
        $stmt->bindParam(':question_05', $question_05, PDO::PARAM_INT);
        $stmt->bindParam(':question_06', $question_06, PDO::PARAM_INT);
        $stmt->bindParam(':question_07', $question_07, PDO::PARAM_INT);
        $stmt->bindParam(':question_08', $question_08, PDO::PARAM_INT);
        $stmt->bindParam(':question_09', $question_09, PDO::PARAM_INT);
        $stmt->bindParam(':question_10', $question_10, PDO::PARAM_INT);
        $stmt->bindParam(':question_11', $question_11, PDO::PARAM_INT);
        $stmt->bindParam(':question_12', $question_12, PDO::PARAM_INT);
        $stmt->bindParam(':question_13', $question_13, PDO::PARAM_INT);
        $stmt->bindParam(':question_14', $question_14, PDO::PARAM_INT);
        $stmt->bindParam(':question_15', $question_15, PDO::PARAM_INT);
        $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: student_dashboard.html"); // Redirect to homepage
            exit();
        } else {
            echo "Failed to submit feedback.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect if not a valid form submission
    header("Location: student_dashboard.html");
    exit();
}
?>