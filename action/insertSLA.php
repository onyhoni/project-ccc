<?php
require  '../functions.php';

$id = $_POST['id'];
$pesan = $_POST['pesan'];
$day = $_POST['day'];


mysqli_query($conn, "UPDATE tiket_tabel SET HASIL_SLA = '$pesan', ACTION_DATE = '$day' WHERE TIKET_ID = '$id'");
