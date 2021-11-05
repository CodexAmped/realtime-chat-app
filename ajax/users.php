<?php
    session_start();
    include_once "../config/config.php";
    $outgoing_id = $_SESSION["unique_id"];
    $query = $connect->prepare("SELECT * FROM users WHERE NOT unique_id=:outgoing_id");
    $query->bindParam(":outgoing_id", $outgoing_id);
    $query->execute();
    $output = "";

    if($query->rowCount() == 1){
        $output .= "No users available to chat!";
    }
    elseif($query->rowCount() > 0){
        include "data.php";
    }
    echo $output;
?>