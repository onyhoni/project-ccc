<?php
require '../functions.php';

$id = $_POST['id'];
$result = query("SELECT * FROM account_tabel WHERE ACCOUNT ='$id'");

echo json_encode($result);
