<?php
session_start();
include "Connection.php";
if (!isset($_SESSION['Username'])) {
    header("Location: Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>My Profile - Music4U</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
            scroll-behavior: smooth !important;
            transition: all 0.5s ease;
            /* Text-Select off  */
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -moz-user-select: none;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-image: url('Css/Background/Music4U.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .profile-container {
            width: 100%;
            max-width: 1000px;
            height: 60%;
            max-height: 600px;
            background: rgba(22, 22, 22, 0.66);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #1DB954;
            /* Spotify green */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            border-right: 2px solid #1DB954;
            /* Spotify green */
            padding-right: 20px;
            width: 40%;
            text-align: center;
        }

        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-details {
            width: 55%;
            text-align: left;
        }

        .profile-details h2 {
            color: #1DB954;
            /* Spotify green */
            font-size: 20px;
            margin-bottom: 10px;
        }

        .profile-details p {
            font-size: 16px;
            color: #fff;
            /* White text */
            margin: 5px 0;
        }

        .songs-container {
            max-height: 300px;
            overflow-y: scroll;
            padding-top: 10px;
        }

        .songs-container::-webkit-scrollbar {
            width: 10px;
        }

        .songs-container::-webkit-scrollbar-thumb {
            background: #1DB954;
            border-radius: 5px;
        }

        .songs-container::-webkit-scrollbar-thumb:hover {
            background: #1ed760;
            /* Slightly lighter green */
        }

        .songs-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .song {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .song img {
            width: 60px;
            height: 60px;
            border-radius: 5px;
            margin-right: 15px;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <?php
            $s = "SELECT * FROM Asusers WHERE Username = '" . mysqli_real_escape_string($conn, $_SESSION['Username']) . "'";
            $r = mysqli_query($conn, $s);
            while ($row = mysqli_fetch_assoc($r)) {
            ?>
                <img Loading="Lazy" src="<?php echo htmlspecialchars($row['ProfilePic']); ?>" alt="Profile Picture">
                <h1><?php echo htmlspecialchars($row['UserName']); ?></h1>
        </div>
        <div class="profile-details">
            <h2>Liked Songs</h2>
            <div class="songs-container">
                <?php
                $sql = "SELECT * FROM liked WHERE Liked_User_Id = " . $row['User_Id'];
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($liked_row = mysqli_fetch_assoc($result)) {
                        $sql2 = "SELECT * FROM songs WHERE Music_Id = " . $liked_row['Liked_Music_Id'];
                        $result2 = mysqli_query($conn, $sql2);
                        if ($song_row = mysqli_fetch_assoc($result2)) {
                ?>
                            <table class="song">
                                <tr>
                                    <td><img Loading="Lazy" src="<?php echo htmlspecialchars($song_row['CoverPath']); ?>" alt="Song Cover"></td>
                                    <td>
                                        <?php
                                        $songname = substr($song_row['SongPath'], 0, strrpos($song_row['SongPath'], '.'));
                                        $songname = str_replace("Upload/", "", $songname);
                                        $songname = trim($songname);
                                        ?>
                                        <p><strong>Song:</strong> <?php echo htmlspecialchars($songname); ?></p>
                                        <p><strong>Artist:</strong> <?php echo htmlspecialchars($song_row['ArtistName']); ?></p>
                                        <p><strong>Album:</strong> <?php echo htmlspecialchars($song_row['AlbumName']); ?></p>
                                    </td>
                                </tr>
                            </table>

                <?php
                        }
                    }
                } else {
                    echo "No liked songs";
                }
                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
<?php } ?>
</body>

</html>