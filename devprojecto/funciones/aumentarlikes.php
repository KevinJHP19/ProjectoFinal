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

$stmt = $mysqli->prepare("UPDATE IMAGENES SET num_likes = num_likes + 1 WHERE id = ? ");
$stmt->bind_param("i", $imageId);
$stmt1 = $mysqli->prepare("INSERT INTO LIKES (imagen_id, usuario_id) VALUES (?, ?)");
$stmt1->bind_param("ii", $imageId, $_SESSION['user_id']);
$stmt1->execute();

$stmt->execute();
if (isset($_GET['page'])) {
    header("Location: ../imagen.php?id_imagen=$imageId");
    exit();
    
} else {
    header("Location: ../index.php");
    exit();
    
    
}

$stmt->close();
$mysqli->close();


?>
