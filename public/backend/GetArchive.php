<?php
require_once('DB.php');
session_start();


if (isset($_SESSION["user_id"])) {
  $sql = "SELECT 
      archive_rez.start,
      archive_rez.end,
      archive_rez.id_status,
      CONCAT(cars.model, ' ', cars.marka) as name,      
      cars.cena        
      FROM archive_rez 
      INNER JOIN cars ON cars.id = archive_rez.id_car
      WHERE archive_rez.id_user=$_SESSION[user_id]
      ";
  $result = mysqli_query($connect, $sql);

  $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);


  echo json_encode($rez);
}
