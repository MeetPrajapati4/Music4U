<script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
<?php
session_start();
include "Connection.php";

$sql = "DELETE FROM AsUsers WHERE User_Id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["Id"]);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo '<script>
            Swal.fire({
                title: "User Deleted Successfully",
                icon: "success",
                confirmButtonText: "Ok"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        </script>';
} else {
    echo '<script>
            Swal.fire({
                title: "User Deletion Failed",
                icon: "error",
                confirmButtonText: "Ok"
            }).then((result) => {
                window.history.back();
            });
        </script>';
}

$stmt->close();
