<?php 
session_start();

if($_SESSION['user_rol'] !== 'admin'){
    header('Location: ../index.php');
    exit();
}