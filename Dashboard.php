<?php
session_start();
include 'Connection.php';
if (!isset($_SESSION['Admin'])) {
    header("Location: Admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin >> Dashboard</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/FontAwesome/css/all.min.css">
    <link rel="stylesheet" href="Css/Dashboard.css">
</head>

<body>
    <?php include 'AHeader.php'; ?>
    <span id="dataset" style="display: none;">
        <div class="container">
            <div class="main-content">
                <div class="header">
                    <h2 style="font-size: 2.5rem; font-weight: 700; text-align: center; margin-bottom: 1rem;">Dashboard</h2>
                </div>
                <div class="info">
                    <div class="users">
                        <div class="icon">
                            <img Loading="Lazy" src="Css/Icons/users.png" onclick="window.location.href='ShowUsers.php'" style="cursor: pointer;" alt="users" target="_self"></a>
                        </div>
                        <h4>Users</h4>
                        <div class="details">
                            <?php
                            $sql = "SELECT * FROM AsUsers";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            echo "<p id='users'>" . $count . "</p>";
                            ?>
                        </div>
                    </div>

                    <div class="songs">
                        <div class="icon">
                            <img Loading="Lazy" src="Css/Icons/music.png" onclick="window.location.href='DataShow.php'" style="cursor: pointer;" alt="song" target="_self">
                        </div>
                        <h4>Songs</h4>
                        <div class="details">
                            <?php
                            $sql = "SELECT * FROM songs";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            echo "<p id='songs'>" . $count . "</p>";
                            ?>
                        </div>
                    </div>
                    <div class="artists">
                        <div class="icon">
                            <img Loading="Lazy" src="css/Icons/Artists.png" onclick="window.location.href='ShowArtists.php'" style="cursor: pointer;" alt="Artists" target="_self">
                        </div>
                        <h4>Artists</h4>
                        <div class="details">
                            <?php
                            $sql = "SELECT DISTINCT ArtistName FROM songs";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($result);
                            echo "<p>" . $count . "</p>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="recently-added">
                    <h3 style="text-align: center; font-size: 2rem; margin-bottom: 1rem;margin-top: 1rem;">Recently Added</h3>
                    <div class="recently-added-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Song Name</th>
                                    <th>Artist</th>
                                    <th>Album</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM songs ORDER BY Music_Id DESC LIMIT 10";
                                $result = mysqli_query($conn, $sql);
                                $a = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $a = $a + 1;
                                    echo "<tr>";
                                    echo "<td>" . $a . "</td>";
                                    $songname = substr($row['SongPath'], 0, strrpos($row['SongPath'], '.'));
                                    $songname = str_replace("Upload/", "", $songname);
                                    $songname = trim($songname);
                                    echo "<td>" . $songname . "</td>";
                                    echo "<td>" . $row['ArtistName'] . "</td>";
                                    echo "<td>" . $row['AlbumName'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </span>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const datasetElement = document.querySelector('#dataset');
                datasetElement.style.opacity = 0;
                datasetElement.style.display = 'block';
                datasetElement.style.transition = 'opacity 1s ease';
                setTimeout(() => {
                    datasetElement.style.opacity = 1;
                }, 50);

            }, 2000); // 2 seconds delay
        });
    </script>
</body>

</html>