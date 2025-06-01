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

// 5. Redirige a la imagen con el parámetro para descargar
header("Location: ../imagen.php?id_imagen=$imageId&descargar=1");
exit();
