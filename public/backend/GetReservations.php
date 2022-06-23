<?php

require_once('DB.php');
session_start();


if (isset($_SESSION["user_id"])) {
  $tab = [];

  $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND prawa_id in (1,2) ";
  $result = mysqli_query($connect, $sql);
  $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if (count($rez) != 0) {
    $sql = "SELECT 
        rez.id,
        CONCAT(cars.model, ' ', cars.marka) as name,
        users.login, rez.start, rez.end, rez.id_status
      FROM rez INNER JOIN cars ON cars.id=rez.id_car 
      INNER JOIN users ON users.id=rez.id_user";

    $result = mysqli_query($connect, $sql);
    $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

    array_push($tab, ...$rez);


    $sql = "SELECT 
        archive_rez.id,
        CONCAT(cars.model, ' ', cars.marka) as name,
        users.login, archive_rez.start, archive_rez.end, archive_rez.id_status
      FROM archive_rez INNER JOIN cars ON cars.id=archive_rez.id_car 
      INNER JOIN users ON users.id=archive_rez.id_user";

    $result = mysqli_query($connect, $sql);
    $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

    array_push($tab, ...$rez);





    $sql = "SHOW EVENTS WHERE Name = 'Date now'";
    $result = mysqli_query($connect, $sql);
    $eventStatus = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["Status"] == "ENABLED" ? true : false;



    $sql = 'SELECT value FROM vars WHERE name="timestamp"';
    $result = mysqli_query($connect, $sql);
    $timeStamp = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]["value"];


    echo json_encode(["arr" => $tab, "eventStatus" => $eventStatus, "timeStamp" => $timeStamp]);
  }
}
