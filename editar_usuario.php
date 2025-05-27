<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

// Si se envía el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_n = $_POST['id_n'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $_POST['current_password'];

    $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE id_n = ?");
    $stmt->execute([$nombre, $email, $password, $id_n]);
    header("Location: usuarios.php");
    exit();
}

// Obtener el usuario a editar
$id_n = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_n) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id_n = ?");
    $stmt->execute([$id_n]);
    $usuario = $stmt->fetch();
    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    // Mostrar lista para seleccionar usuario
    $stmt = $pdo->query("SELECT * FROM usuarios");
    $usuarios = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>editar usuario</h1>

    <?php if ($id_n && $usuario): ?>
        <form method="POST">
            <input type="hidden" name="id_n" value="<?php echo $usuario['id_n']; ?>">
            <input type="hidden" name="current_password" value="<?php echo $usuario['password']; ?>">
            <label>nombre:</label>
            <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br>
            <label>email:</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
            <label>password:</label>
            <input type="password" name="password" placeholder="Dejar en blanco para no cambiar"><br>
            <button type="submit">Actualizar</button>
        </form>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>id_n</th>
                <th>nombre</th>
                <th>email</th>
                <th>acción</th>
            </tr>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?php echo $u['id_n']; ?></td>
                    <td><?php echo $u['nombre']; ?></td>
                    <td><?php echo $u['email']; ?></td>
                    <td><a href="editar_usuario.php?id=<?php echo $u['id_n']; ?>">Editar</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>