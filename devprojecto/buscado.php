<?php 
    session_start();
    
    require_once "./config/config.php";
    
    if(isset($_GET['query'])){
        $itembusqueda = $_GET['query'];
    }else{
        header('Location: index.php');
    }
    //verificamos si existe un usuario 
    if(isset($_SESSION['user_id'])) {
        $userQuery = $mysqli->query("SELECT * FROM USUARIOS where id = " . $_SESSION['user_id']);
        $user = $userQuery->fetch_assoc();
    }
    $limit = 9; //imagenes por pagina
    $page = isset($_GET['page']) ? $_GET['page'] : 1; //pagina actual
    $page =  max($page,1);
    $offset = ($page - 1) * $limit;

    // Obtener el total de imágenes
    $total_result = $mysqli->query("SELECT COUNT(DISTINCT IMAGENES.id) as total
        FROM IMAGENES
        LEFT JOIN IMAGEN_ETIQUETA ON IMAGENES.id = IMAGEN_ETIQUETA.imagen_id
        LEFT JOIN ETIQUETA ON IMAGEN_ETIQUETA.etiqueta_id = ETIQUETA.id
        WHERE IMAGENES.titulo LIKE '%$itembusqueda%' OR ETIQUETA.nombre LIKE '%$itembusqueda%'");
    $total_imagenes = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_imagenes / $limit);
    
    $imagenes = $mysqli->query("SELECT IMAGENES.*, USUARIOS.id AS id_usuario, USUARIOS.nombre, USUARIOS.nick, USUARIOS.rol, USUARIOS.apellido, USUARIOS.avatar 
        FROM IMAGENES 
        LEFT JOIN USUARIOS ON IMAGENES.id_usuario = USUARIOS.id
        LEFT JOIN IMAGEN_ETIQUETA ON IMAGENES.id = IMAGEN_ETIQUETA.imagen_id
        LEFT JOIN ETIQUETA ON IMAGEN_ETIQUETA.etiqueta_id = ETIQUETA.id
        WHERE IMAGENES.titulo LIKE '%$itembusqueda%' OR ETIQUETA.nombre LIKE '%$itembusqueda%'
        GROUP BY IMAGENES.id
        ORDER BY IMAGENES.id DESC 
        LIMIT $limit OFFSET $offset;");
    $imagenes = $imagenes->fetch_all(MYSQLI_ASSOC);
    $etiquetas_relacionadas = $mysqli->query("SELECT DISTINCT ETIQUETA.nombre, ETIQUETA.icono
                FROM ETIQUETA
                JOIN IMAGEN_ETIQUETA ON ETIQUETA.id = IMAGEN_ETIQUETA.etiqueta_id
                JOIN IMAGENES ON IMAGENES.id = IMAGEN_ETIQUETA.imagen_id
                WHERE ETIQUETA.nombre LIKE '%$itembusqueda%' OR IMAGENES.descripcion LIKE '%$itembusqueda%'
                ");
    $etiquetas_relacionadas = $etiquetas_relacionadas->fetch_all(MYSQLI_ASSOC);

    


    ?>

<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectoFinal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include './header.php' ?>
    <main style="background-color: #232323;">
        <section id="busqueda" >
            <div class="container">
                <h1 class="text-start text-white pt-3 pb-3"><?php echo $itembusqueda ?></h1>
                <h3 class="text-white">Etiquetas relacionadas:</h3>
                <div class="etiquetas d-flex gap-2 flex-wrap">
            
                    <?php foreach ($etiquetas_relacionadas as $etiqueta): ?>
                        <?php 
                                    // Convertir el código Unicode a un carácter legible
                                    $icono = '';
                                    if (!empty($etiqueta['icono'])) {
                                        $unicode = str_replace('U+', '', $etiqueta['icono']); // Eliminar el prefijo "U+"
                                        $icono = mb_convert_encoding('&#x' . $unicode . ';', 'UTF-8', 'HTML-ENTITIES');
                                    }
                                ?>
                                <a 
                        <a href="buscado.php?query=<?= htmlspecialchars($etiqueta['nombre']) ?>" class="btn btn-secondary btn-sm m-1" style="background-color: #141414; border-radius: 5px;">
                            <?= $icono . " " . htmlspecialchars($etiqueta['nombre']) ?>
                        </a>
                    <?php endforeach; ?>
                
                <div> 
                    <a href="#" class="nav-link"><i class="fa-solid fa-chevron-right fs-4 text-white m-3"></i></a>  
                </div>  
                </div>
            </div>
            

        </section>
        <section id="images" class="py-5 bg-dark text-white" >
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
                                   echo "<a href=./funciones/disminuirlikes.php?id_imagen=". $imagen['id']."&buscado=true&query=".$itembusqueda."><i class='fa-solid fa-thumbs-up'></i></a>
                                   <span>". $imagen['num_likes']." </span>";

                                }else{
                                  echo "<a href=./funciones/aumentarlikes.php?id_imagen=" .$imagen['id']."&buscado=true&query=".$itembusqueda."><i class='fa-regular fa-thumbs-up'></i></a>
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
    <footer>
        <div class="container-fluid text-white p-3" style="background-color: black;">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <div >
                    <p class="p-3">�� 2025 Your Website. All rights reserved.</p>
                    </div>
                    <div class="social-media d-flex  align-items-center">
                        <a href="#" class="nav-link p-3"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="nav-link p-3"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" class="nav-link p-3"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"class="nav-link p-3"><i class="fa-brands fa-instagram"></i></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>