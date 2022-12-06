<?php
session_start();
require 'vendor/autoload.php';

$conn = mysqli_connect('localhost', 'root', '', 'cccticket');
date_default_timezone_set('Asia/Jakarta');


function login($data)
{
    global $conn;
    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE USERNAME = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['id'] = $row['USER_ID'];
        $_SESSION['user'] = $row['USERNAME'];
        $_SESSION['type_user'] = $row['TYPE_USER'];
        $_SESSION['team'] = $row['TEAM'];
        $_SESSION['branch'] = $row['BRANCH'];

        if (password_verify($password, $row["PASSWORD"])) {
            header("location: index.php");
            exit;
        };
    }
    return true;
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}

function queryAll($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $datas = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $datas[] = $data;
    }

    return $datas;
}


function Tambah($data)
{

    global $_SESSION;
    global $conn;
    $pesan = htmlspecialchars($data['pesan']);
    $respon = htmlspecialchars($data['respon']);
    $tiketID = htmlspecialchars($data['tiket_id']);
    $respon = htmlspecialchars($data['respon']);
    $user = $_SESSION['id'];
    $today = date('Y-m-d H:i:s');
    $gambar = NULL;

    // Upload gambar

    if ($_FILES['gambar']['error'] != 4) {
        $gambar = upload();

        if (!$gambar) {
            return false;
        }
    }

    mysqli_query($conn, "UPDATE ticket_tabel SET RESPONSIBILITY = '$respon' WHERE TIKET_ID = '$tiketID'");

    $query = "INSERT INTO respon_tabel
             VALUES
             ('','$tiketID',NULL,'$pesan','$gambar','$today','$user')";
    mysqli_query($conn, $query);

    mysqli_query($conn, "UPDATE tiket_tabel SET RESPONSIBILITY = '$respon' WHERE TIKET_ID = '$tiketID' ");

    return mysqli_affected_rows($conn);
}
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $erorr = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah ada gambar

    // if ($erorr === 4) {

    //     return true;
    // }

    // cek apakah yang diupload adalah gambar

    $ekstensi_gambar_valid = ['jpg', 'jpeg', 'png'];
    $ekstensi_gambar = explode('.', $namaFile);
    $ekstensi_gambar = strtolower(end($ekstensi_gambar));

    if (in_array(!$ekstensi_gambar, $ekstensi_gambar_valid)) {
        echo "<script>
         alert('Yang Anda upload bukan Gambar')
        </script>";
        return false;
    }


    // cek ukuran gambar

    if ($ukuranFile > 5000000) {
        echo "<script>
        alert('Ukuran Gambar Max 5mb');
       </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi_gambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function TambahUser($data)
{
    global $conn;
    $firstName = htmlspecialchars($data['first_name']);
    $lastname = htmlspecialchars($data['last_name']);
    $username = strtolower($firstName . ' ' . $lastname);
    $mobile = htmlspecialchars($data['mobile_no']);
    $email = htmlspecialchars($data['email_id']);
    $id =  htmlspecialchars($data['id']);
    $team = htmlspecialchars($data['Team']);
    $password = htmlspecialchars($data['password']);
    $typeUser = htmlspecialchars($data['type_user']);
    $branch  = htmlspecialchars($data['branch']);
    $today = date('Y-m-d H:i:s');

    $password = password_hash($password, PASSWORD_DEFAULT);

    if (query("SELECT uSER_ID FROM user WHERE USER_ID = '$id'") > 0) {
        echo "<script>
        alert('User ID sudah terdaftar ..')
        </script>
        ";
        return false;
    }

    $query = "INSERT INTO user
        VALUES
        ('$id','$firstName','$lastname','$username','$password','$typeUser','$branch','$team','$mobile','$email','$typeUser','$today','$today');
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editUser($data)
{
    global $conn;
    $firstName = htmlspecialchars($data['first_name']);
    $lastname = htmlspecialchars($data['last_name']);
    $username = strtolower($firstName . ' ' . $lastname);
    $mobile = htmlspecialchars($data['mobile_no']);
    $email = htmlspecialchars($data['email_id']);
    $id =  htmlspecialchars($data['id']);
    $team = htmlspecialchars($data['Team']);
    $branch  = htmlspecialchars($data['branch']);
    $today = date('Y-m-d H:i:s');

    $query = "UPDATE user SET

    USERNAME ='$username',
    BRANCH ='$branch',
    TEAM ='$team',
    MOBILE_NO ='$mobile',
    EMAIL ='$email',
    UPDATE_DATE ='$today'
     WHERE USER_ID ='$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function TambahAccount($data)
{
    global $conn;
    $Account = htmlspecialchars($data['cust_account']);
    $custName = htmlspecialchars($data['cust_name']);
    $custNameGrouping = htmlspecialchars($data['Cust_name_grouping']);
    $Industry = htmlspecialchars($data['cust_industry']);
    $branch =  htmlspecialchars($data['cust_branch']);
    $payment = htmlspecialchars($data['payment_metode']);
    $picFronline = htmlspecialchars($data['pic_frontline']);
    $teamFl = htmlspecialchars($data['team_fl']);
    $today = date('Y-m-d H:i:s');

    if (query("SELECT ACCOUNT FROM account_tabel WHERE ACCOUNT = '$Account'") > 0) {
        echo "<script>
        alert('No account sudah terdaftar ..')
        </script>
        ";
        return false;
    }

    $query = "INSERT INTO account_tabel
        VALUES
        ('$Account','$custNameGrouping','$Industry','$teamFl','$branch','$payment','$picFronline','$today');
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function editAccount($data)
{
    global $conn;
    $account = htmlspecialchars($data['cust_account']);
    $custNameGrouping = htmlspecialchars($data['Cust_name_grouping']);
    $industry = htmlspecialchars($data['cust_industry']);
    $branch =  htmlspecialchars($data['cust_branch']);
    $payment = htmlspecialchars($data['payment_metode']);
    $picFrontline = htmlspecialchars($data['pic_frontline']);
    $teamFl  = htmlspecialchars($data['team_fl']);

    $query = "UPDATE account_tabel SET
    BIG_GROUPING_CUST='$custNameGrouping',
    CUST_INDUSTRY_NEW='$industry',
    TEAM='$teamFl',
    CUST_BRANCH='$branch',
    PAYMENT_METODE='$payment',
    PIC_FRONTLINE='$picFrontline'
    WHERE ACCOUNT='$account'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function queryAllUniqe($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $datas = [];
    while ($data = mysqli_fetch_row($result)) {
        $datas[] = $data[0];
    }
    return array_unique($datas);
}

function delete($query)
{
    global $conn;

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function import($FILES)
{

    $ekstensi = '';
    global $conn;


    $file_name = $FILES['bgfile']['name'];
    $file_data = $FILES['bgfile']['tmp_name'];

    if (empty($file_name)) {
        echo "<script>
            alert('Silahkan Masukan File ..')
            document.location.href = ''
            </script>";
        return true;
    } else {
        $ekstensi = pathinfo($file_name)['extension'];

        $ekstensi_allow = array('xls', 'xlsx');

        if (!in_array($ekstensi, $ekstensi_allow)) {

            echo "<script>
            alert('silahkan masukan file type xls , xlsx')
            document.location.href = ''
            </script>";

            return true;
        }
    }

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    $spreadsheet = $reader->load($file_data);
    $sheet1 = $spreadsheet->getSheet(0)->toArray();


    // cek apakah template sudah sesuai atau belum

    if ($sheet1[0][0] !== 'User_id' || $sheet1[0][1] !== 'First_name') {
        echo "<script>
            alert('Template upload tidak sesuai ...')
            document.location.href = ''
            </script>";

        return true;
    }

    $hasildata = [];

    // Upload Sheet1

    for ($i = 1; $i < count($sheet1); $i++) {
        $userid = $sheet1[$i]['0'];
        $firstName = $sheet1[$i]['1'];
        $lastname = $sheet1[$i]['2'];
        $username = strtolower($firstName . ' ' . $lastname);
        $password = $sheet1[$i]['3'];
        $typeUser = $sheet1[$i]['4'];
        $branch = $sheet1[$i]['5'];
        $team = $sheet1[$i]['6'];
        $mobile = $sheet1[$i]['7'];
        $email = $sheet1[$i]['8'];
        $jabatan = $sheet1[$i]['9'];
        $today = date('Y-m-d H:i:s');

        $userid = str_replace("'", "", $userid);
        $firstName = str_replace("'", "", $firstName);
        $lastname = str_replace("'", "", $lastname);
        $username = str_replace("'", "", $username);
        $password = str_replace("'", "", $password);
        $typeUser = str_replace("'", "", $typeUser);
        $branch = str_replace("'", "", $branch);
        $team = str_replace("'", "", $team);
        $mobile = str_replace("'", "", $mobile);
        $email = str_replace("'", "", $email);
        $jabatan = str_replace("'", "", $jabatan);


        $password = password_hash($password, PASSWORD_DEFAULT);

        $result = mysqli_query($conn, "SELECT USER_ID FROM user WHERE USER_ID = '$userid'");

        if (mysqli_fetch_assoc($result)) {
            $hasildata[] = [
                'userid' => $userid,
                'firstname' => $firstName,
                'lastname' => $lastname,
                'username' => $username,
                'password' => $password,
                'typeUser' => $typeUser,
                'branch' => $branch,
                'team' => $team,
                'mobile' => $mobile,
                'email' => $email,
                'jabatan' => $jabatan,
                'status' => 'Id Already Exists'
            ];
        } else {
            $query = "INSERT INTO user
        VALUES
        ('$userid','$firstName','$lastname','$username','$password','$typeUser','$branch','$team','$mobile','$email','$jabatan','$today','$today')";

            mysqli_query($conn, $query);
            $hasildata[] = [
                'userid' => $userid,
                'firstname' => $firstName,
                'lastname' => $lastname,
                'username' => $username,
                'password' => $password,
                'typeUser' => $typeUser,
                'branch' => $branch,
                'team' => $team,
                'mobile' => $mobile,
                'email' => $email,
                'jabatan' => $jabatan,
                'status' => 'Successfuly'
            ];
        }
    }

    return $hasildata;
}

function importAccount($FILES)
{

    $ekstensi = '';
    global $conn;

    $file_name = $FILES['bgfile']['name'];
    $file_data = $FILES['bgfile']['tmp_name'];

    if (empty($file_name)) {
        echo "<script>
            alert('Silahkan Masukan File ..')
            document.location.href = ''
            </script>";
        return false;
    } else {
        $ekstensi = pathinfo($file_name)['extension'];

        $ekstensi_allow = array('xls', 'xlsx');

        if (!in_array($ekstensi, $ekstensi_allow)) {

            echo "<script>
            alert('silahkan masukan file type xls , xlsx')
            document.location.href = ''
            </script>";

            return false;
        }
    }

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    $spreadsheet = $reader->load($file_data);
    $sheet1 = $spreadsheet->getSheet(0)->toArray();

    // cek apakah template sudah sesuai atau belum

    if ($sheet1[0][0] != 'Account' || $sheet1[0][1] !== 'Cust_Name' || $sheet1[0][2] !== 'Industry') {
        echo "<script>
            alert('Template upload tidak sesuai...')
            document.location.href = ''
            </script>";
    }

    $hasildata = [];

    // Upload Sheet1

    for ($i = 1; $i < count($sheet1); $i++) {
        $account = $sheet1[$i]['0'];
        $custNameGrouping = $sheet1[$i]['1'];
        $industry = $sheet1[$i]['2'];
        $team = $sheet1[$i]['3'];
        $branch = $sheet1[$i]['4'];
        $payment = $sheet1[$i]['5'];
        $picFrontline = $sheet1[$i]['6'];
        $today = date('Y-m-d H:i:s');


        $account = str_replace("'", "", $account);
        $custNameGrouping = str_replace("'", "", $custNameGrouping);
        $industry = str_replace("'", "", $industry);
        $team = str_replace("'", "", $team);
        $branch = str_replace("'", "", $branch);
        $payment = str_replace("'", "", $payment);
        $picFrontline = str_replace("'", "", $picFrontline);

        $result = mysqli_query($conn, "SELECT ACCOUNT FROM account_tabel WHERE ACCOUNT = '$account'");

        if (mysqli_fetch_assoc($result)) {
            $hasildata[] = [
                'account' => $account,
                'custNameGrouping' => $custNameGrouping,
                'branch' => $branch,
                'industry' => $industry,
                'payment' => $payment,
                'picFrontline' => $picFrontline,
                'team' => $team,
                'status' => 'Id Already Exists'
            ];
        } else {
            $query = "INSERT INTO account_tabel
            VALUES
            ('$account','$custNameGrouping','$industry','$team','$branch','$payment','$picFrontline')";

            mysqli_query($conn, $query);
            $hasildata[] = [
                'account' => $account,
                'custNameGrouping' => $custNameGrouping,
                'branch' => $branch,
                'industry' => $industry,
                'payment' => $payment,
                'picFrontline' => $picFrontline,
                'team' => $team,
                'status' => 'Successfuly'
            ];
        }
    }

    return $hasildata;
}

function importActivites($FILES)
{

    $ekstensi = '';
    global $conn;

    $file_name = $FILES['bgfile']['name'];
    $file_data = $FILES['bgfile']['tmp_name'];

    if (empty($file_name)) {
        echo "<script>
            alert('Silahkan Masukan File ..')
            document.location.href = ''
            </script>";
        return false;
    } else {
        $ekstensi = pathinfo($file_name)['extension'];

        $ekstensi_allow = array('xls', 'xlsx');

        if (!in_array($ekstensi, $ekstensi_allow)) {

            echo "<script>
            alert('silahkan masukan file type xls , xlsx')
            document.location.href = ''
            </script>";

            return false;
        }
    }

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    $spreadsheet = $reader->load($file_data);
    $sheet1 = $spreadsheet->getSheet(0)->toArray();

    $hasildata = [];

    // Upload Sheet1

    if ($sheet1[0][0] !== 'No_Ticket' || $sheet1[0][1] !== 'No_Connote' || $sheet1[0][2] !== 'ID_Account') {
        echo "<script>
        alert('Template upload tidak sesuai..')
        document.location.href = ''
        </script>";

        return false;
    }

    for ($i = 1; $i < count($sheet1); $i++) {
        global $_SESSION;

        $id = $_SESSION['id'];
        $noTiket = $sheet1[$i]['0'];
        $awb = $sheet1[$i]['1'];
        $account = $sheet1[$i]['2'];
        $shipperName = $sheet1[$i]['3'];
        $dateconnote = $sheet1[$i]['4'];
        $origincode = $sheet1[$i]['5'];
        $destcode = $sheet1[$i]['6'];
        $typeCase = $sheet1[$i]['7'];
        $deskripsi = $sheet1[$i]['8'];
        $codingpod = $sheet1[$i]['9'];
        $statuspod = $sheet1[$i]['10'];
        $link1 = $sheet1[$i]['11'];
        // $responsibility = $sheet1[$i]['12'];
        $today = date('Y-m-d H:i:s');



        $noTiket = str_replace("'", '', $noTiket);
        $awb = str_replace("'", '', $awb);
        $account = str_replace("'", '', $account);
        $shipperName = str_replace("'", '', $shipperName);
        $dateconnote = str_replace("'", '', $dateconnote);
        $destcode = str_replace("'", '', $destcode);
        $origincode = str_replace("'", '', $origincode);
        $typeCase = str_replace("'", '', $typeCase);
        $deskripsi = str_replace("'", '', $deskripsi);
        $codingpod = str_replace("'", '', $codingpod);
        $statuspod =  str_replace("'", '', $statuspod);
        $link1 =  str_replace("'", '', $link1);
        // $responsibility = str_replace("'", '', $responsibility);





        $result = mysqli_query($conn, "SELECT TIKET_ID FROM tiket_tabel WHERE TIKET_ID = '$noTiket'");

        if (mysqli_fetch_assoc($result)) {
            $hasildata[] = [
                'account' => $account,
                'noTiket' => $noTiket,
                'awb' => $awb,
                'origin' => $destcode,
                'dest_code' => $destcode,
                'typeCase' => $typeCase,
                'sellerName' => $shipperName,
                'statusPod' => $statuspod,
                'status' => 'Id Already Exists'
            ];
        } else {
            // kueri inssert tiket_tabel
            // if ($_SESSION['team'] === '1'  || $_SESSION['team'] === '2' || $_SESSION['team'] === '3' || $_SESSION['team'] === '6') {
            //     $HandleBY = queryAll("SELECT PIC_BACKLINE FROM `kota_tabel` WHERE KOTA_ID = '$destcode'");
            //     $picFL = ($HandleBY) ? $HandleBY[0]['PIC_BACKLINE'] : ' ';
            //     $picFL =  str_replace("'", '', $picFL);
            //     $query = "INSERT INTO tiket_tabel
            //     VALUES
            //     ('$noTiket','$awb','$account','$shipperName','$dateconnote','$destcode','$origincode','$typeCase',' $deskripsi','$codingpod','$statuspod','OPEN','$picFL','$today',NULL,'$id','SLA',                    0,'BACKLINE')";
            // } else {
            //     $HandleBY = queryAll("SELECT PIC_FRONTLINE FROM `account_tabel` WHERE ACCOUNT = '$account'");
            //     $picBL = ($HandleBY) ? $HandleBY[0]['PIC_FRONTLINE'] : '';
            //     $picBL =  str_replace("'", '', $picBL);
            //     $query = "INSERT INTO tiket_tabel
            //     VALUES
            //     ('$noTiket','$awb','$account','$shipperName','$dateconnote','$destcode','$origincode','$typeCase',' $deskripsi','$codingpod','$statuspod','OPEN','$picBL','$today',NULL,'$id','SLA',                 0,'FRONTLINE')";
            // }
            if ($_SESSION['team'] === '1'  || $_SESSION['team'] === '2' || $_SESSION['team'] === '3' || $_SESSION['team'] === '6') {
                $undel = substr($typeCase, 0, 3);

                if ($undel == 'FUU') {
                    $HandleBY = query("SELECT PIC_BACKLINE_FUU FROM `kota_tabel` WHERE KOTA_ID = '$destcode'");
                    $picBL = ($HandleBY) ? $HandleBY['PIC_BACKLINE_FUU'] : '';
                } else {
                    $HandleBY = query("SELECT PIC_BACKLINE_CASE FROM `kota_tabel` WHERE KOTA_ID = '$destcode'");
                    $picBL = ($HandleBY) ? $HandleBY['PIC_BACKLINE_CASE'] : '';
                }

                $picBL =  str_replace("'", '', $picBL);

                $query = "INSERT INTO tiket_tabel
                VALUES
                ('$noTiket','$awb','$account','$shipperName','$dateconnote','$destcode','$origincode','$typeCase',' $deskripsi','$codingpod','$statuspod','OPEN','$picBL','$today',NULL,'$id','SLA',0,'BACKLINE')";
            } else {
                $HandleBY = queryAll("SELECT PIC_FRONTLINE FROM `account_tabel` WHERE ACCOUNT = '$account'");
                $picFL = ($HandleBY) ? $HandleBY[0]['PIC_FRONTLINE'] : '';
                $picFL =  str_replace("'", '', $picFL);
                $query = "INSERT INTO tiket_tabel
                VALUES
                ('$noTiket','$awb','$account','$shipperName','$dateconnote','$destcode','$origincode','$typeCase',' $deskripsi','$codingpod','$statuspod','OPEN','$picFL','$today',NULL,'$id','SLA',0,'FRONTLINE')";
            }

            mysqli_query($conn, $query);
            // kueri inssert respon_tabel

            mysqli_query($conn, "INSERT INTO respon_tabel VALUES (NULL,'$noTiket','$awb','$deskripsi','$link1','$today','$id')");


            $hasildata[] = [
                'account' => $account,
                'noTiket' => $noTiket,
                'awb' => $awb,
                'origin' => $destcode,
                'dest_code' => $destcode,
                'typeCase' => $typeCase,
                'sellerName' => $shipperName,
                'statusPod' => $statuspod,
                'status' => 'Successfuly'
            ];
        }
    }

    return $hasildata;
}

////// IMPORT BL
function importBL($FILES)
{

    $ekstensi = '';
    global $conn;

    $file_name = $FILES['bgfile1']['name'];
    $file_data = $FILES['bgfile1']['tmp_name'];

    if (empty($file_name)) {
        echo "<script>
            alert('Silahkan Masukan File ..')
            document.location.href = ''
            </script>";
        return false;
    } else {
        $ekstensi = pathinfo($file_name)['extension'];

        $ekstensi_allow = array('xls', 'xlsx');

        if (!in_array($ekstensi, $ekstensi_allow)) {

            echo "<script>
            alert('silahkan masukan file type xls , xlsx')
            document.location.href = ''
            </script>";

            return false;
        }
    }

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_data);
    $spreadsheet = $reader->load($file_data);
    $sheet1 = $spreadsheet->getSheet(0)->toArray();


    if ($sheet1[0][0] !== 'Tiket_ID' || $sheet1[0][1] !== 'No_Connote' || $sheet1[0][2] !== 'Feedback' || $sheet1[0][3] !== 'Link Foto') {
        echo "<script>
        alert('Template upload tidak sesuai..')
        document.location.href = ''
        </script>";

        return false;
    }


    // Upload Sheet1

    for ($i = 1; $i < count($sheet1); $i++) {
        global $_SESSION;

        $id = $_SESSION['id'];
        $tiketID = $sheet1[$i]['0'];
        $awb = $sheet1[$i]['1'];
        $PESAN = $sheet1[$i]['2'];
        $LINK1 = $sheet1[$i]['3'];
        $respon = $sheet1[$i]['4'];
        $status = $sheet1[$i]['5'];
        $today = date('Y-m-d H:i:s');

        $tiketID = str_replace("'", "", $tiketID);
        $awb = str_replace("'", "", $awb);
        $PESAN = str_replace("'", "", $PESAN);
        $LINK1 = str_replace("'", "", $LINK1);
        $respon = str_replace("'", "", $respon);
        $status = str_replace("'", "", $status);

        if ($status !== '' && $respon !== '') {
            if ($status == 'CLOSE') {
                mysqli_query($conn, "UPDATE tiket_tabel SET STATUS ='$status',RESPONSIBILITY ='$respon',CLOSE_TIME ='$today' WHERE TIKET_ID = '$tiketID'");
            } elseif ($status == 'PROGRESS') {
                mysqli_query($conn, "UPDATE tiket_tabel SET STATUS ='$status',RESPONSIBILITY ='$respon' WHERE TIKET_ID = '$tiketID'");
            } else {
                echo "<script>
                    alert('status yang dimasukan tidak valid ..')
                    </script>";
                return false;
            }
        } else if ($status !== '') {
            mysqli_query($conn, "UPDATE `tiket_tabel` SET `STATUS`='$status',CLOSE_TIME='$today' WHERE TIKET_ID = '$tiketID'");
        } else if ($respon !== '') {
            mysqli_query($conn, "UPDATE `tiket_tabel` SET `RESPONSIBILITY`='$respon',CLOSE_TIME='$today' WHERE TIKET_ID = '$tiketID'");
        }


        $query = "INSERT INTO respon_tabel
        VALUES
        (NULL,'$tiketID','$awb','$PESAN','$LINK1','$today','$id')";




        mysqli_query($conn, $query);

        // echo mysqli_error($conn);
    }

    return mysqli_affected_rows($conn);

    ////// IMPORT BL



}
