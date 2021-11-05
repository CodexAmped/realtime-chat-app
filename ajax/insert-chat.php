<?php 
session_start();
if(isset($_SESSION["unique_id"])){

    include_once "../config/config.php";

    $outgoing_msg_id = $_POST["outgoing_id"];
    $incoming_msg_id = $_POST["incoming_id"];
    $message = $_POST["message"];

    if(!empty($message)){
        $query = $connect->prepare("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (:incoming_msg_id, :outgoing_msg_id, :msg)") or die();
        $query->bindParam(":outgoing_msg_id", $outgoing_msg_id);
        $query->bindParam(":incoming_msg_id", $incoming_msg_id);
        $query->bindParam(":msg", $message);
        $query->execute();

        
    }
}
else{
    header("../login.php");
}

?>