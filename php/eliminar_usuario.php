<?php
require "verificar_admin.php";
require "conexion.php";

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    try {
        $consulta = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
        $consulta->execute([':id' => $id_usuario]);
        header("Location: admin_usuarios.php");
        exit;
    } catch (PDOException $error) {
        $inactivar = $conexion->prepare("UPDATE usuarios SET rol = 'inactivo' WHERE id_usuario = :id");
        $inactivar->execute([':id' => $id_usuario]);
        header("Location: admin_usuarios.php?info=inactivado");
        exit;
    }
}

header("Location: admin_usuarios.php");
exit;