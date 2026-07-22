<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Confirmar pedido</title>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="stylesheet" href="../css/checkout.css">
</head>

<body>
  <div id="header-placeholder"></div>
  <section class="checkout">
    <h2 class="seccion-titulo">Confirmar mi pedido</h2>

    <div class="checkout-bloque">
      <h3>Dirección de entrega</h3>
      <p class="direccion-guardada">Calle Reforma 123, Puente de Ixtla, Morelos</p>
      <a href="perfil.php" class="btn-secundario">Editar mi dirección</a>
      <details>
        <summary>Agregar una dirección nueva</summary>
        <form class="form-direccion" action="checkout.php" method="post">
          <label for="nueva-calle">Calle y número</label>
          <input type="text" id="nueva-calle" name="calle_numero">
          <label for="nueva-referencias">Referencias</label>
          <input type="text" id="nueva-referencias" name="referencias">
          <label for="nueva-telefono">Teléfono de contacto</label>
          <input type="tel" id="nueva-telefono" name="telefono_contacto">
        </form>
      </details>
    </div>

    <div class="checkout-bloque1">
      <h3>Resumen de tu pedido</h3>
      <p>Latte de vainilla de Madagascar x1 — $55.00</p>
      <p>Roles de canela de Ceylán x2 — $96.00</p>
    </div>

    <div class="checkout-bloque">
      <h3>Forma de entrega</h3>
      <label class="opcion-entrega">
        <input type="radio" name="tipo_entrega" value="domicilio" checked>
        A domicilio
      </label>
      <label class="opcion-entrega">
        <input type="radio" name="tipo_entrega" value="tienda">
        Recoger en tienda
      </label>
    </div>

    <form id="formulario">
        <h1>Metodo de pago</h1>
        <label for="pago">Elige tu metodo de pago</label>
        <select id="metodo" onchange="mostrarInstrucciones()">
            <option value="">Selecciona</option>
            <option value="tarjeta">Tarjeta de Crédito/Débito</option>
            <option value="transferencia">Transferencia Bancaria</option>
            <option value="efectivo">Efectivo</option>
        </select>
    </form>
    <div id="instrucciones"></div>

    <div class="checkout-bloque checkout-total">
      <p>Subtotal: $151.00</p>
      <p>Costo de entrega: $25.00</p>
      <p class="total-final">Total a pagar: $176.00 MXN</p>
    </div>

    <form action="confirmacion.php" method="get">
      <button type="submit" class="btn-primario">Confirmar y pagar mi pedido</button>
    </form>

  </section>
  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
  <script src="../JS/checkout.js"></script>
</body>

</html>