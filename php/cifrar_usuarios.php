<?php
require "conexion.php";

$usuarios = $conexion->query("SELECT id_usuario, contrasena FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);

$actualizados = 0;

foreach ($usuarios as $u) {
    if (strpos($u['contrasena'], '$2y$') !== 0) {
        $hash = password_hash($u['contrasena'], PASSWORD_BCRYPT);
        $update = $conexion->prepare("UPDATE usuarios SET contrasena = :hash WHERE id_usuario = :id");
        $update->execute([':hash' => $hash, ':id' => $u['id_usuario']]);
        $actualizados++;
    }
}

echo "¡Se actualizaron " . $actualizados . " contraseñas a hash BCRYPT con éxito!";
?>