<?php

require_once "DB.php";
$sql = "DELETE * FROM samochody WHERE id=$_POST[id]";
$result = mysqli_query($connect, $sql);


$msg = '';
$code = 0;

if ($result) {
    $code = 1;
    $msg = "successful";
} else {
    $msg = mysqli_error($connect);
}


echo json_encode(["msg" => $msg, "code" => $code]);
