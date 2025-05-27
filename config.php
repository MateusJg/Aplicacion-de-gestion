<?php
$host = 'localhost';
$db = 'gestion';
$user = 'root'; // Cambia según tu configuración
$pass = '123456';     // Cambia según tu configuración

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>