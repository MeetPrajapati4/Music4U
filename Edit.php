<?php
session_start();
include "Connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin >> Update</title>
	<link rel="stylesheet" href="Css/FontAwesome/css/all.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="Css/Edit.css">
</head>

<body>
	<div id="loader"></div>
	<?php include "AHeader.php"; ?>
	<span id="dataset" style="display: none;">
		<div class="container">
			<form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="frm">
				<h1>Update Song</h1>
				<div class="data">
					<?php
					$id = $_GET["Id"];
					$sql = "SELECT * FROM songs WHERE Music_Id='$id'";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_fetch_assoc($result);
					?>
					<img Loading="Lazy" src="<?php echo $row["CoverPath"]; ?>" draggable="false" id="covers" alt="Logo">
					<?php
					$songname = str_replace("Upload/", "", basename($row['SongPath']));
					$songname = preg_replace('/\\.[^.\\s]{3}$/', '', $songname);
					$songname = trim($songname);
					?>
					<span><?php echo $songname ?></span>
				</div>

				<div class="group">
					<input type="text" id="id" name="id" value="<?php echo $row["Music_Id"]; ?>" title="<?php echo $row["Music_Id"]; ?>" readonly>
				</div>

				<div class="group">
					<label>Artist Name</label>
					<input type="text" id="artist" name="artist" title="Artist Name" autocomplete="off" value="<?php echo $row["ArtistName"]; ?>">
				</div>

				<div class="group">
					<label>Album Name</label>
					<input type="text" id="album" name="album" title="Album Name" value="<?php echo $row["AlbumName"]; ?>" autocomplete="off">
				</div>

				<div class="group">
					<label>Cover</label>
					<input type="file" id="cover" name="cover" accept=".jpg,.jpeg,.png,.svg,.webp">
				</div>

				<div class="group">
					<label>Song Name</label>
					<input type="file" id="songname" name="songname" accept=".mp3,.wav,.m4a,.wma,.aac,.flac">
				</div>
				<label>Languages</label>
				<div class="languages">
					<?php
					$query = "SELECT Lang FROM songs WHERE Music_Id='$id'";
					$result = mysqli_query($conn, $query);
					$row = mysqli_fetch_assoc($result);

					$selected_languages = explode(',', $row['Lang']); // Convert stored languages to an array

					// List of available languages
					$languages = ["Hindi", "Gujarati", "Marathi", "Tamil", "Telugu", "Kannada", "Punjabi", "English", "Malayalam", "Bengali", "Spanish", "French", "Russian", "German", "Italian", "Portuguese", "Turkish", "Arabic", "Chinese"];

					// Display checkboxes
					foreach ($languages as $language) {
						$checked = in_array($language, $selected_languages) ? 'checked' : '';
						echo "<input type='checkbox' id='$language' name='languages[]' value='$language' $checked>";
						echo "<label for='$language'>$language</label><br>";
					}
					?>
				</div>

				<button type="submit" id="update" name="update" onclick="window.location.href='DataShow.php'">Update</button>
				<button type="button" id="back" name="back" onclick="window.location.href='DataShow.php'">Back</button>
			</form>
		</div>

		<div id="coverpopup" class="coverpopup">
			<div class="covrer-popup-content">
				<div class="Coverarea">
					<img Loading="Lazy" id="hovercoverimage" src="<?php echo $row["CoverPath"]; ?>" draggable="false" alt="Cover">
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

	<?php
	if (isset($_GET['Id']) && !empty($_GET['Id'])) {
		$id = $_GET['Id'];
		$sql = "SELECT * FROM songs WHERE Music_Id='$id'";
		$res = mysqli_query($conn, $sql);

		if ($res && $res->num_rows > 0) {
			$row = mysqli_fetch_assoc($res);
			// Handling form submission
			if ($_SERVER["REQUEST_METHOD"] == 'POST') {
				$cover = mysqli_real_escape_string($conn, $_POST["cover"] ?? '');
				$Artistname = mysqli_real_escape_string($conn, $_POST["artist"] ?? '');
				$AlbumName = mysqli_real_escape_string($conn, $_POST["album"] ?? '');
				$languages = $_POST["languages"] ?? [];
				$cover_update = '';
				$song_update = '';

				// Handle cover file upload
				if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
					$cover_ex = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));
					$cover_allowed_exs = array('jpg', 'jpeg', 'png', 'svg', 'webp');
					if (in_array($cover_ex, $cover_allowed_exs)) {
						$cover_upload_path = 'Images/' . $_FILES['cover']['name'];
						if (file_exists($cover_upload_path)) {
							unlink($cover_upload_path);
						}
						if (move_uploaded_file($_FILES['cover']['tmp_name'], $cover_upload_path)) {
							$cover_update = $cover_upload_path;
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

				// Handle song file upload
				if (isset($_FILES['songname']) && $_FILES['songname']['error'] === 0) {
					$song_ex = strtolower(pathinfo($_FILES['songname']['name'], PATHINFO_EXTENSION));
					$song_allowed_exs = array('mp3', 'wav', 'm4a', 'wma', 'aac', 'flac', 'ogg', 'oga', 'opus', 'webm');
					if (in_array($song_ex, $song_allowed_exs)) {
						$song_upload_path = 'Upload/' . $_FILES['songname']['name'];
						if (file_exists($song_upload_path)) {
							unlink($song_upload_path);
						}
						if (move_uploaded_file($_FILES['songname']['tmp_name'], $song_upload_path)) {
							$song_update = $song_upload_path;
						}
					} else {
						echo "<script>
						Swal.fire({
							title: 'Error',
							text: 'Invalid song file type. Only mp3, wav, m4a, wma, aac, flac, ogg, oga, opus, and webm formats are allowed.',
							icon: 'error',
							confirmButtonText: 'Ok',
							customClass: {
								container: 'swal-container-small',
								popup: 'swal-popup-black',
								title: 'swal-title-size'
							},
							allowOutsideClick: false
						})
					</script>";
					}
				}

				// Update SQL query if there are any changes
				$update_fields = [];
				if (!empty($id)) {
					$update_fields[] = "Music_Id ='$id'";
				}
				if (!empty($cover_update)) {
					$update_fields[] = "CoverPath='$cover_update'";
				}
				if (!empty($song_update)) {
					$update_fields[] = "SongPath='$song_update'";
				}
				if (!empty($Artistname)) {
					$update_fields[] = "ArtistName='$Artistname'";
				}
				if (!empty($AlbumName)) {
					$update_fields[] = "AlbumName='$AlbumName'";
				}
				if (!empty($languages)) {
					$update_fields[] = "Lang='" . implode(',', $languages) . "'";
				}
				if (!empty($update_fields)) {
					$sql_update = "UPDATE songs SET " . implode(', ', $update_fields) . " WHERE Music_Id='$id'";
					if (mysqli_query($conn, $sql_update)) {
						echo "<script>
						Swal.fire({
							title: 'Success',
							text: 'Data Updated Successfully',
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
							title: 'Error',
							text: 'Error: ' + mysqli_error($conn),
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
								window.location.href = 'Edit.php';
							}
						});
					</script>";
					}
				}
			}
		} else {
			echo "<script>
					Swal.fire({
						title: 'Song Not Found',
						icon: 'error',
						confirmButtonText: 'Ok',
						customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false,
					allowEscapeKey: false
				}).then(function() {
					window.location.href = 'DataShow.php';
				});
				</script>";
		}
	} else {
		echo "<script>
				Swal.fire({
					title: 'Invalid Song ID',
					icon: 'error',
					confirmButtonText: 'Ok',
					customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
				}).then(function() {
					window.location.href = 'DataShow.php';
				});
			</script>";
	}
	?>
	<script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
</body>

</html>