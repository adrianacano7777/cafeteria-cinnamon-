<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cafetería Cinnamon - Carrito</title>
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/carrito.css">
</head>

<body>
  <div id="header-placeholder"></div>
  <section class="carrito">
    <h2 class="seccion-titulo">Tu carrito</h2>
    <table class="carrito-tabla">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio unitario</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Quitar</th>
        </tr>
      </thead>
    </table>

    <div class="carrito-resumen">
      <p class="carrito-total">Total:</p>
      <a href="menu_comida.php" class="btn-secundario">Seguir viendo el menú</a>
      <a href="checkout.php" class="btn-primario">Continuar con mi pedido</a>
    </div>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
</body>

</html>