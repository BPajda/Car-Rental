<?php

require_once('DB.php');
session_start();


if (isset($_SESSION["user_id"], $_POST["enabled"], $_POST["timestamp"])) {

    $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND prawa_id in (1,2) ";
    $result = mysqli_query($connect, $sql);
    $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if (count($rez) != 0) {
        $stmt = mysqli_prepare($connect, "UPDATE vars SET value=? WHERE name = 'timestamp'");
        mysqli_stmt_bind_param($stmt, "i", $_POST["timestamp"]);
        mysqli_stmt_execute($stmt);


        if ($_POST["enabled"] == "true") {
            mysqli_query($connect, "ALTER EVENT `Date now` ENABLE");
        } else {
            mysqli_query($connect, "ALTER EVENT `Date now` DISABLE");
        }
    }
}
