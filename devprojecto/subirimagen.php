<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vistaimagen</title>
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
        #miraimagen .imagen{
            padding: 30px 0 30px 0;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: end;
            justify-content: end;
            height: 600px;
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
<body >
    <?php include './header.php' ?>
    <main>
        <div class="container mt-5 d-flex justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Subir Imagen</h1>
                <form>
                    <div class="mb-3">
                        <label for="imageTitle" class="form-label">Título de la Imagen</label>
                        <input type="text" class="form-control" id="imageTitle" placeholder="Ingresa el título de la imagen" required>
                    </div>
                    <div class="mb-3">
                        <label for="imageDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="imageDescription" rows="3" placeholder="Ingresa una descripción" required ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imageFile" class="form-label">Seleccionar Imagen</label>
                        <input type="file" class="form-control" id="imageFile" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="imageTags" class="form-label">Etiquetas</label>
                        <input type="text" class="form-control" id="imageTags" placeholder="Ingresa etiquetas separadas por comas" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Subir Imagen</button>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>