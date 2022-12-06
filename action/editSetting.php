<?php
require '../functions.php';

if (editAccount($_POST) > 0) {
    echo "<script>
    alert('data berhasil diubah')
    document.location.href = '../setting.php'
</script>";
} else {
    echo "<script>
    alert('data gagal diubah')
        document.location.href = '../setting.php'
        </script>";
}
