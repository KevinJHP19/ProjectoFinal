<?php
session_start();

require_once './config/config.php';





if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit();
}

if (isset($_GET['id_imagen'])) {
    $id = $_GET['id_imagen'];
} 

$vistaimagen = $mysqli->query("
    SELECT IMAGENES.*, USUARIOS.id AS id_usuario, USUARIOS.nombre, USUARIOS.nick, USUARIOS.rol, USUARIOS.apellido, USUARIOS.avatar 
    FROM IMAGENES 
    LEFT JOIN USUARIOS ON IMAGENES.id_usuario = USUARIOS.id 
    WHERE IMAGENES.id = $id
");
$vistaimagen = $vistaimagen->fetch_all(MYSQLI_ASSOC);

$etiquetasimagen = $mysqli->query("
    SELECT E.* FROM ETIQUETA E INNER JOIN IMAGEN_ETIQUETA EI ON E.id = EI.etiqueta_id WHERE EI.imagen_id = $id
");
$etiquetasimagen = $etiquetasimagen->fetch_all(MYSQLI_ASSOC);

$verificarlike = $mysqli->query("SELECT LIKES.* FROM LIKES WHERE LIKES.imagen_id = $id AND LIKES.usuario_id = ".$_SESSION['user_id']." ");
$verificarlike = $verificarlike->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vistaimagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    

    <style>
        .input-wrapper {
  position: relative;
  width: 271px;
}

.search-icon {
   left: 15px;
}
        #miraimagen .imagen {
    padding: 30px 0 30px 0;
    background-size: cover; /* Ya lo tienes */
    background-repeat: no-repeat;
    background-position: center;
    display: flex;
    align-items: end;
    justify-content: end;
    height: 650px;
    background-color: #232323;
}
/* Responsivo para pantallas pequeñas */
@media (max-width: 768px) {
    #miraimagen .imagen {
        height: 300px;
        background-size: cover;
        padding: 10px 0 10px 0;
    }
}
        h6, i{
            color: rgb(192, 190, 190);
        }
        .etiquetas a{
            background-color: #ECECEC !important;
            color: #4F4F4F !important;
            padding: 15px;
            margin-right: 5px !important;
            margin-top: 10px !important;
        }
    </style>
</head>
<body>
    <?php include './header.php' ?>
    <main>
        <section id="miraimagen" style="background-color: #232323;" class="pt-3">
            <div class="imagen container  rounded-3 mt-3" style="background-image: url(<?php echo $vistaimagen[0]['url'] ?>);">
                <div class="descargar text-align-end">
                    
                    
                    
            <button class="btn btn-success m-1 me-4" onclick="descargarImagen(<?= $vistaimagen[0]['id'] ?>)">
    <i class="fas fa-download"></i> Descargar imagen
</button>
                    
                    
                </div>
            </div>
            <div class="container">
                
                    <div class="d-flex text-white align-items-center justify-content-between mt-4 mb-4">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $vistaimagen[0]['avatar']?>" alt="" width="120px" height="120px" class="rounded-circle me-3">
                            <div class="">
                            <h6><?php echo $vistaimagen[0]['nombre'] ." ". $vistaimagen[0]['apellido'] ?></h6>
                            <h6><em>@<?php echo $vistaimagen[0]['nick'] ?></em></h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center gap-4">
                        <div class="d-flex fs-5 align-items-center">
                            <i class="fa-solid fa-download"></i>
                            <span id="contador-descargas" class="ms-2"><?php echo $vistaimagen[0]['num_descargas'] ?></span>
                        </div>

                        

                        
                            <div class="d-flex fs-5 align-items-center">
                                <?php if(!empty($verificarlike)): ?>
                                    <a href="./funciones/disminuirlikes.php?id_imagen=<?php echo $vistaimagen[0]['id']?>&page=true"><i class="fa-solid fa-thumbs-up"></i></a>
                                    
                                <?php else: ?>
                                    <a href="./funciones/aumentarlikes.php?id_imagen=<?php echo $vistaimagen[0]['id']?>&page=true"><i class="fa-regular fa-thumbs-up"></i></a>
                                    
                                <?php endif; ?>
                                
                                <span class="ms-2"><?php echo $vistaimagen[0]['num_likes'] ?></span>
                            </div>
                         </div>
                    </div>
                    <div>
                        <h7 class="text-white p-2 fs-4">Releated Tags</h7>
                        <div class="etiquetas d-flex pb-5">
                            <div class="d-flex align-items-center">
                                
                            <?php foreach ($etiquetasimagen as $etiqueta): ?>
                                <?php 
                                    // Convertir el código Unicode a un carácter legible
                                    $icono = '';
                                    if (!empty($etiqueta['icono'])) {
                                        $unicode = str_replace('U+', '', $etiqueta['icono']); // Eliminar el prefijo "U+"
                                        $icono = mb_convert_encoding('&#x' . $unicode . ';', 'UTF-8', 'HTML-ENTITIES');
                                    }
                                ?>
                                <a href="buscado.php?query=<?php echo ($etiqueta['nombre']); ?>" class="text-decoration-none text-center rounded-3">
                                    <?php echo $icono . " " . $etiqueta['nombre']; ?>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </div>
    </div>
                
                
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
<script>
function descargarImagen(idImagen) {
    fetch('/funciones/aumentardescarga.php?id_imagen=' + idImagen)
        
        .then(() => {
            //  Actualiza el contador visible
            const contador = document.getElementById('contador-descargas');
            if (contador) {
                contador.textContent = parseInt(contador.textContent) + 1;
            }

            // Inicia descarga real
            window.location.href = '/funciones/descarga.php?id_imagen=' + idImagen;
        })
        
}
</script>



</body>
</html>