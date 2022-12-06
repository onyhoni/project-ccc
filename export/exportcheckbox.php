<?php
require '../functions.php';
$id_user = $_SESSION['id'];
$today = date('Y-m-d H:i:s');

if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        mysqli_query($conn, "UPDATE tiket_tabel SET STATUS = 'PROGRESS' WHERE TIKET_ID = '$id'");
        $query = "INSERT INTO respon_tabel
             VALUES 
             ('','$id','Tiket Berhasil Di ambil','','$today','$id_user')";
        mysqli_query($conn, $query);
    }
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Nomor');
$sheet->setCellValue('B1', 'NO TICKET');
$sheet->setCellValue('C1', 'NO CONNOTE');
$sheet->setCellValue('D1', 'CONNOTE DATE');
$sheet->setCellValue('E1', 'CASE TYPE');
$sheet->setCellValue('F1', 'SUB CASE TYPE');
$sheet->setCellValue('G1', 'CUSTOMER NAME');
$sheet->setCellValue('H1', 'REGIONAL NAME');
$sheet->setCellValue('I1', 'BRANCH NAME');
$sheet->setCellValue('J1', 'DESKRIPSI');
$sheet->setCellValue('K1', 'LAST UPDATE FROM');
$sheet->setCellValue('L1', 'LAST MESSEGE FROM');
$sheet->setCellValue('M1', 'LAST UPDATE DATE');
$sheet->setCellValue('N1', 'ACTION FOLLOW UP');
$sheet->setCellValue('O1', 'SLA CASE');
$sheet->setCellValue('P1', 'STATUS CASE');
$sheet->setCellValue('Q1', 'LINK 1');
$sheet->setCellValue('R1', 'LINK 2');
$sheet->setCellValue('S1', 'LINK 3');
$sheet->setCellValue('T1', 'RESPONSIBILITY');
$sheet->setCellValue('U1', 'CREATE_TIME');
$sheet->setCellValue('V1', 'CLOSE_TIME');


$jumlahDataPerhalaman = $CountData;
$halamanAktif = $index;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;



if ($statusVal !== '' && $CustomerVal !== '' && $dateAction !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND tiket_tabel.STATUS = '$statusVal' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.ACTION_DATE = '$dateAction'AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '' && $dateAction !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.ACTION_DATE = '$dateAction'AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($statusVal !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND  tiket_tabel.STATUS = '$statusVal' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($dateAction !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND  tiket_tabel.ACTION_DATE = '$dateAction' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
}

if ($statusVal !== '' && $CustomerVal !== '' && $dateAction !== '') {
    $hasil = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND tiket_tabel.STATUS = '$statusVal' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.ACTION_DATE = '$dateAction'AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else if ($CustomerVal !== '' && $dateAction !== '') {
    $hasil = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.ACTION_DATE = '$dateAction'AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else if ($CustomerVal !== '') {
    $hasil = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else if ($statusVal !== '') {
    $hasil = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND  tiket_tabel.STATUS = '$statusVal' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else if ($dateAction !== '') {
    $hasil = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND  tiket_tabel.ACTION_DATE = '$dateAction' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else {
    $hasil = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
}

//////////////////////
if ($statusVal !== '' && $CustomerVal !== '' && $dateAction !== '' && $regionals !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND tiket_tabel.STATUS = '$statusVal' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.ACTION_DATE = '$dateAction'AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '' && $dateAction !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.ACTION_DATE = '$dateAction'AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($CustomerVal !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND account_tabel.BIG_GROUPING_CUST = '$CustomerVal' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($statusVal !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND  tiket_tabel.STATUS = '$statusVal' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else if ($dateAction !== '') {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND  tiket_tabel.ACTION_DATE = '$dateAction' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
} else {
    $result = queryAll("SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT WHERE tiket_tabel.TIKET_ID LIKE '%$keyword%' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) LIMIT $awalData , $jumlahDataPerhalaman");
}
///////////////////////////////

$jmlHasil = count($hasil);
if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
    foreach ($result as $i => $val) {
        $id = $val['TIKET_ID'];
        $LastMe = queryAll("SELECT PESAN FROM respon_tabel WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME DESC LIMIT 1");
        $take = queryAll("SELECT USERNAME FROM respon_tabel INNER JOIN user ON respon_tabel.USER_ID = user.USER_ID WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME ASC LIMIT 1
            ");
        foreach ($LastMe as $key => $value) {
            array_push($result[$i], $value['PESAN']);
        }
        foreach ($take as $id => $val) {
            array_push($result[$i], $val['USERNAME']);
        }
    }
}


if (isset($result)) {
    $rowCount  = mysqli_affected_rows($conn);
    foreach ($result as $i => $val) {
        $id = $val['TIKET_ID'];
        $LastMe = queryAll("SELECT PESAN FROM respon_tabel WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME DESC LIMIT 1");
        $take = queryAll("SELECT USERNAME FROM respon_tabel INNER JOIN user ON respon_tabel.USER_ID = user.USER_ID WHERE TIKET_ID = '$id' ORDER BY CREATE_TIME ASC LIMIT 1
            ");
        foreach ($LastMe as $key => $value) {
            array_push($result[$i], $value['PESAN']);
        }
        foreach ($take as $id => $val) {
            array_push($result[$i], $val['USERNAME']);
        }
    }
}
$nomor = 1;
$i = 2;
foreach ($result as $v) {
    $sheet->setCellValue('A' . $i, $nomor++);
    $sheet->setCellValue('B' . $i, $v['TIKET_ID']);
    $sheet->setCellValue('C' . $i, $v['AWB']);
    $sheet->setCellValue('D' . $i, $v['CONNOTE_DATE']);
    $sheet->setCellValue('E' . $i, $v['CATEGORY_CASE']);
    $sheet->setCellValue('F' . $i, $v['CASE']);
    $sheet->setCellValue('G' . $i, $v['BIG_GROUPING_CUST']);
    $sheet->setCellValue('H' . $i, $v['REGIONAL']);
    $sheet->setCellValue('I' . $i, $v['CODE_3LC']);
    $sheet->setCellValue('J' . $i, $v['DESKRIPSI']);
    $sheet->setCellValue('K' . $i, (!empty($v[1])) ? $v[1] : '');
    $sheet->setCellValue('L' . $i, (!empty($v[0])) ? $v[0] : '');
    $sheet->setCellValue('M' . $i, $v['CASE']);
    $sheet->setCellValue('N' . $i, $v['CASE']);
    $sheet->setCellValue('O' . $i, $v['CASE']);
    $sheet->setCellValue('P' . $i, $v['STATUS']);
    $sheet->setCellValue('Q' . $i, $v['LINK_1_PHOTO']);
    $sheet->setCellValue('R' . $i, $v['LINK_2_PHOTO']);
    $sheet->setCellValue('S' . $i, $v['LINK_3_PHOTO']);
    $sheet->setCellValue('T' . $i, $v['REPOSIBILITY']);
    $sheet->setCellValue('U' . $i, $v['CREATE_TIME']);
    $sheet->setCellValue('V' . $i, $v['CLOSE_TIME']);


    $i++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('A1:N' . $i)->applyFromArray($styleArray);
$sheet->getStyle("A1:N1")->getFont()->setBold(true);

$writer = new Xlsx($spreadsheet);
$filename = 'TakeBL';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
