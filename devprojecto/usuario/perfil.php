<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container-fluid bg-dark">
            <nav class="container navbar navbar-expand-lg navbar-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">ProjectoFinal</a>

                    <div class="search-input position-relative w-50">
                        <input type="search" class="form-control form-control-lg ps-5 bg-secondary" placeholder="Search images here">
                        <svg xmlns="http://www.w3.org/2000/svg" class="position-absolute top-50 translate-middle-y search-icon" width="25" height="25" viewBox="0 0 20 20" fill="currentColor">
                           <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                     </div>
                     <div class="dropdown nav-link">
                        
                        <a class=" bg-dark text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/imagenes/avatar.png" alt="" width="50px" height="50px">
                        </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Usuario</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Mis me gusta</a></li>
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Subir imagenes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
                          </ul>
                        </a>
                     </div>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <h1 class="text-center mt-5">Mi Perfil</h1>
            <div class="bg-white border p-4 rounded-3">
                <div class="d-flex justify-content-between  align-items-center">
                    <div class="d-flex align-items-center" > 
                        <img src="/imagenes/avatar.png" alt="" class="img-fluid rounded-circle" width="120px" height="120px">
                        <div  class="d-flex flex-column">
                            <h7>name subname</h7>
                            <h7><em>@email</em></h7>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarPerfilModal">Editar perfil</button>
                    </div>

                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-6 p-3">
                            <label for="name" class="form-label">Nombres:</label>
                            <input type="text" id="name" class="form-control" disabled placeholder="name">
                        </div>
                        <div class="col-6 p-3">
                            <label for="apellido" class="form-label">Apellidos:</label>
                            <input type="text" id="apellido" class="form-control" disabled placeholder=" subname">
                        </div>
                        <div class="col-6 p-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" id="usuario" class="form-control" disabled placeholder="username">
                        </div>
                        <div class="col-6 p-3" >
                            <label for="email" class="form-label">Correo electrónico:</label>
                            <input type="email" id="email" class="form-control" disabled placeholder="email">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarPerfilModalLabel">Editar Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="modalName" class="form-label">Nombres:</label>
              <input type="text" class="form-control" id="modalName" required>
            </div>
            <div class="mb-3">
              <label for="modalApellido" class="form-label">Apellidos:</label>
              <input type="text" class="form-control" id="modalApellido" required>
            </div>
            <div class="mb-3">
              <label for="modalUsuario" class="form-label">Usuario:</label>
              <input type="text" class="form-control" id="modalUsuario" required> 
            </div>
            <div class="mb-3">
              <label for="modalEmail" class="form-label">Correo electrónico:</label>
              <input type="email" class="form-control" id="modalEmail" required>
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="avatar" class="form-label">Avatar:</label>
                <input type="file" id="avatar" name="avatar" accept="image/*" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>