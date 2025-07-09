<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : About</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <link rel="stylesheet" href="Css/About.css">
</head>

<body>
    <div id="loader"></div>
    <?php include 'Header.php'; ?>
    <div class="container">
        <div class="main">
            <div class="profile-card">
                <h2 class="connect">Connect With Me</h2>
                <div class="buttons">
                    <a href="https://github.com/MeetPrajapati4/" class="btn" title="GitHub" target="_blank"><i class="fa-brands fa-github"></i></a>
                    <a href="https://wa.me/qr/GMWAJXC7BBO6J1" class="btn" title="Whatsapp" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://telegram.me/" class="btn" title="Telegram" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                    <a href="https://www.instagram.com/_meet4u/"
                        class="btn" title="Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/chadotara-mit-43544b241?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
                        class="btn" title="Linkedin" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <div class="about">
                    <h2>Our Music4U</h2>
                    <p><i class="fa-solid fa-arrow-right"></i> Music4U is an online music streaming service that allows users to discover, stream, and manage music effortlessly.</p>
                    <br>
                    <p><i class="fa-solid fa-arrow-right"></i> Provides an affordable option for users to experience different music genres.</p>
                    <br>
                    <p><i class="fa-solid fa-arrow-right"></i> Enhances user experience, improves content delivery, and reduces operational costs for music platforms.</p>
                    <br>
                    <p><i class="fa-solid fa-arrow-right"></i> Integrates modern technology to provide a cohesive, user-friendly platform for discovering, streaming, and managing music services.</p>
                    <br>
                    <p><i class="fa-solid fa-arrow-right"></i> Provides guidence for developers, stakeholders, and users to understand the platform’s features, structure, and music streaming process.</p>
                    <br>
                    <p><i class="fa-solid fa-arrow-right"></i> Increases knowledge about the project and language used to build it.</p>
                    <br>
                    <p><i class="fa-solid fa-arrow-right"></i> Elevates user engagement, optimizes content distribution, and lowers operational expenses for music services.</p>
                </div>
            </div>
        </div>
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
    <script src="js/Main.js"></script>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Simulate a loading time
        setTimeout(() => {
            document.querySelector('.profile-pic').style.animation = 'looks 0.8s ease-in-out';
        }, 1000); // 3 seconds delay
    });
</script>

</html>