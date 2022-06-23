<?php
include_once("./DB.php");
session_start();

$zmienna = "unLogged";


if (isset($_SESSION["user_id"])) {
    $check = mysqli_query($connect, "SELECT * FROM users WHERE id=$_SESSION[user_id]");
    $odp = mysqli_fetch_all($check, MYSQLI_ASSOC);

    //  var_dump($odp);

    if (count($odp) != 0) {
        switch ($odp[0]["prawa_id"]) {
            case 1:
                $zmienna = "Admin";
                break;
            case 2:
                $zmienna = "Mod";
                break;
            case 3:
                $zmienna = "User";
                break;
        }
    }
}


echo json_encode(["zmienna" => $zmienna]);
