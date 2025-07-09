<?php
session_start();
include "../Connection.php";

if (isset($_POST['songid']) && isset($_POST['playlistid']) && isset($_POST['playlistname'])) {
    $songid = $_POST['songid'];
    $playlistId = $_POST['playlistid'];
    $playlistName = $_POST['playlistname'];

    if (!empty($songid) && !empty($playlistId) && !empty($playlistName)) {
        // Check if the song exists in the playlist
        $checkSql = "SELECT * FROM playlistSongs WHERE List_Id = '$playlistId' AND Song_Id = '$songid'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            // Delete the song from the playlist
            $sql = "DELETE FROM playlistSongs WHERE List_Id = '$playlistId' AND Song_Id = '$songid'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "success";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Song does not exist in the playlist.";
        }
    } else {
        echo "Error: Missing required data.";
    }
} else {
    echo "Error: Missing required data.";
}

mysqli_close($conn);
