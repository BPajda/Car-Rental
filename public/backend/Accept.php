<?php
include_once("./DB.php");

session_start();

$zmienna = true;

if (isset($_SESSION["user_id"], $_POST["start"], $_POST["end"], $_POST["id"])) {
   // header("Location: ./main.php");
   $sql = "SELECT * FROM users WHERE id = $_SESSION[user_id] AND prawa_id in (1,2) ";
   $result = mysqli_query($connect, $sql);
   $rez = mysqli_fetch_all($result, MYSQLI_ASSOC);

   if (count($rez) != 0) {

      $stmt = mysqli_prepare($connect, "SELECT * FROM rez WHERE id = ?");
      mysqli_stmt_bind_param($stmt, "s", $_POST["id"]);
      mysqli_stmt_execute($stmt);

      $result = $stmt->get_result();
      $odp =  mysqli_fetch_all($result, MYSQLI_ASSOC);


      if ($odp[0]["id_status"] == 1) { // edycja data
         $stmt = mysqli_prepare($connect, "UPDATE rez SET start=?, end=? WHERE id = ?");
         mysqli_stmt_bind_param($stmt, "sss", $_POST["start"], $_POST["end"], $_POST["id"]);
         mysqli_stmt_execute($stmt);
         $zmienna = false;
      } else if ($odp[0]["id_status"] == 3) { // akceptacja + edycja data         
         $stmt = mysqli_prepare($connect, "UPDATE rez SET start=?, end=?, id_status = 1 WHERE id = ?");
         mysqli_stmt_bind_param($stmt, "sss", $_POST["start"], $_POST["end"], $_POST["id"]);
         mysqli_stmt_execute($stmt);

         $stmt = mysqli_prepare($connect, "DELETE FROM rez WHERE id_car = ? AND id != ?");
         mysqli_stmt_bind_param($stmt, "ss", $odp[0]["id_car"], $_POST["id"]);
         mysqli_stmt_execute($stmt);

         $zmienna = false;
      }
   };
}


echo json_encode(["zmienna" => $zmienna]);
