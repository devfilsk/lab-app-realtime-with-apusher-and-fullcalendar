<?php

try{
    $conn = new PDO("mysql:host=localhost;dbname=lab_pusher", "root", "");
    $conn->exec('set names utf8');
}catch(PDOException $e){
    echo "erro ao conectar com o MYSQL: ". $e->getMessage();
    exit;
}


?>