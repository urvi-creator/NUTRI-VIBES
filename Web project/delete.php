<?php
    // Start the session
    session_start();

    // Include your database connection file
    include 'connect.php';

    // Get the user ID from the session
    $userid = $_SESSION['userid'];

    // Prepare the SQL statement
    $stmt = $connect->prepare("DELETE FROM registration WHERE id = ?");

    // Bind the user ID to the SQL statement
    $stmt->bind_param("i", $userid);

    // Execute the SQL statement
    $result = $stmt->execute();

    if ($result) {
        // Destroy the session and redirect to another page after successful deletion
        session_destroy();
        header("Location: Sign up.php");
    } else {
        // Display an error message if the deletion failed
        echo "Error: " . $stmt->error;
    }
?>
