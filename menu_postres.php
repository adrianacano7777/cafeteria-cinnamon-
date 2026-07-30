<?php
  require_once 'conexion.php';

  $titulo_pagina = "Menú Postres - Cafetería Cinnamon";
  $categoria_actual = "Nuestros Postres";
  $subtitulo = "Repostería artesanal horneada diariamente en casa";

  $consulta = $conexion->prepare("SELECT * FROM productos WHERE categoria = 'Postres'");
  $consulta->execute();
  $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);
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
      <?php if (count($productos) > 0): ?>
        <?php foreach ($productos as $producto): ?>
        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
          <div class="categoria-label">
            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
            <p class="bebida-desc"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
            <span class="bebida-precio">$<?php echo number_format($producto['precio'], 2); ?></span>
            <a href="carrito.php?id=<?php echo $producto['id_producto']; ?>" class="btn-pedir">Pedir</a>
          </div>
        </article>
        <?php endforeach; ?>
      <?php else: ?>
        <article class="categoria-carta">
          <img class="categoria-foto" src="../img/rolcanela.JPG" alt="Roles de Canela">
          <div class="categoria-label">
            <h3>Roles de Canela</h3>
            <p class="bebida-desc">Rol horneado con canela auténtica y glaseado cremoso.</p>
            <span class="bebida-precio">$48.00</span>
            <a href="carrito.php" class="btn-pedir">Pedir</a>
          </div>
        </article>
      <?php endif; ?>
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