<?php 
session_start();
if(isset($_SESSION["unique_id"])){

    include_once "../config/config.php";

    $outgoing_msg_id = $_POST["outgoing_id"];
    $incoming_msg_id = $_POST["incoming_id"];

    $output = "";
    $query = $connect->prepare("SELECT * FROM messages 
                                LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                                WHERE (incoming_msg_id=:incoming_id AND outgoing_msg_id=:outgoing_id)
                                OR (incoming_msg_id=:outgoing_id AND outgoing_msg_id=:incoming_id) ORDER BY msg_id");
    $query->bindParam(":outgoing_id", $outgoing_msg_id);
    $query->bindParam(":incoming_id", $incoming_msg_id);
    $query->bindParam(":msg", $message);
    $query->execute();

    if($query->rowCount() > 0){
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            if($row["outgoing_msg_id"] === $outgoing_msg_id){
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'.$row["msg"].'</p>
                                </div>
                            </div>';
            }
            else{
                $output .= '<div class="chat incoming">
                                <img src="assets/images/profile/'.$row["image"].'" alt="">
                                <div class="details">
                                <p>'.$row["msg"].'</p>
                                </div>
                            </div>';
            }
        }
        echo $output;
    }
}
else{
    header("../login.php");
}

?>