<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
include 'config.php';
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>ver productos</h1>
    <table border="1">
        <tr>
            <th>id_p</th>
            <th>nom_prod</th>
            <th>descripcion</th>
            <th>precio</th>
            <th>stock</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto['id_p']; ?></td>
                <td><?php echo $producto['nom_prod']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>