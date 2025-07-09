<?php
session_start();
include '../Connection.php';
if (isset($_SESSION['LoggedInUserID']) && !empty($_SESSION['LoggedInUserID'])) {
    $userid = $_SESSION['LoggedInUserID'];
    $sql = "SELECT * FROM Trend WHERE TUser_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {
        echo "<script>
                  window.location.href = '../Home.php';
              </script>";
    }
} else {
    echo "<script>
              window.location.href = '../index.php';
          </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : Trending </title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../Css/FontAwesome/css/all.css">
    <script src="../jquery/Js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../Css/Other/Pages.css">
</head>

<body>
    <nav class="navbar">
        <img Loading="Lazy" src="../Css/Background/logo.png" onclick="window.location.href = '../Home.php';" class="navbar-logo" alt="logo" title="Music4U">

        <?php if (isset($_SESSION['Username'])): ?>
            <?php
            // Sanitize the username to allow only alphabetic characters
            $username = preg_replace('/[^A-Za-z]/', '', $_SESSION['Username']);
            ?>
            <h3 style="position: absolute; left: 50%; transform: translateX(-50%);"></h3>
        <?php endif; ?>

        <script>
            // Ensure username is set before using it in JavaScript
            <?php if (isset($username)): ?>
                const textArray = [
                    `Hello 👋, <?php echo json_encode(ucwords($username)); ?>`,
                    "Music4U - Trending Songs",
                    'Listen to the best music, with the best people, at the best website.',
                    "Music4U - Rhythm 🎶, Rest 😌, Recharge! 💪"
                ];
                let i = 0;
                const h3 = document.querySelector("h3");
                const interval = setInterval(function() {
                    h3.style.color = 'white';
                    h3.style.transition = 'opacity 0.5s';
                    h3.style.opacity = '0';
                    setTimeout(function() {
                        h3.textContent = textArray[i];
                        h3.style.opacity = '1';
                        if (i === 1) {
                            clearInterval(interval);
                        } else {
                            i = (i + 1) % textArray.length;
                        }
                    }, 1000);
                }, 4000);
            <?php endif; ?>
        </script>

        <!-- Nav Menu -->
        <ul class="navbar-list">
            <li><a href="../Home.php">Home</a></li>
            <li><a href="../ContactUs.php">Contact Us</a></li>
            <li><a href="../About.php">About</a></li>
        </ul>

        <div class="profile-dropdown">
            <div onclick="toggle()" class="profile-dropdown-btn">
                <?php
                if (isset($_SESSION['Username'])) {
                    $sql = "SELECT ProfilePic FROM AsUsers WHERE Username = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("s", $_SESSION['Username']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $profilePic = htmlspecialchars($row['ProfilePic'] ?? 'MYCOVERS/Default.png');
                    } else {
                        $profilePic = 'MYCOVERS/Default.png';
                    }
                } else {
                    $profilePic = 'MYCOVERS/Default.png';
                }
                ?>
                <img Loading="Lazy" src="<?php echo "../" . $profilePic; ?>" class="profile-img" alt="Profile Picture" />
            </div>
            <ul class="profile-dropdown-list">
                <li class="profile-dropdown-list-item">
                    <a href="../EditProfile.php">
                        <i class="fa-regular fa-user"></i>
                        Edit Profile
                    </a>
                </li>
                <li class="profile-dropdown-list-item">
                    <a href="../BecomeArtist.php">
                        <i class="fa-solid fa-guitar"></i>
                        Become an Artist
                    </a>
                </li>
                <li class="profile-dropdown-list-item">
                    <a href="#">
                        <i class="fa-regular fa-address-card"></i>
                        My Profile
                    </a>
                </li>
                <hr />
                <li class="profile-dropdown-list-item">
                    <a href="#">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Create Playlist Popup -->
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
                                <input type="radio" class="playlistNameRadio" name="playlistNameRadio" value="<?php echo htmlspecialchars($row['PlaylistName']); ?>" id="<?php echo $row['Playlist_Id']; ?>">
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
                <button type="submit" id="DeleteList" name="DeleteList">DeleteList</button>
                <button type="button" id="closeCreatePopup">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Pop up Menu -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <img Loading="Lazy" class="close-btn" id="closePopup" src="../Css/Icons/close.png" alt="Close"></img>
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


    <!--PopUp Close -->

    <!-- Player -->
    <div class="player">
        <div class="container">
            <div class="searchbar">
                <img Loading="Lazy" src="../Css/Icons/search.png" draggable="false" style="width: 20px;margin-right: 10px;cursor: pointer;" alt="Search" title="Search">
                <input type="text" placeholder="Search Here" id="search" title="Search Song Here">
            </div>
            <img Loading="Lazy" src="../Css/Icons/menu.png" draggable="false" class="hamburger" onclick="openSideMenu()" title="Menu"></img>
            <img Loading="Lazy" src="../Css/Icons/close.png" draggable="false" class="cross" onclick="closeSideMenu()" title="Close"></img>

            <!-- Side Menu -->
            <div class="left">
                <div class="sidemenu">
                    <ul class="menu" id="fileList">
                        <li id="NewReleaseList"><button id="NewRelease" name="NewRelease"><i class="fas fa-fire-alt"></i>&nbsp; New Release</button></li>
                        <li id="LikedList"><button id="Liked" name="Liked"><i class="likes fas fa-heart"></i>&nbsp; Liked</button></li>
                        <li id="TrendingList"><button id="Trending" name="Trending"><i class="fa-solid fa-arrow-trend-up"></i>&nbsp; Trending</button></li>
                        <li id="PlaylistsList"><button id="Playlists" name="Playlists"><i class="fas fa-list-ul"></i>&nbsp; Playlists</button></li>
                        <li id="TopOfMusic4UList"><button id="TopOfMusic4U" name="TopOfMusic4U"><i class="fas fa-bolt"></i>&nbsp; Top of Music4U</button></li>
                    </ul>
                </div>
            </div>

            <!-- Main Songs -->
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const buttons = document.querySelectorAll('#fileList li button');

                    buttons.forEach(button => {
                        button.addEventListener('click', () => {
                            const pageName = button.getAttribute('name');
                            const currentPage = window.location.href.split('/').pop().split('.')[0];

                            if (pageName === currentPage) {
                                Swal.fire({
                                    title: 'You Are Already On This Page',
                                    icon: 'info',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false,
                                });
                            } else {
                                // Open page in self window
                                window.open(`${pageName}.php`, '_Self');
                            }
                        });
                    });
                });
            </script>

            <div class="center">
                <table>
                    <tr tabindex="0" id="header">
                        <th>Cover</th>
                        <th>SongName</th>
                        <th>Artists</th>
                        <th>AlbumName</th>
                    </tr>
                    <?php

                    function getSongName($songPath)
                    {
                        $songname = substr($songPath, 0, strrpos($songPath, '.'));
                        $songname = str_replace("Upload/", "", $songname);
                        return htmlspecialchars(trim($songname));
                    }

                    $sql = "SELECT * FROM Trend t JOIN songs s ON t.TSong_Id = s.Music_Id ORDER BY t.Trend_Id DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = mysqli_fetch_assoc($result)) {
                        $songname = getSongName($row['SongPath']);
                    ?>
                        <tr id="songrow" class="Songs" title="<?php echo $songname; ?>">
                            <td>
                                <img Loading="Lazy" id="songcover" draggable="false" src='<?php echo "../" . $row['CoverPath']; ?>' alt='Cover' style="Cursor:pointer;">
                            </td>
                            <td id="songname" style="Cursor:pointer;">
                                <?php echo $songname; ?>
                            </td>
                            <td id="artistname">
                                <span style="Cursor:pointer;">
                                    <?php
                                    $r = explode(",", $row['ArtistName']);
                                    $artistlist = "";
                                    for ($i = 0; $i < count($r); $i++) {
                                        $artistlist .= "<a style='z-index: 10;' href='../Artists.php?Name=" . $r[$i] . "'>" . $r[$i] . "</a>";
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
                                    <i class="songplay fas fa-play-circle" id="playpause" style="display:none;"></i>
                                    <audio id="<?php echo $row['Music_Id']; ?>" class="audioplayer" name="song" src='<?php echo "../" . $row['SongPath']; ?>'></audio>
                                    <input type="Hidden" name="songId" id="songId" value="<?php echo $row['Music_Id']; ?>">
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <script>
                document.querySelectorAll('#songrow').forEach(song => {
                    let clickCount = 0; // Initialize the click count for each song

                    song.addEventListener('click', () => {
                        clickCount++; // Increment click count on each click

                        // Proceed only on the 5th click
                        if (clickCount === 5) {
                            // Assuming songId is nested within each song row element
                            const songId = song.querySelector('#songId') ? song.querySelector('#songId').value : null;

                            // Check if songId exists before making the request
                            if (!songId) {
                                Swal.fire({
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
                                return;
                            }

                            // Get the userId from PHP session
                            const userId = <?php echo json_encode($_SESSION['LoggedInUserID']); ?>;

                            // Send POST request to AddTrend.php
                            fetch('AddTrend.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: `songid=${songId}&userid=${userId}`
                                })
                                .then(response => response.text())
                                .then(data => {
                                    // Check the response data to handle success or failure
                                    if (data.includes("already")) {
                                        Swal.fire({
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
                                        });
                                    } else {
                                        // Proceed with other actions
                                        // Insert Complete
                                    }
                                })
                                .catch(error => {
                                    // Handle errors gracefully
                                    console.error('Error:', error);
                                    Swal.fire({
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
                                    });
                                });

                            // Reset the click counter after the 5th click
                            clickCount = 0;
                        }
                    });
                });
            </script>
        </div>
    </div>

    <!-- Main Songs Done -->

    <!-- Right Side -->
    <div class="right">
        <div class="righttop">
            <img Loading="Lazy" src="../MYCOVERS/Default.png" draggable="false" alt='Cover' id='rightcoverimage'>
        </div>
        <div class="rightscroll">
            <div class="rightmiddle">
                <div class="options">
                    <button id="Share">
                        <img Loading="Lazy" class="share" draggable="false" src="../Css/Icons/Share.png" alt="Share" draggable="false">
                        <span class="tooltip">Share</span>
                    </button>
                    <button style="Cursor:pointer;" id="playlistbtn">
                        <img Loading="Lazy" draggable="false" src="../Css/Icons/Add.png" class="playlist" alt="Playlist"></img><span class="tooltip">Playlist</span>
                    </button>
                    <button id="likebtn">
                        <?php
                        $userid = $_SESSION['LoggedInUserID'] ?? 0;
                        $songid = $_POST['songid'] ?? 0;
                        $sql = "SELECT * FROM liked WHERE Liked_User_Id = ? AND Liked_Music_Id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $userid, $songid);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $isLiked = $result->num_rows > 0;
                        ?>
                        <img Loading="Lazy" src="../Css/Icons/<?php echo $isLiked ? 'Liked' : 'Disliked'; ?>.png" alt="Like" name="<?php echo $isLiked ? 'liked' : 'disliked'; ?>" draggable="false" class="likes" id="likeImage">
                        <span class="tooltip" id="liketext"><?php echo $isLiked ? 'Like' : 'Dislike'; ?></span>
                    </button>
                    <button>
                        <span style="Cursor:pointer;" id="downloadbtn">
                            <img Loading="Lazy" src="../Css/Icons/download.png" class="download" alt="Download"></img>
                            <span class="tooltip">Download</span>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.getElementById('downloadbtn').addEventListener('click', function() {
                                        const songElement = document.querySelector('.focus #songId');
                                        const songId = songElement ? songElement.value : null;
                                        const songName = document.querySelector('.focus #songname').textContent.trim();
                                        const songPath = document.querySelector(`audio[id="${songId}"]`).src;

                                        if (songId && songPath) {
                                            const link = document.createElement('a');
                                            link.href = songPath;
                                            link.download = `${songName}.mp3`;
                                            document.body.appendChild(link);
                                            link.click();
                                            document.body.removeChild(link);
                                        } else {
                                            Swal.fire({
                                                title: 'Error',
                                                text: 'No song selected for download.',
                                                icon: 'error',
                                                confirmButtonText: 'Ok',
                                                customClass: {
                                                    container: 'swal-container-small',
                                                    popup: 'swal-popup-black',
                                                    title: 'swal-title-size'
                                                },
                                                allowOutsideClick: false
                                            });
                                        }
                                    });
                                });
                            </script>
                        </span>
                    </button>
                    <a href="../MYSONGS/Default.mp3" download="../Default.mp3" style="display:none;"></a>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById('likebtn').addEventListener('click', function() {
                            const likeButton = this;
                            const likeImage = likeButton.children[0];
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

                            const isLiked = likeImage.src.includes('Liked');
                            const action = isLiked ? 'DislikeSong' : 'Likesong';
                            const url = `${action}.php`;

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
                                    const isLiked = likeImage.src.includes('Liked');
                                    likeButton.name = isLiked ? "disliked" : "liked";
                                    likeImage.src = `../Css/Icons/${likeButton.name === "liked" ? 'Liked' : 'Disliked'}.png`;
                                    likeButton.querySelector('.tooltip').textContent = likeButton.name === "liked" ? "Like" : "Dislike";

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
                <div class="rightbottom" id="rightbottom">
                    <div class="songinfo" id="Artistbox">
                        <p class="artist-content">
                            <span class="right-artist">
                                <a class="song-artist" href="../Artists.php?name=Music4U">Music4U</a>
                                <button class="follow-btn" onclick="ToggleFollow(this, 'Music4U')">Follow</button>
                            </span>
                        </p>
                        <p class="artist-content">
                            <span class="right-artist">
                                <a class="song-artist" href="../Artists.php?name=Music4U">Music4U</a>
                                <button class="follow-btn" onclick="ToggleFollow(this, 'Music4U')">Follow</button>
                            </span>
                        </p>
                        <p class="artist-content">
                            <span class="right-artist">
                                <a class="song-artist" href="../Artists.php?name=Music4U">Music4U</a>
                                <button class="follow-btn" onclick="ToggleFollow(this, 'Music4U')">Follow</button>
                            </span>
                        </p>
                        <p class="artist-content">
                            <span class="right-artist">
                                <a class="song-artist" href="../Artists.php?name=Music4U">Music4U</a>
                                <button class="follow-btn" onclick="ToggleFollow(this, 'Music4U')">Follow</button>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom -->
    <div class="bottom">
        <div class="songbar">
            <div class="mini-player">
                <div class="mini-player-content">
                    <div class="mini-song-info">
                        <img Loading="Lazy" id="minicover" src="../MYCOVERS/Default.png" draggable="false" alt="Cover">
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
                        <img Loading="Lazy" id="hovercoverimage" src="../MYCOVERS/Default.png" draggable="false" alt="Cover">
                    </div>
                    <img Loading="Lazy" class="close" id="closePop" src="../Css/Icons/close.png" alt="Close" title="Close"></img>
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
            <button class="btn" id="iccenter"><img Loading="Lazy" src="../Css/Icons/previous.png" id="previoussong"></img><span class="tooltip">Previous</span></button>
            <button class="btn" id="iccenter"><img Loading="Lazy" src="../Css/Icons/Backward.png" id="backward"></img><span class="tooltip">Backward</span></button>
            <button class="btn" id="iccenter"><img Loading="Lazy" src="../Css/Icons/play.png" id="mainplaypause"></img><span class="tooltip">Play</span></button>
            <button class="btn" id="iccenter"><img Loading="Lazy" src="../Css/Icons/Forward.png" id="forward"></img><span class="tooltip">Foreward</span></button>
            <button class="btn" id="iccenter"><img Loading="Lazy" src="../Css/Icons/Next.png" id="nextsong"></><span class="tooltip">Next</span></button>
        </div>
        <div class="progressbar">
            <span id="Currenttime" title="Current Time">00:00</span>
            <input type="range" name="range" id="progress" min="0" value="0" max="100">
            <span id="Durationtime" title="Song Duration">00:00</span>
        </div>

        <div class="rightbuttons">
            <button class="btn" id="icright">
                <img Loading="Lazy" src="../Css/Icons/repeat.png" id="repeat"></img>
                <span class="tooltip" id="repeatmode">RepeatAll</span>
            </button>
            <button class="btn" id="icright">
                <img Loading="Lazy" src="../Css/Icons/shuffle.png" id="shuffle"></img>
                <span class="tooltip">Shuffle</span>
            </button>
            <button class="btn" id="icright">
                <img Loading="Lazy" src="../Css/Icons/ChangeBG.png" id="changebg"></img>
                <span class="tooltip">ChangeBG</span>
            </button>
            <button class="btn" id="icright" onclick="toggleFullscreen()">
                <img Loading="Lazy" src="../Css/Icons/Fullscreen.png" id="fullscreen"></img>
                <span class="tooltip">Fullscreen</span>
            </button>
            <button class="btn" id="icright">
                <img Loading="Lazy" src="../Css/Icons/volume.png" id="volume"></img>
                <span class="tooltip">Volume</span>
            </button>
            <input type="range" name="volumerange" id="volumerange" min="0" value="100" max="100">
        </div>
    </div>
    <!-- End Bottom -->
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-section about">
                <h3>About Music4U</h3>
                <p>Music4U is a Music Streaming Service with a User-Friendly Interface With Lot's of Songs.</p>
            </div>
            <div class="footer-section links">
                <h3>Quick Access</h3>
                <ul class="list">
                    <li><a href="../Home.php" onclick="window.scrollTo(0, 0); return false;">Home</a></li>
                    <li><a href="Playlists.php">YourPlaylists</a></li>
                    <li><a href="../ContactUs.php">ContactUs</a></li>
                    <li><a href="../About.php">About</a></li>
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
        $('#search').on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.Songs').each(function() {
                const contactText = $(this).text().toLowerCase();
                $(this).toggle(contactText.includes(searchTerm));
            });
        });
    </script>
    <script>
        function setupProfileDropdown() {
            const profileDropdownList = document.querySelector(".profile-dropdown-list");
            const btn = document.querySelector(".profile-dropdown-btn");
            const profileImg = document.querySelector(".profile-img");
            const classList = profileDropdownList.classList;

            const toggle = () => {
                classList.toggle("active");
                profileImg.style.transform = classList.contains("active") ? "translateX(100%)" : "translateX(0%)";
                profileImg.style.transition = "all 0.3s ease";
            };

            btn.addEventListener("click", toggle);

            window.addEventListener("click", function(e) {
                if (!btn.contains(e.target)) {
                    classList.remove("active");
                    profileImg.style.transform = "translateX(0%)";
                    profileImg.style.transition = "all 0.3s ease";
                }
            });
        }

        setupProfileDropdown();

        // Copy
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
        // End Copy

        // Create Playlist
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
                    document.body.style.overflow = 'auto';
                }
            });
        });
        document.querySelector('#closeCreatePopup').addEventListener('click', () => {
            let playpopup = document.querySelector('#createPlaylistPopup');
            playpopup.style.opacity = 1;
            playpopup.style.animation = 'fadeOut 0.5s ease forwards';
            setTimeout(() => playpopup.style.display = 'none', 500);
            playpopup.style.opacity = 0;
            document.body.style.overflow = 'auto'; // Restore scrolling
        });
        // End Create Playlist
    </script>
    <script>
        // Add to Playlist
        document.getElementById("Done").addEventListener("click", function(e) {
            // Prevent default action (if it's part of a form submission)
            e.preventDefault();
            // Get the necessary values from the DOM
            const selectedPlaylist = document.querySelector('input.playlistNameRadio:checked');
            const playlistid = selectedPlaylist ? selectedPlaylist.parentNode.querySelector('.playlistId').value : null;
            const playlistname = selectedPlaylist ? selectedPlaylist.value : '';
            const songElement = document.querySelector('.focus #songId');
            const songid = songElement ? songElement.value : null;

            // Basic validation: Ensure that all necessary inputs are available
            if (!playlistid || !songid || !playlistname) {
                Swal.fire({
                    title: 'Missing Information',
                    text: 'Please make sure all fields are selected.',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
                return; // Exit the function if validation fails
            }

            // Construct the data to send in the request
            const data = `songid=${encodeURIComponent(songid)}&playlistid=${encodeURIComponent(playlistid)}&playlistname=${encodeURIComponent(playlistname)}`;

            // Make the request to the server
            fetch("AddToPlaylist.php", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data
                })
                .then(response => response.text())
                .then(result => {
                    // Check if the operation was successful or failed
                    if (!result.includes("success")) {
                        Swal.fire({
                            title: 'Song Added To Playlist Successfully',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            customClass: {
                                container: 'swal-container-small',
                                popup: 'swal-popup-black',
                                title: 'swal-title-size'
                            },
                            allowOutsideClick: false,
                        });
                        document.getElementById("playlistbtn").querySelector(".playlist").src = "../Css/Icons/Added.png";
                        document.getElementById("playlistbtn").querySelector(".tooltip").textContent = "Added";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'An error occurred',
                        text: 'Please try again later.',
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
    </script>

    <script>
        document.getElementById("Delete").addEventListener("click", function(e) {
            // Prevent default action (if it's part of a form submission)
            e.preventDefault();

            // Get the necessary values from the DOM
            const selectedPlaylist = document.querySelector('input.playlistNameRadio:checked');
            const playlistid = document.querySelector('input.playlistNameRadio:checked') ? document.querySelector('input.playlistNameRadio:checked').parentNode.querySelector('.playlistId').value : null;
            const playlistname = selectedPlaylist ? selectedPlaylist.value : null;
            const songid = document.querySelector('.focus #songId') ? document.querySelector('.focus #songId').value : null;

            // Basic validation: Ensure that all necessary inputs are available
            if (!playlistid || !songid || !playlistname) {
                Swal.fire({
                    title: 'Missing Information',
                    text: 'Please make sure all fields are selected.',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
                return; // Exit the function if validation fails
            }

            // Construct the data to send in the request
            const data = `songid=${encodeURIComponent(songid)}&playlistid=${encodeURIComponent(playlistid)}&playlistname=${encodeURIComponent(playlistname)}`;

            // Make the request to the server
            fetch("DeleteFromPlaylist.php", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data
                })
                .then(response => response.text())
                .then(result => {
                    // Check if the operation was successful or failed
                    if (!result.includes("success")) {
                        Swal.fire({
                            title: 'Song Deleted From Playlist Successfully',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            customClass: {
                                container: 'swal-container-small',
                                popup: 'swal-popup-black',
                                title: 'swal-title-size'
                            },
                            allowOutsideClick: false,
                        });
                        document.getElementById("playlistbtn").querySelector(".playlist").src = "../Css/Icons/Add.png";
                        document.getElementById("playlistbtn").querySelector(".tooltip").textContent = "Playlist";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'An error occurred',
                        text: 'Please try again later.',
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
    </script>
    <script src="../js/NewRelease.js"></script>
    <script src="../Js/SweetAlert/dist/sweetalert2.all.min.js"></script>
    <?php
    if (isset($_POST['submitPlaylist'])) {

        if (isset($_SESSION['LoggedInUserID'])) {
            $UserID = $_SESSION['LoggedInUserID'];
            $PlaylistName = isset($_POST['playlistName']) ? trim($_POST['playlistName']) : null;
            $UserName = $_SESSION['Username'];
            $UserType = "User";
        } elseif (isset($_SESSION['AdminId'])) {
            $UserID = $_SESSION['AdminId'];
            $PlaylistName = isset($_POST['playlistName']) ? trim($_POST['playlistName']) : null;
            $UserName = $_SESSION['Admin'];
            $UserType = "Admin";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'User is not logged in.',
                    icon: 'info',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
            </script>";
            exit;
        }

        if (empty($PlaylistName)) {
            echo "<script>
                Swal.fire({
                title: 'Error',
                text: 'Playlist name cannot be empty!',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });</script>";
            exit;
        }
        $check_sql = "SELECT * FROM playlist WHERE User_Id = $UserID AND PlaylistName = '$PlaylistName'";
        $check_result = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>Swal.fire({
                title: 'Error',
                text: 'Playlist already exists for this song.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });</script>";
            exit;
        }

        $sql = "INSERT INTO playlist (User_Id, PlaylistName, Created_By_Type) 
                VALUES ($UserID, '$PlaylistName', '$UserType')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>Swal.fire({
                title: 'Success',
                text: 'Playlist created successfully!',
                icon: 'success',
                confirmButtonText: 'Ok', 
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },               
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            });</script>";
        } else {
            echo "<script>Swal.fire({
                title: 'Error',
                text: 'Error creating playlist. Please try again later.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });</script>";
        }
    }
    ?>
    <?php
    // Delete Playlist
    if (isset($_POST['DeleteList'])) {

        if (isset($_SESSION['LoggedInUserID'])) {
            $UserID = $_SESSION['LoggedInUserID'];
        } elseif (isset($_SESSION['AdminId'])) {
            $UserID = $_SESSION['AdminId'];
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'User is not logged in.',
                    icon: 'info',
                    confirmButtonText: 'Ok',
                    customClass: {
                        container: 'swal-container-small',
                        popup: 'swal-popup-black',
                        title: 'swal-title-size'
                    },
                    allowOutsideClick: false
                });
            </script>";
            exit;
        }

        $PlaylistName = $_POST['playlistNameRadio'];

        $query = "DELETE FROM playlist WHERE PlaylistName = ? AND User_Id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'si', $PlaylistName, $UserID);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script>Swal.fire({
                title: 'Success',
                text: 'Playlist deleted successfully!',
                icon: 'success',
                confirmButtonText: 'Ok', 
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },               
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =window.location.href; 
                }
            });</script>";
        } else {
            echo "<script>Swal.fire({
                title: 'Error',
                text: 'Error deleting playlist. Please try again later.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });</script>";
        }
        mysqli_stmt_close($stmt);
    }
    ?>
</body>

</html>