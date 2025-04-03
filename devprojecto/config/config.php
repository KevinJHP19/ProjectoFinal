<?php

    $host = 'mysql-kevinjhp19.alwaysdata.net';
    $dbname = 'kevinjhp19_proyectofinal';
    $username = '398189';
    $password = '5261260casa';


    $mysqli = new mysqli($host,$username,$password,$dbname);
    if($mysqli->connect_error){
        die("Error de conexcion: " .$mysqli->connect_error);
    } 

?>