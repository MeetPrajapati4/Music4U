<?php
session_start();
include 'Connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/FontAwesome/css/all.min.css">
    <link rel="stylesheet" href="Css/Artists.css">
    <title>Music4U : Artists</title>
</head>

<body>
    <?php include 'Header.php'; ?>
    <div id="createPlaylistPopup" class="playlistpopup">
        <div class="popupContent">
            <h2>Music4U - Playlist</h2>
            <form id="createPlaylistForm" method="POST">
                <div class="playlistNameContainer">
                    <?php
                    $UserID = $_SESSION['LoggedInUserID'];
                    $sql = "SELECT * FROM playlist WHERE User_Id ='$UserID' ORDER BY Playlist_Id ASC";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="playlistNameWrapper">
                                <input type="radio" class="playlistNameRadio" name="playlistName" value="<?php echo htmlspecialchars($row['PlaylistName']); ?>">
                                <input type="hidden" name="playlistId" class="playlistId" id="playlist_Id" value="<?php echo $row['Playlist_Id']; ?>">
                                <label for="playlist_<?php echo $row['Playlist_Id']; ?>" class="playlistName"><?php echo htmlspecialchars($row['PlaylistName']); ?></label>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <input type="text" id="NewPlaylistName" name="playlistName" placeholder="New PlaylistName Here" autocomplete="off">
                <button type="submit" id="submitPlaylist" name="submitPlaylist">NewCreate</button>
                <button type="submit" id="Done" name="Done">AddSongs</button>
                <button type="submit" id="Delete" name="Delete">Delete</button>
                <button type="button" id="closeCreatePopup">Cancel</button>
            </form>
        </div>
    </div>
    <div id="popup" class="popup">
        <div class="popup-content">
            <img Loading="Lazy" class="close-btn" id="closePopup" src="Css/Icons/close.png" alt="Close"></img>
            <h4>Share With Us</h4>
            <div class="social-icons">
                <button class="faq-button" id="CopyBtn">
                    <i class="far fa-clone"></i>
                    <span class="tooltip">Copy</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-github" onclick="OnSocialmedia('github')"></i>
                    <span class="tooltip">GitHub</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-x-twitter" onclick="OnSocialmedia('twitter')"></i>
                    <span class="tooltip">Twitter</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-whatsapp" onclick="OnSocialmedia('whatsapp')"></i>
                    <span class="tooltip">Whatsapp</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-facebook" onclick="OnSocialmedia('facebook')"></i><span class="tooltip">Facebook</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-telegram" onclick="OnSocialmedia('telegram')"></i><span class="tooltip">Telegram</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-instagram" onclick="OnSocialmedia('instagram')"></i><span class="tooltip">Instagram</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-linkedin-in" onclick="OnSocialmedia('linkedin')"></i><span class="tooltip">Linkedin</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-skype" onclick="OnSocialmedia('skype')"></i><span class="tooltip">Skype</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-snapchat-ghost" onclick="OnSocialmedia('snapchat')" id="snapchat"></i>
                    <span class="tooltip">Snapchat</span></button>
                <button class="faq-button">
                    <i class="fa-brands fa-pinterest" onclick="OnSocialmedia('pinterest')"></i><span class="tooltip">Pinterest</span>
                </button>
                <button class="faq-button">
                    <i class="fa-brands fa-reddit" onclick="OnSocialmedia('reddit')"></i><span class="tooltip">Reddit</span>
                </button>
            </div>
        </div>
    </div>
    <div class="box">
        <?php
        $artistname = '';
        if (isset($_GET['Name'])) {
            $artistname = mysqli_real_escape_string($conn, $_GET['Name']);
            $profilePic = 'MYCOVERS/Default.png';
            $sql = "SELECT AImage FROM AsArtist WHERE AName LIKE ?";
            $stmt = mysqli_prepare($conn, $sql);
            $likeArtistName = '%' . str_replace(' ', '%', $artistname) . '%';
            mysqli_stmt_bind_param($stmt, "s", $likeArtistName);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $profilePic = $row['AImage'];
            }
        }
        ?>

        <div class="profile-container">
            <div class="profile-image">
                <img Loading="Lazy" src="<?php echo $profilePic ?>" alt="Artist profile">
            </div>

            <div class="profile-details">
                <h1 class="artist-name"><?php echo $artistname ?></h1>
                <?php
                $num = rand(1, 20);
                echo "<p class='followers'>" . $num . "M Followers</p>";
                ?>
                <div class="buttons">
                    <button class="heart-button" id="likebtn">
                        <?php
                        $userid = $_SESSION['LoggedInUserID'] ?? 0;
                        $songid = $_POST['songid'] ?? 0;
                        $sql = "SELECT * FROM liked WHERE Liked_User_Id = ? AND Liked_Music_Id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $userid, $songid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            echo '<img Loading="Lazy" src="Css/Icons/Liked.png" alt="Like" name="liked" draggable="false" class="likes" id="likeImage">';
                            echo '<span class="tooltip" id="liketext">Like</span>';
                        } else {
                            echo '<img Loading="Lazy" src="Css/Icons/Disliked.png" alt="Like" name="Disliked" draggable="false" class="likes" id="likeImage">';
                            echo '<span class="tooltip" id="liketext">Dislike</span>';
                        }
                        ?>
                    </button>

                    <button class="list-button" style="Cursor:pointer;" id="playlistbtn">
                        <img Loading="Lazy" draggable="false" src="Css/Icons/Add.png" class="playlist" alt="Playlist"></img><span class="tooltip">Playlist</span>
                    </button>
                    <button class="share-button">
                        <img Loading="Lazy" src="Css/Icons/Share.png" id="Share" alt="Share" draggable="false">
                        <span class="tooltip">Share</span>

                        <script>
                            // Share Pop up Menu  
                            const openPopupBtn = document.getElementById('Share');
                            const popup = document.getElementById('popup');
                            const popupContent = document.querySelector(".popup-content");
                            const closePopupBtn = document.getElementById('closePopup');

                            // Open the popup when the button is clicked
                            openPopupBtn.addEventListener('click', () => {
                                popup.style.display = 'flex'; // Show the popup
                                popup.style.animation = 'fadeIn 1s ease';
                                popupContent.style.animation = 'slideIn 1s ease';
                            });
                            // Close the popup when the close button is clicked
                            closePopupBtn.addEventListener('click', () => {
                                setTimeout(() => popup.style.display = 'none', 800);
                                popup.style.animation = 'fadeOut 1s ease';
                                popupContent.style.animation = 'slideOut 1s ease';
                            });
                        </script>
                    </button>
                </div>
                <script>
                    document.querySelectorAll('#songrow').forEach(s => {
                        let c = 0;
                        s.addEventListener('click', () => {
                            if (++c === 5) {
                                const i = s.querySelector('#songId') ? s.querySelector('#songId').value : null;
                                if (!i) return Swal.fire({
                                    title: 'Error',
                                    text: 'Song ID not found!',
                                    icon: 'error',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false
                                });
                                fetch('AddTrend.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: `songid=${i}&userid=${<?php echo json_encode($_SESSION['LoggedInUserID']); ?>}`
                                    })
                                    .then(r => r.text())
                                    .then(d => d.includes("already") ? Swal.fire({
                                        title: 'Error',
                                        text: 'Song already in trend table',
                                        icon: 'error',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                            container: 'swal-container-small',
                                            popup: 'swal-popup-black',
                                            title: 'swal-title-size'
                                        },
                                        allowOutsideClick: false
                                    }) : null)
                                    .catch(e => console.error('Error:', e) || Swal.fire({
                                        title: 'Error',
                                        text: 'There was an error processing your request.',
                                        icon: 'error',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                            container: 'swal-container-small',
                                            popup: 'swal-popup-black',
                                            title: 'swal-title-size'
                                        },
                                        allowOutsideClick: false
                                    }));
                                c = 0;
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="songs">
            <div class="table-container">
                <table>
                    <?php
                    $sql1 = "SELECT * FROM songs WHERE ArtistName LIKE ?";
                    if ($stmt1 = $conn->prepare($sql1)) {
                        $likeArtistName = '%' . $artistname . '%';
                        $stmt1->bind_param("s", $likeArtistName);
                        $stmt1->execute();
                        $result1 = $stmt1->get_result();
                    }
                    while ($row = $result1->fetch_assoc()) {
                    ?>
                        <?php
                        $songname = substr($row['SongPath'], 0, strrpos($row['SongPath'], '.'));
                        $songname = str_replace("Upload/", "", $songname);
                        $songname = trim($songname);
                        ?>
                        <tr id="songrow" class="Songs" style="z-index: -1;" title="<?php echo $songname; ?>">
                            <td>
                                <img Loading="Lazy" id="songcover" draggable="false" src='<?php echo $row['CoverPath']; ?>' alt='Cover' style="Cursor:pointer;">
                            </td>
                            <?php
                            $songname = substr($row['SongPath'], 0, strrpos($row['SongPath'], '.'));
                            $songname = str_replace("Upload/", "", $songname);
                            $songname = trim($songname);
                            ?>
                            <td id="songname" style="Cursor:pointer;">
                                <?php echo $songname ?>
                            </td>
                            <td id="artistname">
                                <span style="Cursor:pointer;">
                                    <?php
                                    $r = explode(",", $row['ArtistName']);
                                    $artistlist = "";
                                    for ($i = 0; $i < count($r); $i++) {
                                        $artistlist .= "<a style='z-index: 10;' href='Artists.php?Name=" . $r[$i] . "'>" . $r[$i] . "</a>";
                                        if ($i < (count($r) - 1)) {
                                            $artistlist .= ", ";
                                        }
                                    }
                                    echo $artistlist;
                                    ?>
                                </span>
                            </td>
                            <td>
                                <span style="Cursor:pointer;">
                                    <?php echo $row['AlbumName']; ?>
                                    <i class="fas fa-play-circle" id="playpause" style="display:none;"></i>
                                    <audio id="<?php echo $row['Music_Id']; ?>" name="song" src='<?php echo $row['SongPath']; ?>'></audio>
                                </span>
                            </td>
                            <td>
                                <span style="Cursor:pointer;" id="downloadbtn">
                                    <a href="<?php echo $row['SongPath']; ?>" download="<?php echo $songname; ?>" class="download-link" id="download" onclick="event.stopPropagation();">
                                        <img Loading="Lazy" src="Css/Icons/download.png" class="download" alt="Download">
                                    </a>
                                </span>
                            </td>
                            <td>
                                <span id="views" style="cursor:pointer;">
                                    <span id="views<?php echo $row['Music_Id']; ?>"></span>
                                    <script>
                                        var views = Math.floor(Math.random() * 100000) + 1;
                                        document.getElementById("views<?php echo $row['Music_Id']; ?>").innerHTML = new Intl.NumberFormat('en-US').format(views);
                                    </script>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <script>
                    // Add to Trend
                    document.querySelectorAll('#songrow').forEach(s => {
                        let c = parseInt(sessionStorage.getItem('clickCount')) || 0;
                        s.addEventListener('click', () => {
                            c++;
                            sessionStorage.setItem('clickCount', c);
                            if (c === 10) {
                                const i = s.querySelector('#songId') ? s.querySelector('#songId').value : null;
                                if (!i) return Swal.fire({
                                    title: 'Error',
                                    text: 'Song ID not found!',
                                    icon: 'error',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false
                                });
                                fetch('OtherPages/AddTrend.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: `songid=${i}&userid=${<?php echo json_encode($_SESSION['LoggedInUserID']); ?>}`
                                    })
                                    .then(r => r.text())
                                    .catch(e => console.error('Error:', e) || Swal.fire({
                                        title: 'Error',
                                        text: 'There was an error processing your request.',
                                        icon: 'error',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                            container: 'swal-container-small',
                                            popup: 'swal-popup-black',
                                            title: 'swal-title-size'
                                        },
                                        allowOutsideClick: false
                                    }));
                                sessionStorage.removeItem('clickCount');
                            }
                        });
                    });
                </script>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById('likebtn').addEventListener('click', function() {
                            const likeButton = this;
                            const songid = document.querySelector('.focus #songId') ? document.querySelector('.focus #songId').value : null;
                            const userid = <?php echo json_encode($_SESSION['LoggedInUserID']); ?>;
                            const songname = document.querySelector('.focus #songname') ? document.querySelector('.focus #songname').textContent.trim() : null;

                            if (!songid || !userid || !songname) {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No song selected or user not logged in.',
                                    icon: 'error',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false
                                });
                                return;
                            }

                            const isLiked = likeButton.name === "liked";
                            const action = isLiked ? 'DislikeSong' : 'Likesong';
                            const url = `OtherPages/${action}.php`;

                            fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: `songid=${encodeURIComponent(songid)}&userid=${encodeURIComponent(userid)}`
                                })
                                .then(response => response.text())
                                .then(result => {
                                    const success = result.includes("success");
                                    const alreadyLiked = result.includes("already");
                                    likeButton.name = likeButton.name === "liked" ? "disliked" : "liked";
                                    likeButton.children[0].src = `Css/Icons/${likeButton.name === "liked" ? 'Liked' : 'Disliked'}.png`;
                                    likeButton.children[1].textContent = likeButton.name === "liked" ? "Like" : "Dislike";

                                    if (success) {
                                        Swal.fire({
                                            title: `You ${action} - ${songname}`,
                                            icon: 'success',
                                            confirmButtonText: 'Ok',
                                            customClass: {
                                                container: 'swal-container-small',
                                                popup: 'swal-popup-black',
                                                title: 'swal-title-size'
                                            },
                                            allowOutsideClick: false
                                        });
                                    } else {
                                        Swal.fire({
                                            title: `You ${action} - ${songname}`, // Already Liked
                                            icon: 'info',
                                            confirmButtonText: 'Ok',
                                            customClass: {
                                                container: 'swal-container-small',
                                                popup: 'swal-popup-black',
                                                title: 'swal-title-size'
                                            },
                                            allowOutsideClick: false
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'An error occurred while processing your request.2',
                                        icon: 'error',
                                        confirmButtonText: 'Ok',
                                        customClass: {
                                            container: 'swal-container-small',
                                            popup: 'swal-popup-black',
                                            title: 'swal-title-size'
                                        },
                                        allowOutsideClick: false
                                    });
                                });
                        });
                    });
                </script>
            </div>
        </div>

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
                            <p id="miniartistname">--:--</p>
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
                coverPopup.style.display = 'flex';
                coverPopup.style.animation = 'fadeIn 1s ease';
                hoverCoverImage.style.animation = 'songcover 1s ease';
            });

            // Close the coverPopup when close is clicked
            closePopup.addEventListener('click', () => {
                coverPopup.style.animation = 'fadeOut 1s ease';
                hoverCoverImage.style.animation = 'songcoverclose 1s ease';
                setTimeout(() => coverPopup.style.display = 'none', 800);
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
            <span id="Currenttime" title="CurrentTime">00:00</span>
            <input type="range" name="range" id="progress" min="0" value="0" max="100">
            <span id="Duration" title="SongDuration">00:00</span>
        </div>

        <div class="rightbuttons">

            <button class="btn" id="icright">
                <img Loading="Lazy" src="Css/Icons/repeat.png" id="repeat"></img>
                <span class="tooltip">Repeat</span>
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
    <!-- End Footer -->
    <script>
        document.getElementById("CopyBtn").addEventListener("click", function(event) {
            const songName = encodeURIComponent(document.querySelector(".focus #songname").textContent.trim());
            const songUrl = new URL(`${window.location.href}?songname=${songName}`);
            navigator.clipboard.writeText(songUrl.toString()).then(() => {
                document.querySelector("#CopyBtn").querySelector(".tooltip").textContent = "Copied";
                setTimeout(() => {
                    document.querySelector("#CopyBtn").querySelector(".tooltip").textContent = "Copy";
                }, 1000);
                document.querySelector("#CopyBtn i").classList.toggle("fas");
                document.querySelector("#CopyBtn i").classList.toggle("far");
                setTimeout(() => {
                    document.querySelector("#CopyBtn i").classList.toggle("fas");
                    document.querySelector("#CopyBtn i").classList.toggle("far");
                }, 1000);
            })
        });

        document.querySelectorAll('.playlist').forEach(function(playlistbtn) {
            playlistbtn.addEventListener('click', () => {
                let playpopup = document.querySelector('#createPlaylistPopup');
                if (playpopup.style.display !== 'flex') {
                    playpopup.style.opacity = 0;
                    playpopup.style.display = 'flex';
                    playpopup.style.animation = 'fadeIn 0.5s ease forwards';
                    setTimeout(() => playpopup.style.opacity = 1, 100);
                    document.body.style.overflow = 'hidden';
                } else {
                    playpopup.style.opacity = 1;
                    playpopup.style.animation = 'fadeOut 0.5s ease forwards';
                    setTimeout(() => playpopup.style.display = 'none', 500);
                    playpopup.style.opacity = 0;
                    document.body.style.overflow = 'hidden';
                }
            });
        });
        document.querySelector('#closeCreatePopup').addEventListener('click', () => {
            let playpopup = document.querySelector('#createPlaylistPopup');
            playpopup.style.opacity = 1;
            playpopup.style.animation = 'fadeOut 0.5s ease forwards';
            setTimeout(() => playpopup.style.display = 'none', 500);
            playpopup.style.opacity = 0;
            document.body.style.overflow = 'hidden';
        });
        // End Create Playlist
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('likebtn').addEventListener('click', function() {
                let likeImage = this.querySelector('img');
                let isLiked = likeImage.getAttribute("name") === "liked";

                if (isLiked) {
                    Swal.fire({
                        title: 'You Have Already Liked',
                        icon: 'info',
                        confirmButtonText: 'Ok',
                        customClass: {
                            container: 'swal-container-small',
                            popup: 'swal-popup-black',
                            title: 'swal-title-size'
                        },
                        allowOutsideClick: false
                    });
                    return;
                }
                const songRow = document.querySelector('.focus');
                if (empty(songRow)) {
                    Swal.fire({
                        text: 'Song information not found!',
                        icon: 'error',
                        title: 'Error',
                        confirmButtonText: 'Ok',
                        customClass: {
                            container: 'swal-container-small',
                            popup: 'swal-popup-black',
                            title: 'swal-title-size'
                        },
                        allowOutsideClick: false
                    });
                    return;
                }

                const songid = songRow.querySelector('#songId')?.value;
                const songname = songRow.querySelector('#songname')?.textContent;
                const userid = <?php echo json_encode($_SESSION['LoggedInUserID'] ?? 0); ?>;

                if (empty(songid) || empty(userid)) {
                    Swal.fire({
                        text: 'Invalid song or user ID!',
                        icon: 'error',
                        title: 'Error',
                        confirmButtonText: 'Ok',
                        customClass: {
                            container: 'swal-container-small',
                            popup: 'swal-popup-black',
                            title: 'swal-title-size'
                        },
                        allowOutsideClick: false
                    });
                    return;
                }

                // Send the data using the fetch API
                fetch('OtherPages/Likesong.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `songid=${encodeURIComponent(songid)}&userid=${encodeURIComponent(userid)}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (!data.includes("already")) {
                            Swal.fire({
                                title: `You Liked - ${songname}`,
                                icon: 'success',
                                confirmButtonText: 'Ok',
                                customClass: {
                                    container: 'swal-container-small',
                                    popup: 'swal-popup-black',
                                    title: 'swal-title-size'
                                },
                                allowOutsideClick: false
                            });

                            likeImage.setAttribute("name", "liked");
                            likeImage.src = "Css/Icons/Liked.png";
                            this.querySelector('.tooltip').textContent = "Like";
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            text: 'An error occurred while processing your request.',
                            icon: 'error',
                            title: 'Error',
                            confirmButtonText: 'Ok',
                            customClass: {
                                container: 'swal-container-small',
                                popup: 'swal-popup-black',
                                title: 'swal-title-size'
                            },
                            allowOutsideClick: false
                        });
                    });
            });
        });
    </script>
    <script src="js/Main2.js"></script>
    <script src="Js/SweetAlert/dist/sweetalert2.all.min.js"></script>
</body>

</html>