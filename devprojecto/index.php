<?php
 session_start();
    require_once './config/config.php';
    if(isset($_SESSION['user_id'])) {
        $userQuery = $mysqli->query("SELECT * FROM USUARIOS where id = " . $_SESSION['user_id']);
        $user = $userQuery->fetch_assoc();
    }
    $imagenes = $mysqli->query("SELECT IMAGENES.*, USUARIOS.id AS id_usuario, USUARIOS.nombre, USUARIOS.nick, USUARIOS.rol, USUARIOS.apellido, USUARIOS.avatar FROM IMAGENES LEFT JOIN USUARIOS ON IMAGENES.id_usuario = USUARIOS.id;");
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
                        <h1>Proyecto final</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </p>
                        <div class="search-input position-relative">
                                <div class="d-flex align-items-center justify-content-center w-50 mx-auto">
                                <input type="search" class="form-control ps-2 bg-secondary mt-2 mb-2" placeholder="Buscar...">
                                <button class="btn btn-primary p-2 ps-4 pe-4 mt-2 mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                            $verificarlike = $mysqli->query("SELECT * FROM LIKES WHERE imagen_id = " . $imagen['id'] . " AND usuario_id = " . $_SESSION['user_id']);
                            $verificarlike = $verificarlike->fetch_all(MYSQLI_ASSOC);
                            ?>
                            <?php if(!empty($verificarlike)): ?>
                                <a href="./funciones/disminuirlikes.php?id_imagen=<?php echo $imagen['id']?>"><i class="fa-solid fa-thumbs-up"></i></a>
                                
                            <?php else: ?>
                                <a href="./funciones/aumentarlikes.php?id_imagen=<?php echo $imagen['id']?>"><i class="fa-regular fa-thumbs-up"></i></a>
                                
                            <?php endif; ?>
                            <span><?php echo $imagen['num_likes'] ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                
                <div class="col-md-4 mb-4">
                <a href="./imagen.php"><img src="./imagenes/image1.jpg" alt="Image 1" class="w-100"></a>
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <a href="./usuario/perfil.php"><img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;"></a>
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <a href="#"><i class="fa-regular fa-thumbs-up"></i></a>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image2.jpg" alt="Image 2" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image3.jpg" alt="Image 3" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image4.jpg" alt="Image 4" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image5.jpg" alt="Image 5" class="w-100 ">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image6.jpg" alt="Image 6" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image7.jpg" alt="Image 7" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image8.jpg" alt="Image 8" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="./imagenes/image9.jpg" alt="Image 9" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="./imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
        <section id="paginacion" class="p-3" style="background-color: rgb(33, 37, 41);">
            <div class="text-center" >
                <ul class="d-flex  rounded-5 " >
                    <li class="nav-item"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">6</a></li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">10</a></li>
                    <li><a href="#">>></a></li>

                </ul>
            </div>


        </section>
        
        
    </main>

    <?php include 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    
</body>
</html>