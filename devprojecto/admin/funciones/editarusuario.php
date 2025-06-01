<?php
// filepath: /workspaces/ProjectoFinal/devprojecto/admin/funciones/editarusuario.php
session_start();
require_once '../../config/config.php';

// Solo admin puede editar
if ($_SESSION['user_rol'] !== 'admin') {
    header('Location: ../../index.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID de usuario no proporcionado.";
    exit();
}

$id = intval($_GET['id']);

// Obtener datos del usuario
$stmt = $mysqli->prepare("SELECT * FROM USUARIOS WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $nick = $_POST['usuario'];
    $correo = $_POST['email'];
    $rol = $_POST['rol'];

    $stmt = $mysqli->prepare("UPDATE USUARIOS SET nombre=?, apellido=?, nick=?, correo=?, rol=? WHERE id=?");
    $stmt->bind_param("sssssi", $nombre, $apellido, $nick, $correo, $rol, $id);
    $stmt->execute();

    header("Location: ../paneldegestion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2>Editar Usuario</h2>
        <form method="post" class="bg-secondary bg-opacity-25 p-4 rounded shadow-lg" autocomplete="off">
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                <div class="form-text text-white"">Introduce el nombre real del usuario.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required maxlength="50" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                <div class="form-text text-white">Introduce el apellido real del usuario.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <input type="text" name="usuario" class="form-control" value="<?php echo htmlspecialchars($usuario['nick']); ?>" required maxlength="30" pattern="[A-Za-z0-9_]+" title="Solo letras, números y guion bajo">
                <div class="form-text text-white"" >El nombre de usuario solo puede contener letras, números y guion bajo.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required maxlength="100">
                <div class="form-text text-white"">Introduce un correo electrónico válido.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="admin" <?php if($usuario['rol']=='admin') echo 'selected'; ?>>Admin</option>
                    <option value="usuario" <?php if($usuario['rol']=='usuario') echo 'selected'; ?>>Usuario</option>
                </select>
                <div class="form-text text-white"">Selecciona el rol del usuario.</div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                <a href="../paneldegestion.php" class="btn btn-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>


