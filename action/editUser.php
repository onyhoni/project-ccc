<?php
require '../functions.php';

if (editUser($_POST) > 0) {
    echo "<script>
    alert('data Berhasil di Ubah ..')
    document.location.href = '../user_m.php'
</script>";
} else {
    echo "<script>
    alert('data Gagal di Ubah ..')
        document.location.href = '../user_m.php'
        </script>";
}
