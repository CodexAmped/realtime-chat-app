<?php
session_start();
include_once "../config/config.php";
$outgoing_id = $_SESSION["unique_id"];

$searchTerm = $_POST["searchTerm"];
$output = "";

$query = $connect->prepare("SELECT * FROM users WHERE NOT unique_id=:outgoing_id AND (first_name LIKE CONCAT('%', :term, '%') OR last_name LIKE CONCAT('%', :term, '%'))");
$query->bindParam(":outgoing_id", $outgoing_id);
$query->bindParam(":term", $searchTerm);
$query->execute();

if($query->rowCount() > 0){
    include "data.php";
}
else{
    $output .= "No user found related to your search!";
}
echo $output;
?>