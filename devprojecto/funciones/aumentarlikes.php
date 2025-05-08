<?php 
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
//Obtenemos el id de la imagen
if(isset($_GET['id_imagen'])) {
    $imageId = $_GET['id_imagen'];
} else {
    // Manejar el caso en que no se proporciona un ID de imagen
    echo "ID de imagen no proporcionado.";
    exit();
}


//Ahora le aumentamos un like a la imagen

$stmt = $mysqli->prepare("UPDATE IMAGENES SET num_likes = num_likes + 1 WHERE id = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    // Si se actualizó correctamente, redirigir a la página de la imagen
    header("Location: ../index.php");
} else {
    // Si no se actualizó, redirigir a una página de error o mostrar un mensaje
    // Puedes usar un mensaje de error más amigable o redirigir a una página de error
    // header("Location: ../error.php");
    // o simplemente mostrar un mensaje
    // echo "Error al aumentar el like.";
    // echo "Error al aumentar el like.";
    echo "Error al aumentar el like.";
}

$stmt->close();
$mysqli->close();


?>
