<header>
    <div class="container-fluid bg-dark pt-2 pb-2">
        <nav class="container navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="./imagenes/logo/logo.svg" alt=""> alerium
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse w-100" id="navbarNav">
                    <div class="d-flex align-items-center justify-content-center w-50 mx-auto">
                        <input type="search" class="form-control ps-2 bg-secondary mt-2 mb-2" placeholder="Buscar...">
                        <button class="btn btn-primary p-2 ps-4 pe-4 mt-2 mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>

                    <div class="ms-auto">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <a href="register.php" class="btn btn-primary me-2">Registrate</a>
                        <a href="login.php" class="btn btn-secondary">Iniciar Sesion</a>
                    <?php else: ?>
                        <!-- Dropdown para pantallas grandes -->
                        <div class="dropdown d-none d-lg-block">
                            <a class="bg-dark text-white dropdown-toggle d-flex align-items-center nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $_SESSION['user_avatar'] ?>" alt="" class="rounded-circle" width="50px" height="50px">
                                <span class="ms-2 d-none d-lg-inline "><?php echo $_SESSION['user_nickname'] ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="./admin/paneldegestion.php">Rol: <?php echo $_SESSION['user_rol'] ?> <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                                    <i class="fa-solid fa-gear m2 text-wring"></i> <!-- Ícono para admin -->
                            <?php endif; ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./usuario/mismegusta.php">Mis me gusta</a></li>
                                <li><a class="dropdown-item" href="./usuario/perfil.php">Perfil</a></li>
                                <li><a class="dropdown-item" href="./subirimagen.php">Subir imagenes</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./logout.php">Cerrar sesion</a></li>
                            </ul>
                        </div>

                        <!-- Lista para pantallas pequeñas -->
                        <div class="d-block d-lg-none text-white">
                            <div class="d-flex align-items-center mb-2">
                                <img src="<?php echo $_SESSION['user_avatar'] ?>" alt="" class="rounded-circle me-2" width="40px" height="40px">
                                <span><?php echo $_SESSION['user_nickname'] ?></span>
                            </div>
                            <ul class="list-unstyled">
                                <li>Rol: <?php echo $_SESSION['user_rol'] ?><?php if ($_SESSION['user_rol'] === 'admin'): ?>
                                <i class="fa-solid fa-shield-halved text-warning ms-2"></i> <!-- Ícono para admin -->
                            <?php endif; ?> </li>
                                <li><a href="./usuario/mismegusta.php" class="mt-2 text-white nav-link">Mis me gusta</a></li>
                                <li><a href="./usuario/perfil.php" class=" mt-32 text-white nav-link">Perfil</a></li>
                                <li><a href="./subirimagen.php" class=" mt-2 text-white nav-link">Subir imagenes</a></li>
                                <li><a href="./logout.php" class="mt-3 btn btn-secondary ">Cerrar sesion</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                </div>
            </div>
        </nav>
    </div>
</header>