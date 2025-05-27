<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    $nom_prod = $_POST['nom_prod'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $stmt = $pdo->prepare("INSERT INTO productos (nom_prod, descripcion, precio, stock) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom_prod, $descripcion, $precio, $stock]);
    header("Location: productos.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>agregar producto</h1>
    <form method="POST">
        <label>nom_prod:</label>
        <input type="text" name="nom_prod" required><br>
        <label>descripcion:</label>
        <input type="text" name="descripcion"><br>
        <label>precio:</label>
        <input type="number" step="0.01" name="precio" required><br>
        <label>stock:</label>
        <input type="number" name="stock" required><br>
        <button type="submit">Agregar</button>
    </form>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>