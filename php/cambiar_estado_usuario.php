<?php
require "verificar_admin.php";
require "conexion.php";

if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id_usuario = $_GET['id'];
    $nuevo_estado = (int)$_GET['estado'];

    $consulta = $conexion->prepare("UPDATE usuarios SET activo = :estado WHERE id_usuario = :id");
    $consulta->execute([
        ':estado' => $nuevo_estado,
        ':id' => $id_usuario
    ]);
}

header("Location: admin_usuarios.php");
exit;