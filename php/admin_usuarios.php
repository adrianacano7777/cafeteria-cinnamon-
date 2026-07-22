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
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Angelica Rosas</td>
          <td>angelica@gmail.com</td>
          <td>Cliente</td>
          <td><a href="#" class="btn-eliminar">Eliminar</a></td>
        </tr>
        <tr>
          <td>Manuel Tapia</td>
          <td>manuel@gmail.com</td>
          <td>Cliente</td>
          <td><a href="#" class="btn-eliminar">Eliminar</a></td>
        </tr>
        <tr>
          <td>Denisse Nava</td>
          <td>denisse@gmail.com</td>
          <td>Cliente</td>
          <td><a href="#" class="btn-eliminar">Eliminar</a></td>
        </tr>
      </tbody>
    </table>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
  <script src="../JS/admin.js"></script>
</body>
</html>