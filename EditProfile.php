<?php
session_start();
include "Connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : EditUserProfile</title>
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/EditProfile.css">
</head>

<body>
    <div id="loader"></div>
    <?php include "Header.php"; ?>
    <span id="dataset" style="display: none;">
        <?php
        if (isset($_GET['Id']) && !empty($_GET['Id'])) {
            $id = $_GET['Id'];
            $sql = "SELECT * FROM Asusers WHERE User_Id='$id'";
            $res = mysqli_query($conn, $sql);

            if ($res && $res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
                // Handling form submission
                if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                    $password = mysqli_real_escape_string($conn, $_POST["password"] ?? '');
                    $username = mysqli_real_escape_string($conn, $_POST["username"] ?? '');
                    $email = mysqli_real_escape_string($conn, $_POST["email"] ?? '');
                    $phone = mysqli_real_escape_string($conn, $_POST["phone"] ?? '');
                    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"] ?? '');
                    $followartist = mysqli_real_escape_string($conn, $_POST["followartist"] ?? '');
                    $profile = '';
                    $update_fields = [];

                    // Handle cover file upload
                    if (isset($_FILES['profilepic']) && $_FILES['profilepic']['error'] === 0) {
                        $profilepic_ex = strtolower(pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION));
                        $profilepic_allowed_exs = array('jpg', 'jpeg', 'png', 'svg', 'webp');
                        if (in_array($profilepic_ex, $profilepic_allowed_exs)) {
                            $profilepic_upload_path = 'Users/' . $_FILES['profilepic']['name'];
                            if (file_exists($profilepic_upload_path)) {
                                unlink($profilepic_upload_path);
                            }
                            if (move_uploaded_file($_FILES['profilepic']['tmp_name'], $profilepic_upload_path)) {
                                $profile = $profilepic_upload_path;
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

                    if (!empty($username)) {
                        $update_fields[] = "Username='$username'";
                    }
                    if (!empty($password)) {
                        $update_fields[] = "Pass='" . $password . "'";
                    }
                    if (!empty($email)) {
                        $update_fields[] = "Email='$email'";
                    }
                    if (!empty($phone)) {
                        $update_fields[] = "Phone='$phone'";
                    }
                    if (!empty($fullname)) {
                        $update_fields[] = "FullName='$fullname'";
                    }
                    if (!empty($profile)) {
                        $update_fields[] = "ProfilePic='$profile'";
                    }
                    if (!empty($followartist)) {
                        $update_fields[] = "FollowedArtists='$followartist'";
                    }
                    if (!empty($update_fields)) {
                        $sql_update = "UPDATE Asusers SET " . implode(', ', $update_fields) . " WHERE User_Id='$id'";
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
                                        window.location.href='ShowUsers.php';
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
                                        window.location.href='ShowUsers.php';
                                    }
                                });
                            </script>";
                        }
                    }
                }
        ?>

                <div class="container">
                    <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="frm">
                        <h1>Update UserProfile</h1>
                        <div class="data">
                            <img Loading="Lazy" src="<?php echo $row["ProfilePic"]; ?>" draggable="false" id="covers" alt="Logo">
                            <span><?php echo $row["UserName"]; ?></span>
                        </div>
                        <br>
                        <div class="group">
                            <label>Fullname</label>
                            <input type="text" id="fullname" name="fullname" title="Fullname" autocomplete="off" value="<?php echo $row["FullName"]; ?>">
                        </div>

                        <div class="group">
                            <label>Username</label>
                            <input type="text" id="username" name="username" title="Username" value="<?php echo $row["UserName"]; ?>" autocomplete="off">
                        </div>

                        <div class="group">
                            <label>Password</label>
                            <input type="text" id="password" name="password" title="Password" value="<?php echo $row['Pass']; ?>" autocomplete="off">
                        </div>

                        <div class="group">
                            <label>Email</label>
                            <input type="text" id="email" name="email" title="Email" value="<?php echo $row["Email"]; ?>" autocomplete="off">
                        </div>
                        <div class="group">
                            <label>Phone</label>
                            <input type="text" id="phone" name="phone" title="Phone" value="<?php echo $row["Phone"]; ?>" autocomplete="off">
                        </div>
                        <div class="group">
                            <label>Profile Picture</label>
                            <input type="file" id="profilepic" name="profilepic" accept=".jpg,.jpeg,.png,.svg,.webp">
                        </div>

                        <button type="submit" id="update" name="update" onclick="window.location.href='ShowUsers.php'">Update</button>
                        <button type="button" id="back" name="back" onclick="window.history.back()" target="_Search">Back</button>
                    </form>
                </div>

                <div id="coverpopup" class="coverpopup">
                    <div class="covrer-popup-content">
                        <div class="Coverarea">
                            <img Loading="Lazy" id="hovercoverimage" src="<?php echo $row["ProfilePic"]; ?>" draggable="false" alt="Cover">
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