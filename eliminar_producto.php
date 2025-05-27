<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

// Si se confirma la eliminación
if (isset($_GET['id'])) {
    $id_p = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id_p = ?");
    $stmt->execute([$id_p]);
    header("Location: productos.php");
    exit();
}

// Mostrar lista de productos para eliminar
$stmt = $pdo->query("SELECT * FROM productos");
$productos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>eliminar producto</h1>
    <table border="1">
        <tr>
            <th>id_p</th>
            <th>nom_prod</th>
            <th>descripcion</th>
            <th>precio</th>
            <th>stock</th>
            <th>acción</th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto['id_p']; ?></td>
                <td><?php echo $producto['nom_prod']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['precio']; ?></td>
                <td><?php echo $producto['stock']; ?></td>
                <td><a href="eliminar_producto.php?id=<?php echo $producto['id_p']; ?>" onclick="return confirm('¿Seguro que desea eliminar este producto?')">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="opciones.php">regresar's a opciones</a>
</body>
</html>