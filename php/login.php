<?php
session_start();
require_once 'conexion.php';

$titulo_pagina = "Cafetería Cinnamon - Iniciar sesión";
$mensaje_bienvenida = "Entrar a mi cuenta";
$error_login = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['correo']) && !isset($_POST['nombre'])) {

    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    if (!empty($correo) && !empty($contrasena)) {

        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $consulta->bindParam(':correo', $correo);
        $consulta->execute();
        $usuario_bd = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario_bd && (password_verify($contrasena, $usuario_bd['contrasena']) || $contrasena === $usuario_bd['contrasena'])) {

            $_SESSION['id_usuario'] = $usuario_bd['id_usuario'];
            $_SESSION['nombre']     = $usuario_bd['nombre'];
            $_SESSION['usuario']    = $usuario_bd['correo'];
            $_SESSION['rol']        = $usuario_bd['rol'];

            if ($usuario_bd['rol'] === 'admin') {
                header("Location: admin_inventario.php");
                exit();
            } else {
                header("Location: perfil.php");
                exit();
            }

        } else {
            $error_login = "Correo o contraseña incorrectos.";
        }

    } else {
        $error_login = "Escribe tu correo y contraseña.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {

    $nombre_nuevo = trim($_POST['nombre']);
    $correo_nuevo = trim($_POST['correo']);
    $contrasena_nueva = trim($_POST['contrasena']);

    $direccion = isset($_POST['calle_numero']) ? trim($_POST['calle_numero']) : '';
    $telefono  = isset($_POST['telefono_contacto']) ? trim($_POST['telefono_contacto']) : '';

    if (!empty($nombre_nuevo) && !empty($correo_nuevo) && !empty($contrasena_nueva)) {
      $consulta_existe = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = :correo");
        $consulta_existe->bindParam(':correo', $correo_nuevo);
        $consulta_existe->execute();

        if ($consulta_existe->fetch()) {
            $error_login = "Ya existe una cuenta registrada con ese correo.";
        } else {
          $contrasena_hash = password_hash($contrasena_nueva, PASSWORD_DEFAULT);
          $insertar = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES (:nombre, :correo, :contrasena, 'cliente')");
            $insertar->bindParam(':nombre', $nombre_nuevo);
            $insertar->bindParam(':correo', $correo_nuevo);
            $insertar->bindParam(':contrasena', $contrasena_hash);
            $insertar->execute();
            $_SESSION['id_usuario'] = $conexion->lastInsertId();
            $_SESSION['nombre']     = $nombre_nuevo;
            $_SESSION['usuario']    = $correo_nuevo;
            $_SESSION['rol']        = 'cliente';

            header("Location: perfil.php");
            exit();
        }

    } else {
        $error_login = "Llena los campos obligatorios para crear tu cuenta.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo_pagina; ?></title>

  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <div id="header-placeholder"></div>

  <section class="acceso">
    <h2 class="seccion-titulo"><?php echo $mensaje_bienvenida; ?></h2>
    <p class="acceso-intro">
      Si ya tienes una cuenta con nosotros, inicia sesión en el primer recuadro.
      Si es tu primera vez en Cafetería Cinnamon, llena el segundo recuadro para crear tu cuenta.
      Los campos marcados con <span class="campo-obligatorio">*</span> son obligatorios; los demás los puedes dejar en
      blanco y llenarlos después.
    </p>

    <?php if(!empty($error_login)): ?>
      <div class="alert alert-danger text-center container" role="alert">
        <?php echo $error_login; ?>
      </div>
    <?php endif; ?>

    <div class="acceso-contenedor-paneles">
      <div class="acceso-panel" id="iniciar-sesion">
        <h3>Ya tengo cuenta: Iniciar sesión</h3>

        <form class="form-acceso" action="login.php" method="post">
          <label for="login-correo">Correo electrónico <span class="campo-obligatorio">*</span></label>
          <input type="email" id="login-correo" name="correo" placeholder="Ejemplo: admin@cinnamon.com o usuario@gmail.com" required>
          <p class="texto-ayuda">Escribe tu correo de usuario o administrador.</p>

          <label for="login-contrasena">Contraseña <span class="campo-obligatorio">*</span></label>
          <input type="password" id="login-contrasena" name="contrasena" placeholder="Escribe tu contraseña" required>

          <button type="submit" class="btn-primario">Entrar</button>
        </form>
      </div>

      <div class="acceso-panel" id="crear-cuenta">
        <h3>Crear cuenta</h3>
        <form class="form-acceso" action="login.php" method="post">
          <label for="registro-nombre">Nombre completo <span class="campo-obligatorio">*</span></label>
          <input type="text" id="registro-nombre" name="nombre" placeholder="Ejemplo: María López" required>

          <label for="registro-correo">Correo electrónico <span class="campo-obligatorio">*</span></label>
          <input type="email" id="registro-correo" name="correo" placeholder="Ejemplo: nombre@gmail.com" required>
          <p class="texto-ayuda">Usaremos este correo para avisarte sobre tus pedidos.</p>

          <label for="registro-contrasena">Crea una contraseña <span class="campo-obligatorio">*</span></label>
          <input type="password" id="registro-contrasena" name="contrasena" placeholder="Mínimo 6 caracteres" required>

          <label for="registro-direccion">Tu dirección (opcional, la puedes agregar después)</label>
          <input type="text" id="registro-direccion" name="calle_numero" placeholder="Calle, número y colonia">
          <p class="texto-ayuda">Solo es necesaria si vas a pedir a domicilio. Puedes omitir este paso ahora.</p>

          <label for="registro-telefono">Teléfono de contacto</label>
          <input type="tel" id="registro-telefono" name="telefono_contacto" placeholder="Ejemplo: 7341234567">

          <button type="submit" class="btn-primario">Crear mi cuenta</button>
        </form>
      </div>

    </div>
  </section>

  <div id="footer-placeholder"></div>

  <script src="../JS/header-footer.js"></script>

</body>

</html>