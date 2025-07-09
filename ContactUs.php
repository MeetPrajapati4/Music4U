<?php
session_start();
include "Connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="Css/Contact.css">
</head>

<body>
    <div id="loader"></div>
    <?php include "Header.php"; ?>
    <span id="dataset" style="display: none;">
        <div class="container">
            <div class="contact-header">
                <h1>Contact Us</h1>
            </div>
            <form class="contact-form" action="https://api.web3forms.com/submit" method="POST">
                <input type="hidden" name="access_key" value="91f6dfc1-8873-49c9-b21b-2c79ac9e63f7">
                <?php
                $sql = "SELECT email FROM asusers WHERE username = '" . mysqli_real_escape_string($conn, $_SESSION['Username']) . "'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $email = $row['email'];
                }
                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
                <label for="name"><i class="fas fa-user"></i> UserName</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['Username']); ?>" autocomplete="off" readonly required>

                <label for="email"><i class="fas fa-envelope"></i> Email </label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" autocomplete="off" required>

                <label for="message"><i class="fas fa-comment"></i> Message </label>
                <textarea id="message" style="resize: none;" name="message" rows="5" autocomplete="off" required></textarea>

                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
        <footer>
            <div class="fcontainer">
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
            // Simulate a loading time
            setTimeout(() => {
                // Show the content
                document.getElementById('dataset').style.display = 'block';
            }, 1000); // 3 seconds delay
        });
    </script>
    <script src="js/Main.js"></script>
</body>

</html>