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
            <title>Admin&nbsp;&nbsp;>>>&nbsp;&nbsp;ShowArtists</title>
            <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
            <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="Css/ShowArtists.css">
        </head>

        <body>
            <div id="loader"></div>
            <?php include "AHeader.php"; ?>
            <span id="dataset" style="display: none;">
                <div class="searchbar">
                    <img Loading="Lazy" src="Css/Icons/search.png" draggable="false" style="width: 20px;margin-right: 10px;cursor: pointer;" alt="Search" title="Search">
                    <input type="text" placeholder="Search Here" id="search" title="Search Song Here">
                    <input class="searchbtn" type="submit" value="Search" title="Search">
                </div>
                <div class="add">
                    <button id="add" type="button" onclick="window.location.href='AddArtists.php'"><i class="fa-solid fa-folder-plus"></i> Add Artist</button>
                </div>
                <div class="box">
                    <?php
                    #Check if form submitted
                    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                        $Artistname = mysqli_real_escape_string($conn, $_POST["artist"] ?? '');
                        $Email = mysqli_real_escape_string($conn, $_POST["email"] ?? '');
                        $AImage = mysqli_real_escape_string($conn, $_POST["photo"] ?? '');

                        $sql = "INSERT INTO AsArtist (AName, AEmail, AImage) VALUES ('$Artistname', '$Email', '$AImage')";
                        if (mysqli_query($conn, $sql)) {
                            echo "<script>
                                Swal.fire({
                                    title: 'Artist Added Successfully',
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
                                    title: 'Artist Added Failed',
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
                    $sql = "SELECT * FROM AsArtist ORDER BY Artist_Id DESC";
                    $res = mysqli_query($conn, $sql);
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            $data[] = $row;
                        }
                    }
                    if (count($data) > 0) { ?>
                        <table>
                            <tr id="header">
                                <th>Cover</th>
                                <th>ArtistName</th>
                                <th>ArtistEmail</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                            $i = 0;
                            foreach ($data as $row) {
                                $i++;
                                $id = $row['Artist_Id'];
                            ?>
                                <tr title="<?php echo $row['AName']; ?>" class="data">
                                    <td>
                                        <img Loading="Lazy" id="songcover" draggable="false" src='<?php echo $row['AImage']; ?>' alt='Cover'>
                                    </td>

                                    <td id="songname">
                                        <?php echo $row['AName']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['AEmail']; ?>
                                    </td>
                                    <td>
                                        <a href="EditArtists.php?Id=<?php echo $row['Artist_Id']; ?>" target="_self" class="btn-blue"><img Loading="Lazy" src="Css/Icons/Edit.png" class="edit" alt="Edit"></a>
                                    </td>
                                    </td>
                                    <td>
                                        <a href="DeleteArtists.php?Id=<?php echo $row['Artist_Id']; ?>" target="_Self" onclick="return confirm('Do you want to Delete?') && confirm('Are you sure?')" class="btn-red"><img Loading="Lazy" src="Css/Icons/Delete.png" class="delete" alt="Delete"></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
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
                    // Simulate a loading time
                    setTimeout(() => {
                        // Show the content
                        document.getElementById('dataset').style.display = 'block';
                    }, 1000); // 3 seconds delay
                });
            </script>
            <script src="js/Main.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </body>
        <script>
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();
                const dataElements = document.querySelectorAll('.data');
                dataElements.forEach(element => {
                    const contactText = element.textContent.toLowerCase();
                    if (contactText.includes(searchTerm)) {
                        element.style.display = '';
                    } else {
                        element.style.display = 'none';
                    }
                });
            });
        </script>

        </html>