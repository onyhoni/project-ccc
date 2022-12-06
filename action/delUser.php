<?php
require '../functions.php';

$id = $_GET['id'];
$delete = delete("DELETE FROM user WHERE USER_ID = '$id'");

if ($delete > 0) {
    echo "<script>
        alert('data Berhasil di dihapus ..')
        document.location.href = '../user_m.php'
        </script>
        ";
} else {
    echo "<script>
        alert('data Gagal di dihapus ..')
        document.location.href = '../user_m.php'
        </script>";
}
