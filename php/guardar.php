<?php
require_once("conexion.php");
$usuario=$_POST["nombre"];
$correo=$_POST["correo"];
$password=password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
//$stmt->bind_param("sss", $usuario, $correo, $password);

if($stmt->execute()){
    echo "Usuario registrado.";
}else{
    echo "Error al registrar el usuario.";
}
$stmt->close();
$conexion->close();
?>