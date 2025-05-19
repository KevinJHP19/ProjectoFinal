<?php
session_start();
require_once '../config/config.php';
// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
// Obtiene el id del usuario desde la URL
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
} else {
    echo "ID de usuario no proporcionado.";
    exit();
}
// Consulta las imágenes que le gustan al usuario
$megustas = $mysqli->query("
    SELECT IMAGENES.*, USUARIOS.id AS id_usuario, USUARIOS.nombre, USUARIOS.nick, USUARIOS.rol, USUARIOS.apellido, USUARIOS.avatar 
    FROM LIKES 
    LEFT JOIN IMAGENES ON LIKES.imagen_id = IMAGENES.id 
    LEFT JOIN USUARIOS ON IMAGENES.id_usuario = USUARIOS.id 
    WHERE LIKES.usuario_id = $userId
    
");
$megustas = $megustas->fetch_all(MYSQLI_ASSOC);
// Consulta los detalles del usuario
$userQuery = $mysqli->query("SELECT * FROM USUARIOS WHERE id = " . $_SESSION['user_id']);
$user = $userQuery->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Me gusta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <style>
        .card {
            height: 100%;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <header>
    <div class="container-fluid bg-dark pt-2 pb-2">
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
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
                                    <li><a class="dropdown-item" href="./mismegusta.php?user_id=<?php echo $_SESSION['user_id']?>">Mis me gusta</a></li>
                                    <li><a class="dropdown-item" href="./perfil.php">Perfil</a></li>
                                    <li><a class="dropdown-item" href="../subirimagen.php">Subir imagenes</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="../logout.php">Cerrar sesion</a></li>
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
                                    <li><a href="./mismegusta.php?user_id=<?php echo $_SESSION['user_id']?>" class="mt-2 text-white nav-link">Mis me gusta</a></li>
                                    <li><a href="./perfil.php" class=" mt-32 text-white nav-link">Perfil</a></li>
                                    <li><a href="../subirimagen.php" class=" mt-2 text-white nav-link">Subir imagenes</a></li>
                                    <li><a href="../logout.php" class="mt-3 btn btn-primary ">Cerrar sesion</a></li>
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
        <div class="container mt-5">
            <h1 class="text-center mb-4"><i class="fas fa-heart text-danger"></i> Imágenes que te gustan</h1>
            <?php if (empty($megustas)): ?>
                <div class="alert alert-info text-center">
                    No has dado like a ninguna imagen todavía.
                </div>
            <?php else: ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach ($megustas as $imagen): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <div class="ratio ratio-1x1" style="max-height: 300px; overflow: hidden;">
                                    <img src="../<?php echo htmlspecialchars($imagen['url']) ?>" class="card-img-top object-fit-cover" alt="<?php echo htmlspecialchars($imagen['nombre']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo htmlspecialchars($imagen['titulo']) ?></h5>
                                    <p class="card-text flex-grow-1"><?php echo htmlspecialchars($imagen['descripcion']) ?></p>
                                    <div class="d-flex align-items-center mt-2">
                                        <img src="../<?php echo htmlspecialchars($imagen['avatar']) ?>" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                                        <span class="fw-bold"><?php echo htmlspecialchars($imagen['nick']) ?></span>
                                    </div>
                                    <a href="../funciones/disminuirlikes.php?id_imagen=<?php echo $imagen['id']&; ?>" class="btn btn-outline-danger w-100 mt-3">
                                        <i class="fas fa-heart-broken"></i> Quitar Like
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>