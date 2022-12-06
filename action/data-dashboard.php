<?php
require '../functions.php';
$cust = $_POST['cust'];
$Region = $_POST['reg'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];


if ($cust != '' && $Region != '') {
    $data = mysqli_query($conn, "SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE account_tabel.BIG_GROUPING_CUST= '$cust' AND kota_tabel.REGIONAL ='$Region' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else if ($cust != '') {
    $data = mysqli_query($conn, "SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID  WHERE account_tabel.BIG_GROUPING_CUST= '$cust' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else if ($Region != '') {
    $data = mysqli_query($conn, "SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE kota_tabel.REGIONAL ='$Region' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
} else {
    $data = mysqli_query($conn, "SELECT * FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY)");
}


while ($result = mysqli_fetch_assoc($data)) {
    $dataCustomer[] = $result['BIG_GROUPING_CUST'];
    $dataBranch[] = $result['CODE_3LC'];
    $dataZona[] = $result['ZONA'];
    $dataStatus[] = $result['STATUS'];
    $dataSLA[] = $result['HASIL_SLA'];
    $dataCategory[] = $result['CATEGORY_CASE'];
    $industry[$result['CUST_INDUSTRY_NEW']][] = $result['STATUS'];
    $regional[$result['REGIONAL']][] = $result['STATUS'];
}

$totalTiket = count($dataStatus);

$dataCustomer = array_count_values($dataCustomer);
$dataBranch = array_count_values($dataBranch);
$dataZona = array_count_values($dataZona);
$dataStatus = array_count_values($dataStatus);
$dataSLA = array_count_values($dataSLA);
$dataCategory = array_count_values($dataCategory);


arsort($dataCustomer);
arsort($dataBranch);

$i = 0;
foreach ($dataCustomer as $key => $value) {
    $dataChartcustomer[] = $key;
    $dataChartValCustomer[] = $value;
    if (++$i == 10) break;
}

$dataCustomer = [
    'id' => $dataChartcustomer,
    'value' => $dataChartValCustomer
];

$i = 0;
foreach ($dataBranch as $key => $value) {
    $dataChartBranch[] = $key;
    $dataChartValBranch[] = $value;
    if (++$i == 10) break;
}

$dataBranch = [
    'id' => $dataChartBranch,
    'value' => $dataChartValBranch
];

foreach ($dataZona as $key => $value) {
    $dataChartZona[] = $key;
    $dataChartValZona[] = $value;
}
$dataZona = [
    'id' => $dataChartZona,
    'value' => $dataChartValZona
];

foreach ($dataSLA as $key => $value) {
    $dataChartSLA[] = $key;
    $dataChartValSLA[] = $value;
}

$dataSLA = [
    'id' => $dataChartSLA,
    'value' => $dataChartValSLA
];



foreach ($dataCategory as $key => $value) {
    $dataChartCategory[] = $key;
    $dataChartValCategory[] = $value;
}
$dataCategory = [
    'id' => $dataChartCategory,
    'value' => $dataChartValCategory
];



// $industry = [
//     'Agregator' => [
//         "open" => 200,
//         "progress" => 30,
//         "solved" => 30,
//     ],

// ];

// diatas Contoh
foreach ($industry as $key => $value) {
    $inds[$key] = array_count_values($value);
}


// $ind = [
//     'open' => [200, 30],
//     'progress' => [30, 30],
//     'solved' => [30, 50]
// ];

foreach ($inds as $i => $data) {
    $ind[] = $i;
    foreach ($data as $key => $value) {
        $indsVal[$key][$i] = $value;
    }
}

$dataIndustry = [
    'id' => $ind,
    'value' => $indsVal
];


// Data Regioanl

foreach ($regional as $key => $value) {
    $reg[$key] = array_count_values($value);
}


foreach ($reg as $i => $data) {
    $regi[] = $i;
    foreach ($data as $key => $value) {
        $regiVal[$key][$i] = $value;
    }
}

$dataRegional = [
    'id' => $regi,
    'value' => $regiVal
];

$dataTicket = [
    'totalTiket' => $totalTiket,
    'CLOSE' => (!empty($dataStatus['CLOSE']) ? $dataStatus['CLOSE'] : 0),
    'OPEN' => (!empty($dataStatus['OPEN']) ? $dataStatus['OPEN'] : 0),
    'PROGRESS' => (!empty($dataStatus['PROGRESS']) ? $dataStatus['PROGRESS'] : 0)
];


if ($cust != '' && $Region != '') {
    $data = [];
    for ($i = 0; $i <= 5; $i++) {
        $AC_0 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CUSTOMER_NAME = '$cust' AND kota_tabel.REGIONAL = '$Region'  AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE = '$i'");

        array_push($data, $AC_0["AC_0"]);
    }
    $AC_6 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CUSTOMER_NAME = '$cust' AND kota_tabel.REGIONAL = '$Region' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE > '5'");

    array_push($data, $AC_6["AC_0"]);
} else if ($cust != '') {
    $data = [];
    for ($i = 0; $i <= 5; $i++) {
        $AC_0 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CUSTOMER_NAME = '$cust' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE = '$i'");

        array_push($data, $AC_0["AC_0"]);
    }
    $AC_6 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CUSTOMER_NAME = '$cust' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE > '5'");

    array_push($data, $AC_6["AC_0"]);
} else if ($Region != '') {
    $data = [];
    for ($i = 0; $i <= 5; $i++) {
        $AC_0 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE kota_tabel.REGIONAL = '$Region' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE = '$i'");

        array_push($data, $AC_0["AC_0"]);
    }
    $AC_6 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE kota_tabel.REGIONAL = '$Region' AND tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE > '5'");

    array_push($data, $AC_6["AC_0"]);
} else {
    $data = [];
    for ($i = 0; $i <= 5; $i++) {
        $AC_0 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE = '$i'");

        array_push($data, $AC_0["AC_0"]);
    }
    $AC_6 = query("SELECT COUNT(ACTION_DATE) as AC_0 FROM tiket_tabel INNER JOIN case_tabel ON tiket_tabel.CASE_TYPE = case_tabel.CASE_TYPE_ID INNER JOIN kota_tabel ON tiket_tabel.dest_code = kota_tabel.KOTA_ID INNER JOIN account_tabel ON tiket_tabel.CUSTOMER_NAME = account_tabel.ACCOUNT INNER JOIN category_case ON case_tabel.CATEGORY_ID=category_case.CATEGORY_ID WHERE tiket_tabel.CREATE_TIME BETWEEN '$dateStart' AND DATE_ADD('$dateEnd',INTERVAL 1 DAY) AND ACTION_DATE > '5'");

    array_push($data, $AC_6["AC_0"]);
}


foreach ($data as $key => $value) {
    $dataChartAction[] = $key;
    $dataChartValAction[] = $value;
}

$dataAction = [
    'id' => ['Action 1', 'Action 2', 'Action 3', 'Action 4', 'Action 5', 'Action > 5'],
    'value' => $dataChartValAction
];

$data = [
    'dataRegional' => $dataRegional,
    'dataIndustry' => $dataIndustry,
    'dataAction' => $dataAction,
    'dataCustomer' => $dataCustomer,
    'dataBranch' => $dataBranch,
    'dataZona' => $dataZona,
    'dataCategory' => $dataCategory,
    'dataIndustry' => $dataIndustry,
    'dataSLA' => $dataSLA,
    'dataTiket' => $dataTicket
];

echo json_encode($data);
