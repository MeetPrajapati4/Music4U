<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : Loading</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        .loader {
            position: relative;
            background: transparent;
            width: 2.5em;
            height: 2.5em;
            scale: 2;
            transform: rotate(165deg);
        }

        .loader:before,
        .loader:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 70%;
            display: block;
            width: 3em;
            height: 3em;
            border-radius: 0.25em;
            transform: translate(-50%, -50%);
        }

        .loader:before {
            animation: before8 2s alternate-reverse infinite;
        }

        .loader:after {
            animation: after6 2s alternate-reverse infinite;
        }

        @keyframes before8 {
            0% {
                width: 0.5em;
                box-shadow: 1em -0.5em rgba(254, 0, 97, 0.9), -1em 0.5em rgba(0, 255, 4, 0.9);
            }

            35% {
                width: 2.5em;
                box-shadow: 0 -0.5em rgba(254, 0, 97, 0.9), 0 0.5em rgba(0, 255, 4, 0.9);
            }

            70% {
                width: 0.5em;
                box-shadow: -1em -0.5em rgba(254, 0, 97, 0.9), 1em 0.5em rgba(0, 255, 4, 0.9);
            }

            100% {
                box-shadow: 1em -0.5em rgba(254, 0, 97, 0.9), -1em 0.5em rgba(0, 255, 4, 0.9);
            }
        }

        @keyframes after6 {
            0% {
                height: 0.5em;
                box-shadow: 0.5em 1em rgba(61, 184, 143, 0.9), -0.5em -1em rgba(255, 174, 0, 0.9);
            }

            35% {
                height: 2.5em;
                box-shadow: 0.5em 0 rgba(4, 22, 220, 0.9), -0.5em 0 rgba(255, 174, 0, 0.9);
            }

            70% {
                height: 0.5em;
                box-shadow: 0.5em -1em rgba(4, 22, 220, 0.9), -0.5em 1em rgba(255, 174, 0, 0.9);
            }

            100% {
                box-shadow: 0.5em 1em rgba(4, 22, 220, 0.9), -0.5em -1em rgba(255, 174, 0, 0.9);
            }
        }

        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="loader"></div>
</body>

</html>