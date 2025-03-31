<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IniciarSession</title>
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
</style>
</head>
<body style="background-image: url(https://cdn.pixabay.com/photo/2014/07/02/08/30/images-381937_1280.jpg);
">
    <?php include './header.php' ?>
    <main >
    <div class="container" id="login" >
        <h1 class="text-center mt-5 mb-2 text-white p-2">Iniciar Sesión</h1>
        <div class="card p-5 ">
        <form action="validar_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="botones text-start">
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            
            <a href="olvido_password.php" class="btn btn-link">Olvidé mi contraseña</a>
            </div>
        </form>
    </div>
    </div>
    </main>
    
</body>
</html>