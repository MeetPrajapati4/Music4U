<?php
session_start();
include "Connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : EditArtistProfile</title>
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/EditArtists.css">
</head>

<body>
    <div id="loader"></div>
    <?php include "Header.php"; ?>
    <span id="dataset" style="display: none;">
        <?php

        if (isset($_GET['Id']) && !empty($_GET['Id'])) {
            $id = $_GET['Id'];
            $sql = "SELECT * FROM AsArtist WHERE Artist_Id='$id'";
            $res = mysqli_query($conn, $sql);

            if ($res && $res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
                // Handling form submission
                if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                    $Artistname = mysqli_real_escape_string($conn, $_POST["artist"] ?? '');
                    $email = mysqli_real_escape_string($conn, $_POST["email"] ?? '');
                    $AImage = '';
                    $update_fields = [];

                    // Handle cover file upload
                    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
                        $photo_ex = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                        $photo_allowed_exs = array('jpg', 'jpeg', 'png', 'svg', 'webp');
                        if (in_array($photo_ex, $photo_allowed_exs)) {
                            $photo_upload_path = 'AImages/' . $_FILES['photo']['name'];
                            if (file_exists($photo_upload_path)) {
                                unlink($photo_upload_path);
                            }
                            if (move_uploaded_file($_FILES['photo']['tmp_name'], $photo_upload_path)) {
                                $AImage = $photo_upload_path;
                            }
                        } else {

                            echo "<script>
						Swal.fire({
							title: 'Error',
							text: 'Invalid cover file type. Only jpg, jpeg, png, svg, and webp formats are allowed.',
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
                    if (!empty($Artistname)) {
                        $update_fields[] = "AName='$Artistname'";
                    }
                    if (!empty($email)) {
                        $update_fields[] = "AEmail='$email'";
                    }
                    if (!empty($AImage)) {
                        $update_fields[] = "AImage='$AImage'";
                    }
                    if (!empty($update_fields)) {
                        $sql_update = "UPDATE AsArtist SET " . implode(', ', $update_fields) . " WHERE Artist_Id='$id'";
                        if (mysqli_query($conn, $sql_update)) {
                            echo "<script>
                                Swal.fire({
                                    title: 'Data Updated Successfully!',
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
                                        window.location.href='ShowArtists.php';
                                    }
                                });
                            </script>";
                        } else {
                            echo "<script>
                                Swal.fire({
                                    title: 'Error: " . mysqli_error($conn) . "',
                                    icon: 'error',
                                    confirmButtonText: 'Ok',
                                    customClass: {
                                        container: 'swal-container-small',
                                        popup: 'swal-popup-black',
                                        title: 'swal-title-size'
                                    },
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href='ShowArtists.php';
                                    }
                                });
                            </script>";
                        }
                    }
                }
        ?>

                <div class="container">
                    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="frm">
                        <h1>Update Artist</h1>
                        <div class="data">
                            <img Loading="Lazy" src="<?php echo $row["AImage"]; ?>" draggable="false" id="covers" alt="Logo">
                            <span><?php echo $row["AName"]; ?></span>
                        </div>
                        <br>
                        <div class="group">
                            <label>Artist name</label>
                            <input type="text" id="artist" name="artist" title="artist" value="<?php echo $row["AName"]; ?>" autocomplete="off">
                        </div>
                        <div class="group">
                            <label>Artist Email</label>
                            <input type="text" id="email" name="email" title="Email" value="<?php echo $row["AEmail"]; ?>" autocomplete="off">
                        </div>
                        <div class="group">
                            <label>Artist ProfilePic</label>
                            <input type="file" id="photo" name="photo" accept=".jpg,.jpeg,.png,.svg,.webp">
                        </div>
                        <button type="submit" id="update" name="update" onclick="window.location.href='ShowArtists.php'">Update</button>
                        <button type="button" id="back" name="back" onclick="window.history.back()" target="_Search">Back</button>
                    </form>
                </div>

                <div id="coverpopup" class="coverpopup">
                    <div class="covrer-popup-content">
                        <div class="Coverarea">
                            <img Loading="Lazy" id="hovercoverimage" src="<?php echo $row["AImage"]; ?>" draggable="false" alt="Cover">
                        </div>
                        <img Loading="Lazy" class="close" id="closePop" src="Css/Icons/close.png" alt="Close" title="Close"></img>
                    </div>
                </div>
                <script>
                    // Share Pop up Menu  
                    const openPopup = document.getElementById('covers');
                    const coverPopup = document.getElementById('coverpopup');
                    const closePopup = document.getElementById('closePop');
                    const hoverCoverImage = document.getElementById('hovercoverimage');

                    // Open the popup when clicked
                    openPopup.addEventListener('click', () => {
                        coverPopup.style.display = 'flex'; // Show the coverPopup
                        coverPopup.style.animation = 'fadeIn 1s ease, slideIn 1s ease';
                        hoverCoverImage.style.animation = "songcover 1s ease";
                    });

                    // Close the coverPopup when close is clicked
                    closePopup.addEventListener('click', () => {
                        setTimeout(() => coverPopup.style.display = 'none', 800);
                        coverPopup.style.animation = 'fadeOut 1s ease, slideOut 1s ease';
                        hoverCoverImage.style.animation = 'songcoverclose 1s ease';
                    });
                </script>
                <footer>
                    <div id="container">
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
    </span>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelector('#dataset').style.display = 'block';
            }, 2000);
        });
    </script>
    <script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
</body>
<?php
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'User Not Found',
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
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Invalid User ID',
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
?>

</html>