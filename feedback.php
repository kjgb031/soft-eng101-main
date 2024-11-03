<?php
// Include your database connection file
include 'db_connection.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];
    $rating = $_POST['rating'];

    // Check that the rating is within the accepted range
    if ($rating >= 1 && $rating <= 5) {
        try {
            // Prepare SQL statement to insert or update the rating
            $stmt = $pdo->prepare("INSERT INTO ratings (user_id, event_id, rating) VALUES (:user_id, :event_id, :rating) 
                ON DUPLICATE KEY UPDATE rating = :rating");
            
            // Bind parameters
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

            // Execute the query
            if ($stmt->execute()) {
                echo "Rating submitted successfully!";
            } else {
                echo "Failed to submit rating.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Rating must be between 1 and 5.";
    }
}
?>