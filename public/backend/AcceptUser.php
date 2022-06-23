<?php


require_once('DB.php');
session_start();


if (isset($_SESSION["user_id"], $_POST["id"], $_POST["aktywny"], $_POST["prawa_id"])) {
    $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND prawa_id = 1 ";
    $result = mysqli_query($connect, $sql);
    $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rez) != 0) {
        $stmt = mysqli_prepare($connect, "UPDATE users SET aktywny=?, prawa_id=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "iii", $_POST["aktywny"], $_POST["prawa_id"], $_POST["id"]);
        mysqli_stmt_execute($stmt);
    }
}

echo "[1]";
