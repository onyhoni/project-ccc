<?php
require '../functions.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'NO');
$sheet->setCellValue('B1', 'USER_ID');
$sheet->setCellValue('C1', 'FIRST_NAME');
$sheet->setCellValue('D1', 'LAST_NAME');
$sheet->setCellValue('E1', 'USER_NAME');
$sheet->setCellValue('F1', 'PASSWORD');
$sheet->setCellValue('G1', 'TYPE_USER');
$sheet->setCellValue('H1', 'BRANCH');
$sheet->setCellValue('I1', 'TEAM');
$sheet->setCellValue('J1', 'MOBILE_NO');
$sheet->setCellValue('K1', 'EMAIL');
$sheet->setCellValue('L1', 'JABATAN');
$sheet->setCellValue('M1', 'CREATE_DATE');
$sheet->setCellValue('N1', 'UPDATE_DATE');

$result = mysqli_query($conn, "SELECT * FROM user ORDER BY CREATE_DATE ASC");
$nomor = 1;
$i = 2;
foreach ($result as $k => $v) {
    $sheet->setCellValue('A' . $i, $nomor++);
    $sheet->setCellValue('B' . $i, $v['USER_ID']);
    $sheet->setCellValue('C' . $i, $v['FIRST_NAME']);
    $sheet->setCellValue('D' . $i, $v['LAST_NAME']);
    $sheet->setCellValue('E' . $i, $v['USERNAME']);
    $sheet->setCellValue('F' . $i, $v['PASSWORD']);
    $sheet->setCellValue('G' . $i, $v['TYPE_USER']);
    $sheet->setCellValue('H' . $i, $v['BRANCH']);
    $sheet->setCellValue('I' . $i, $v['TEAM']);
    $sheet->setCellValue('J' . $i, $v['MOBILE_NO']);
    $sheet->setCellValue('K' . $i, $v['EMAIL']);
    $sheet->setCellValue('L' . $i, $v['JABATAN']);
    $sheet->setCellValue('M' . $i, $v['CREATE_DATE']);
    $sheet->setCellValue('N' . $i, $v['UPDATE_DATE']);
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
$filename = 'Report All User';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
