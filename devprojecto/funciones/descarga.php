<?php

require_once '../config/config.php';

if(isset($_GET['id_imagen'])) {
    $imageId = $_GET['id_imagen'];
} else {
    exit("ID de imagen no proporcionado.");
}

$stmt = $mysqli->prepare("SELECT url FROM IMAGENES WHERE id = ?");
$stmt->bind_param("i", $imageId);
$stmt->execute();
$result = $stmt->get_result();
$image = $result->fetch_assoc();

if (!$image) {
    exit("Imagen no encontrada.");
}

$imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($image['url'], '/');


if (file_exists($imagePath)) {
    $filename = basename($imagePath);
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
    exit("Archivo no encontrado.");
}