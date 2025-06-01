<?php
session_start();
require_once './config/config.php';

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT * FROM USUARIOS WHERE correo = ? LIMIT 1");
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['correo'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_subname'] = $user['apellido'];
            $_SESSION['user_nickname'] = $user['nick'];
            $_SESSION['user_avatar'] = $user['avatar'];
            $_SESSION['user_rol'] = $user['rol'];
            header('Location: index.php');
            exit();
        } else {
            echo 'Credenciales incorrectas';
        }
    } else {
        echo 'Credenciales incorrectas';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IniciarSession</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/147cf78807.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        
.card{
    max-width: 50%;
    
    margin: auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.2);
    

}
.form-label{
    
    font-size: 18px !important;
    text-align: start !important; 
}
main {
    
    padding: 30px;
    
}
#login {
    background-image: url(https://cdn.pixabay.com/photo/2014/07/02/08/30/images-381937_1280.jpg);
background-size: cover;
background-position: center;
background-repeat: no-repeat;
background-attachment: fixed;



border-radius: 10px;

box-shadow: 0px 4px 8px 0px rgba(0,0,0,0.2);


}
</style>
</head>
<body >
    <?php include './header.php'?>
    <main>
    <div class="container" id="login">
        <div class="row">
            <div class="izquierda col-5">
                
            </div>
        
        <div class="col-7 p-5 d-flex justify-content-around flex-column" style="background-color:rgb(255, 255, 255); ">
            <div class="logo d-flex  align-items-center">
                        <img src="./imagenes/logo/logonegro.svg" alt="Logo" class="img-fluid">
                        <h2>alerium</h2>
                    </div>
            
        <h1 class="  mb-2 pt-4 pb-4 text-dark ">Iniciar sesión en tu cuenta</h1>
        <form action="" method="POST">
            <div class="mb-4">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo..." required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu constaseña..." required>
            </div>
            <div class="botones text-start d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            
            <div class="d-flex">
                <p class="text-center">¿No tienes una cuenta? <a href="register.php" class="btn btn-link">Registrate</a></p>
            </div>
            </div>

        </form>
    </div>
    </div>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>