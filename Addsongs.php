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
    <title>Admin&nbsp;&nbsp;>>>&nbsp;&nbsp;AddSong</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="css/Addsong.css">
</head>

<body>
    <div id="loader"></div>
    <?php include "AHeader.php"; ?>
    <span id="dataset" style="display: none;">
        <div class="box">
            <h2>Add Songs Here</h2>
            <form action="Addsongs.php" method="post" enctype="multipart/form-data">
                <label for="artist">Artist</label>
                <input type="text" id="artist" name="artist" autocomplete="off" required>

                <label for="album">Album</label>
                <input type="text" id="album" name="album" autocomplete="off" required>

                <label for="songname">Song</label>
                <input type="file" id="songname" name="songname" accept=".mp3,.wav,.m4a,.wma,.aac,.flac" required>

                <label for="cover">Cover</label>
                <input type="file" id="cover" name="cover" accept=".jpg,.jpeg,.png,.svg,.webp" required>

                <label>languages</label>
                <div class="languages">
                    <input type="checkbox" id="Hindi" name="languages[]" value="Hindi">
                    <label for="Hindi">Hindi</label><br>
                    <input type="checkbox" id="Gujarati" name="languages[]" value="Gujarati">
                    <label for="Gujarati">Gujarati</label><br>
                    <input type="checkbox" id="Marathi" name="languages[]" value="Marathi">
                    <label for="Marathi">Marathi</label><br>
                    <input type="checkbox" id="Tamil" name="languages[]" value="Tamil">
                    <label for="Tamil">Tamil</label><br>
                    <input type="checkbox" id="Telugu" name="languages[]" value="Telugu">
                    <label for="Telugu">Telugu</label><br>
                    <input type="checkbox" id="Kannada" name="languages[]" value="Kannada">
                    <label for="Kannada">Kannada</label><br>
                    <input type="checkbox" id="Punjabi" name="languages[]" value="Punjabi">
                    <label for="Punjabi">Punjabi</label><br>
                    <input type="checkbox" id="English" name="languages[]" value="English">
                    <label for="English">English</label><br>
                    <input type="checkbox" id="Malayalam" name="languages[]" value="Malayalam">
                    <label for="Malayalam">Malayalam</label><br>
                    <input type="checkbox" id="Bengali" name="languages[]" value="Bengali">
                    <label for="Bengali">Bengali</label><br>
                    <input type="checkbox" id="Spanish" name="languages[]" value="Spanish">
                    <label for="Spanish">Spanish</label><br>
                    <input type="checkbox" id="French" name="languages[]" value="French">
                    <label for="French">French</label><br>
                    <input type="checkbox" id="Russian" name="languages[]" value="Russian">
                    <label for="Russian">Russian</label><br>
                    <input type="checkbox" id="German" name="languages[]" value="German">
                    <label for="German">German</label><br>
                    <input type="checkbox" id="Italian" name="languages[]" value="Italian">
                    <label for="Italian">Italian</label><br>
                    <input type="checkbox" id="Portuguese" name="languages[]" value="Portuguese">
                    <label for="Portuguese">Portuguese</label><br>
                    <input type="checkbox" id="Turkish" name="languages[]" value="Turkish">
                    <label for="Turkish">Turkish</label><br>
                    <input type="checkbox" id="Arabic" name="languages[]" value="Arabic">
                    <label for="Arabic">Arabic</label><br>
                    <input type="checkbox" id="Chinese" name="languages[]" value="Chinese">
                    <label for="Chinese">Chinese</label><br>
                    <input type="checkbox" id="Japanese" name="languages[]" value="Japanese">
                    <label for="Japanese">Japanese</label><br>
                    <input type="checkbox" id="Korean" name="languages[]" value="Korean">
                    <label for="Korean">Korean</label><br>
                    <input type="checkbox" id="Swedish" name="languages[]" value="Swedish">
                    <label for="Swedish">Swedish</label><br>
                    <input type="checkbox" id="Danish" name="languages[]" value="Danish">
                    <input type="checkbox" id="Brazilian" name="languages[]" value="Brazilian">
                    <label for="Brazilian">Brazilian</label><br>
                </div>

                <input class="button" type="submit" name="submit" value="Send All">
                <input class="button" type="submit" name="submit" value="Home" onclick="window.open('Home.php', '_search')">
            </form>
        </div>
        <footer>
            <div class="container">
                <div class="footer-section about">
                    <h3>About Music4U</h3>
                    <p>Music4U is a Music Streaming Service with a User-Friendly Interface With Lot's of Songs.</p>
                </div>
                <div class="footer-section links">
                    <h3>Quick Access</h3>
                    <ul class="list">
                        <li><a href="Home.php" onclick="window.scrollTo(0, 0); return false;">Home</a></li>
                        <li><a href="OtherPages/Playlists.php">YourPlaylists</a></li>
                        <li><a href="ContactUs.php">ContactUs</a></li>
                        <li><a href="About.php">About</a></li>
                    </ul>
                </div>
                <div class="footer-section social">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 Music4U. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
            </div>
        </footer>
        <!-- End Footer -->
    </span>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Simulate a loading time
            setTimeout(() => {
                // Show the content
                document.getElementById('dataset').style.display = 'block';
            }, 1000); // 3 seconds delay
        });
    </script>
