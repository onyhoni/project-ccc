<?php
require '../functions.php';

$result = queryAll("SELECT tiket_tabel.TIKET_ID , tiket_tabel.CREATE_TIME , kota_tabel.SLA FROM `tiket_tabel` INNER JOIN kota_tabel ON tiket_tabel.DEST_CODE = kota_tabel.KOTA_ID WHERE tiket_tabel.STATUS = 'OPEN' OR tiket_tabel.STATUS = 'PROGRESS'");

foreach ($result as $data) {
    $id = $data['TIKET_ID'];
    $dateStart = $data['CREATE_TIME'];
    $waktuawal  = date_create($dateStart); //waktu di setting
    $waktuakhir = date_create(); //2019-02-21 09:35 waktu sekarang
    $diff  = date_diff($waktuawal, $waktuakhir);

    if ($diff->d > $data['SLA']) {
        mysqli_query($conn, "UPDATE tiket_tabel SET HASIL_SLA = 'OVER SLA', ACTION_DATE = '$diff->d' WHERE TIKET_ID ='$id'");
    } else {
        mysqli_query($conn, "UPDATE tiket_tabel SET HASIL_SLA = 'SLA', ACTION_DATE = '$diff->d' WHERE TIKET_ID ='$id'");
    }
}
