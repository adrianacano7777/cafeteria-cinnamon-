<?php
$host = "localhost";
$puerto = "2207";
$basedatos = "cinnamon";
$usuario = "root";
$contrasena = "";
 
try {
    $conexion = new PDO("mysql:host=$host;port=$puerto;dbname=$basedatos;charset=utf8mb4", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    die("Error de conexión: " . $error->getMessage());
}
 