</body>

<?php
// For Cover
if (isset($_POST['submit']) && isset($_FILES['cover'])) {
    // Images
    $cover_name = $_FILES['cover']['name'];
    $tmp_name = $_FILES['cover']['tmp_name'];
    $error = $_FILES['cover']['error'];
    $size = $_FILES['cover']['size'];

    if ($error === 0) {
        if ($size > 104857600) { // 100MB in bytes
            echo "<script>alert('Sorry, your file is too large.');</script>";
            echo "<script>window.location.href = 'Addsongs.php';</script>";
        }

        $cover_ex = pathinfo($cover_name, PATHINFO_EXTENSION);
        $cover_ex_lc = strtolower($cover_ex);
        $cover_allowed_exs = array('jpg', 'jpeg', 'png', 'svg', 'webp');

        if (in_array($cover_ex_lc, $cover_allowed_exs)) {
            $new_cover_name = $cover_name;
            $cover_upload_path = 'Images/' . $new_cover_name;

            if (move_uploaded_file($tmp_name, $cover_upload_path)) {
                //echo "<script>alert('Cover Moved !')</script>";
            } else {
                echo  "<script>alert('Cover Not Moved !')</script>";
            }
        } else {
            echo "<script>alert('Please Select a Valid File');</script>";
            echo "<script>window.location.href = 'Addsongs.php';</script>";
        }
    }
}

// For Songs
if (isset($_POST['submit']) && isset($_FILES['songname'])) {
    $songname = $_FILES['songname']['name'];
    $tmp_name = $_FILES['songname']['tmp_name'];
    $error = $_FILES['songname']['error'];
    $size = $_FILES['songname']['size'];

    if ($error === 0) {
        if ($size > 524288000) { // 500MB in bytes
            echo "<script>alert('Sorry, your file is too large.');</script>";
            echo "<script>window.location.href = 'Addsongs.php';</script>";
        }

        $songname_ex = pathinfo($songname, PATHINFO_EXTENSION);
        $songname_ex_lc = strtolower($songname_ex);
        $allowed_exs = array('mp3', 'wav', 'm4a', 'wma', 'aac', 'flac');

        if (in_array($songname_ex_lc, $allowed_exs)) {
            $new_songname = $songname;
            $song_upload_path = 'Upload/' . $new_songname;

            if (move_uploaded_file($tmp_name, $song_upload_path)) {
            } else {
                echo  "<script>alert('Song Not Moved !')</script>";
            }
        } else {
            echo "<script>alert('Please Select a Valid File');</script>";
            echo "<script>window.location.href = 'Addsongs.php';</script>";
        }
    }
}

// Check if form is submitted
if (isset($_POST['submit']) && isset($_POST['artist']) && isset($_POST['album'])) {
    // Get form data
    $artist = $_POST['artist'];
    $album = $_POST['album'];

    // Validate form data
    if (empty($artist)) {
        echo "<script>alert('Please enter the Artist Name.');</script>";
        echo "<script>window.location.href = 'Addsongs.php';</script>";
    }

    if (empty($album)) {
        echo "<script>alert('Please enter the Album Name.');</script>";
        echo "<script>window.location.href = 'Addsongs.php';</script>";
    }
    // Process languages
    $languages = isset($_POST['languages']) ? implode(',', $_POST['languages']) : '';

    // Validate languages
    if (empty($languages)) {
        echo "<script>alert('Please select at least one language.');</script>";
        echo "<script>window.location.href = 'Addsongs.php';</script>";
    }
    // Insert data into database
    $sql = "INSERT INTO songs (CoverPath, SongPath, ArtistName, AlbumName, Lang) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $cover_upload_path, $song_upload_path, $artist, $album, $languages);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if ($result) {
        echo "<script>alert('All Data Inserted Successfully !!')</script>";
        echo "<script>window.location.href = 'Datashow.php';</script>";
    } else {
        echo "<scrip>alert('Data Not Inserted !')</script>";
    }
}
?>

</html>