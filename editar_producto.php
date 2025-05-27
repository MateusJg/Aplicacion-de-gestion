<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';

// Si se envía el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_p = $_POST['id_p'];
    $nom_prod = $_POST['nom_prod'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $pdo->prepare("UPDATE productos SET nom_prod = ?, descripcion = ?, precio = ?, stock = ? WHERE id_p = ?");
    $stmt->execute([$nom_prod, $descripcion, $precio, $stock, $id_p]);
    header("Location: productos.php");
    exit();
}

// Obtener el producto a editar
$id_p = isset($_GET['id']) ? $_GET['id'] : null;
if ($id_p) {
    $stmt = $pdo->prepare("SELECT * FROM productos WHERE id_p = ?");
    $stmt->execute([$id_p]);
    $producto = $stmt->fetch();
    if (!$producto) {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    // Mostrar lista para seleccionar producto
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>editar producto</h1>

    <?php if ($id_p && $producto): ?>
        <form method="POST">
            <input type="hidden" name="id_p" value="<?php echo $producto['id_p']; ?>">
            <label>nom_prod:</label>
            <input type="text" name="nom_prod" value="<?php echo $producto['nom_prod']; ?>" required><br>
            <label>descripcion:</label>
            <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>"><br>
            <label>precio:</label>
            <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>" required><br>
            <label>stock:</label>
            <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required><br>
            <button type="submit">Actualizar</button>
        </form>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>id_p</th>
                <th>nom_prod</th>
                <th>descripcion</th>
                <th>precio</th>
                <th>stock</th>
                <th>acción</th>
            </tr>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?php echo $p['id_p']; ?></td>
                    <td><?php echo $p['nom_prod']; ?></td>
                    <td><?php echo $p['descripcion']; ?></td>
                    <td><?php echo $p['precio']; ?></td>
                    <td><?php echo $p['stock']; ?></td>
                    <td><a href="editar_producto.php?id=<?php echo $p['id_p']; ?>">Editar</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>