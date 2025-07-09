<?php
session_start();
include 'Connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="Favicon.ico" type="image/x-icon">
  <title>Music4U : Register</title>
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

    #data {
      display: none;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      width: 100%;
      padding: 0 20px;
      background-image: url("Css/Background/Login.png");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    /* General Wrapper Styles */
    .wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 40vw;
      height: 95vh;
      background-color: rgba(0, 0, 0, 0.4);
      border: 2px ridge lightseagreen;
      padding: 20px;
      border-radius: 30px;
      backdrop-filter: blur(5px);
      box-shadow: 0 0 5px lightseagreen;
      animation: fadeIn 0.5s ease-in;
      text-align: center;
    }

    /* FadeIn Animation */
    @keyframes fadeIn {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }
    form{
      position: relative;
      top : -1vw;
    }

    /* Header Styling */
    h2 {
      font-size: 2rem;
      color: #fff;
      margin-bottom: 1.5vw;
      position: relative;
      top: -2vw;
    }

    /* Input Field Styles */
    .input-field {
      display: flex;
      flex-direction: column;
      width: 100%;
      margin-bottom: 1.5vw;
      position: relative;
    }

    /* Input Field Base Styles */
    .input-field input {
      width: 30vw;
      height: 50px;
      padding: 10px 20px;
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
      transform: translateY(-40%);
      color: #fff;
      font-size: 16px;
      pointer-events: none;
      transition: 0.3s ease;
    }

    /* Label when Input is Focused or Valid */
    .input-field input:focus~label,
    .input-field input:valid~label {
      font-size: 1rem;
      top: 2vh;
      transform: translateY(-110%);
    }

    /* File Input Styling */
    .input-field input[type="file"] {
      width: 100%;
      padding: 15px 30px;
      color: #fff;
      text-indent: -1vw;
      background-color: transparent;
      border-bottom: 2px solid lightseagreen;
      border-left: 2px solid lightseagreen;
      border-right: 2px solid lightseagreen;
      border-radius: 10px;
      outline: none;
      transition: border-color 0.3s ease;
    }

    /* Submit Button Styling */
    .submitbutton {
      margin-top: 25px;
    }

    .button {
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      font-weight: 600;
      border: none;
      outline: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 16px;
      width: 100%;
      position: absolute;
      bottom: -1.5vw;
      left: 50%;
      transform: translateX(-50%);
      margin-bottom: 0.5vw;
      transition: all 0.3s ease;
    }

    /* Button Hover State */
    .button:hover {
      color: black;
      width: 25%;
      border-radius: 30px;
      background: lightseagreen;
    }

    /* Register Text Styling */
    .register {
      text-align: center;
      color: white;
      position: relative;
      top: 3vw;
      font-size: 1rem;
      font-weight: 600;
    }

    .register a {
      color: lightseagreen;
      text-decoration: none;
    }

    .register a:hover {
      color: crimson;
      transition: color 0.3s ease;
    }

    /* Message Styling */
    #message,
    #Phonemessage,
    #emailmessage,
    #nameMessage,
    #usernameMessage {
      color: #fff;
      font-size: 1rem;
    }
  </style>
</head>

<body>
  <div id="loader"></div>
  <div id="data">
    <div class="wrapper">
      <h2>Register</h2>
      <form method="POST" action="SubIndex.php" autocomplete="off" enctype="multipart/form-data">
        <div class="input-field">
          <input type="text" name="fullName" id="fullName" required>
          <label>Name</label>
          <div id="nameMessage"></div>
          <script>
            let fullName = document.getElementById("fullName");
            let nameMessage = document.getElementById("nameMessage");

            function validateFullName() {
              if (fullName.value.trim() === "") {
                nameMessage.style.color = 'orangered';
                nameMessage.innerHTML = "Name cannot be empty";
              } else {
                nameMessage.innerHTML = "";
              }
            }
            fullName.addEventListener("input", validateFullName);
          </script>
        </div>
        <div class="input-field">
          <input type="text" name="username" id="username" required>
          <label>Username</label>
          <div id="usernameMessage"></div>
          <script>
            let username = document.getElementById("username");
            let usernameMessage = document.getElementById("usernameMessage");

            function validateUsername() {
              if (username.value.trim() === "") {
                usernameMessage.style.color = 'orangered';
                usernameMessage.innerHTML = "Username cannot be empty";
              } else {
                usernameMessage.innerHTML = "";
              }
            }
            username.addEventListener("input", validateUsername);
          </script>
        </div>
        <div class="input-field">
          <input type="email" name="email" id="email" required>
          <label>Email</label>
          <div id="emailmessage"></div>
          <script>
            let email = document.getElementById("email");
            let email_message = document.getElementById("emailmessage");

            function validateEmail() {
              let emailPattern = /^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

              if (!emailPattern.test(email.value)) {
                email_message.style.color = 'orangered';
                email_message.innerHTML = "Invalid email address";
              } else {
                email_message.innerHTML = "";
              }
            }
            email.addEventListener("input", validateEmail);
          </script>
        </div>
        <div class="input-field">
          <input type="text" name="phone" id="phone" required pattern="[0-9]{10}" inputmode="numeric">
          <label>Phone Number</label>
          <div id="Phonemessage"></div>
          <script>
            let phone = document.getElementById("phone");
            let phone_message = document.getElementById("Phonemessage");

            function validatePhone() {
              if (phone.value.length != 10) {
                phone_message.style.color = 'orangered';
                phone_message.innerHTML = "Phone number must be 10 digits";
              } else {
                phone_message.innerHTML = "";
              }
            }
            phone.addEventListener("input", validatePhone);
          </script>
        </div>
        <div class="input-field">
          <input type="password" name="password" required id="password">
          <label>Password</label>
        </div>
        <div class="input-field">
          <input type="password" name="confirmPassword" required id="confirmPassword">
          <label>Confirm Password</label>
          <div id="message"></div>
          <script>
            let password = document.getElementById("password");
            let confirm_password = document.getElementById("confirmPassword");
            let message = document.getElementById("message");

            function validatePassword() {
              if (password.value === confirm_password.value) {
                message.innerHTML = "";
              } else {
                message.style.color = 'orangered';
                message.innerHTML = "Passwords do not match";
              }
            }
            password.addEventListener("input", validatePassword);
            confirm_password.addEventListener("input", validatePassword);
          </script>
        </div>
        <div class="input-field">
          <input type="file" name="profilePic" accept=".png, .jpg, .jpeg" required>
        </div>
        <div class="submitbutton">
          <input class="button" type="submit" name="Register" value="Register">
        </div>
        <div class="register">
          <p>Already have an account? <a href="index.php">Login</a></p>
        </div>
      </form>
    </div>
  </div>
  <script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
      document.querySelector('#data').style.display = 'block';
    }, 1500); // 2 seconds delay
  });
