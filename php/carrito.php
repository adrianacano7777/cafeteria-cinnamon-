<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cafetería Cinnamon - Carrito</title>
  <link rel="stylesheet" href="css/principal.css">
  <link rel="icon" href="img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="css/carrito.css">
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
      <tbody>
        <tr class="carrito-item">
          <td>Latte de vainilla de Madagascar</td>
          <td>$55.00</td>
          <td>
            <form class="cantidad-form" action="carrito.php" method="post">
              <input type="number" name="cantidad" value="1" min="1">
              <button type="submit" class="btn-actualizar">Actualizar</button>
            </form>
          </td>
          <td>$55.00</td>
          <td>
            <form action="carrito.php" method="post"><button type="submit" class="btn-quitar">Quitar</button></form>
          </td>
        </tr>
        <tr class="carrito-item">
          <td>Roles de canela de Ceylán</td>
          <td>$48.00</td>
          <td>
            <form class="cantidad-form" action="carrito.php" method="post">
              <input type="number" name="cantidad" value="2" min="1">
              <button type="submit" class="btn-actualizar">Actualizar</button>
            </form>
          </td>
          <td>$96.00</td>
          <td>
            <form action="carrito.php" method="post"><button type="submit" class="btn-quitar">Quitar</button></form>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="carrito-resumen">
      <p class="carrito-total">Total: $151.00 MXN</p>
<<<<<<< HEAD:php/carrito.php
      <a href="php/menu_comida.php" class="btn-secundario">Seguir viendo el menú</a>
      <a href="php/checkout.php" class="btn-primario">Continuar con mi pedido</a>
=======
      <a href="menu_comida.php" class="btn-secundario">Seguir viendo el menú</a>
      <a href="checkout.php" class="btn-primario">Continuar con mi pedido</a>
>>>>>>> 0494299581c4a4534b61991028ae1da1e4271be5:carrito.php
    </div>
  </section>

  <div id="footer-placeholder"></div>
  <script src="JS/header-footer.js"></script>
</body>

</html>