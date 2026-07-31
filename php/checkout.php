<?php
session_start();

$carrito = $_SESSION['carrito'] ?? [];

$subtotal = 0;
foreach ($carrito as $item) {
    $subtotal += $item['precio'] * $item['cantidad'];
}

$costo_envio = 25.00;
$total_final = $subtotal + $costo_envio;
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Confirmar pedido - Cafetería Cinnamon</title>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="stylesheet" href="../css/checkout.css">
</head>

<body>
  <div id="header-placeholder"></div>

  <section class="checkout">
    <h2 class="seccion-titulo">Confirmar mi pedido</h2>

    <form action="confirmacion.php" method="POST">
      <div class="checkout-bloque">
        <h3>Forma de entrega</h3>
        <label class="opcion-entrega">
          <input type="radio" name="tipo_entrega" value="domicilio" checked onchange="toggleDireccion()">
          A domicilio
        </label>
        <label class="opcion-entrega">
          <input type="radio" name="tipo_entrega" value="tienda" onchange="toggleDireccion()">
          Recoger en tienda
        </label>
      </div>

      <div class="checkout-bloque" id="bloque-direccion">
        <h3>Dirección de entrega</h3>
        <p class="direccion-guardada">Calle Reforma 123, Puente de Ixtla, Morelos</p>
        <a href="perfil.php" class="btn-secundario">Editar mi dirección</a>
        <details>
          <summary>Agregar una dirección nueva</summary>
          <div class="form-direccion">
            <label for="nueva-calle">Calle y número</label>
            <input type="text" id="nueva-calle" name="calle_numero">
            <label for="nueva-referencias">Referencias</label>
            <input type="text" id="nueva-referencias" name="referencias">
            <label for="nueva-telefono">Teléfono de contacto</label>
            <input type="tel" id="nueva-telefono" name="telefono_contacto">
          </div>
        </details>
      </div>

      <div class="checkout-bloque1">
        <h3>Resumen de tu pedido</h3>
        <?php if (empty($carrito)): ?>
          <p style="margin-top: 10px;">Tu carrito está vacío. <a href="menu_comida.php">Ir al menú</a></p>
        <?php else: ?>
          <ul style="list-style: none; padding: 0; margin-top: 15px;">
            <?php foreach ($carrito as $id => $item): 
                $subtotal_prod = $item['precio'] * $item['cantidad'];
            ?>
              <li style="display: flex; justify-content: space-between; margin-bottom: 8px; border-bottom: 1px dashed #ccc; padding-bottom: 4px;">
                <span><strong><?= $item['cantidad'] ?>x</strong> <?= htmlspecialchars($item['nombre']) ?></span>
                <span>$<?= number_format($subtotal_prod, 2) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>

      <div class="checkout-bloque">
        <h3>Método de pago</h3>
        <label for="id_metodo_pago">Elige tu método de pago</label>
        <select id="id_metodo_pago" name="id_metodo_pago" required>
          <option value="">Selecciona</option>
          <option value="1">Tarjeta</option>
          <option value="2">Efectivo</option>
          <option value="3">Transferencia</option>
        </select>
      </div>

      <div class="checkout-bloque checkout-total">
        <p>Subtotal: <span>$<?= number_format($subtotal, 2) ?></span></p>
        <p id="linea-envio">Costo de entrega: <span>$<?= number_format($costo_envio, 2) ?></span></p>
        <p class="total-final">Total a pagar: <span id="texto-total">$<?= number_format($total_final, 2) ?></span></p>
      </div>

      <button type="submit" class="btn-primario" <?= empty($carrito) ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : '' ?>>
        Confirmar y pagar mi pedido
      </button>
    </form>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>

  <script>
    function toggleDireccion() {
      const opcionSeleccionada = document.querySelector('input[name="tipo_entrega"]:checked').value;
      const bloqueDireccion = document.getElementById('bloque-direccion');
      const lineaEnvio = document.getElementById('linea-envio');
      const textoTotal = document.getElementById('texto-total');

      const subtotal = <?= (float)$subtotal ?>;
      const costoEnvio = <?= (float)$costo_envio ?>;

      if (opcionSeleccionada === 'tienda') {
        bloqueDireccion.style.display = 'none';
        lineaEnvio.style.display = 'none';
        textoTotal.textContent = '$' + subtotal.toFixed(2);
      } else {
        bloqueDireccion.style.display = 'block';
        lineaEnvio.style.display = 'block';
        const totalConEnvio = subtotal + costoEnvio;
        textoTotal.textContent = '$' + totalConEnvio.toFixed(2);
      }
    }
  </script>
</body>

</html>