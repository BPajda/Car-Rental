<?php
include_once("./DB.php");

session_start();
$zmienna = true;


if (isset($_SESSION["user_id"], $_POST["id"])) {
    $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND prawa_id in (1,2) ";
    $result = mysqli_query($connect, $sql);
    $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rez) != 0) {
        $stmt = mysqli_prepare($connect, "DELETE FROM rez WHERE id != ?");
        mysqli_stmt_bind_param($stmt, "s", $_POST["id"]);
        mysqli_stmt_execute($stmt);
    }
}
echo json_encode(["zmienna" => $zmienna]);
