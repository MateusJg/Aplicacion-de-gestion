<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $email, $password]);
    header("Location: usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>agregar usuario</h1>
    <form method="POST">
        <label>nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>email:</label>
        <input type="email" name="email" required><br>
        <label>password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Agregar</button>
    </form>
    <a href="opciones.php">regresar a opciones</a>
</body>
</html>