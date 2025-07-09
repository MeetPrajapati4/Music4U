        <?php
        session_start();
        include "Connection.php";
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
            <title>Admin&nbsp;&nbsp;>>>&nbsp;&nbsp;ShowData</title>
            <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="Css/DataShow.css">
        </head>

        <body>
            <div id="loader"></div>
            <?php include "AHeader.php"; ?>
            <span id="dataset" style="display: none;">
                <div class="searchbar">
                    <img Loading="Lazy" src="Css/Icons/search.png" draggable="false" style="width: 20px;margin-right: 10px;cursor: pointer;" alt="Search" title="Search">
                    <input type="text" placeholder="Search Here" id="search" title="Search Song Here">
                </div>
                <div class="add">
                    <button id="add" type="button" onclick="window.location.href='Addsongs.php'"><i class="fa-solid fa-folder-plus"></i> AddSongs</button>
                </div>
                <div class="box">
                    <?php
                    #Check if form submitted
                    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                        $Artistname = mysqli_real_escape_string($con, $_POST["artist"]);
                        $AlbumName = mysqli_real_escape_string($con, $_POST["album"]);
                        $songPath = mysqli_real_escape_string($con, $_POST["songname"]);
                        $coverPath = mysqli_real_escape_string($con, $_POST["cover"]);
                        $sql = "INSERT INTO songs (CoverPath, SongPath, ArtistName, AlbumName) VALUES ('$coverPath', '$songPath', '$Artistname', '$AlbumName')";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>
                                Swal.fire({
                                    title: 'Song Added Successfully',
                                    icon: 'success',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false
                                });
                            </script>";
                        } else {
                            echo "<script>
                                Swal.fire({
                                    title: 'Song Added Failed',
                                    icon: 'error',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false
                                });
                            </script>";
                        }
                    }

                    #select all records from the table
                    $data = [];
                    $sql = "SELECT * FROM songs ORDER BY Music_Id DESC";
                    $res = mysqli_query($conn, $sql);
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            $data[] = $row;
                        }
                    }
                    if (count($data) > 0) { ?>
                        <table>
                            <tr id="header">
                                <th>Id</th>
                                <th>Cover</th>
                                <th>Song</th>
                                <th>Artist</th>
                                <th>Album</th>
                                <th>Language</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($data as $row) {
                                $i++;
                                $id = $row['Music_Id'];
                                $songname = substr($row['SongPath'], 0, strrpos($row['SongPath'], '.'));
                                $songname = str_replace("Upload/", "", $songname);
                                $songname = trim($songname);
                            ?>
                                <tr title="<?php echo $songname; ?>" id="songrow" class="data">
                                    <td>
                                        <?php echo $row['Music_Id']; ?>
                                    </td>
                                    <td>
                                        <img Loading="Lazy" id="songcover" draggable="false" src='<?php echo $row['CoverPath']; ?>' alt='Cover'>
                                    </td>
                                    <td id="songname">
                                        <?php echo $songname ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ArtistName']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['AlbumName'] ?>
                                        <i class="songplay fas fa-play-circle" id="playpause" style="display:none;"></i>
                                        <audio id="<?php echo $row['Music_Id']; ?>" class="audioplayer" name="song" src='<?php echo $row['SongPath']; ?>'></audio>
                                    </td>
                                    <td>
                                        <?php echo $row['Lang']; ?>
                                    </td>
                                    <td><a href="Edit.php?Id=<?php echo $row['Music_Id']; ?>" target="_Self" class="btn-blue"><img Loading="Lazy" src="Css/Icons/Edit.png" class="edit" alt="Edit"></a></td>
                                    <td>
                                        <a href="Delete.php?Id=<?php echo $row['Music_Id']; ?>" target="_self" onclick="return confirm('Do you want to Delete?') && confirm('Are you sure?')" class="btn-red"><img Loading="Lazy" src="Css/Icons/Delete.png" class="delete" alt="Delete"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                </div>

                <div class="bottom">
                    <div class="songbar">
                        <div class="mini-player">
                            <div class="mini-player-content">
                                <div class="mini-song-info">
                                    <img Loading="Lazy" id="minicover" src="MYCOVERS/Default.png" draggable="false" alt="Cover">
                                    <div>
                                        <p id="minisongtitle">
                                            <span>--:--</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="coverpopup" class="coverpopup">
                            <div class="covrer-popup-content">
                                <div class="Coverarea">
                                    <img Loading="Lazy" id="hovercoverimage" src="MYCOVERS/Default.png" draggable="false" alt="Cover">
                                </div>
                                <img Loading="Lazy" class="close" id="closePop" src="Css/Icons/close.png" alt="Close" title="Close"></img>
                            </div>
                        </div>
                    </div>
                    <script>
                        // Share Pop up Menu  
                        const openPopup = document.getElementById('minicover');
                        const coverPopup = document.getElementById('coverpopup');
                        const closePopup = document.getElementById('closePop');
                        const hoverCoverImage = document.getElementById('hovercoverimage');
                        // Open the popup when clicked
                        openPopup.addEventListener('click', () => {
                            coverPopup.style.display = 'flex'; // Show the coverPopup
                            coverPopup.style.animation = 'fadeIn 1s ease';
                            hoverCoverImage.style.animation = "songcover 1s ease";
                        });

                        // Close the coverPopup when close is clicked
                        closePopup.addEventListener('click', () => {
                            setTimeout(() => coverPopup.style.display = 'none', 800);
                            coverPopup.style.animation = 'fadeOut 1s ease';
                            hoverCoverImage.style.animation = 'songcoverclose 1s ease';
                        });
                    </script>

                    <!-- For Cover Pop up end -->
                    <div class="centerbuttons">
                        <button class="btn" id="iccenter"><img Loading="Lazy" src="Css/Icons/previous.png" id="previoussong"></img><span class="tooltip">Previous</span></button>
                        <button class="btn" id="iccenter"><img Loading="Lazy" src="Css/Icons/Backward.png" id="backward"></img><span class="tooltip">Backward</span></button>
                        <button class="btn" id="iccenter"><img Loading="Lazy" src="Css/Icons/play.png" id="mainplaypause"></img><span class="tooltip">Play</span></button>
                        <button class="btn" id="iccenter"><img Loading="Lazy" src="Css/Icons/Forward.png" id="forward"></img><span class="tooltip">Foreward</span></button>
                        <button class="btn" id="iccenter"><img Loading="Lazy" src="Css/Icons/Next.png" id="nextsong"></><span class="tooltip">Next</span></button>
                    </div>
                    <div class="progressbar">
                        <span id="Currenttime" title="Current Time">00:00</span>
                        <input type="range" name="range" id="progress" min="0" value="0" max="100">
                        <span id="Durationtime" title="Song Duration">00:00</span>
                    </div>

                    <div class="rightbuttons">
                        <button class="btn" id="icright">
                            <img Loading="Lazy" src="Css/Icons/repeat.png" id="repeat"></img>
                            <span class="tooltip" id="repeatmode">RepeatAll</span>
                        </button>
                        <button class="btn" id="icright">
                            <img Loading="Lazy" src="Css/Icons/shuffle.png" id="shuffle"></img>
                            <span class="tooltip">Shuffle</span>
                        </button>
                        <button class="btn" id="icright">
                            <img Loading="Lazy" src="Css/Icons/ChangeBG.png" id="changebg"></img>
                            <span class="tooltip">ChangeBG</span>
                        </button>
                        <button class="btn" id="icright" onclick="toggleFullscreen()">
                            <img Loading="Lazy" src="Css/Icons/Fullscreen.png" id="fullscreen"></img>
                            <span class="tooltip">Fullscreen</span>
                        </button>
                        <button class="btn" id="icright">
                            <img Loading="Lazy" src="Css/Icons/volume.png" id="volume"></img>
                            <span class="tooltip">Volume</span>
                        </button>
                        <input type="range" name="volumerange" id="volumerange" min="0" value="100" max="100">
                    </div>
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


            <?php } else { ?>
                <div class='alert-red'>No Records</div>
            <?php } ?>
            </span>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    // Show the content
                    document.getElementById('dataset').style.display = 'block';
                });
            </script>
            <script src="js/DataShow.js"></script>
            <script src="../Js/SweetAlert/dist/sweetalert2.all.min.js"></script>
        </body>
        <script>
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                const dataElements = document.querySelectorAll('table .data');

                dataElements.forEach(element => {
                    const contactText = element.textContent.toLowerCase();
                    if (contactText.includes(searchTerm)) {
                        element.style.display = ''; // Reset to default display
                        element.style.opacity = '1';
                        element.style.animation = 'fadeIn 1s ease';
                        element.style.width = '100%';
                        element.style.height = 'auto';
                    } else {
                        element.style.display = 'none'; // Hide the element
                        element.style.opacity = '0';
                    }
                });
            });
            const firstMatch = document.querySelector('table .data[style*="display:"]');
            if (firstMatch) {
                firstMatch.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        </script>

        </html>