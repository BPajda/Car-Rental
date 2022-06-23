<?php
require_once('DB.php');
session_start();


if (isset($_SESSION["user_id"])) {
    $sql = 'SELECT value FROM vars WHERE name="currentTime"';
    $result = mysqli_query($connect, $sql);
    $dateNow = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["value"];


    $sql = "SELECT * FROM rez WHERE FROM_UNIXTIME($dateNow) > end AND id_user=$_SESSION[user_id]";

    $result = mysqli_query($connect, $sql);
    $anyDetention = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sql = 'SELECT * FROM cars';
    $result = mysqli_query($connect, $sql);
    $cars = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $tab = [];


    foreach ($cars as $key => $value) {


        $sql = "SELECT * FROM rez WHERE id_car=$value[id] ";
        $result = mysqli_query($connect, $sql);
        $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $accepted = array_filter($rez, function ($el) {
            return $el["id_status"] == 1;
        });

        if (count($accepted) == 0) {
            $reserved = false;
        } else {
            $reserved = true;
        }

        $value["count"] = count($rez);
        $value["reserved"] = $reserved;

        $reserved = array_filter($rez, function ($el) {
            return $el["id_user"] == $_SESSION["user_id"];
        });

        if (count($reserved) > 0) {
            $value["startTime"] = $reserved[0]["start"];
            $value["endTime"] = $reserved[0]["end"];
            $value["myWaiting"] = true;

            if ($reserved) {
                $id = "https://www.infor.pl/prawo/wykroczenia/wykroczenia-drogowe/2699270,Dopuszczalna-zawartosc-alkoholu-u-kierowcy-w-Polsce.html";
                $path = "https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl=$id";

                $value["qrCode"] = $path;
            }
        } else {
            $value["startTime"] = "";
            $value["endTime"] = "";
            $value["myWaiting"] = false;
        }


        if (count($anyDetention) == 0 || $value["myWaiting"] == true) {
            array_push($tab, $value);
        }
    }


    echo json_encode(["arr" => $tab, "dateNow" => $dateNow * 1000]);
}
