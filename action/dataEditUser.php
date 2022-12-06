<?php
require '../functions.php';

$id = $_POST['id'];
$result = query("SELECT * FROM user WHERE USER_ID ='$id'");

echo json_encode($result);
