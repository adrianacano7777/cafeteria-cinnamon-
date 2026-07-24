<?php
  $titulo_pagina = "Menú Bebidas - Cafetería Cinnamon";
  $categoria_actual = "Nuestras Bebidas";
  $subtitulo = "Preparadas con el mejor café artesanal e ingredientes selectos";

  $conexion = mysqli_connect("localhost", "root", "", "cafeteria_cinnamon");

  $query = "SELECT * FROM productos WHERE categoria = 'bebidas'";
  $resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php echo $titulo_pagina; ?></title>

  <link rel="stylesheet" href="../css/menu_postres.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div id="header-placeholder"></div>
  
  <div id="carruselPromosBebidas" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carruselPromosBebidas" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carruselPromosBebidas" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../img/americano.webp" class="d-block w-100" alt="Promoción Americano" style="max-height: 400px; object-fit: cover;">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>Café de Especialidad</h5>
          <p>Grano etíope seleccionado y preparado con filtro tradicional.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../img/mocha.webp" class="d-block w-100" alt="Promoción Mocha" style="max-height: 400px; object-fit: cover;">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h5>Dulce Encuentro</h5>
          <p>Prueba nuestro Mocha con auténtico chocolate belga fundido.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carruselPromosBebidas" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carruselPromosBebidas" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>

  <section class="menu">
    <h2 class="seccion-titulo"><?php echo $categoria_actual; ?></h2>
    <p class="seccion-subtitulo"><?php echo $subtitulo; ?></p>

    <div class="menu-categoria" style="margin-bottom: 30px;">
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
          <img class="categoria-foto" src="../img/americano.webp" alt="Café americano">
          <div class="categoria-label">
            <h3>Café Americano</h3>
            <p class="bebida-desc">Café de grano etíope preparado en filtro tradicional.</p>
            <span class="bebida-precio">$35.00</span>
            <a href="carrito.php" class="btn-pedir">Pedir</a>
          </div>
        </article>

        <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/latte-vainilla.webp'); background-size: cover; background-position: center;">
          <div class="categoria-label">
            <h3>Latte Vainilla</h3>
            <p class="bebida-desc">Espresso con leche vaporizada y vainilla auténtica.</p>
            <span class="bebida-precio">$55.00</span>
            <a href="carrito.php" class="btn-pedir">Pedir</a>
          </div>
        </article>

        <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/capuchino.webp'); background-size: cover; background-position: center;">
          <div class="categoria-label">
            <h3>Capuchino Clásico</h3>
            <p class="bebida-desc">Espresso con espuma cremosa y un toque de canela de Ceylán.</p>
            <span class="bebida-precio">$50.00</span>
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