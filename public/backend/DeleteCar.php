<?php


require_once('DB.php');
session_start();

$zmienna = true;



if (isset($_SESSION["user_id"], $_POST["id"])) {


    $stmt = mysqli_prepare($connect, "DELETE FROM rez WHERE id_car=? AND id_user=?");
    mysqli_stmt_bind_param($stmt, "ii", $_POST["id"], $_SESSION["user_id"]);
    mysqli_stmt_execute($stmt);


    $zmienna = false;
}


echo json_encode(["zmienna" => $zmienna]);
