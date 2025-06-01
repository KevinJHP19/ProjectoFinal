<?php
 session_start();
    require_once './config/config.php';
    if(isset($_SESSION['user_id'])) {
        $userQuery = $mysqli->query("SELECT * FROM USUARIOS where id = " . $_SESSION['user_id']);
        $user = $userQuery->fetch_assoc();
    }


    $limit = 9; //imagenes por pagina
    $page = isset($_GET['page']) ? $_GET['page'] : 1; //pagina actual
    $page =  max($page,1);
    $offset = ($page - 1) * $limit;

    // Obtener el total de imágenes
$total_result = $mysqli->query("SELECT COUNT(*) as total FROM IMAGENES");
$total_imagenes = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_imagenes / $limit);

    $imagenes = $mysqli->query("SELECT IMAGENES.*, USUARIOS.id AS id_usuario, USUARIOS.nombre, USUARIOS.nick, USUARIOS.rol, USUARIOS.apellido, USUARIOS.avatar FROM IMAGENES LEFT JOIN USUARIOS ON IMAGENES.id_usuario = USUARIOS.id
    ORDER BY IMAGENES.id DESC 
    LIMIT $limit OFFSET $offset;");
    $imagenes = $imagenes->fetch_all(MYSQLI_ASSOC);



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <style>
    @media (max-width: 768px) {
        #banner h1 {
            font-size: 2rem;
        }
        .info {
            flex-direction: column !important;
            align-items: flex-start !important;
        }
        .datos {
            margin-top: 10px;
        }
    }
    /* Efecto de expansión al pasar el mouse */
    .card-hover {
        transition: transform 0.3s cubic-bezier(.4,2,.6,1);
    }
    .card-hover:hover {
        transform: scale(1.04);
        z-index: 2;
        box-shadow: 0 8px 24px rgba(0,0,0,0.25);
    }
</style>
</head>
<body>
    <?php include 'header.php' ?>
    <main>
    <section id="banner" style="background-image: url(./imagenes/bg-img.png);">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center">
                            <a class="navbar-brand mb-2 mb-md-0" href="index.php">
                            <img src="./imagenes/logo/logo.svg" alt="logo" width="70px" height="70px"> 
                            </a>
                            <h1 class="ms-md-3">alerium</h1>
                        </div>
                        
                        <p>Una plataforma inteligente para la gestión, exploración y publicación de contenido visual</p>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-6">
                                <form class="d-flex w-100" method="get" action="buscado.php">
                                    <input type="search" name="query" class="form-control ps-2 bg-secondary mt-2 mb-2" placeholder="Buscar...">
                                    <button type="submit" class="btn btn-primary p-2 ps-4 pe-4 mt-2 mb-2 ms-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="images" class="py-5 bg-dark text-white" style="background-color: #232323;">
            <div class="container">
                <div class="row">
                    <?php foreach ($imagenes as $imagen): ?>
                    <div class="mb-4 col-12 col-sm-6 col-lg-4 overflow-hidden card-hover">
                        <a href="./imagen.php?id_imagen=<?php echo $imagen['id'] ?>">
                            <img src="<?php echo $imagen['url'] ?>" alt="<?php echo $imagen['nombre'] ?>" class="w-100 img-fluid" style="max-height:300px;object-fit:cover;">
                        </a>
                        <div class="info d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between p-3" style="background-color: #141414;">
                            <div class="izquierda d-flex align-items-center mb-2 mb-md-0">
                                <a href="./usuario/perfil.php?id_usuario=<?php echo $imagen['id'] ?>">
                                    <img src="<?php echo $imagen['avatar'] ?>" alt="" style="width: 50px; height: 50px; object-fit:cover; border-radius:50%;">
                                </a>
                                <div class="d-flex flex-column ms-2">
                                    <h6 class="mb-0"><?php echo $imagen['nombre'] . " " . $imagen['apellido'] ?></h6>
                                    <em class="text-secondary"><?php echo "@" . $imagen['nick'] ?></em>
                                </div>
                            </div>
                            <div class="datos d-flex align-items-center">
                                <?php
                                //Esto es para verificar si el usuario ya le dio like a la imagen
                                if(isset($_SESSION['user_id'])){
                                    $verificarlike = $mysqli->query("SELECT * FROM LIKES WHERE imagen_id = " . $imagen['id'] . " AND usuario_id = " . $_SESSION['user_id']);
                                    $verificarlike = $verificarlike->fetch_all(MYSQLI_ASSOC);
                                    if(!empty($verificarlike)){
                                        echo "<a href=./funciones/disminuirlikes.php?id_imagen=". $imagen['id']." class='me-2'><i class='fa-solid fa-thumbs-up'></i></a>
                                        <span>". $imagen['num_likes']." </span>";
                                    }else{
                                        echo "<a href=./funciones/aumentarlikes.php?id_imagen=" .$imagen['id']." class='me-2'><i class='fa-regular fa-thumbs-up'></i></a>
                                        <span>". $imagen['num_likes']." </span>";     
                                    }
                                }else{
                                    echo "<a href=./login.php class='me-2'><i class='fa-solid fa-thumbs-up'></i></a>
                                        <span>". $imagen['num_likes']." </span>";
                                }
                                if(isset($_SESSION['user_rol']) && $_SESSION['user_rol'] == 'admin')
                                {
                                    echo "<a class='btn btn-outline-danger ms-3' href=./funciones/eliminarimagen.php?id_imagen=" .$imagen['id']."><i class='fa-solid fa-trash'></i></a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section id="paginacion" class="p-3" style="background-color: rgb(33, 37, 41);">
            <div class="text-center">
                <ul class="pagination justify-content-center flex-wrap">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">Anterior</a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">Siguiente</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </section>
    </main>
    <?php include 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <style>
        @media (max-width: 768px) {
            #banner h1 {
                font-size: 2rem;
            }
            .info {
                flex-direction: column !important;
                align-items: flex-start !important;
            }
            .datos {
                margin-top: 10px;
            }
        }
    </style>
</body>
</html>