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
<body>
    <?php include './header.php' ?>
    <main>
        <section id="miraimagen" style="background-color: #232323;" class="pt-3">
            <div class="imagen container  rounded-3 mt-3" style="background-image: url(/imagenes/image5.jpg);">
                <div class="descargar text-align-end">
                    <a href="#" class="btn btn-success m-1 me-4"><i class="fas fa-download"></i> Download image</a>
                </div>
            </div>
            <div class="container">
                
                    <div class="d-flex text-white align-items-center justify-content-between mt-4 mb-4">
                        <div class="d-flex align-items-center">
                            <img src="./imagenes/avatar.png" alt="" width="120px" height="120px">
                            <div class="">
                            <h6>Nombre Apellidos</h6>
                            <h6><em>@username</em></h6>
                            </div>
                        </div>
                        <div class="d-flex fs-5 align-items-center">
                            <i class="fa-regular fa-thumbs-up "></i>
                            <span class="ms-2">2.3K</span>
                        </div>
                    </div>
                    <div>
                        <h7 class="text-white p-2 fs-4">Releated Tags</h7>
                        <div class="etiquetas d-flex pb-5">
                            <div>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Animals in the wild</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Animals images & Pictures</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Elephant Images</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Nature Images</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Animals walking</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Natural habitat</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Wild</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Animal pictures</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Animals</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Giant animals</a>
                            <a href="#" class="btn btn-secondary btn-sm m-1 ">Fors animals</a>

                        </div>
                    </div>
                
                
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>