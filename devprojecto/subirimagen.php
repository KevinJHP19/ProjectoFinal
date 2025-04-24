<?php 
session_start();
require_once './config/config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_SESSION['user_id'])) {
    $userQuery = $mysqli->query("SELECT * FROM USUARIOS where id = " . $_SESSION['user_id']);
    $user = $userQuery->fetch_assoc();
}

if (isset($_POST['imageTitle']) && isset($_POST['imageDescription']) && isset($_FILES['imageFile']) && isset($_POST['imageTags']) && isset($_POST['imagetagicon'])) {
    $title = $_POST['imageTitle'];
    $description = $_POST['imageDescription'];
    
    $file = $_FILES['imageFile'];
    $tags = $_POST['imageTags'];
    
    $arraytags = explode(',', $tags);
    $iconstags = $_POST['imagetagicon'];
    $arrayiconstags = explode(',', $iconstags);
    if (is_array($arraytags) && is_array($arrayiconstags)) {
        foreach ($arraytags as $index => $tag) {
            $tag = trim($tag);
            $iconstag = isset($arrayiconstags[$index]) ? trim($arrayiconstags[$index]) : null;
            // Convierte el icono a Unicode en formato HEX
            $iconstag = strtoupper(dechex(mb_ord($iconstag, 'UTF-8')));
            
            // Inserta la etiqueta y su icono en la tabla ETIQUETAS
            $query = "INSERT INTO ETIQUETAS (nombre, iconos) VALUES ('$tag', 'U+$iconstag')";
            $mysqli->query($query);

            
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vistaimagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        
        #miraimagen .imagen {
            padding: 30px 0 30px 0;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: end;
            justify-content: end;
            height: 600px;
        }
        h6, i {
            color: rgb(192, 190, 190);
        }
        
    </style>
</head>
<body>
    <?php include 'header.php' ?>
    <main>
        <div class="container mt-5 d-flex justify-content-center ">
            <div class="col-md-10 border shadow p-5">
                <h1 class="text-center">Subir Imagen</h1>

                    <form method="POST" enctype="multipart/form-data">
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

                        <div id="miraimagen" class="imagen border rounded-5" style="background-image: url('https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg'); width: 500px; height: 400px;" data-bs-toggle="modal" data-bs-target="#imageModal">
                            
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-image: url('https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg'); background-size: cover; background-position: center; height: 500px; width: 500px;">
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>

                        </div>
                        
                        <div class="mb-3">
                            <label for="imageTags" class="form-label">Etiquetas</label>
                            <input type="text" class="form-control" id="imageTags" name="imageTags" placeholder="Ingresa las etiquetas separadas por comas" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagetagicon" class="form-label">Etiqueta icono</label>
                            <input class="form-control" id="imagetagicon" name="imagetagicon" placeholder="Ingresa los iconos separados por comas" required>
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