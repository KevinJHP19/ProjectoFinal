<?php 
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
//Obtenemos el id de la imagen
$imageId = $_GET['imageId'];

//Ahora le disminuimos un like a la imagen

$stmt = $mysqli->prepare("UPDATE IMAGENES SET likes = likes - 1 WHERE id_imagen = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    // Si se actualizó correctamente, redirigir a la página de la imagen
    header("Location: ../index.php");
} else {
    // Si no se actualizó, redirigir a una página de error o mostrar un mensaje
    echo "Error al aumentar el like.";
}
$stmt->close();
$mysqli->close();



?>