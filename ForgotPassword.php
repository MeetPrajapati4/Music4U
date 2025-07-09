<?php
include 'Connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : Forgot Password</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Open Sans", sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
            background: url("Css/Background/Login.png") no-repeat center center fixed;
            background-size: cover;
        }

        form {
            width: 500px;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 0px 40px;
            display: grid;
            gap: 20px;
            height: 50vh;
            padding-bottom: 20px;
            border-radius: 30px;
            backdrop-filter: blur(5px);
            border: 2px ridge lightseagreen;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }

        h1 {
            margin-top: 20px;
            color: lightseagreen;
            text-align: center;
        }

        input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: 2px ridge lightseagreen;
            outline: none;
            border-radius: 20px;
            font-size: 16px;
            color: #fff;
            text-indent: 5px;
            padding-left: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus {
            border-color: lightseagreen;
            box-shadow: 0 2px 5px rgba(0, 255, 255, 0.2);
        }

        .btn {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-weight: 600;
            border: none;
            outline: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
            width: 100%;
            height: 50px;
            margin-bottom: 8vw;
            transition: all 0.3s ease;
        }

        .btn:hover {
            color: black;
            border-radius: 30px;
            background: lightseagreen;
            box-shadow: 0 2px 5px rgba(0, 255, 255, 0.2);
            transition: all 0.3s ease;
        }


        .password-remember {
            display: flex;
            white-space: nowrap;
            text-align: center;
            margin-top: 10px;
            color: #fff;
            position: absolute;
            bottom: 35px;
            left: 50%;
            font-size: 16px;
            transform: translateX(-50%);
        }

        .password-remember a {
            text-decoration: none;
            color: lightseagreen;
        }

        .password-remember a:hover {
            color: crimson;
            text-decoration: none;
            transition: color 0.3s ease;
        }
    </style>
</head>

<body>
    <form action="ForgotPassword.php" method="POST">
        <h1>OTP Verification</h1>
        <input type="text" id="user" name="username" placeholder="Enter Username...">
        <input type="email" id="email" name="useremail" placeholder="Enter Email...">
        <button type="submit" name="otp" class="btn">Send OTP</button>
        <p class="password-remember">Do you remember your password?
            &nbsp;<a href="ChangePassword.php" target="_search">Change Password</a></p>
    </form>
</body>

</html>