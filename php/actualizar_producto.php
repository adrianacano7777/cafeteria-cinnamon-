<?php
require "verificar_admin.php";
require "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto'])) {
    $sql = "UPDATE productos SET 
                nombre = :nombre, 
                categoria = :categoria, 
                precio = :precio, 
                disponibilidad = :disponibilidad 
            WHERE id_producto = :id";

    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':nombre'         => $_POST['nombre'],
        ':categoria'      => $_POST['categoria'],
        ':precio'         => $_POST['precio'],
        ':disponibilidad' => $_POST['disponibilidad'],
        ':id'             => $_POST['id_producto']
    ]);
}

header("Location: admin_inventario.php");
exit;