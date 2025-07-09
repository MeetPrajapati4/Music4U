
<?php

// Create connection
$conn = mysqli_connect("Localhost", "root", "", "music4u");

// Check connection
if (!$conn) {
    echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
}
?>