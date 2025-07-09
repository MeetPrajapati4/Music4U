<?php

include "../Connection.php";
// Assuming you're already connected to the database via $conn
if (isset($_POST['songid']) && isset($_POST['playlistid']) && isset($_POST['playlistname'])) {
    $songid = $_POST['songid'];
    $playlistid = $_POST['playlistid'];
    $playlistname = $_POST['playlistname'];

    if (!empty($songid) && !empty($playlistid) && !empty($playlistname)) {
        $checkSql = "SELECT * FROM playlistSongs WHERE List_Id = '$playlistid' AND Song_Id = '$songid'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            echo "Error: Song already exists in the playlist.";
        } else {
            // Insert the song into the playlist
            $sql = "INSERT INTO playlistSongs (List_Id, Song_Id, ListName) 
                VALUES ('$playlistid', '$songid', '$playlistname')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "success";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error: Missing required data.";
    }
}
