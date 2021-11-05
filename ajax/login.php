<?php
session_start();
include_once "../config/config.php";

$email = $_POST["email"];
$password = $_POST["password"];

if(!empty($email) && !empty($password)){
    $query = $connect->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $query->bindParam(":email", $email);
    $query->bindParam(":password", $password);
    $query->execute();
    if($query->rowCount() >  0){
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $unique_id = $row["unique_id"];
        $status = "Active now";
        $query = $connect->prepare("UPDATE users SET status=:status WHERE unique_id=:unique_id");
        $query->bindParam(":status", $status);
        $query->bindParam(":unique_id", $unique_id);
        $query->execute();
        
        if($query){
            $_SESSION["unique_id"] = $row["unique_id"];
            echo "success";
        }
    }
    else{
        echo "Email or password is incorrect!";
    }
}
else{
    echo "All input fields are required";
}
?>