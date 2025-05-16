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
    // Obtener el total de imágenes
    $total_result = $mysqli->query("SELECT COUNT(DISTINCT IMAGENES.id) as total
        FROM IMAGENES
        LEFT JOIN IMAGEN_ETIQUETA ON IMAGENES.id = IMAGEN_ETIQUETA.imagen_id
        LEFT JOIN ETIQUETA ON IMAGEN_ETIQUETA.etiqueta_id = ETIQUETA.id
        WHERE IMAGENES.titulo LIKE '%$itembusqued%' OR ETIQUETA.nombre LIKE '%$itembusqueda%'");
    $total_imagenes = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_imagenes / $limit);

    printf($total_imagenes);

    $limit = 9; //imagenes por pagina
    $page = isset($_GET['page']) ? $_GET['page'] : 1; //pagina actual
    $page =  max($page,1);
    $offset = ($page - 1) * $limit;

   

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
                <h1 class="text-start text-white pt-3 pb-3">Animals in the wild</h1>
                <div class="etiquetas d-flex">
                    <div>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Elefants</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Lions</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Tigers</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Birds</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Reptiles</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Nature</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Amphibians</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Mammals</a>
                    <a href="#" class="btn btn-secondary btn-sm m-1">Insects</a>



















                    
                    
                    
                </div>
                <div> 
                    <a href="#" class="nav-link"><i class="fa-solid fa-chevron-right fs-4 text-white m-3"></i></a>  
                </div>  
                </div>
            </div>
            

        </section>
        <section id="images" class="py-5 bg-dark text-white" >
            <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image1.jpg" alt="Image 1" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image2.jpg" alt="Image 2" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image3.jpg" alt="Image 3" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image4.jpg" alt="Image 4" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image5.jpg" alt="Image 5" class="w-100 ">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image6.jpg" alt="Image 6" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image7.jpg" alt="Image 7" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image8.jpg" alt="Image 8" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
                    <h6>User Name</h6>
                    </div>
                    <div class="datos d-flex align-items-center">
                    <i class="fa-regular fa-thumbs-up"></i>
                    <span>100</span>
                    </div>
                </div>
                </div>
                <div class="col-md-4 mb-4">
                <img src="/imagenes/image9.jpg" alt="Image 9" class="w-100">
                <div class="info d-flex align-items-center justify-content-between p-3" style="background-color: #141414;">
                    <div class="izquierda d-flex align-items-center">
                    <img src="/imagenes/avatar.png" alt="" style="width: 50px; height: 50px;">
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