<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : Full Screen</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Css/FontAwesome/css/all.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
        }

        body {
            background:url(Css/Background/Music4U.png) no-repeat center center fixed;
            background-size: cover;
            color: white;
            min-height: 100vh;
            display: grid;
            grid-template-rows: 1fr auto;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            gap: 2rem;
        }

        .content {
            position: relative;
            bottom: 3rem;
        }

        .header {
            position:relative;
            top: -8vw;
            left: -33vw;
            text-align: left;
        }

        .playlist-info {
            font-size: 0.875rem;
            color: #b3b3b3;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .playlist-title {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
        }

        .album-art {
            display: block;
            position: relative;
            left: -30vw;
            top: 10vw;
            width: min(30vh, 40vw);
            height: min(30vh, 40vw);
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        }

        .song-info {
            position: relative;
            left: -14vw;
            top: 6vw;
            text-align: left;
        }

        .song-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .player-controls {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, #121212);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .progress-container {
            width: 100%;
            max-width: 1600px;
            margin: 0 auto;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            cursor: pointer;
            position: relative;
        }

        .progress-bar-filled {
            position: absolute;
            height: 100%;
            background-color: #1db954;
            border-radius: 2px;
            width: 50%;
        }

        .progress-bar:hover .progress-bar-filled {
            background-color: #1ed760;
        }
            #minimize{
                position: absolute;
                top: -43vw;
                right: -1vw;
                color: white;
                font-size: 2rem;
                cursor: pointer;
            }

        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
            }

            .album-art {
                width: 90vw;
                height: 90vw;
            }

            .player-controls {
                padding: 1rem;
            }

            .main-controls {
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="content">
            <header class="header">
                <div class="playlist-info">PLAYING FROM PLAYLIST</div>
                <h1 class="playlist-title">Best Hindi Romantic Songs 2025 <i class="fas fa-heart"></i></h1>
            </header>
            <img src="Css/Background/Meet-1.jpeg" alt="Album Art" class="album-art" />

            <div class="song-info">
                <div class="song-title">Tainu Khabar Nahi - From "Munjiya"</div>
            </div>
        </div>
    </div>

    <div class="player-controls">
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-bar-filled"></div>
                <i class="fas fa-compress" id="minimize"></i>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('minimize').addEventListener('click', () => {
            window.location.href = 'Home.php'
    });
</script>

</html>