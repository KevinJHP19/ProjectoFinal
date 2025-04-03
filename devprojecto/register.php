<?php

include './config/config.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
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

        .card {
            max-width: 50%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.2);
        }

        .form-label {
            font-size: 18px !important;
            text-align: start !important; 
        }

        main {
            padding: 30px;
        }

        #register {
            background-image: url(https://cdn.pixabay.com/photo/2014/07/02/08/30/images-381937_1280.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
            
            border-radius: 10px;
            box-shadow: 0px 4px 18px 0px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <?php include './header.php' ?>
    <main>
        <div class="container" id="register">
            <div class="row">
                <div class="izquierda col-5">
                    <!-- Espacio para contenido adicional si es necesario -->
                </div>
                <div class="col-7 p-5 d-flex justify-content-around flex-column" style="background-color:rgb(255, 255, 255);">
                    <div class="logo d-flex justify-content-start align-items-center">
                        <img src="./imagenes/logo/logonegro.svg" alt="Logo" class="img-fluid">
                        <h2>alerium</h2>
                    </div>
                    <h1 class="mb-2 pt-4 pb-4 text-dark">Crea tu cuenta</h1>
                    <form action="validar_register.php" method="POST">
                        <!-- Inputs específicos del formulario de registro -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar:</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" required>
                        </div>
                        <div class="botones text-start d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                            <div class="d-flex">
                                <p class="text-center">¿Ya tienes una cuenta? <a href="login.php" class="btn btn-link">Inicia sesión</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>