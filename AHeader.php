<style>
    /* Navbar */
    .navbar {
        position: fixed;
        top: 0;
        background-color: #161616;
        border: 1px ridge white;
        height: 62px;
        width: 99.9vw;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 10px;
        z-index: 10;
    }

    .navbar-logo {
        height: 2.5vw;
        width: auto;
        transition: 0.3s ease;
        cursor: pointer;
    }

    .navbar-list {
        position: absolute;
        right: 3vw;
        width: 30%;
        text-align: left;
        padding-left: 2rem;
    }

    .navbar-list li {
        position: relative;
        top: -1.5vh;
        display: inline-block;
        margin: 0 10px;
    }

    .navbar-list:hover>:not(:hover) {
        filter: blur(1px);
        opacity: 0.5;
        transition: filter 0.3s ease 0.1s, opacity 0.3s ease;
    }

    .navbar-list li a {
        text-decoration: none;
        color: #fff;
        font-size: 1.2vw;
        padding: 1vw 1vw;
        border-radius: 30px;
        transition: 0.3s ease;
    }

    .navbar-list li a:hover {
        transition: 0.3s ease;
        font-size: 1.2vw;
        background-color: #04af6b;
        padding: 0.5vw 1vw;
    }

    .profile-dropdown {
        position: relative;
        left: 0vw;
        width: fit-content;
    }

    .profile-dropdown #username {
        font-size: 15px;
        font-weight: 500;
        color: #fff;
    }

    .profile-dropdown-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-right: 1rem;
        font-size: 1.5rem;
        font-weight: 500;
        width: 99.5px;
        border-radius: 50px;
        color: #393e46;
        cursor: pointer;
        border: 2px ridge white;
        transition: all 0.3s ease;
    }

    .profile-dropdown-btn:hover {
        border: 2px ridge #10dbc0;
        box-shadow: 0px 2px 8px 0px rgba(34, 124, 112, 0.2);
    }

    .profile-img {
        position: relative;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        background: url("Background/Meet-1.jpeg") no-repeat center center;
        background-size: cover;
    }

    .profile-dropdown-btn span {
        margin: 0 0.5rem;
        margin-right: 0;
    }

    .profile-dropdown-list {
        position: absolute;
        top: 68px;
        width: 220px;
        right: 0;
        background-color: black;
        border-radius: 10px;
        max-height: 0;
        overflow: hidden;
        box-shadow: 0px 2px 8px 0px rgba(34, 124, 112, 0.2);
        transition: max-height 0.5s;
    }

    .profile-dropdown-list hr {
        border: 0.5px ridge #1db954;
    }

    .profile-dropdown-list.active {
        max-height: 500px;
    }

    .profile-dropdown-list-item {
        padding: 0.5rem 0rem 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .profile-dropdown-list-item a {
        display: flex;
        align-items: center;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        color: white;
    }

    .profile-dropdown-list-item a i {
        margin-right: 0.8rem;
        font-size: 1.1rem;
        width: 2.3rem;
        height: 2.3rem;
        background-color: #1db954;
        color: black;
        line-height: 2.3rem;
        text-align: center;
        margin-right: 1rem;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .profile-dropdown-list-item:hover {
        transition: all 0.3s ease;
        padding-left: 1.5rem;
        background-color: rgba(29, 185, 84, 0.3);
    }

    /* Navbar End */
</style>

<nav class="navbar">
    <img Loading="Lazy" src="Css/Background/logo.png" onclick="window.location.href = 'Dashboard.php';" class="navbar-logo" alt="logo" title="Music4U">
    <?php

    if (isset($_SESSION['Admin'])) {
        // Clean the username to keep only alphabetic characters
        $username = preg_replace('/[^A-Za-z]/', '', $_SESSION['Admin']);
    ?>
        <h3 style="position: absolute; left: 50%; transform: translateX(-50%);"></h3>
    <?php } ?>
    <script>
        const username = "<?php echo json_encode(ucwords($username)); ?>";
        const textArray = [
            `Hello 👋, ${username}`,
            "Welcome To Music4U ",
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
    </script>

    <!-- Nav Menu -->
    <div class="navbar-menu">
        <ul class="navbar-list">
            <li><a href="Home.php">Home</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
            <li><a href="About.php">About</a></li>
        </ul>
    </div>

    <div class="profile-dropdown">
        <div onclick="toggle()" class="profile-dropdown-btn">
            <?php
            $sql = "SELECT AdminProfilePic FROM AsAdmins WHERE AdminUserName = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION['Admin']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                echo '<img Loading="Lazy" src="' . htmlspecialchars($row['AdminProfilePic']) . '" class="profile-img" alt="Profile Picture" />';
            } else {
                echo '<img Loading="Lazy" src="MYCOVERS/Default.png" class="profile-img" alt="Default Profile Picture" />';
            }
            ?>
        </div>
        <ul class="profile-dropdown-list">
            <li class="profile-dropdown-list-item">
                <a href="AddArtists.php">
                    <i class="fa-solid fa-guitar"></i>
                    Become an Artist
                </a>
            </li>
            <hr />
            <li class="profile-dropdown-list-item">
                <a href="OtherPages/Logout.php">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Log out
                </a>
            </li>
        </ul>
    </div>
</nav>
<script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
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
</script>