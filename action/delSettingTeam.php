<?php

require '../functions.php';

$id  = $_GET['team'];
$user  = $_GET['type'];

$delete = delete("DELETE FROM user WHERE TEAM = '$id' AND TYPE_USER = '$user'");

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
