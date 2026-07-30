<?php
  $titulo_pagina = "Menú Bebidas - Cafetería Cinnamon";
  $categoria_actual = "Nuestras Bebidas";
  $subtitulo = "Preparadas con el mejor café artesanal e ingredientes selectos";

  $conexion = mysqli_connect("localhost:2207", "root", "", "cinnamon");

  $query = "SELECT * FROM productos WHERE categoria = 'bebidas'";
  $resultado = mysqli_query($conexion, $query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $titulo_pagina; ?></title>
  
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/menu_postres.css?v=<?php echo filemtime('../css/menu_postres.css'); ?>">
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

  <section class="menu container my-5">
    <div class="text-center mb-4">
      <h2 class="seccion-titulo fw-bold"><?php echo $categoria_actual; ?></h2>
      <p class="seccion-subtitulo text-muted fst-italic"><?php echo $subtitulo; ?></p>
    </div>

    <div class="row g-4">
      <?php 
      if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($producto = mysqli_fetch_assoc($resultado)) { 
      ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <article class="categoria-carta h-100">
            <img class="categoria-foto" src="<?php echo isset($producto['imagen']) && !empty($producto['imagen']) ? '../img/' . $producto['imagen'] : '../img/americano.webp'; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>"> 
            <div class="categoria-label">
              <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
              <p class="bebida-desc"><?php echo isset($producto['descripcion']) ? htmlspecialchars($producto['descripcion']) : ''; ?></p>
              <span class="bebida-precio">$<?php echo number_format($producto['precio'], 2); ?></span>
              
              <form action="carrito.php" method="POST" class="mt-auto">
                <input type="hidden" name="id" value="<?php echo $producto['id_producto']; ?>">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="btn-pedir">Pedir</button>
              </form>
            </div>
          </article>
        </div>
      <?php 
        }
      } else { 
      ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <article class="categoria-carta h-100">
            <img class="categoria-foto" src="../img/americano.webp" alt="Café americano">
            <div class="categoria-label">
              <h3>Café Americano</h3>
              <p class="bebida-desc">Café de grano etíope preparado en filtro tradicional.</p>
              <span class="bebida-precio">$35.00</span>
              <form action="agregar_al_carrito.php" method="POST" class="mt-auto">
                <input type="hidden" name="id" value="cafe-americano">
                <input type="hidden" name="nombre" value="Café Americano">
                <input type="hidden" name="precio" value="35.00">
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="btn-pedir">Pedir</button>
              </form>
            </div>
          </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <article class="categoria-carta h-100">
            <img class="categoria-foto" src="../img/latte-vainilla.webp" alt="Latte Vainilla">
            <div class="categoria-label">
              <h3>Latte Vainilla</h3>
              <p class="bebida-desc">Espresso con leche vaporizada y vainilla auténtica.</p>
              <span class="bebida-precio">$55.00</span>
              <form action="agregar_al_carrito.php" method="POST" class="mt-auto">
                <input type="hidden" name="id" value="latte-vainilla">
                <input type="hidden" name="nombre" value="Latte Vainilla">
                <input type="hidden" name="precio" value="55.00">
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="btn-pedir">Pedir</button>
              </form>
            </div>
          </article>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <article class="categoria-carta h-100">
            <img class="categoria-foto" src="../img/capuchino.webp" alt="Capuchino Clásico">
            <div class="categoria-label">
              <h3>Capuchino Clásico</h3>
              <p class="bebida-desc">Espresso con espuma cremosa y un toque de canela de Ceylán.</p>
              <span class="bebida-precio">$50.00</span>
              <form action="agregar_al_carrito.php" method="POST" class="mt-auto">
                <input type="hidden" name="id" value="capuchino-clasico">
                <input type="hidden" name="nombre" value="Capuchino Clásico">
                <input type="hidden" name="precio" value="50.00">
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="btn-pedir">Pedir</button>
              </form>
            </div>
          </article>
        </div>
      <?php } ?>
    </div>
  </section>

  <div id="footer-placeholder"></div>

  <script src="../JS/header-footer.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>