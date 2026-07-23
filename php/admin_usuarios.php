<?php
require "verificar_admin.php";
require "conexion.php";

$usuarios = $conexion->query("SELECT * FROM usuarios ORDER BY id_usuario")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cinnamon Admin - Usuarios</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
</head>
<body>

  <div id="header-placeholder" data-tipo="admin"></div>

  <section class="admin-main">
    <h2 class="seccion-titulo">Usuarios registrados</h2>

    <?php if (isset($_GET['info']) && $_GET['info'] === 'inactivado'): ?>
    <p class="alerta-error" style="background-color: #fff3cd; color: #856404; border-color: #ffeeba;">El usuario tiene historial activo en el sistema. Se ha marcado como 'Inactivo' para proteger los registros de ventas y reseñas.</p>
    <?php endif; ?>

    <div class="buscador">
      <input type="text" data-buscar-tabla="tabla-usuarios" placeholder="Buscar usuario por nombre o correo...">
    </div>

    <table class="admin-tabla" id="tabla-usuarios">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
          <td><?php echo htmlspecialchars($u['nombre']); ?></td>
          <td><?php echo htmlspecialchars($u['correo']); ?></td>
          <td>
            <?php 
              if ($u['rol'] === 'admin') echo 'Administrador';
              elseif ($u['rol'] === 'inactivo') echo 'Inactivo';
              else echo 'Cliente';
            ?>
          </td>
          <td>
            <a href="eliminar_usuario.php?id=<?php echo $u['id_usuario']; ?>" class="btn-eliminar btn-eliminar-protegido" data-nombre="<?php echo htmlspecialchars($u['nombre']); ?>">Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
  <script src="../JS/admin.js?v=<?php echo time(); ?>"></script>
</body>
</html>