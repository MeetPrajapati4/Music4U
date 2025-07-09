<?php
session_start();
include "../Connection.php";
// Delete data
if (isset($_POST['songid']) && isset($_POST['userid'])) {
    $songid = $_POST['songid'];
    $userId = $_SESSION['LoggedInUserID']; // assuming user_id is stored in session

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM liked WHERE Liked_User_Id = ? AND Liked_Music_Id = ?");
    $stmt->bind_param("ii", $userId, $songid);

    // Execute the query
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
