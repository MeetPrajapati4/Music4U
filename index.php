<?php
session_start();
include "Connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Music4U : Login</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      box-sizing: border-box;
      text-shadow: 0px 2px 1px black;
      scroll-behavior: smooth !important;
      transition: all 0.5s ease;
      /* Text-Select off  */
      -webkit-user-select: none;
      -ms-user-select: none;
      user-select: none;
      -moz-user-select: none;
    }


    /* Alert */
    .swal-title-size {
      background-color: transparent;
      font-size: 18px;
    }

    .swal-popup-black {
      width: 400px;
      height: 350px;
      background-color: #161616;
      color: #fff;
      font-size: 18px;
      border: 2px ridge #04af6b;
      box-shadow: inset 0px 2px 8px 0px rgba(18, 162, 143, 0.484);
      max-width: 100% !important;
      border-radius: 50px;
    }

    .swal-container-small {
      display: flex;
      background: transparent;
      font-size: 18px;
      justify-content: center;
      align-items: center;
    }

    /* Alert Close */

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100%;
      padding: 20px;
      background: url("Css/Background/Login.png") no-repeat center center fixed;
      background-size: cover;
    }

    /* Wrapper styles */
    .wrapper {
      display: flex;
      flex-direction: column;
      width: 70vw;
      max-width: 500px;
      height: 55vh;
      padding: 30px 40px;
      border-radius: 30px;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(5px);
      border: 2px ridge lightseagreen;
      box-shadow: 0 0 5px lightseagreen;
      position: relative;
      animation: fadeIn 0.5s ease-in;
    }

    /* Fade-in animation */
    @keyframes fadeIn {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    /* Form styling */
    form {
      width: 100%;
    }

    /* Header styles */
    h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
      color: #fff;
      text-align: center;
    }

    /* Input Field Styles */
    .input-field {
      display: flex;
      flex-direction: column;
      width: 100%;
      margin-bottom: 2vw;
      position: relative;
      right: 1vw;
    }

    /* Input Field Base Styles */
    .input-field input {
      width: 30vw;
      height: 50px;
      padding: 10px 25px;
      border-radius: 10px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 16px;
      color: #fff;
      border-bottom: 2px solid lightseagreen;
      border-left: 2px solid lightseagreen;
      border-right: 2px solid lightseagreen;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Focused Input Field */
    .input-field input:focus {
      border-color: lightseagreen;
    }

    /* Label Styles */
    .input-field label {
      position: absolute;
      top: 50%;
      left: 20px;
      transform: translateY(-50%);
      color: #fff;
      font-size: 16px;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    /* Label when Input is Focused or Valid */
    .input-field input:focus~label,
    .input-field input:valid~label {
      font-size: 1rem;
      top: 2vh;
      transform: translateY(-120%);
    }

    /* File Input Styling */
    .input-field input[type="file"] {
      width: 100%;
      padding: 10px 30px;
      color: #fff;
      text-indent: -1vw;
      background-color: transparent;
      border-bottom: 2px solid lightseagreen;
      border-top: none;
      border-left: none;
      border-right: none;
      border-radius: 10px;
      outline: none;
      transition: border-color 0.3s ease;
    }

    /* Forgot password and remember me section */
    .forget {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 25px 0 35px 0;
      color: #fff;
    }

    #remember {
      accent-color: #fff;
    }

    .forget label {
      display: flex;
      align-items: center;
    }

    .forget label p {
      margin-left: 8px;
    }

    /* Link styling */
    .wrapper a {
      color: #efefef;
      text-decoration: none;
    }

    .wrapper a:hover {
      text-decoration: underline;
    }

    /* Button styles */
    #Login {
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      font-weight: 600;
      border: none;
      outline: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 16px;
      width: 90%;
      margin-bottom: 3vw;
      position: absolute;
      bottom: 0.5vw;
      left: 50%;
      transform: translateX(-50%);
      transition: all 0.3s ease;
    }

    #Login:hover {
      color: black;
      width: 20%;
      border-radius: 30px;
      background: lightseagreen;
      box-shadow: 0 2px 5px rgba(0, 255, 255, 0.2);
      transition: all 0.3s ease;
    }

    /* Registration section */
    .register {
      text-align: center;
      color: white;
      margin-top: 30px;
      font-size: 1.3rem;
      font-weight: 600;
      position: relative;
      top: 2vw;
    }

    .register a {
      color: lightseagreen;
      text-decoration: none;
    }

    .register a:hover {
      color: crimson;
      text-decoration: none;
      transition: color 0.3s ease;
    }
  </style>
</head>

<body>
  <div id="data" style="display:none;">
    <div class="wrapper">
      <form method="post">
        <h2>Login</h2>
        <div class="input-field">
          <input type="text" name="username" autocomplete="off" required>
          <label>Username</label>
        </div>
        <div class="input-field">
          <input type="password" name="password" autocomplete="off" required>
          <label>Password</label>
        </div>
        <div class="forget">
          <label for="remember">
            <input type="checkbox" id="remember" name="remember" value="remember">
            <p>Remember me</p>
          </label>
          <a href="ForgotPassword.php">Forgot password?</a>
        </div>
        <button type="submit" id="Login" name="Login">Log In</button>
        <div class="register">
          <p>Don't have an account? <a href="SubIndex.php">Register</a></p>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
        document.querySelector('#data').style.display = 'flex';
      }, 2000); // 2 seconds delay
    });
  </script>
  <script src="js/SweetAlert/dist/sweetalert2.all.js"></script>
  <?php

  // User Login
  if (isset($_POST['Login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM AsUsers WHERE Username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
      $user = mysqli_fetch_assoc($result);
      if ($password === $user['Pass']) {
        $_SESSION['Username'] = $username;
        $_SESSION['UserId'] = $user['User_Id'];
        $_SESSION['LoggedInUserID'] = $user['User_Id'];
        echo "<script>window.location.href = 'Home.php';</script>";
      } else {
        echo "<script>
          Swal.fire({
            title: 'Incorrect username or password',
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
              window.location.href = 'index.php';
              document.body.style.overflow = 'auto';
            }
          })
        </script>";
      }
    } else {
      echo "<script>
        Swal.fire({
          title: 'Incorrect username or password',
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
              window.location.href = 'index.php';
              document.body.style.overflow = 'auto';
            }
          })
      </script>";
    }
  }
  ?>
</body>

</html>