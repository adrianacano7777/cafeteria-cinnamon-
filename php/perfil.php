<?php
  session_start();

  $titulo_pagina = "Cafetería Cinnamon - Mi Perfil";

  $nombre    = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : (!empty($_POST['nombre']) ? $_POST['nombre'] : "María López");
  $correo    = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : (!empty($_POST['correo']) ? $_POST['correo'] : "maria@gmail.com");
  $telefono  = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : (!empty($_POST['telefono_contacto']) ? $_POST['telefono_contacto'] : "7341234567");
  $direccion = isset($_SESSION['direccion']) ? $_SESSION['direccion'] : (!empty($_POST['calle_numero']) ? $_POST['calle_numero'] : "Calle Hidalgo #10, Col. Centro");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo_pagina; ?></title>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/perfil.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

      <div class="perfil-datos">
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

      <button class="btn-perfil">Editar mis datos</button>
    </div>
  </section>

  <div id="footer-placeholder"></div>

  <footer class="text-center py-3 bg-dark text-white mt-5">
    <p class="mb-0">&copy; <?php echo date('Y'); ?> Cafetería Cinnamon. Todos los derechos reservados.</p>
  </footer>

  <script src="../JS/header-footer.js"></script>

</body>
</html>