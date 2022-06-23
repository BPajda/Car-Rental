<?php

require_once('DB.php');
session_start();

$zmienna = true;

if (isset($_SESSION["user_id"], $_POST["id"], $_POST["startDate"], $_POST["endDate"])) {
    if ($_POST["startDate"] != "" && $_POST["endDate"] != "") {


        $stmt = mysqli_prepare($connect, "SELECT * FROM rez WHERE id_car=? AND id_user=? AND id_status=3");
        mysqli_stmt_bind_param($stmt, "ss", $_POST["id"], $_SESSION["user_id"]);
        mysqli_stmt_execute($stmt);

        $result = $stmt->get_result();
        $odp =  mysqli_fetch_all($result, MYSQLI_ASSOC);


        if (count($odp) == 0) {
            $stmt = mysqli_prepare($connect, "INSERT INTO rez(id_car, id_user, start, end, id_status) VALUES(?,?,?,?,3)");
            mysqli_stmt_bind_param($stmt, "iiss", $_POST["id"], $_SESSION["user_id"], $_POST["startDate"], $_POST["endDate"]);
            mysqli_stmt_execute($stmt);

            $zmienna = false;
        } else {


            $stmt = mysqli_prepare($connect, "UPDATE rez SET start=?, end=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssi", $_POST["startDate"], $_POST["endDate"], $odp[0]["id"]);
            mysqli_stmt_execute($stmt);
            $zmienna = false;
        }
    }
}

echo json_encode(["zmienna" => $zmienna]);
