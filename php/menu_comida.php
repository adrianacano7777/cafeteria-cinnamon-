<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú Comida - Cafetería Cinnamon</title>
  <link rel="stylesheet" href="../css/menu_postres.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="seccion-titulo">Nuestra Comida</h2>
    <p class="seccion-subtitulo">Opciones deliciosas preparadas al momento</p>

    <div class="menu-categoria" style="margin-bottom: 40px;">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/sandwich-club.webp" alt="Sandwich club de pollo">
        <div class="categoria-label">
          <h3>Sándwich Club</h3>
          <p class="bebida-desc">Pan artesanal con pollo, tocino, lechuga y aguacate.</p>
          <span class="bebida-precio">$85.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/bagel-salmon.webp" alt="Bagel con salmón ahumado">
        <div class="categoria-label">
          <h3>Bagel Salmón</h3>
          <p class="bebida-desc">Bagel tostado con queso crema, salmón y alcaparras.</p>
          <span class="bebida-precio">$95.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/croissant-jamon.webp" alt="Croissant jamón y queso">
        <div class="categoria-label">
          <h3>Croissant J&Q</h3>
          <p class="bebida-desc">Croissant horneado relleno de jamón y queso gouda.</p>
          <span class="bebida-precio">$65.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
    </div>

    <div class="menu-categoria" style="margin-bottom: 20px;">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/ensalada-cesar.webp" alt="Ensalada césar con pollo">
        <div class="categoria-label">
          <h3>Ensalada César</h3>
          <p class="bebida-desc">Lechuga romana, pollo a la parrilla y aderezo césar.</p>
          <span class="bebida-precio">$90.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/quesadilla-calabaza.webp" alt="Quesadilla de flor de calabaza">
        <div class="categoria-label">
          <h3>Quesadilla</h3>
          <p class="bebida-desc">Tortilla de harina con flor de calabaza y queso oaxaca.</p>
          <span class="bebida-precio">$70.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/panini-caprese.webp" alt="Panini caprese">
        <div class="categoria-label">
          <h3>Panini Caprese</h3>
          <p class="bebida-desc">Pan ciabatta con tomate, mozzarella y pesto.</p>
          <span class="bebida-precio">$80.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
    </div>

    <div class="menu-categoria" style="margin-bottom: 20px;">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/omelette-espianca.webp" alt="Omelette de espinaca y champiñones">
        <div class="categoria-label">
          <h3>Omelette</h3>
          <p class="bebida-desc">Omelette esponjoso con espinaca fresca y champiñones.</p>
          <span class="bebida-precio">$75.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/wrap-atun.webp" alt="Wrap de atún">
        <div class="categoria-label">
          <h3>Wrap de Atún</h3>
          <p class="bebida-desc">Tortilla integral con atún, apio y mayonesa ligera.</p>
          <span class="bebida-precio">$78.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>

      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/torta-tamal.webp" alt="Torta de tamal">
        <div class="categoria-label">
          <h3>Torta de Tamal</h3>
          <p class="bebida-desc">Tamal oaxaqueño servido en bolillo con crema.</p>
          <span class="bebida-precio">$60.00</span>
          <a href="carrito.php" class="btn-pedir">Pedir</a>
        </div>
      </article>
    </div>

    <div class="menu-categoria">
      <article class="categoria-carta">
        <img class="categoria-foto" src="../img/molletes.webp" alt="Molletes con pico de gallo">
        <div class="categoria-label">
          <h3>Molletes</h3>
          <p class="bebida-desc">Bolillo horneado con frijoles, queso gratinado y pico de gallo.</p>
          <span class="bebida-precio">$65.00</span>
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