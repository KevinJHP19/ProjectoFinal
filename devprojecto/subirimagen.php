<?php
session_start();
require_once './config/config.php';

$upload_dir = 'uploads/imagenes/';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['imageTitle']);
    $description = htmlspecialchars($_POST['imageDescription']);
    $tags = explode(',', $_POST['tags']);
    $icons = explode(',', $_POST['icons']);

    if(isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imageFile']['tmp_name'];
        $fileName = $_FILES['imageFile']['name'];

        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if(in_array($fileExtension, $allowedfileExtensions)) 
        {
            
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            //ruta final en carpeta uploads

            $dest_path = $upload_dir . $newFileName;

            if(!move_uploaded_file($fileTmpPath, $dest_path))
            {
                die('Erorr al mover el archivo');
            };

        } 
        else {
            die('Formato de archivo no perminitido');
            
        }

    } else {
        die('Error al subir el archivo');
        exit;
    }

    

    // Insertar imagen
    $stmt = $mysqli->prepare("INSERT INTO IMAGENES (titulo, descripcion, url, id_usuario) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $title, $description, $dest_path, $_SESSION['user_id']);
    $stmt->execute();
    $imageId = $stmt->insert_id;

    // Procesar etiquetas
    foreach ($tags as $i => $tag) {
        $tag = trim($tag);
        if (empty($tag)) continue;

        // Icono correspondiente si está disponible
        $icon = '';
        if (isset($icons[$i]) && !empty(trim($icons[$i]))) {
            $unicode = strtoupper(dechex(mb_ord(trim($icons[$i]), 'UTF-8')));
            $icon = 'U+' . $unicode;
        }

        // Verificar si la etiqueta ya existe
        $check = $mysqli->prepare("SELECT id FROM ETIQUETA WHERE nombre = ?");
        $check->bind_param("s", $tag);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $tagId = $row['id'];
        } else {
            $insertTag = $mysqli->prepare("INSERT INTO ETIQUETA (nombre, icono) VALUES (?, ?)");
            $insertTag->bind_param("ss", $tag, $icon);
            $insertTag->execute();
            $tagId = $insertTag->insert_id;
        }

        // Insertar relación imagen-etiqueta
        $relacion = $mysqli->prepare("INSERT INTO IMAGEN_ETIQUETA (imagen_id, etiqueta_id) VALUES (?, ?)");
        $relacion->bind_param("ii", $imageId, $tagId);
        $relacion->execute();
    }

    
}
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
        
        .imagen {
            background-image: url('https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_1280.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 600px;
            height: 400px;
            
        }
        h6, i {
            color: rgb(192, 190, 190);
        }
        
    </style>
</head>
<body>
    <?php include 'header.php' ?>
    <main >

        <div class="container mt-5 d-flex justify-content-center pb-5" >
            <div class="col-md-10 border shadow p-5">
                <h1 class="text-center ">
                    Subir Imagen
                    
                </h1>

                    <form method="POST" enctype="multipart/form-data" action="subirimagen.php">
                        <div class="mb-3">
                            <label for="imageTitle" class="form-label">Título de la Imagen</label>
                            <input type="text" class="form-control" id="imageTitle" name="imageTitle" placeholder="Ingresa el título de la imagen" required>
                        </div>
                        <div class="mb-3">
                            <label for="imageDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="imageDescription" name="imageDescription" rows="3" placeholder="Ingresa una descripción" required></textarea>
                        </div>
                        <div class="d-flex gap-5 justify-content-between align-items-center">
                        <div class="mb-3">
                            <label for="imageFile" class="form-label">Seleccionar Imagen</label>
                            <input type="file" class="form-control" id="imageFile" name="imageFile" accept="image/*" required>
                        </div>

                        <div id="miraimagen" class="imagen border rounded-5" style="background-image: url('https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_1280.png'); width: 600px; height: 400px  ;" data-bs-toggle="modal" data-bs-target="#imageModal">
                            
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true" >
                            <div class="modal-dialog modal-dialog-centered" style="width: 900px; height: 800px;">
                                <div class="modal-content" style="background-image: url('https://cdn.pixabay.com/photo/2017/01/25/17/35/picture-2008484_1280.png'); background-size: cover; background-position: center; background-repeat: no-repeat;  width: 900px; height: 400px;">
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>

                        </div>
                        
                        <div class="mb-3">
                            <label for="tags" class="form-label">Etiquetas</label>
                            <input type="text" class="form-control" id="tags" name="tags" placeholder="Ingresa las etiquetas separadas por comas (ej: felicidad,caliente,fotografico)" required>
                        </div>
                        <div class="mb-3">
                            <label for="icons" class="form-label">Iconos de etiquetas (Abrir panel de emojis: " <i class="fa-brands fa-windows" style="color: #000000;"></i> + . ")</label>
                            <input class="form-control" id="icons" name="icons" placeholder="Ingresa los iconos separados por comas (ej: 😃,🔥,📷)" required>
                        </div>

                        
                        <button type="submit" class="btn btn-primary">Subir Imagen</button>
                    </form>
                
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const imageFileInput = document.getElementById('imageFile');
        const miraimagen = document.getElementById('miraimagen');
        const modalContent = document.querySelector('#imageModal .modal-content');

        imageFileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageUrl = e.target.result;
                    miraimagen.style.backgroundImage = `url(${imageUrl})`;
                    miraimagen.style.backgroundSize = 'cover';
                    miraimagen.style.backgroundPosition = 'center';

                    modalContent.style.backgroundImage = `url(${imageUrl})`;
                    modalContent.style.backgroundSize = 'cover';
                    modalContent.style.backgroundPosition = 'center';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    </script>
</body>
</html>