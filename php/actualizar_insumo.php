<?php
require "conexion.php";

if (isset($_POST['id_insumo'])) {
    $sql = "UPDATE insumos SET cantidad_disponible = :cantidad WHERE id_insumo = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':cantidad' => $_POST['cantidad_disponible'],
        ':id' => $_POST['id_insumo']
    ]);
}

header("Location: admin_inventario.php");
exit;