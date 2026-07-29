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

    <div class="buscador">
      <input type="text" data-buscar-tabla="tabla-usuarios" placeholder="Buscar usuario por nombre o correo...">
    </div>

    <table class="admin-tabla" id="tabla-usuarios">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $u): ?>
        <?php $estatus_activo = isset($u['activo']) ? (int)$u['activo'] : ($u['rol'] === 'inactivo' ? 0 : 1); ?>
        <tr class="<?php echo $estatus_activo ? '' : 'fila-inactiva'; ?>">
          <td><?php echo htmlspecialchars($u['nombre']); ?></td>
          <td><?php echo htmlspecialchars($u['correo']); ?></td>
          <td>
            <?php 
              if ($u['rol'] === 'admin') echo 'Administrador';
              else echo 'Cliente';
            ?>
          </td>
          <td>
            <span class="<?php echo $estatus_activo ? 'stock-suficiente' : 'stock-bajo'; ?>">
              <?php echo $estatus_activo ? 'Activo' : 'Inactivo'; ?>
            </span>
          </td>
          <td>
            <?php if ($estatus_activo): ?>
              <a href="cambiar_estado_usuario.php?id=<?php echo $u['id_usuario']; ?>&estado=0" class="btn-eliminar">Desactivar</a>
            <?php else: ?>
              <a href="cambiar_estado_usuario.php?id=<?php echo $u['id_usuario']; ?>&estado=1" class="btn-editar" style="background-color: #28a745; color: white;">Reactivar</a>
            <?php endif; ?>
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