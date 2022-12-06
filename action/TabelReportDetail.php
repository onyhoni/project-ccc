<?php

require '../functions.php';

$keyword  = $_POST['keyword'];

$keyword = str_replace("'", "", $keyword);


$statusVal  = $_POST['statusVal'];
$CustomerVal  = $_POST['CustomerVal'];
$CountData  = $_POST['CountData'];
$index = $_POST['index'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];
$dateAction = $_POST['dateAction'];
$regionals = $_POST['regionals'];



$jumlahDataPerhalaman = $CountData;
$halamanAktif = $index;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;



if ($statusVal !== '' && $CustomerVal !== '' && $dateAction !== '' && $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND ACTION_DATE='$dateAction' AND STATUS ='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '' && $dateAction !== '' && $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND ACTION_DATE='$dateAction' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '' && $statusVal !== '' && $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND STATUS='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '' &&  $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal'  AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '' &&  $statusVal != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE RESPONSIBILITY ='$CustomerVal' AND STATUS ='$statusVal'  AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'  LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '') {
    $result = queryAll("SELECT * FROM
     (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.RESPONSIBILITY ='$CustomerVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) ) as data
     
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($statusVal !== '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.STATUS ='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) ) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($dateAction !== '') {
    $result = queryAll("SELECT * FROM
     (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.ACTION_DATE ='$dateAction' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
     
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
} else {
    $result = queryAll("SELECT * FROM (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%'  OR TIKET_ID LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' LIMIT $awalData , $jumlahDataPerhalaman");
}


if ($statusVal !== '' && $CustomerVal !== '' && $dateAction !== '' && $regionals != '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND ACTION_DATE='$dateAction' AND STATUS ='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($CustomerVal !== '' && $dateAction !== '' && $regionals != '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND ACTION_DATE='$dateAction' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($CustomerVal !== '' && $statusVal !== '' && $regionals != '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND STATUS='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($CustomerVal !== '' &&  $regionals != '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal'  AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($CustomerVal !== '' &&  $statusVal != '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE RESPONSIBILITY ='$CustomerVal' AND STATUS ='$statusVal'  AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($regionals != '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($CustomerVal !== '') {
    $hasil = queryAll("SELECT * FROM
     (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.RESPONSIBILITY ='$CustomerVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
     
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($statusVal !== '') {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.STATUS ='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else if ($dateAction !== '') {
    $hasil = queryAll("SELECT * FROM
     (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.ACTION_DATE ='$dateAction' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
     
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
} else {
    $hasil = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%'");
}



$jmlHasil = count($hasil);
if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
    foreach ($result as $i => $val) {
        $id = $val['TIKET_ID'];
        $LastMe = queryAll("SELECT PESAN FROM respon_tabel WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME DESC LIMIT 1");
        $take = queryAll("SELECT USERNAME FROM respon_tabel INNER JOIN user ON respon_tabel.USER_ID = user.USER_ID WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME DESC LIMIT 1
            ");
        $respon = queryAll("SELECT * FROM `respon_tabel` WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME DESC LIMIT 1");

        foreach ($LastMe as $key => $value) {
            array_push($result[$i], $value['PESAN']);
        }
        foreach ($take as $id => $val) {
            array_push($result[$i], $val['USERNAME']);
        }
        foreach ($respon as $id => $val) {
            array_push($result[$i], $val['FOTO']);
            array_push($result[$i], $val['CREATE_TIME']);
        }
    }
}




$jumlahhalaman = ceil($jmlHasil / $jumlahDataPerhalaman);
?>

<?php if ($rowCount > 0) : ?>

    <div class="border-neutral-200 rounded-md w-full  overflow-x-auto">
        <table class="table-auto bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3 whitespace-nowrap">
            <thead class=" border-b-2 border-neutral-200">
                <tr class="uppercase text-xs font-bold text-black">
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div class="text-primary-700 cursor-pointer">
                                No
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div class="text-primary-700 cursor-pointer">
                                No Ticket
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                No Connote
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                ID Account
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Shipper Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Connote Date
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Dest Code
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Origin Code
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Koding POD
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Status POD
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Case Type
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Sub Case Type
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Deskripsi Case
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Create By
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Create Date
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Customer Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Regional Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Branch Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Zona
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Handle By
                            </div>
                        </div>
                    </th>

                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Last Update From
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Last Update Note
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Last Update Date
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Action Follow Up
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                SLA Case
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                SLA Case Day
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Status Case
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Responsibility
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Last Photo
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 align-top">
                <?php $awalData = $awalData + 1  ?>
                <?php foreach ($result as $data) : ?>
                    <tr class="uppercase text-xs text-neutral-500">
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div>
                                <?= $awalData++ ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="uppercase rounded-md text-xs font-semibold p-1 bg-[#C5DCFA] text-[#0F56B3]">
                                <a href="detail.php?id=<?= $data['TIKET_ID'] ?>"><?= $data['TIKET_ID'] ?> </a>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['AWB'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['CUSTOMER_NAME'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['SHIPPER_NAME'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['CONNOTE_DATE'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['DEST_CODE'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['ORIGIN_CODE'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['KODING_POD'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['STATUS_POD'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['CATEGORY_CASE'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['CASE'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['DESKRIPSI'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['USERNAME'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['CREATE_TIME'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['BIG_GROUPING_CUST'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['REGIONAL'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['CODE_3LC'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['ZONA'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['HANDLE'] ?>
                            </div>
                        </td>

                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= (!empty($data[1])) ? $data[1] : '' ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= (!empty($data[0])) ? $data[0] : '' ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= (!empty($data[3])) ? $data[3] : '' ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['ACTION_DATE'] ?>
                            </div>
                        </td>
                        <td class=" px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['HASIL_SLA'] ?>
                            </div>
                        </td>
                        <td class=" px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['SLA'] ?>-days
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <?php if ($data['STATUS'] == 'CLOSE') : ?>
                                <div class="uppercase py-1 px-2 rounded-md text-xs font-semibold bg-[#E8FFF7] text-[#04B49F]">
                                    <?= $data['STATUS'] ?>
                                </div>
                            <?php elseif ($data['STATUS'] == 'OPEN') : ?>
                                <div class="uppercase py-1 px-2 rounded-md text-xs font-semibold bg-[#f5dcd8] text-[#b44a04]">
                                    <?= $data['STATUS'] ?>
                                </div>
                            <?php else : ?>
                                <div class="uppercase py-1 px-2 rounded-md text-xs font-semibold  bg-[#FFD572] text-[#a38a4f]">
                                    <?= $data['STATUS'] ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class=" px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= $data['RESPONSIBILITY'] ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 select-none cursor-pointer">
                            <div class="p-1">
                                <?= (!empty($data[2])) ? $data[2] : '' ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class=" text-gray-300 flex items-center space-x-2 select-none mt-5" id="pagination">
        <button type="button" class="h-8 w-8 p-1 hover:bg-gray-700 rounded page-control" data-action="minus"><svg fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="space-x-1">
            <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
                <?php if ($i == $index) : ?>
                    <button type="button" class="hover:bg-gray-700 bg-gray-700 px-2 rounded page-item" data-index="<?= $i ?>"><?= $i ?></button>
                <?php else : ?>
                    <button type="button" class="hover:bg-gray-700  px-2 rounded page-item" data-index="<?= $i ?>"><?= $i ?></button>
                <?php endif; ?>
                <?php if ($i == 6) {
                    break;
                } ?>

            <?php endfor ?>
        </div>
        <button type="button" class="h-8 w-8 p-1 hover:bg-gray-700 rounded page-control" data-action="plus">
            <svg fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <p class="text-black font-inter">Hasil <span class="font-bold"><?= $jmlHasil ?></span></p>
    </div>
<?php else : ?>
    <div class="border-neutral-200 rounded-md w-full h-[660px] overflow-x-auto overflow-y-auto ">
        <table class="table-auto bg-white min-w-full overflow-x-auto font-inter text-center border-separate border-spacing-y-3 whitespace-nowrap">
            <thead class=" border-b-2 border-neutral-200">
                <tr class="uppercase text-xs font-bold text-black">
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>

                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                No
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div class="text-primary-700 cursor-pointer">
                                No Ticket
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                No Connote
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Case Type
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Status Case
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Customer Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Seller Name
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Dest Code
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Regional
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Ref ID
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Create Date
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Close Date
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Fist Take
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                Last Messege From
                            </div>
                        </div>
                    </th>
                    <th class="px-4 py-3 select-none cursor-pointer">
                        <div class="">
                            <div>
                                SLA Case
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 align-top">
                <tr class="uppercase text-xs text-neutral-500">
                    <td class="px-4 select-none cursor-pointer" colspan="15">
                        <div>
                            <p class="text-primary text-sm font-bold">Data Tidak Ditemukan...</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>