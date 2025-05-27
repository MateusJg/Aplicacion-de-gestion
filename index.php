<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión CRUD - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>GESTION CRUD</h1>
    <form method="POST" action="index.php">
        <label>nombre:</label>
        <input type="text" name="nombre" value="Administrador" readonly><br>
        <label>email:</label>
        <input type="email" name="email" required><br>
        <label>password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include 'config.php';
        $email = $_POST['email'];
        $password = md5($_POST['password']); // En producción, usa password_hash y password_verify

        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            $_SESSION['admin'] = true;
            header("Location: opciones.php");
            exit();
        } else {
            echo "<p style='color:red;'>Credenciales incorrectas</p>";
        }
    }
    ?>
</body>
</html>