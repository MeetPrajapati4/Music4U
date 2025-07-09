<?php
session_start();
include 'Connection.php';
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : Become An Artist</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="css/AddArtists.css">
</head>

<body>
    <div id="loader"></div>
    <?php include "Header.php"; ?>
    <span id="dataset" style="display: none;">
        <div class="box">
            <h2>Become A New Artist</h2>
            <form action="BecomeArtist.php" method="post" enctype="multipart/form-data">
                <label for="artist">Artist Name</label>
                <input type="text" id="artist" name="artist" autocomplete="off" required>

                <label for="email">Artist Email</label>
                <input type="text" id="email" name="email" autocomplete="off" required
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Invalid Email Address">

                <label for="photo">Artist Photo</label>
                <input type="file" id="photo" name="photo" accept=".jpg,.jpeg,.png,.svg,.webp" required>

                <input class="button" type="submit" name="submit" value="Send All">
                <input class="button" type="button" value="Back" onclick="window.history.back()">
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
    <script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
</body>

<?php
// For photo
if (isset($_POST['submit']) && isset($_FILES['photo'])) {
    // Images
    $photo_name = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $error = $_FILES['photo']['error'];
    $size = $_FILES['photo']['size'];

    if ($error === 0) {
        if ($size > 100000000) {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Sorry, your file is too large.',
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
                            window.location.href = 'Addsongs.php';
                        }
                    });
                </script>";
        }

        $photo_ex = pathinfo($photo_name, PATHINFO_EXTENSION);
        $photo_ex_lc = strtolower($photo_ex);
        $photo_allowed_exs = array('jpg', 'jpeg', 'png', 'svg', 'webp');

        if (in_array($photo_ex_lc, $photo_allowed_exs)) {
            $new_photo_name = $photo_name;
            $photo_upload_path = 'AImages/' . $new_photo_name;

            if (move_uploaded_file($tmp_name, $photo_upload_path)) {
            } else {
                echo  "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Photo Not Moved !',
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
                            window.location.href = 'AddArtists.php';
                        }
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Please Select a Valid File',
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
                        window.location.href = 'AddArtists.php';
                    }
                });
            </script>";
        }
    }
}


// Check if form is submitted
if (isset($_POST['submit']) && isset($_POST['artist']) && isset($_POST['email'])) {
    // Get form data
    $artist = $_POST['artist'];
    $email = $_POST['email'];

    // Validate form data
    if (empty($artist)) {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Please enter the Artist Name.',
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
                    window.location.href = 'AddArtists.php';
                }
            });
        </script>";
    }

    if (empty($email)) {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Please enter the Artist Email.',
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
                    window.location.href = 'AddArtists.php';
                }
            });
        </script>";
    }

    // Insert data into database
    $_SESSION['ArtistName'] = $artist;
    $sql = "INSERT INTO AsArtist (AName, AEmail, AImage) VALUES ('$artist', '$email', '$photo_upload_path')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            Swal.fire({
                title: 'Success',
                text: 'All Data Inserted Successfully !!',
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
                    window.location.href = 'AddArtists.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Data Not Inserted !',
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
                    window.location.href = 'AddArtists.php';
                }
            });
        </script>";
    }
}
?>

</html>