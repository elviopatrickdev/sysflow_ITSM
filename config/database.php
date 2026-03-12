<?php

$host = "localhost";
$user = "root";
$password = "fullstack2026";
$db = "ti_system";

$conn = mysqli_connect($host, $user, $password, $db);

if(!$conn){
    die("Erro na conexão com banco");
}

?>