<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cafetería Cinnamon</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
</head>

<body>
  <div id="header-placeholder"></div>
  <section class="hero">
    <img class="hero-bg" src="../img/foto-fondo.jpg" alt="Foto de fondo de la cafetería">
    <div class="hero-contenido">
      <p class="hero-desde">Desde 2026</p>
      <h1 class="hero-frase">Tu pausa favorita del día empieza con un buen café.</h1>
      <p class="hero-horario">Horario: Lunes a Domingo, 8:00 am - 10:00 pm</p>
      <p id="texto-horario">Cargando...</p>
    </div>
  </section>

  <section class="menu">
    <h2 class="seccion-titulo">Conoce nuestro menú</h2>
    <div class="menu-categoria">
      <a href="php/menu_comida.php" class="categoria-carta">
        <img class="categoria-foto" src="../img/comida.webp" alt="Comida">
        <span class="categoria-label">Comida</span></a>

      <a href="php/menu_postres.php" class="categoria-carta">
        <img class="categoria-foto" src="../img/postres.jpg" alt="Postres">
        <span class="categoria-label">Postres</span></a>

      <a href="php/menu_bebidas.php" class="categoria-carta">
        <img class="categoria-foto" src="../img/bebidas.webp" alt="Bebidas">
        <span class="categoria-label">Bebidas</span></a>

    </div>
  </section>
  <section class="ingredientes">
    <h2 class="seccion-titulo">Nuestros ingredientes estrella</h2>
    <p class="seccion-subtitulo">Ingredientes importados y de calidad que nos distinguen de otras cafeterías.</p>

    <div class="carousel-ingredientes">
      <button type="button" class="carousel-btn" id="carousel-prev" aria-label="Ingrediente anterior"></button>

      <div class="carousel-viewport">
        <ul class="ingredientes-lista" id="lista-ingredientes">
          <li class="ingrediente-item">
            <img src="../img/ingrediente1.jpg" alt="Canela de Ceylán">
            <h3>Canela de Ceylán</h3>
            <p>A diferencia de la canela común, esta es conocida como la "canela auténtica". Es sumamente aromática, con un sabor más dulce, suave y complejo.</p>
          </li>
          <li class="ingrediente-item">
            <img src="../img/ingrediente2.webp" alt="Extracto puro de Vainilla de Madagascar">
            <h3>Extracto puro de Vainilla de Madagascar</h3>
            <p>Considerada la mejor vainilla del mundo por su proceso de curado artesanal. Aporta un perfil de sabor profundo, dulce y con notas cremosas que eleva por completo el sabor de los lattes, galletas y brownies.</p>
          </li>
          <li class="ingrediente-item">
            <img src="../img/ingrediente3.jpg" alt="Chocolate belga">
            <h3>Chocolate belga</h3>
            <p>Reconocido mundialmente por su finura y su alto porcentaje de manteca de cacao pura. Utilizarlo en tus coberturas, mochas o troceado en la repostería asegura una textura que se derrite perfectamente y un sabor de especialidad.</p>
          </li>
          <li class="ingrediente-item">
            <img src="../img/ingrediente4.webp" alt="Café de Especialidad de Etiopía">
            <h3>Café de Especialidad de Etiopía</h3>
            <p>Es un café sumamente elegante, famoso por sus notas florales y cítricas, con un cuerpo ligero que recuerda al té.</p>
          </li>
        </ul>
      </div>

      <button type="button" class="carousel-btn" id="carousel-next" aria-label="Siguiente ingrediente"></button>
    </div>

    <div class="carousel-dots" id="carousel-dots"></div>
  </section>

  <section class="reseñas">
    <h2 class="seccion-titulo">Reseñas</h2>

    <div class="carousel-resenas">
      <div class="carousel-viewport">
        <ul class="reseña-lista" id="lista-resenas">
          <li class="reseña-carta">
            <p class="reseña-texto">¡Los mejores roles de canela y brownies que he probado! Se nota muchísimo la calidad del
              chocolate belga en su repostería. El lugar es súper acogedor, ideal para venir a estudiar o platicar con
              amigos.</p>
            <p class="reseña-autor">Angelica Rosas</p>
            <p class="reseña-rating">Calificación: 5/5</p>
          </li>
          <li class="reseña-carta">
            <p class="reseña-texto">Soy súper exigente con el café y el latte de aquí con granos de Etiopía es una joya, el
              balance de notas a caramelo es perfecto.</p>
            <p class="reseña-autor">Manuel Tapia</p>
            <p class="reseña-rating">Calificación: 5/5</p>
          </li>
          <li class="reseña-carta">
            <p class="reseña-texto">Cinnamon se convirtió en mi parada obligatoria de todas las tardes. El aroma a café y
              vainilla de Madagascar desde que entras te atrapa.</p>
            <p class="reseña-autor">Denisse Nava</p>
            <p class="reseña-rating">Calificación: 5/5</p>
          </li>
        </ul>
      </div>
    </div>

    <div class="carousel-dots" id="carousel-dots-resenas"></div>
  </section>

  <section class="nosotros" id="sobre-nosotros">
    <img class="sobre-foto" src="../img/sobre_nosotros.webp" alt="Nosotros">
    <div class="sobre-texto">
      <h2 class="seccion-titulo">Sobre nosotros</h2>
      <p>En Cinnamon, creemos que los mejores días comienzan con un buen café y una gran conversación. Somos un espacio
        creado para los amantes de los sabores auténticos, la repostería horneada desde cero y los momentos de
        inspiración. Ya sea que busques un lugar tranquilo para concentrarte en tus proyectos, reunirte con amigos o
        disfrutar de un momento contigo mismo, en Cinnamon te recibimos con la taza perfecta y un ambiente listo para
        hacerte sentir como en casa. ¡Ven a descubrir tu nuevo rincón favorito!</p>
    </div>
  </section>
  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
  <script src="../JS/principal.js"></script>
  <script src="../JS/horario.js"></script>
</body>

</html>