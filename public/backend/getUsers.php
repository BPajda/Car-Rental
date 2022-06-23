<?php


require_once('DB.php');
session_start();


if (isset($_SESSION["user_id"])) {
  $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND prawa_id = 1 ";
  $result = mysqli_query($connect, $sql);
  $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if (count($rez) != 0) {
    $sql = "SELECT * FROM users ";

    $result = mysqli_query($connect, $sql);
    $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($rez);
  }
}
