<?php
include "Connection.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music4U : Change Password</title>
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
            width: 30%;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            height: 70vh;
            border-radius: 30px;
            backdrop-filter: blur(5px);
            border: 2px ridge lightseagreen;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
        }

        form label {
            color: lightseagreen;
            font-weight: 600;
            font-size: 16px;
            letter-spacing: 1px;
        }

        h1 {
            margin-top: 10px;
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
            text-indent: 10px;
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
            margin-bottom: 3vw;
            transition: all 0.3s ease;
        }

        .btn:hover {
            color: black;
            border-radius: 30px;
            background: lightseagreen;
            box-shadow: 0 2px 5px rgba(0, 255, 255, 0.2);
            transition: all 0.3s ease;
        }


        .otp-input {
            display: flex;
            gap: 10px;
        }

        #otp:focus {
            border-color: #00ff5e;
            box-shadow: 0 2px 5px rgba(0, 255, 94, 0.2);
        }

        .otp-verify {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-weight: 600;
            border: none;
            outline: none;
            padding: 12px 20px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            top: 0;
        }

        .otp-verify:hover {
            color: black;
            border-radius: 30px;
            background: #00ff5e;
            box-shadow: 0 2px 5px rgba(0, 255, 94, 0.2);
            transition: all 0.3s ease;
        }

        .password-remember {
            display: flex;
            white-space: nowrap;
            text-align: center;
            margin-top: 10px;
            color: #fff;
            position: absolute;
            bottom: 20px;
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
    <form method="POST">
        <h1>Change Password</h1>
        <div class="otp-input">
            <input type="text" id="otp" name="checkotp" placeholder="Enter OTP...">
            <button type="submit" name="verify" class="otp-verify">VerifyOTP</button>
        </div>
        <label for="user">New Password</label>
        <input type="text" id="user" name="userpassword" autocomplete="off" placeholder="Enter NewPassword...">
        <label for="user">Confirm New Password</label>
        <input type="text" id="user" name="userconfirmpassword" autocomplete="off" placeholder="Enter ConfirmNewPassword...">
        <button type="submit" name="otp" class="btn" onclick="return myFunction()">Change</button>
        </div>
        <p class="password-remember">Forgot Password?&nbsp;<a href="ForgotPassword.php" target="_search">Click Here</a></p>
    </form>
</body>
<?php
if (isset($_POST['verify'])) {
    $otpval = $_POST['checkotp'];
if ($otpval == $_SESSION['otpval']) {
        echo "<script>alert('OTP Verified')</script>";
    } else {
        echo "<script>alert('Invalid OTP')</script>";
    }
}
?>

</html>