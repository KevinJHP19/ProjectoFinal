<?php
session_start();
require_once '../config/config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
    $misimagenes = $mysql->query("SELECT * FROM IMAGENES WHERE id_usuario = " . $_SESSION['user_id']);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis imagenes</title>
</head>
<body>
    
</body>
</html>
