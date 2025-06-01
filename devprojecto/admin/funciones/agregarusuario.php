<?php 

require_once '../../config/config.php';
$uploadDir = __DIR__.'/../../uploads/avatars/';


if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rol'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        die('Error al subir el archivo: ' . $_FILES['avatar']['error']);
    }
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        if(in_array($fileExtension, $allowedExtensions)){
            $newFileName = md5(time() . $fileName). '.'. $fileExtension;
            $dest_path = $uploadDir . $newFileName;

            // Verificar si la carpeta de destino existe, si no, crearla
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if(move_uploaded_file($fileTmpPath, $dest_path)){
                // Guardar solo la ruta relativa en la base de datos
                $avatarPathDB = 'uploads/avatars/' . $newFileName;
            } else {
                die('Error al mover el archivo');
            }
        } else {
            die('Formato de archivo no permitido');
        }
    }else{
        die('Error al subir el archivo');
    }
    //2. cifrar la paswword con password_hash
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $stmt = $mysqli->prepare("INSERT INTO USUARIOS (nombre, apellido, nick, correo, avatar, password, rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $apellido, $usuario, $email, $avatarPathDB, $passwordHashed, $rol);
    
    if($stmt->execute()){
        
        header("Location: ../paneldegestion.php");
        exit();
    } else {
        echo "<script>alert('Error al registrar');</script>";
    }
}

