<?php

include_once("./DB.php");

session_start();
$zmienna = true;
if (isset($_SESSION["user_id"])) {
    // header("Location: ./main.php");
} else {


    if (isset($_POST["log"], $_POST["pas"])) {


        $log = $_POST["log"];
        $pas = $_POST["pas"];

        if (mb_strlen($log, "UTF-8") > 2 && mb_strlen($pas, "UTF-8") > 2) {


            $stmt = mysqli_prepare($connect, "SELECT * FROM users WHERE login=?");
            mysqli_stmt_bind_param($stmt, "s", $log);
            mysqli_stmt_execute($stmt);

            $result = $stmt->get_result();
            $odp =  mysqli_fetch_all($result, MYSQLI_ASSOC);



            if (count($odp) == 0) {
            } else {


                foreach ($odp as $e) {

                    if (md5($pas) == $e["password"] && $e["aktywny"] == 1) {
                        $zmienna = false;

                        $_SESSION["user_id"] = $e["id"];
                    }
                    break;
                }
            }
        }
    }
}
echo json_encode(["zmienna" => $zmienna]);
