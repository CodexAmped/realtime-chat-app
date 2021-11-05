<?php

session_start();
if(isset($_SESSION["unique_id"])){
    include_once "../config/config.php";
    $logout_id = $_GET["logout_id"];

    if(isset($logout_id)){
        $status = "Offline now";
        $query = $connect->prepare("UPDATE users SET status=:status WHERE unique_id=:unique_id");
        $query->bindParam(":status", $status);
        $query->bindParam(":unique_id", $logout_id);
        $query->execute();

        if($query){
            session_unset();
            session_destroy();
            header("Location: ../login.php");
        }
    }
    else{
        header("Location: ../users.php");
    }
}
else{
    header("Location: ../login.php");
}
?>