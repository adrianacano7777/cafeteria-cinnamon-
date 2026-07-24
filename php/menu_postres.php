<?php
  $titulo_pagina = "Menú Postres - Cafetería Cinnamon";
  $categoria_actual = "Nuestros Postres";
  $subtitulo = "Repostería artesanal horneada diariamente en casa";

  $conexion = mysqli_connect("localhost", "root", "", "cafeteria_cinnamon");

  $query = "SELECT * FROM productos WHERE categoria = 'postres'";
  $resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo_pagina; ?></title>
  <link rel="stylesheet" href="../css/menu_postres.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div id="header-placeholder"></div>

  <section class="menu">
    <h2 class="seccion-titulo"><?php echo $categoria_actual; ?></h2>
    <p class="seccion-subtitulo"><?php echo $subtitulo; ?></p>

    <div class="menu-categoria" style="margin-bottom: 20px;">
      <?php 
      if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($producto = mysqli_fetch_assoc($resultado)) { 
      ?>
        <article class="categoria-carta">
          <img class="categoria-foto" src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
          <div class="categoria-label">
            <h3><?php echo $producto['nombre']; ?></h3>
            <p class="bebida-desc"><?php echo $producto['descripcion']; ?></p>
            <span class="bebida-precio">$<?php echo $producto['precio']; ?></span>
            <a href="carrito.php?id=<?php echo $producto['id']; ?>" class="btn-pedir">Pedir</a>
          </div>
        </article>
      <?php 
        }
      } else { 
      ?>
        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/rolcanela.JPG" alt="Roles de Canela">
          <div class="categoria-label">
            <h3>Roles de Canela</h3>
            <p class="bebida-desc">Rol horneado con canela auténtica y glaseado cremoso.</p>
            <span class="bebida-precio">$48.00</span>
            <a href="carrito.php" class="btn-pedir">Pedir</a>
          </div>
        </article>

        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/brownie.jpg" alt="Brownie de Chocolate">
          <div class="categoria-label">
            <h3>Brownie de Chocolate</h3>
            <p class="bebida-desc">Brownie húmedo con chocolate belga y nuez.</p>
            <span class="bebida-precio">$52.00</span>
            <a href="carrito.php" class="btn-pedir">Pedir</a>
          </div>
        </article>

        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/quesocake.webp" alt="Cheesecake Vainilla">
          <div class="categoria-label">
            <h3>Cheesecake Vainilla</h3>
            <p class="bebida-desc">Cheesecake cremoso con vainilla de Madagascar.</p>
            <span class="bebida-precio">$58.00</span>
            <a href="carrito.php" class="btn-pedir">Pedir</a>
          </div>
        </article>
      <?php } ?>
    </div>
  </section>

  <div id="footer-placeholder"></div>

  <footer class="text-center py-3 bg-dark text-white">
    <p class="mb-0">&copy; <?php echo date('Y'); ?> Cafetería Cinnamon. Todos los derechos reservados.</p>
  </footer>

  <script src="../JS/header-footer.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>