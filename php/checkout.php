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
        <h3>Dirección de entrega</h3>
        <p class="direccion-guardada">Calle Reforma 123, Puente de Ixtla, Morelos</p>
        <a href="perfil.php" class="btn-secundario">Editar mi dirección</a>
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
        <p>Costo de entrega: <span>$<?= number_format($costo_envio, 2) ?></span></p>
        <p class="total-final">Total a pagar: <span>$<?= number_format($total_final, 2) ?></span></p>
      </div>

      <button type="submit" class="btn-primario" <?= empty($carrito) ? 'disabled style="opacity:0.5; cursor:not-allowed;"' : '' ?>>
        Confirmar y pagar mi pedido
      </button>
    </form>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
</body>

</html>