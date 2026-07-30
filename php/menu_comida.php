 <?php
  require_once 'conexion.php';

  $titulo_pagina = "Menú Comida - Cafetería Cinnamon";
  $categoria_actual = "Nuestra Comida";
  $subtitulo = "Opciones deliciosas preparadas al momento";

  $consulta = $conexion->prepare("SELECT * FROM productos WHERE categoria = 'Comida'");
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
  <link rel="stylesheet" href="../css/menu_postres.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
</head>

<body>
  <div id="header-placeholder"></div>

  <div id="carruselPromosComida" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carruselPromosComida" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carruselPromosComida" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../img/sandwich-club.webp" class="d-block w-100" alt="Promoción Sándwich" style="max-height: 400px; object-fit: cover;">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>¡El favorito del día!</h5>
          <p>Disfruta de nuestro clásico Sándwich Club preparado al momento.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../img/bagel-salmon.webp" class="d-block w-100" alt="Promoción Bagel" style="max-height: 400px; object-fit: cover;">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>Especial del Chef</h5>
          <p>Bagel de Salmón con queso crema y alcaparras seleccionadas.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carruselPromosComida" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carruselPromosComida" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>

  <section class="menu">
    <h2 class="seccion-titulo"><?php echo $categoria_actual; ?></h2>
    <p class="seccion-subtitulo"><?php echo $subtitulo; ?></p>

    <div class="menu-categoria" style="margin-bottom: 40px;">
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
          <img class="categoria-foto" src="../img/sandwich-club.webp" alt="Sandwich club de pollo">
          <div class="categoria-label">
            <h3>Sándwich Club</h3>
            <p class="bebida-desc">Pan artesanal con pollo, tocino, lechuga y aguacate.</p>
            <span class="bebida-precio">$85.00</span>
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