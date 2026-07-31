<?php
  session_start();
  require_once 'conexion.php';

  $titulo_pagina = "Cafetería Cinnamon - Mi Perfil";
  $mensaje_guardado = "";

  $sesion_activa = isset($_SESSION['id_usuario']);
  if ($sesion_activa) {
      $id_usuario = $_SESSION['id_usuario'];
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_perfil'])) {
          $nombre_nuevo    = trim($_POST['nombre']);
          $telefono_nuevo  = trim($_POST['telefono_contacto']);
          $direccion_nueva = trim($_POST['calle_numero']);

          if (!empty($nombre_nuevo)) {
              $actualizar = $conexion->prepare("UPDATE usuarios SET nombre = :nombre WHERE id_usuario = :id_usuario");
              $actualizar->bindParam(':nombre', $nombre_nuevo);
              $actualizar->bindParam(':id_usuario', $id_usuario);
              $actualizar->execute();

              $_SESSION['nombre'] = $nombre_nuevo;
          }

          $_SESSION['telefono']  = $telefono_nuevo;
          $_SESSION['direccion'] = $direccion_nueva;

          $mensaje_guardado = "Tus datos se actualizaron correctamente.";
      }
      $consulta_u = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
      $consulta_u->bindParam(':id_usuario', $id_usuario);
      $consulta_u->execute();
      $usuario_bd = $consulta_u->fetch(PDO::FETCH_ASSOC);

      $nombre    = $usuario_bd['nombre'] ?? $_SESSION['nombre'] ?? '';
      $correo    = $usuario_bd['correo'] ?? $_SESSION['usuario'] ?? '';
      $telefono  = $_SESSION['telefono'] ?? '';
      $direccion = $_SESSION['direccion'] ?? '';
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
  <link rel="stylesheet" href="../css/perfil.css">
</head>

<body>
  <div id="header-placeholder"></div>

  <section class="perfil-seccion">
    <h2 class="seccion-titulo">Mi Perfil</h2>

    <div class="perfil-tarjeta">
      
      <?php if ($sesion_activa): ?>
        <div class="perfil-avatar">
          <span>👤</span>
        </div>

        <h3>Bienvenido de vuelta, <?php echo htmlspecialchars($nombre); ?></h3>

        <?php if (!empty($mensaje_guardado)): ?>
          <p style="color:#ffd54f; font-weight:bold; text-align:center;"><?php echo $mensaje_guardado; ?></p>
        <?php endif; ?>
        <div class="perfil-datos" id="vista-datos">
          <div class="dato-bloque">
            <strong>Nombre completo:</strong>
            <p><?php echo htmlspecialchars($nombre); ?></p>
          </div>

          <div class="dato-bloque">
            <strong>Correo electrónico:</strong>
            <p><?php echo htmlspecialchars($correo); ?></p>
          </div>

          <div class="dato-bloque">
            <strong>Teléfono:</strong>
            <p><?php echo !empty($telefono) ? htmlspecialchars($telefono) : '<em>No registrado</em>'; ?></p>
          </div>

          <div class="dato-bloque">
            <strong>Dirección de entrega:</strong>
            <p><?php echo !empty($direccion) ? htmlspecialchars($direccion) : '<em>No registrada</em>'; ?></p>
          </div>
        </div>
        <form class="perfil-datos" id="form-editar" method="post" action="perfil.php" style="display:none; text-align:left;">
          <input type="hidden" name="guardar_perfil" value="1">

          <div class="dato-bloque">
            <strong>Nombre completo:</strong>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" style="width:100%; padding:8px; margin-top:5px;" required>
          </div>

          <div class="dato-bloque">
            <strong>Correo electrónico:</strong>
            <p><?php echo htmlspecialchars($correo); ?> <em style="font-size:0.8rem;">(no se puede editar)</em></p>
          </div>

          <div class="dato-bloque">
            <strong>Teléfono:</strong>
            <input type="tel" name="telefono_contacto" value="<?php echo htmlspecialchars($telefono); ?>" placeholder="Ej. 7341234567" style="width:100%; padding:8px; margin-top:5px;">
          </div>

          <div class="dato-bloque">
            <strong>Dirección de entrega:</strong>
            <input type="text" name="calle_numero" value="<?php echo htmlspecialchars($direccion); ?>" placeholder="Calle, número y colonia" style="width:100%; padding:8px; margin-top:5px;">
          </div>

          <button type="submit" class="btn-perfil" style="margin-top:10px;">Guardar cambios</button>
        </form>

        <div style="display:flex; gap:10px; margin-top:10px; justify-content:center;">
          <button type="button" class="btn-perfil" id="btn-editar" onclick="mostrarEdicion()">Editar mis datos</button>
          <a href="logout.php" class="btn-perfil" style="text-align:center; text-decoration:none; background-color:#a33b3b; color:#fff;">Cerrar sesión</a>
        </div>

      <?php else: ?>
        <div class="perfil-avatar">
          <span>🔒</span>
        </div>

        <h3>Inicia sesión para ver tus datos</h3>
        <p style="text-align:center; margin-top:15px;">Para acceder a la información de tu perfil, historial o realizar pedidos, necesitas iniciar sesión.</p>

        <div style="margin-top:20px; text-align:center;">
          <a href="login.php" class="btn-perfil" style="text-decoration:none; display:inline-block; padding:10px 25px;">Ir a Iniciar Sesión</a>
        </div>

      <?php endif; ?>

    </div>
  </section>

  <div id="footer-placeholder"></div>

  <script src="../JS/header-footer.js"></script>

  <script>
    function mostrarEdicion() {
      document.getElementById('vista-datos').style.display = 'none';
      document.getElementById('form-editar').style.display = 'block';
      document.getElementById('btn-editar').style.display = 'none';
    }
  </script>

</body>
</html>
