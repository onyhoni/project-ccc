<?php
require '../functions.php';



$dateStart = $_POST['input-date-start'];
$dateEnd = $_POST['input-date-end'];
$statusVal = $_POST['input-status'];
$CustomerVal = $_POST['input-customer'];
$dateAction = $_POST['input-action'];
$jmlData = $_POST['input-data'];
$keyword = $_POST['input-search'];
$regionals = $_POST['input-regional'];




use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Nomor');
$sheet->setCellValue('B1', 'NO TICKET');
$sheet->setCellValue('C1', 'NO CONNOTE');
$sheet->setCellValue('D1', 'ID ACCOUNT');
$sheet->setCellValue('E1', 'SHIPPER NAME');
$sheet->setCellValue('F1', 'CONNOTE DATE');
$sheet->setCellValue('G1', 'DEST CODE');
$sheet->setCellValue('H1', 'ORIGIN CODE');
$sheet->setCellValue('I1', 'KODING POD');
$sheet->setCellValue('J1', 'STATUS POD');
$sheet->setCellValue('K1', 'CASE TYPE');
$sheet->setCellValue('L1', 'SUB CASE TYPE');
$sheet->setCellValue('M1', 'DESKRIPSI CASE');
$sheet->setCellValue('N1', 'CREATED BY');
$sheet->setCellValue('O1', 'CREATED DATE');
$sheet->setCellValue('P1', 'CUSTOMER NAME');
$sheet->setCellValue('Q1', 'REGIONAL NAME');
$sheet->setCellValue('R1', 'BRACH NAME');
$sheet->setCellValue('S1', 'ZONA');
$sheet->setCellValue('T1', 'HANDLE BY');
$sheet->setCellValue('U1', 'LAST UPDATE FROM');
$sheet->setCellValue('V1', 'LAST UPDATE NOTE');
$sheet->setCellValue('W1', 'LAST UPDATE DATE');
$sheet->setCellValue('X1', 'ACTION FOLLOW UP');
$sheet->setCellValue('Y1', 'SLA CASE');
$sheet->setCellValue('Z1', 'SLA CASE DAY');
$sheet->setCellValue('AA1', 'STATUS CASE');
$sheet->setCellValue('AB1', 'RESPONSIBILITY');
$sheet->setCellValue('AC1', 'LAST PHOTO');

if ($statusVal !== '' && $CustomerVal !== '' && $dateAction !== '' && $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND ACTION_DATE='$dateAction' AND STATUS ='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else if ($CustomerVal !== '' && $dateAction !== '' && $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND ACTION_DATE='$dateAction' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%' ");
} else if ($CustomerVal !== '' && $statusVal !== '' && $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal' AND STATUS='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else if ($CustomerVal !== '' &&  $regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND RESPONSIBILITY ='$CustomerVal'  AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else if ($CustomerVal !== '' &&  $statusVal != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE RESPONSIBILITY ='$CustomerVal' AND STATUS ='$statusVal'  AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else if ($regionals != '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE REGIONAL ='$regionals' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%' ");
} else if ($CustomerVal !== '') {
    $result = queryAll("SELECT * FROM
     (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.RESPONSIBILITY ='$CustomerVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) ) as data
     
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else if ($statusVal !== '') {
    $result = queryAll("SELECT * FROM
    (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.STATUS ='$statusVal' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) ) as data
    
   WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else if ($dateAction !== '') {
    $result = queryAll("SELECT * FROM
     (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.ACTION_DATE ='$dateAction' AND t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data
     
    WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
} else {
    $result = queryAll("SELECT * FROM (SELECT t.TIKET_ID , t.AWB , t.CUSTOMER_NAME , t.SHIPPER_NAME , t.CONNOTE_DATE  , t.DEST_CODE, t.ORIGIN_CODE ,t.CASE_TYPE , t.DESKRIPSI ,t.KODING_POD ,t.STATUS_POD, t.STATUS ,t.HANDLE ,t.HASIL_SLA , t.CREATE_TIME ,t.CLOSE_TIME , t.ACTION_DATE , t.RESPONSIBILITY , k.ZONA , k.REGIONAL , k.SLA , ct.CATEGORY_CASE , c.CASE , u.USERNAME , k.CODE_3LC , a.BIG_GROUPING_CUST FROM tiket_tabel t INNER JOIN case_tabel c ON t.CASE_TYPE = c.CASE_TYPE_ID INNER JOIN kota_tabel k ON t.dest_code = k.KOTA_ID INNER JOIN category_case ct ON c.CATEGORY_ID=ct.CATEGORY_ID INNER JOIN account_tabel a ON t.CUSTOMER_NAME = a.ACCOUNT INNER JOIN user u ON t.USER_ID = u.USER_ID WHERE t.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)) as data WHERE HANDLE LIKE '%$keyword%' OR AWB LIKE '%$keyword%' OR CUSTOMER_NAME LIKE '%$keyword%' OR TIKET_ID LIKE '%$keyword%'");
}



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

// var_dump($result);

// die;
$nomor = 1;
$i = 2;
foreach ($result as $v) {
    $sheet->setCellValue('A' . $i, $nomor++);
    $sheet->setCellValue('B' . $i, $v['TIKET_ID']);
    $sheet->setCellValue('C' . $i, $v['AWB']);
    $sheet->setCellValue('D' . $i, $v['CUSTOMER_NAME']);
    $sheet->setCellValue('E' . $i, $v['SHIPPER_NAME']);
    $sheet->setCellValue('F' . $i, $v['CONNOTE_DATE']);
    $sheet->setCellValue('G' . $i, $v['DEST_CODE']);
    $sheet->setCellValue('H' . $i, $v['ORIGIN_CODE']);
    $sheet->setCellValue('I' . $i, $v['KODING_POD']);
    $sheet->setCellValue('J' . $i, $v['STATUS_POD']);
    $sheet->setCellValue('K' . $i, $v['CATEGORY_CASE']);
    $sheet->setCellValue('L' . $i, $v['CASE']);
    $sheet->setCellValue('M' . $i, $v['DESKRIPSI']);
    $sheet->setCellValue('N' . $i, $v['USERNAME']);
    $sheet->setCellValue('O' . $i, $v['CREATE_TIME']);
    $sheet->setCellValue('P' . $i, $v['BIG_GROUPING_CUST']);
    $sheet->setCellValue('Q' . $i, $v['REGIONAL']);
    $sheet->setCellValue('R' . $i, $v['CODE_3LC']);
    $sheet->setCellValue('S' . $i, $v['ZONA']);
    $sheet->setCellValue('T' . $i, $v['HANDLE']);
    $sheet->setCellValue('U' . $i, (!empty($v[1])) ? $v[1] : '');
    $sheet->setCellValue('V' . $i, (!empty($v[0])) ? $v[0] : '');
    $sheet->setCellValue('W' . $i, (!empty($v[3])) ? $v[3] : '');
    $sheet->setCellValue('X' . $i, $v['ACTION_DATE']);
    $sheet->setCellValue('Y' . $i, $v['HASIL_SLA']);
    $sheet->setCellValue('Z' . $i, $v['SLA']);
    $sheet->setCellValue('AA' . $i, $v['STATUS']);
    $sheet->setCellValue('AB' . $i, $v['RESPONSIBILITY']);
    $sheet->setCellValue('AC' . $i, (!empty($v[2])) ? $v[2] : '');
    $i++;
}

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$sheet->getStyle('A1:AC' . $i)->applyFromArray($styleArray);
$sheet->getStyle("A1:AC1")->getFont()->setBold(true);

$writer = new Xlsx($spreadsheet);
$filename = 'Report All';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
