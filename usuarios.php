<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';
$stmt = $pdo->query("SELECT * FROM usuarios");
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>ver usuarios</h1>
    <table border="1">
        <tr>
            <th>id_n</th>
            <th>nombre</th>
            <th>email</th>
            <th>password</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['id_n']; ?></td>
                <td><?php echo $usuario['nombre']; ?></td>
                <td><?php echo $usuario['email']; ?></td>
                <td><?php echo $usuario['password']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>