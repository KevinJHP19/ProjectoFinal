<?php
session_start();
require_once '../config/config.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit("No autorizado");
}

// Verifica si se proporcionó un ID de imagen
if (!isset($_GET['id_imagen'])) {
    http_response_code(400);
    exit("Falta ID de imagen");
}

$imageId = intval($_GET['id_imagen']);

// Aumenta el contador de descargas
$stmt = $mysqli->prepare("UPDATE IMAGENES SET num_descargas = num_descargas + 1 WHERE id = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();
