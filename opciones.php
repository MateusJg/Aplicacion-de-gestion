<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Opciones</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>OPCIONES</h1>
    <div>
        <h2>usuarios</h2>
        <a href="usuarios.php">ver</a><br>
        <a href="agregar_usuario.php">agregar</a><br>
        <a href="editar_usuario.php">editar</a><br>
        <a href="eliminar_usuario.php">eliminar</a>
    </div>
    <div>
        <h2>productos</h2>
        <a href="productos.php">ver</a><br>
        <a href="agregar_producto.php">agregar</a><br>
        <a href="editar_producto.php">editar</a><br>
        <a href="eliminar_producto.php">eliminar</a>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>