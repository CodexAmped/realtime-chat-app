<?php

while($row = $query->fetch(PDO::FETCH_ASSOC)){

    $firstName = $row["first_name"];
    $lastName = $row["last_name"];
    $status = $row["status"];
    $image = $row["image"];
    $unique_id = $row["unique_id"];

    $query2 = $connect->prepare("SELECT * FROM messages
                                WHERE (incoming_msg_id=:unique_id OR outgoing_msg_id=:unique_id)
                                AND (incoming_msg_id=:outgoing_id OR outgoing_msg_id=:outgoing_id) ORDER BY msg_id DESC LIMIT 1");
    $query2->bindParam(":outgoing_id", $outgoing_id);
    $query2->bindParam(":unique_id", $unique_id);
    $query2->bindParam(":msg", $message);
    $query2->execute();

    $row2 = $query2->fetch(PDO::FETCH_ASSOC);

    if($query2->rowCount() > 0){
        $result = $row2["msg"];
    }
    else{
        $result = "No message available";
    }

    (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
    ($outgoing_id == $row2["outgoing_msg_id"]) ? $you = "You: " : $you = "";

    ($row["status"] == "Offline now") ? $offline = "offline" : $offline = "";

    $output .= '<a href="chats.php?user_id='.$row["unique_id"].'">
                    <div class="content">
                        <img src="assets/images/profile/'.$image.'" alt="">
                        <div class="details">
                            <span>'.$firstName. " " .$lastName.'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                    </div>
                    <div class="status-dot '.$offline.'">
                        <i class="fas fa-circle"></i>
                    </div>
                </a>';
}

?>