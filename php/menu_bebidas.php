<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Bebidas - Cafetería Cinnamon</title>
<<<<<<< HEAD
  <link rel="stylesheet" href="css/menu_postres.css">
=======
  <link rel="stylesheet" href="../css/menu_bebidas.css">
>>>>>>> edff46cbb11f9e3668d73b7a66e6b642b4ee8b72
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
    <h2 class="seccion-titulo">Nuestras Bebidas</h2>
    <p class="seccion-subtitulo">Preparadas con el mejor café artesanal e ingredientes selectos</p>

    <div class="menu-categoria" style="margin-bottom: 30px;">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/americano.webp" alt="Café americano">
        <div class="categoria-label">
          <h3>Café Americano</h3>
          <p class="bebida-desc">Café de grano etíope preparado en filtro tradicional.</p>
          <span class="bebida-precio">$35.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/latte-vainilla.webp'), url('imagen/latte-vainilla.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Latte Vainilla</h3>
          <p class="bebida-desc">Espresso con leche vaporizada y vainilla auténtica.</p>
          <span class="bebida-precio">$55.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/capuchino.webp'), url('imagen/capuchino.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Capuchino Clásico</h3>
          <p class="bebida-desc">Espresso con espuma cremosa y un toque de canela de Ceylán.</p>
          <span class="bebida-precio">$50.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
    </div>


    <div class="menu-categoria" style="margin-bottom: 30px;">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/mocha.webp" alt="Mocha de chocolate belga">
        <div class="categoria-label">
          <h3>Mocha Belga</h3>
          <p class="bebida-desc">Espresso, chocolate belga fundido y leche vaporizada.</p>
          <span class="bebida-precio">$60.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/chai-latte.webp'), url('imagen/chai-latte.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Chai Latte</h3>
          <p class="bebida-desc">Té chai especiado con leche vaporizada.</p>
          <span class="bebida-precio">$58.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/cold-brew.webp'), url('imagen/cold-brew.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Cold Brew</h3>
          <p class="bebida-desc">Café de extracción en frío, suave y servido con hielo.</p>
          <span class="bebida-precio">$52.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
    </div>

    <div class="menu-categoria" style="margin-bottom: 30px;">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/matcha.webp" alt="Matcha latte">
        <div class="categoria-label">
          <h3>Matcha Latte</h3>
          <p class="bebida-desc">Té matcha ceremonial batido con leche.</p>
          <span class="bebida-precio">$62.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/frappe-caramelo.webp'), url('imagen/frappe-caramelo.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Frappé Caramelo</h3>
          <p class="bebida-desc">Café frío licuado con caramelo y crema batida.</p>
          <span class="bebida-precio">$65.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/bebidas.webp'), url('imagen/bebidas.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Té Helado Durazno</h3>
          <p class="bebida-desc">Té negro infusionado con durazno natural.</p>
          <span class="bebida-precio">$45.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
    </div>

    <div class="menu-categoria">
      <article class="categoria-carta" style="background: linear-gradient(rgba(121, 102, 82, 0.65), rgba(121, 102, 82, 0.65)), url('../img/chocolate-caliente.webp'), url('imagen/chocolate-caliente.webp'); background-size: cover; background-position: center;">
        <div class="categoria-label">
          <h3>Chocolate Belga</h3>
          <p class="bebida-desc">Chocolate belga fundido con leche entera y malvaviscos.</p>
          <span class="bebida-precio">$58.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
      
      <div style="display: table-cell; visibility: hidden;"></div>
      <div style="display: table-cell; visibility: hidden;"></div>
    </div>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>