</script>

<?php
if (isset($_POST['Register'])) {
  // Collect and sanitize user inputs
  // Validate and sanitize user inputs
  $fullName = filter_var(trim($_POST['fullName']), FILTER_SANITIZE_STRING);
  $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
  $_SESSION['Username'] = $username;

  $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
  if ($email === false) {
    echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Invalid email format',
            icon: 'error',
            confirmButtonText: 'Ok',
            customClass: {
                container: 'swal-container-small',
                popup: 'swal-popup-black',
                title: 'swal-title-size'
            },
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'Subindex.php';
        })
    </script>";
    exit;
  }

  $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
  if (strlen($phone) !== 10 || !preg_match('/^\d{10}$/', $phone)) {
    echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Invalid phone number, please enter 10 digits',
            icon: 'error',
            confirmButtonText: 'Ok',
            customClass: {
                container: 'swal-container-small',
                popup: 'swal-popup-black',
                title: 'swal-title-size'
            },
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'Subindex.php';
        })
    </script>";
    exit;
  }
  $orignalpassword = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  // Check if passwords match
  if ($orignalpassword !== $confirmPassword) {
    echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Passwords do not match',
            icon: 'error',
            confirmButtonText: 'Ok',
            customClass: {
                container: 'swal-container-small',
                popup: 'swal-popup-black',
                title: 'swal-title-size'
            },
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'Subindex.php';
        })
    </script>";
    exit;
  }

  // Handle profile picture upload
  $profilePic_upload_path = 'MYCOVERS/Default.png';  // Default image in case no picture is uploaded
  if (isset($_FILES['profilePic'])) {
    $profilePic_name = $_FILES['profilePic']['name'];
    $tmp_name = $_FILES['profilePic']['tmp_name'];
    $error = $_FILES['profilePic']['error'];
    $size = $_FILES['profilePic']['size'];

    if ($error === 0) {
      // Check file size (max 10MB)
      if ($size > 1000000000) {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Sorry, your file is too large.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            }).then(() => {
                window.location.href = 'Subindex.php';
            })
        </script>";
        exit;
      }

      // Get file extension
      $profilePic_ex = pathinfo($profilePic_name, PATHINFO_EXTENSION);
      $profilePic_ex_lc = strtolower($profilePic_ex);
      $profilePic_allowed_exs = array('jpg', 'jpeg', 'png');

      if (in_array($profilePic_ex_lc, $profilePic_allowed_exs)) {
        $new_profilePic_name = $username . '.' . $profilePic_ex_lc;
        $profilePic_upload_path = 'Users/' . $new_profilePic_name;

        // Move the uploaded file to the server
        if (move_uploaded_file($tmp_name, $profilePic_upload_path)) {
          // Profile picture uploaded successfully
        } else {
          echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Profile picture upload failed.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            }).then(() => {
                window.location.href = 'Subindex.php';
            })
          </script>";
          exit;
        }
      } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Please select a valid file format (jpg, jpeg, png).',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            }).then(() => {
                window.location.href = 'Subindex.php';
            })
        </script>";
        exit;
      }
    } else {
      echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'There was an error uploading your file.',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            }).then(() => {
                window.location.href = 'Subindex.php';
            })
        </script>";
      exit;
    }
  }

  // Prepare the SQL query to prevent SQL injection
  $sql = "INSERT INTO AsUsers (FullName, UserName, Email, Phone, Pass, ProfilePic) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssss", $fullName, $username, $email, $phone, $orignalpassword, $profilePic_upload_path);

  // Execute the query and check for success
  if ($stmt->execute()) {
    echo "<script>
            Swal.fire({
                title: 'Registration Successful',
                icon: 'success',
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
              }
            });
        </script>";
  } else {
    echo "<script>
            Swal.fire({
                title: 'Error',
                text: '" . $stmt->error . "',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            }).then(() => {
                window.location.href = 'Subindex.php';
            })
        </script>";
  }
  // Close the statement
  $stmt->close();
}
?>


</html>