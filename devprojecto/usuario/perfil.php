<?php
session_start();
require_once '../config/config.php';
$uploadDir =__DIR__ . '../../uploads/avatars/';
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener los datos del usuario desde la base de datos
$userQuery = $mysqli->query("SELECT * FROM USUARIOS WHERE id = $_SESSION[user_id]");
$user = $userQuery->fetch_assoc();

if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_POST['email'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];

    // Verificar si se ha subido un nuevo avatar
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if(in_array($fileExtension, $allowedExtensions)){
            $newFileName = md5(time() . $fileName). '.'. $fileExtension;
            //Ruta final en carpeta uploads
            $dest_path = $uploadDir . $newFileName;
            // Verificar si la carpeta de destino existe, si no, crearla
            

            if(move_uploaded_file($fileTmpPath, $dest_path)){
                // Guardar solo la ruta relativa en la base de datos
                $avatarPathDB = 'uploads/avatars/' . $newFileName;
                } else {
                    die('Error al mover el archivo');
                }
            } else {
                die('Formato de archivo no permitido');
            }
        } else {
            die('Error al subir el archivo');
        }

    // Actualizar la información del usuario en la base de datos
    $stmt = $mysqli->prepare("UPDATE USUARIOS SET nombre=?, apellido=?, nick=?, correo=?, avatar=? WHERE id=?");
    $stmt->bind_param("sssssi", $nombre, $apellido, $usuario, $email, $avatarPathDB, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Actualizar la sesión con los nuevos datos
        $_SESSION['user_name'] = $nombre;
        $_SESSION['user_subname'] = $apellido;
        $_SESSION['user_nickname'] = $usuario;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_avatar'] = $dest_path;

        header('Location: perfil.php');
        exit();
    } else {
        echo "<script>alert('Error al actualizar el perfil');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="container-fluid bg-dark pt-2 pb-2">
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="../imagenes/logo/logo.svg" alt=""> alerium
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse w-100" id="navbarNav">
                    <div class="d-flex align-items-center justify-content-center w-50 mx-auto">
                        <input type="search" class="form-control ps-2 bg-secondary mt-2 mb-2" placeholder="Buscar...">
                        <button class="btn btn-primary p-2 ps-4 pe-4 mt-2 mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>

                    <div class="ms-auto">
                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <a href="register.php" class="btn btn-primary me-2">Registrate</a>
                            <a href="login.php" class="btn btn-secondary">Iniciar Sesion</a>
                        <?php else: ?>
                            <!-- Dropdown para pantallas grandes -->
                            <div class="dropdown d-none d-lg-block">
                                <a class="bg-dark text-white dropdown-toggle d-flex align-items-center nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="../<?php echo $user['avatar'] ?>" alt="" class="rounded-circle" width="50px" height="50px">
                                    <span class="ms-2 d-none d-lg-inline "><?php echo $user['nick'] ?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="./admin/paneldegestion.php">Rol: <?php echo $user['rol'] ?> <?php if ($user['rol'] === 'admin'): ?>
                                        <i class="fa-solid fa-gear m2 text-wring"></i> <!-- Ícono para admin -->
                                    <?php endif; ?></a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="./usuario/mismegusta.php">Mis me gusta</a></li>
                                    <li><a class="dropdown-item" href="./usuario/perfil.php">Perfil</a></li>
                                    <li><a class="dropdown-item" href="./subirimagen.php">Subir imagenes</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="./logout.php">Cerrar sesion</a></li>
                                </ul>
                            </div>

                            <!-- Lista para pantallas pequeñas -->
                            <div class="d-block d-lg-none text-white">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="../<?php echo $user['avatar'] ?>" alt="" class="rounded-circle me-2" width="40px" height="40px">
                                    <span><?php echo $user['nick'] ?></span>
                                </div>
                                <ul class="list-unstyled">
                                    <li>Rol: <?php echo $user['rol'] ?><?php if ($user['rol'] === 'admin'): ?>
                                    <i class="fa-solid fa-shield-halved text-warning ms-2"></i> <!-- Ícono para admin -->
                                <?php endif; ?> </li>
                                    <li><a href="./usuario/mismegusta.php" class="mt-2 text-white nav-link">Mis me gusta</a></li>
                                    <li><a href="./usuario/perfil.php" class=" mt-32 text-white nav-link">Perfil</a></li>
                                    <li><a href="./subirimagen.php" class=" mt-2 text-white nav-link">Subir imagenes</a></li>
                                    <li><a href="./logout.php" class="mt-3 btn btn-secondary ">Cerrar sesion</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        <h1 class="text-center mt-5">Mi Perfil</h1>
        <div class="bg-white border p-4 rounded-3">
            <div class="d-flex justify-content-between  align-items-center">
                <div class="d-flex align-items-center" > 
                <img src="../<?php echo $user['avatar'] ?>" alt="" class="img-fluid rounded-circle me-3" width="120px" height="120px" data-bs-toggle="modal" data-bs-target="#verImagenModal">
                    <div  class="d-flex flex-column">
                        <h7><?php echo $user['nombre'] . " " . $user['apellido'] ?></h7>
                        <h7><em>@<?php echo $user['nick'] ?></em></h7>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">Editar perfil <i class="fa-solid fa-user-pen ms-2"></i></button>
                    <a class="btn btn-success">Mis imagenes  <i class="fa-solid fa-images"></i></a>

                    <?php if ($user['rol'] === 'admin'): ?>
                        <a class="btn btn-danger" href="../admin/paneldegestion.php">Panel de administración <i class="fa-solid fa-screwdriver-wrench ms-2"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-6 p-3">
                        <label for="name" class="form-label">Nombres:</label>
                        <input type="text" id="name" class="form-control" disabled placeholder="<?php echo $user['nombre'] ?>">
                    </div>
                    <div class="col-6 p-3">
                        <label for="apellido" class="form-label">Apellidos:</label>
                        <input type="text" id="apellido" class="form-control" disabled placeholder="<?php echo $user['apellido'] ?>">
                    </div>
                    <div class="col-6 p-3">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="text" id="usuario" class="form-control" disabled placeholder="<?php echo $user['nick'] ?>">
                    </div>
                    <div class="col-6 p-3" >
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" id="email" class="form-control" disabled placeholder="<?php echo $user['correo'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
    <!-- Modal -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarPerfilModalLabel">Editar Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data" action="">
          <label for="avatar" class="form-label">Avatar actual:</label>
            <div class="text-center">
            
            <img src="../<?php echo $user['avatar'] ?>" alt="" class="img-fluid rounded-circle mb-3" width="120px" height="120px">
            </div>
            <div class="mb-3">
              <label for="modalName" class="form-label">Nombres:</label>
              <input type="text" class="form-control" name="nombre" id="modalName" value="<?php echo $user['nombre']?>" required>
            </div>
            <div class="mb-3">
              <label for="modalApellido" class="form-label">Apellidos:</label>
              <input type="text" class="form-control" name='apellido' id="modalApellido" value="<?php echo $user['apellido']?>" required>
            </div>
            <div class="mb-3">
              <label for="modalUsuario" class="form-label">Usuario:</label>
              <input type="text" class="form-control" name="usuario" id="modalUsuario" value="<?php echo $user['nick']?>" required> 
            </div>
            <div class="mb-3">
              <label for="modalEmail" class="form-label">Correo electrónico:</label>
              <input type="email" class="form-control" name="email" id="modalEmail" required value="<?php echo $user['correo']?>">
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="avatar" class="form-label">Avatar:</label>
                
                <input type="file" id="avatar" name="avatar" accept="image/*" required >
                
            </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal para mostrar la imagen del perfil -->
<div class="modal fade" id="verImagenModal" tabindex="-1" aria-labelledby="verImagenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verImagenModalLabel">Imagen del Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../<?php echo $_SESSION['user_avatar'] ?>" alt="Imagen del perfil" class="img-fluid rounded">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>