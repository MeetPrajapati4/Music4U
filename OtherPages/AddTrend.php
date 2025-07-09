<?php
session_start();
include "../Connection.php";

// Insert data
if (isset($_POST['songid']) && isset($_POST['userid'])) {
    $songid = $_POST['songid'];
    $userId = $_POST['userid'];

    // Check if song is already in Trend table
    $sql = "SELECT * FROM Trend WHERE TSong_Id = '$songid' AND TUser_Id = '$userId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "already";
    } else {
        // Prepare SQL query to insert the data
        $sql = "INSERT INTO Trend (TSong_Id, TUser_Id) VALUES ('$songid', '$userId')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // echo "success";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Close the connection
mysqli_close($conn);
