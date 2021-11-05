<?php
try{
    $connect = new PDO("mysql:dbname=chatapp;host=localhost", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} 
catch(PDOExption $e){
    echo "Connection failed: " . $e->getMessage;
}

?>