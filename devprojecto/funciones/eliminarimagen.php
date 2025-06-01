<?php 

 session_start();
require_once '../config/config.php';
// 1. Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
// 2. Obtiene el id de la imagen desde la URL
if(isset($_GET['id_imagen'])) {
    $imageId = $_GET['id_imagen'];
} else {
    // Manejar el caso en que no se proporciona un ID de imagen
    echo "ID de imagen no proporcionado.";
    exit();
}
// 3. Consulta la URL de la imagen en la base de datos
$stmt = $mysqli->prepare("SELECT url FROM IMAGENES WHERE id = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();
$result = $stmt->get_result();
$image = $result->fetch_assoc();
if (!$image) {
    echo "Imagen no encontrada.";
    exit();
}
// 4. Elimina la imagen de la base de datos
$stmt = $mysqli->prepare("DELETE FROM IMAGENES WHERE id = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();
// 5. Elimina la imagen del servidor
$imagePath = '../' . $image['url']; // Ajusta la ruta si es necesario
if (file_exists
($imagePath)) {
    unlink($imagePath);
} else {
    echo "La imagen no existe en el servidor.";
}
// 6. Redirige a la página de inicio o a la página anterior
if (isset($_GET['page']) && $_GET['page'] == 'true') {
    header("Location: ../imagen.php?id_imagen=$imageId");
    exit();
} else if ($_GET['buscado'] == true) {
    header("Location: ../buscado.php?query=".$_GET['query']);
    exit();
} else {
    header("Location: ../misimagenes.php?user_id=".$_SESSION['user_id']);
    exit();
}
$stmt->close();
$mysqli->close();
?>