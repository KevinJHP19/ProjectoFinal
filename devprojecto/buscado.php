<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjectoFinal</title>
    
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    

    <style>
        .input-wrapper {
  position: relative;
  width: 271px;
}

.search-icon {
   left: 15px;
}
#banner .input{
    position: absolute;
    left: 50%;
}
        #banner{
            padding: 30px 0 30px 0;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Estilos adicionales para la galería de imágenes */
        #images .col-md-4 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #images img {
            width: 100%;
            height: 300px; /* Ajusta la altura según tus necesidades */
            object-fit: cover;
        }

        #images .info {
            width: 100%;
            background-color: #141414;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #images .info .izquierda {
            display: flex;
            align-items: center;
        }

        #images .info .izquierda img {
            width: 0px;
            
            margin-right: 10px;
        }

        #images .info .datos {
            display: flex;
            align-items: center;
        }

        #images .info .datos i {
            margin-right: 5px;
        }
     
        #paginacion ul{
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-direction: row;
            list-style: none !important;
            
        }
        #paginacion li a{
            color: #fff;
            text-decoration: none;

        }
        #paginacion li{
            padding: 10px;
            border-radius: 5px;
            
        }
        #paginacion li:hover{
            background-color: #007bff;
            color: #fff;
        }
        .btn-secondary{
            background-color: #232323 !important;
            color: #fff !important;
            padding:10px 35px 10px 35px !important;    
        }
        
    </style>
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