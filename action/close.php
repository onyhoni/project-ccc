<?php
require '../functions.php';
$id_user = $_SESSION['id'];
$today = date('Y-m-d H:i:s');

if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        mysqli_query($conn, "UPDATE tiket_tabel SET STATUS = 'CLOSE',
        CLOSE_TIME = '$today' WHERE TIKET_ID = '$id'");
        $query = "INSERT INTO respon_tabel
        VALUES 
        ('','$id',NULL,'Tiket Berhasil Ditutup',NULL,'$today','$id_user')";
        mysqli_query($conn, $query);
    }
}
