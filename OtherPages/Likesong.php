<?php
session_start();

include "../Connection.php";
// Insert data
if (isset($_POST['songid']) && isset($_SESSION['LoggedInUserID'])) {
    $songid = $_POST['songid'];
    $userId = $_SESSION['LoggedInUserID']; // assuming user_id is stored in session

    // Prepare SQL query to insert the data
    $sql = "INSERT INTO liked (Liked_User_Id, Liked_Music_Id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $songid);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Song liked successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<script>alert('Missing data!');</script>";
}
$conn->close();
