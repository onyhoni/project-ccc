<?php
require '../functions.php';

$id = $_GET['id'];
$delete = delete("DELETE FROM account_tabel WHERE ACCOUNT = '$id'");

if ($delete > 0) {
    echo "<script>
        alert('data Berhasil di dihapus ..')
        document.location.href = '../setting.php'
        </script>
        ";
} else {
    echo "<script>
        alert('data Gagal di dihapus ..')
        document.location.href = '../setting.php'
        </script>";
}
