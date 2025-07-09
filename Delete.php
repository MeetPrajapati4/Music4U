<script src="Js/SweetAlert/dist/sweetalert2.all.js"></script>
<?php
session_start();
include "Connection.php";

$sql = "DELETE FROM songs WHERE Music_Id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["Id"]);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo '<script>
            Swal.fire({
                title: "Song Deleted Successfully",
                icon: "success",
                confirmButtonText: "Ok"
            }).then(function() {
                if (result.isConfirmed) {
                    window.history.back();
                }
            });
        </script>';
} else {
    echo '<script>
            Swal.fire({
                title: "Song Deleted Failed",
                icon: "error",
                confirmButtonText: "Ok"
            }).then(function() {
                window.history.back();
            });
        </script>';
}
?>