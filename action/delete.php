<?php
require '../functions.php';

if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        mysqli_query($conn, "DELETE FROM tiket_tabel WHERE TIKET_ID = '$id'");
    }
}
