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
</head>
<body>
    <?php include 'header.php' ?>
    <main>
    <section id="banner" style="background-image: url(./imagenes/bg-img.png);">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <div class="d-flex align-items-center justify-content-center">
                            <a class="navbar-brand" href="index.php">
                            <img src="./imagenes/logo/logo.svg" alt="logo" width="70px" height="70px"> 
                            </a>
                            <h1>alerium</h1>
                        </div>
                        
                        <p>Una plataforma inteligente para la gestión, exploración y publicación de contenido visual</p>
                            <div class="d-flex align-items-center justify-content-center w-50 mx-auto">
                                <form class="d-flex w-100" method="get" action="buscado.php">
                                    <input type="search" name="query" class="form-control ps-2 bg-secondary mt-2 mb-2" placeholder="Buscar...">
                                    <button type="submit" class="btn btn-primary p-2 ps-4 pe-4 mt-2 mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form>
                        
                            </div>
                    </div>
                </div>
            </div>

        </section>
        <section id="images" class="py-5 bg-dark text-white" style="background-color: #232323;">
            <div class="container">
            <div class="row">
                <?php foreach ($imagenes as $imagen): ?>
                <div class=" mb-4 col-lg-4 overflow-hidden" height="400px">
                    <a href="./imagen.php?id_imagen=<?php echo $imagen['id'] ?>">
                        <img src="<?php echo $imagen['url'] ?>" alt="<?php echo $imagen['nombre'] ?>" class="w-100" ></a>
                    <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                        <div class="izquierda d-flex align-items-center">
                            <a href="./usuario/perfil.php?id_usuario=<?php echo $imagen['id'] ?>"><img src="<?php echo $imagen['avatar'] ?>" alt="" style="width: 50px; height: 50px;"></a>
                            <div class="d-flex flex-column ms-2">
                                <h6><?php echo $imagen['nombre'] . $imagen['apellido'] ?></h6>
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
                                   echo "<a href=./funciones/disminuirlikes.php?id_imagen=". $imagen['id']."><i class='fa-solid fa-thumbs-up'></i></a>
                                   <span>". $imagen['num_likes']." </span>";

                                }else{
                                  echo "<a href=./funciones/aumentarlikes.php?id_imagen=" .$imagen['id']."><i class='fa-regular fa-thumbs-up'></i></a>
                                  <span>". $imagen['num_likes']." </span>";     
                                }
                                
                            }else{
                                echo "<a href=./login.php><i class='fa-solid fa-thumbs-up'></i></a>
                                       <span>". $imagen['num_likes']." </span>";
                            }
                            
                            ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                
                
                </div>
            </div>
            </div>
        </section>
        <section id="paginacion" class="p-3" style="background-color: rgb(33, 37, 41);">
  <div class="text-center">
    <ul class="pagination justify-content-center">

      <?php if ($page > 1): ?>
        <!-- Botón para ir a la página anterior (se muestra solo si no estamos en la primera página) -->
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page - 1 ?>">Anterior</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <!-- Botones numerados para cada página -->
        <!-- Si la página actual coincide con $i, se marca como activa -->
        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <!-- Botón para ir a la página siguiente (se muestra solo si no estamos en la última página) -->
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
    
</body>
</html>