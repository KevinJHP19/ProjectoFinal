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

// 4. Aumenta el contador de descargas en la base de datos
$stmt = $mysqli->prepare("UPDATE IMAGENES SET num_descargas = num_descargas + 1 WHERE id = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();

// 5. Si viene de la página, solo redirige de vuelta (opcional, para otros usos)
if (isset($_GET['page']) && $_GET['page'] == 'true') {
    header("Location: ../imagen.php?id_imagen=$imageId");
    exit();
}

// 6. Forzar la descarga si la imagen está en el servidor
$imagePath = '../' . $image['url']; // Ajusta la ruta si es necesario

if (file_exists($imagePath)) {
    $filename = basename($imagePath);

    // Envía los headers para forzar la descarga
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($imagePath));
    readfile($imagePath);
    exit();
} else {
    // Si la imagen es externa o no está en el servidor, redirige a la URL
    header("Location: " . $image['url']);
    exit();
    
    exit();
}