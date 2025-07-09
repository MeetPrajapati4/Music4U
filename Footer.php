<?php
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
} ?>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<style>
    footer {
        background-color: #222;
        color: #fff;
        padding: 65px 0;
        font-family: Arial, sans-serif;
        font-size: 0.9rem;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    footer .container {
        max-width: 1200px;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 0 30px;
    }

    footer .footer-section {
        flex: 1;
        padding: 0 15px;
        margin-bottom: 30px;
        position: relative;
        left: 1vw;
    }

    footer h3 {
        font-size: 1.6rem;
        color: #f1f1f1;
        margin-bottom: 20px;
        text-align: center;
    }

    footer p {
        font-size: 1rem;
        color: #bbb;
        line-height: 1.6;
        text-align: center;
    }

    footer ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 2vw;
        justify-content: center;
    }

    footer ul:hover>:not(:hover) {
        filter: blur(1px);
        opacity: 0.3;
        transition: filter 0.3s ease 0.1s, opacity 0.3s ease;
    }

    footer ul li {
        margin: 10px 0;
    }

    footer ul li a {
        text-decoration: none;
        color: #ddd;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    footer ul li a:hover {
        color: #1db954;
    }

    footer .social-icons {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    footer .social-icon {
        font-size: 1.5rem;
        margin: 0 10px;
        color: #ddd;
        transition: color 0.3s ease;
    }

    .social-icons:hover>:not(:hover) {
        filter: blur(1px);
        opacity: 0.3;
        transition: filter 0.3s ease 0.1s, opacity 0.3s ease;
    }

    footer .social-icon:hover {
        color: #1db954;
    }

    footer .social-icons i {
        padding: 10px;
        border-radius: 20px;
        background-color: transparent;
        transition: all 0.3s ease;
    }

    footer .social-icons i:hover {
        background-color: #0c692c;
        transform: scale(1.1);
    }

    footer .copyright {
        background-color: #111;
        color: #aaa;
        text-align: center;
        padding: 20px 0;
        width: 100%;
    }

    footer .copyright p {
        margin-left: 3vw;
        font-size: 0.9rem;
    }

    footer .copyright a {
        color: #aaa;
        text-decoration: none;
    }

    footer .copyright a:hover {
        color: #1db954;
    }
</style>
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