<?php
require "verificar_admin.php";
require "conexion.php";

if (isset($_GET['id'])) {
    $consulta = $conexion->prepare("DELETE FROM productos WHERE id_producto = :id");
    $consulta->execute([':id' => $_GET['id']]);
}

header("Location: admin_inventario.php");
exit;