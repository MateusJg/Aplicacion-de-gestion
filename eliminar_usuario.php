<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

// Si se confirma la eliminación
if (isset($_GET['id'])) {
    $id_n = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_n = ?");
    $stmt->execute([$id_n]);
    header("Location: usuarios.php");
    exit();
}

// Mostrar lista de usuarios para eliminar
$stmt = $pdo->query("SELECT * FROM usuarios");
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>eliminar usuario</h1>
    <table border="1">
        <tr>
            <th>id_n</th>
            <th>nombre</th>
            <th>email</th>
            <th>acción</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id_n']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><a href="eliminar_usuario.php?id=<?php echo $usuario['id_n']; ?>" onclick="return confirm('¿Seguro que desea eliminar este usuario?')">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>