<?php 
session_start();
require_once '../config/config.php';
if($_SESSION['user_rol'] !== 'admin'){
    header('Location: ../index.php');
    exit();
}
// Verifica si el usuario está autenticado

$userQuery = $mysqli->query("SELECT * FROM USUARIOS WHERE id = " . $_SESSION['user_id']);
$user = $userQuery->fetch_assoc();

$usuarios = $mysqli->query("SELECT * FROM USUARIOS");



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">



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
                        <form class="d-flex w-100" method="get" action="../buscado.php">
                            <input type="search" name="query" class="form-control ps-2 bg-secondary mt-2 mb-2" placeholder="Buscar...">
                            <button type="submit" class="btn btn-primary p-2 ps-4 pe-4 mt-2 mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
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
                                    <li><a class="dropdown-item" href="../admin/paneldegestion.php">Rol: <?php echo $user['rol'] ?> <?php if ($user['rol'] === 'admin'): ?>
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
            <h1 class="text-center display-4 fw-bold text-primary mb-4">
                <i class="fa-solid fa-gears me-2"></i>Panel de <span class="text-dark">Gestión</span>
            </h1>
            
            <!-- Gestión de Usuarios Mejorada -->
            <section class="mt-5">
                <h2 class="text-center mb-4 h3 fw-semibold text-secondary">
                    <i class="fa-solid fa-users-gear me-2"></i>Gestión de <span class="text-dark">Usuarios</span>
                </h2>
                <!-- Formulario para agregar usuario -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7">
                        <form class="card shadow p-4 mb-4" method="post" action="agregar_usuario.php" enctype="multipart/form-data" autocomplete="off">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="userName" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="userName" name="nombre" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="userLastName" class="form-label">Apellido:</label>
                                    <input type="text" class="form-control" id="userLastName" name="apellido" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="userUsername" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="userUsername" name="username" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="userEmail" class="form-label">Correo Electrónico:</label>
                                    <input type="email" class="form-control" id="userEmail" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="userPassword" class="form-label">Contraseña:</label>
                                    <input type="password" class="form-control" id="userPassword" name="password" required minlength="6" autocomplete="new-password">
                                </div>
                                <div class="col-md-6">
                                    <label for="userAvatar" class="form-label">Avatar:</label>
                                    <input type="file" class="form-control" id="userAvatar" name="avatar" accept="image/*">
                                </div>
                                <div class="col-md-6">
                                    <label for="userRole" class="form-label">Rol:</label>
                                    <select class="form-select" id="userRole" name="rol" required>
                                        <option value="">Selecciona un rol</option>
                                        <option value="admin">Admin</option>
                                        <option value="usuario">Usuario</option>
                                    </select>
                                </div>
                                <div class="col-md-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fa fa-user-plus me-2"></i>Agregar Usuario
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Tabla de usuarios -->
                <div class="table-responsive mt-4">
                    <table class="table table-hover align-middle text-center shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Username</th>
                                <th>Correo Electrónico</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['id'] ?></td>
                                <td><img src="../<?php echo $usuario['avatar'] ?>" alt="" class="rounded-circle" width="50px" height="50px"></td>
                                <td><?php echo $usuario['nombre'] ?></td>
                                <td><?php echo $usuario['apellido'] ?></td>
                                <td><?php echo $usuario['nick'] ?></td>
                                <td><?php echo $usuario['correo'] ?></td>
                                <td><span class="badge bg-<?php echo ($usuario['rol'] === 'admin') ? 'danger' : 'primary'; ?>"><?php echo ucfirst($usuario['rol']) ?></span></td>
                                <td>
                                    <button class="btn btn-warning btn-sm me-1"><i class="fa fa-edit"></i> Editar</button>
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Eliminar</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

           
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>