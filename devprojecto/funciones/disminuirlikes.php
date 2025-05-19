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

//Ahora le disminuimos un like a la imagen

$stmt = $mysqli->prepare("UPDATE IMAGENES SET num_likes = GREATEST(num_likes - 1, 0) WHERE id = ?");
$stmt->bind_param("i", $imageId);

$stmt1 = $mysqli->prepare("DELETE FROM LIKES WHERE imagen_id = ? AND usuario_id = ?");
$stmt1->bind_param("ii", $imageId, $_SESSION['user_id']);

if (!$stmt->execute()) {
    echo "Error al disminuir el like: " . $stmt->error;
    exit();
}

if (!$stmt1->execute()) {
    echo "Error al eliminar el registro de like: " . $stmt1->error;
    exit();
}

if ($_GET['page'] == true) {
    header("Location: ../imagen.php?id_imagen=$imageId");
    exit();
    
} else if ($_GET['buscado'] == true) {
    header("Location: ../buscado.php?query=".$_GET['query']);
    exit();

} else if($_GET['mismegusta'] == true){
    header("Location: ../usuario/mismegusta.php?user_id=".$_SESSION['user_id']);
    exit();

}else {
    header("Location: ../index.php");
    exit();
}
$stmt->close();
$mysqli->close();



?>