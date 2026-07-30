<?php
  session_start();
  require_once 'conexion.php';

  $titulo_pagina = "Cafetería Cinnamon - Mi Perfil";
  $mensaje_guardado = "";

  // Guardar cambios si se envió el formulario de edición
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_perfil'])) {
    $nombre_nuevo    = trim($_POST['nombre']);
    $telefono_nuevo  = trim($_POST['telefono_contacto']);
    $direccion_nueva = trim($_POST['calle_numero']);

    if (!empty($nombre_nuevo) && isset($_SESSION['id_usuario'])) {
      $actualizar = $conexion->prepare("UPDATE usuarios SET nombre = :nombre WHERE id_usuario = :id_usuario");
      $actualizar->bindParam(':nombre', $nombre_nuevo);
      $actualizar->bindParam(':id_usuario', $_SESSION['id_usuario']);
      $actualizar->execute();

      $_SESSION['nombre'] = $nombre_nuevo;
    }

    $_SESSION['telefono']  = $telefono_nuevo;
    $_SESSION['direccion'] = $direccion_nueva;

    $mensaje_guardado = "Tus datos se actualizaron correctamente.";
  }

  $nombre    = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : (!empty($_POST['nombre']) ? $_POST['nombre'] : "María López");
  $correo    = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : (!empty($_POST['correo']) ? $_POST['correo'] : "maria@gmail.com");
  $telefono  = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : (!empty($_POST['telefono_contacto']) ? $_POST['telefono_contacto'] : "7341234567");
  $direccion = isset($_SESSION['direccion']) ? $_SESSION['direccion'] : (!empty($_POST['calle_numero']) ? $_POST['calle_numero'] : "Calle Hidalgo #10, Col. Centro");

  $sesion_activa = isset($_SESSION['id_usuario']);
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
      <div class="perfil-avatar">
        <span>👤</span>
      </div>

      <h3>Bienvenido de vuelta</h3>

      <?php if (!empty($mensaje_guardado)): ?>
        <p style="color:#ffd54f; font-weight:bold; text-align:center;"><?php echo $mensaje_guardado; ?></p>
      <?php endif; ?>

      <!-- Vista normal de los datos -->
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
          <p><?php echo htmlspecialchars($telefono); ?></p>
        </div>

        <div class="dato-bloque">
          <strong>Dirección de entrega:</strong>
          <p><?php echo htmlspecialchars($direccion); ?></p>
        </div>
      </div>

      <!-- Formulario de edición (oculto hasta que se presiona "Editar mis datos") -->
      <form class="perfil-datos" id="form-editar" method="post" action="perfil.php" style="display:none; text-align:left;">
        <input type="hidden" name="guardar_perfil" value="1">

        <div class="dato-bloque">
          <strong>Nombre completo:</strong>
          <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" style="width:100%; padding:8px; margin-top:5px;">
        </div>

        <div class="dato-bloque">
          <strong>Correo electrónico:</strong>
          <p><?php echo htmlspecialchars($correo); ?> <em style="font-size:0.8rem;">(no se puede editar)</em></p>
        </div>

        <div class="dato-bloque">
          <strong>Teléfono:</strong>
          <input type="tel" name="telefono_contacto" value="<?php echo htmlspecialchars($telefono); ?>" style="width:100%; padding:8px; margin-top:5px;">
        </div>

        <div class="dato-bloque">
          <strong>Dirección de entrega:</strong>
          <input type="text" name="calle_numero" value="<?php echo htmlspecialchars($direccion); ?>" style="width:100%; padding:8px; margin-top:5px;">
        </div>

        <button type="submit" class="btn-perfil" style="margin-top:10px;">Guardar cambios</button>
      </form>

      <div style="display:flex; gap:10px; margin-top:10px;">
        <button type="button" class="btn-perfil" id="btn-editar" onclick="mostrarEdicion()">Editar mis datos</button>
        <?php if ($sesion_activa): ?>
          <a href="logout.php" class="btn-perfil" style="text-align:center; text-decoration:none; background-color:#a33b3b; color:#fff;">Cerrar sesión</a>
        <?php endif; ?>
      </div>
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