<?php

include_once("./DB.php");


session_start();
$zmienna = true;


if (isset($_SESSION["user_id"])) {
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
                $prep = mysqli_prepare($connect, "INSERT INTO users(login, password) VALUES(?,?)");
                @mysqli_stmt_bind_param($prep, "ss", $log, md5($pas));
                mysqli_stmt_execute($prep);
                $zmienna = false;
            } else {
            }
        }
    }
}
echo json_encode(["zmienna" => $zmienna]);
