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
    <title>Admin&nbsp;&nbsp;>>>&nbsp;&nbsp;Register</title>
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
            height: 100vh;
            width: 100%;
            padding: 20px;
            background: url("Css/Background/Music12.jpg") no-repeat center center;
            backdrop-filter: blur(5px);
            background-size: cover;
            background-attachment: fixed;
        }

        /* General Wrapper Styles */
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 35vw;
            height: 85vh;
            background-color: rgba(0, 0, 0, 0.4);
            border: 2px ridge red;
            padding: 20px;
            border-radius: 30px;
            backdrop-filter: blur(5px);
            box-shadow: 0 0 5px red;
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

        /* Header Styling */
        h2 {
            font-size: 2rem;
            color: #fff;
            position: relative;
            top: -3vh;
        }

        /* Input Field Styles */
        .input-field {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-bottom: 1.8vw;
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
            border-bottom: 2px solid red;
            border-left: 2px solid red;
            border-right: 2px solid red;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Focused Input Field */
        .input-field input:focus {
            border-color: red;
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
            padding: 10px 30px;
            color: #fff;
            text-indent: -1vw;
            background-color: transparent;
            border-bottom: 2px solid red;
            border-left: 2px solid red;
            border-right: 2px solid red;
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
            width: 30vw;
            position: absolute;
            bottom: 3.5vw;
            left: 50%;
            transform: translateX(-50%);
            transition: all 0.3s ease;
        }

        /* Button Hover State */
        .button:hover {
            color: black;
            width: 25%;
            border-radius: 30px;
            background: red;
        }

        /* Register Text Styling */
        .register {
            text-align: center;
            color: white;
            position: relative;
            top: 4vw;
            font-size: 1rem;
            font-weight: 600;
        }

        .register a {
            color: red;
            text-decoration: none;
        }

        .register a:hover {
            color: lightseagreen;
            transition: color 0.3s ease;
        }

        /* Message Styling */
        #message {
            color: #fff;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div id="data">
        <div class="wrapper">
            <h2>Admin Register</h2>
            <form method="POST" action="AdminRegister.php" autocomplete="off" enctype="multipart/form-data">
                <div class="input-field">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-field">
                    <input type="email" name="email" required>
                    <label>Email</label>
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
                    <input type="file" name="profilePic" accept=".png, .jpg, .jpeg">
                </div>
                <div class="submitbutton">
                    <input class="button" type="submit" name="Register" value="Register">
                </div>
                <div class="register">
                    <p>Already have an account? <a href="Admin.php">AdminLogin</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.querySelector('#data').style.display = 'block';
        }, 1000);
    });
</script>

<?php
if (isset($_POST['Register'])) {

    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $_SESSION['AdminUsername'] = $username;
    $_SESSION['AdminId'] = $_SESSION['LoggedInAdminID'];

    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

    if (!$email) {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'Invalid email address',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });
        </script>";
        exit;
    }
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
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
            });
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
            if ($size > 10000000) {
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
                    });
                </script>";
                exit;
            }

            // Get file extension
            $profilePic_ex = pathinfo($profilePic_name, PATHINFO_EXTENSION);
            $profilePic_ex_lc = strtolower($profilePic_ex);
            $profilePic_allowed_exs = array('jpg', 'jpeg', 'png');

            if (in_array($profilePic_ex_lc, $profilePic_allowed_exs)) {
                $new_profilePic_name = $profilePic_name;
                $profilePic_upload_path = 'Admins/' . $new_profilePic_name;

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
                        });
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
                    });
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
                });
            </script>";
            exit;
        }
    }

    $sql = "INSERT INTO AsAdmins (AdminUserName, AdminEmail, AdminPass, AdminProfilePic) VALUES ('$username', '$email', '$password', '$profilePic_upload_path')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
            Swal.fire({
                title: 'Registration as Admin successful',
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
                    window.location.href='Admin.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error: " . mysqli_error($conn) . "',
                icon: 'error',
                confirmButtonText: 'Ok',
                customClass: {
                    container: 'swal-container-small',
                    popup: 'swal-popup-black',
                    title: 'swal-title-size'
                },
                allowOutsideClick: false
            });
        </script>";
    }
}
?>

</html>