<?php 

require_once '../../config/config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // Prepare the SQL statement
    $stmt = $mysqli->prepare("DELETE FROM USUARIOS WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    if($stmt->execute()){
        header("Location: ../paneldegestion.php");
        exit();
    } else {
        echo "<script>alert('Error al eliminar el usuario');</script>";
    }
} else {
    echo "<script>alert('ID no proporcionado');</script>";
}