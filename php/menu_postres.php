<?php
  $titulo_pagina = "Menú Postres - Cafetería Cinnamon";
  $categoria_actual = "Nuestros Postres";
  $subtitulo = "Repostería artesanal horneada diariamente en casa";

  $conexion = mysqli_connect("localhost", "root", "", "cafeteria_cinnamon");

  $query = "SELECT * FROM productos WHERE categoria = 'Postres'";
  $resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo_pagina; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/menu_postres.css">
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
          <img class="categoria-foto" src="<?php echo isset($producto['imagen']) ? $producto['imagen'] : '../img/rolcanela.JPG'; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
          <div class="categoria-label">
            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
            <p class="bebida-desc"><?php echo isset($producto['descripcion']) ? htmlspecialchars($producto['descripcion']) : ''; ?></p>
            <span class="bebida-precio">$<?php echo number_format($producto['precio'], 2); ?></span>
            
           
            <form action="carrito.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $producto['id_producto']; ?>">
              <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
              <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
              <input type="hidden" name="cantidad" value="1">
              <button type="submit" class="btn-pedir">Pedir</button>
            </form>
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
            <form action="agregar_al_carrito.php" method="POST">
              <input type="hidden" name="id" value="rol-canela">
              <input type="hidden" name="nombre" value="Roles de Canela">
              <input type="hidden" name="precio" value="48.00">
              <input type="hidden" name="cantidad" value="1">
              <button type="submit" class="btn-pedir">Pedir</button>
            </form>
          </div>
        </article>

        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/brownie.jpg" alt="Brownie de Chocolate">
          <div class="categoria-label">
            <h3>Brownie de Chocolate</h3>
            <p class="bebida-desc">Brownie húmedo con chocolate belga y nuez.</p>
            <span class="bebida-precio">$52.00</span>
            <form action="agregar_al_carrito.php" method="POST">
              <input type="hidden" name="id" value="brownie-chocolate">
              <input type="hidden" name="nombre" value="Brownie de Chocolate">
              <input type="hidden" name="precio" value="52.00">
              <input type="hidden" name="cantidad" value="1">
              <button type="submit" class="btn-pedir">Pedir</button>
            </form>
          </div>
        </article>

        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/quesocake.webp" alt="Cheesecake Vainilla">
          <div class="categoria-label">
            <h3>Cheesecake Vainilla</h3>
            <p class="bebida-desc">Cheesecake cremoso con vainilla de Madagascar.</p>
            <span class="bebida-precio">$58.00</span>
            <form action="agregar_al_carrito.php" method="POST">
              <input type="hidden" name="id" value="cheesecake-vainilla">
              <input type="hidden" name="nombre" value="Cheesecake Vainilla">
              <input type="hidden" name="precio" value="58.00">
              <input type="hidden" name="cantidad" value="1">
              <button type="submit" class="btn-pedir">Pedir</button>
            </form>
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