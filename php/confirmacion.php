<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
if (empty($carrito) && !isset($_POST['nombre'])) {
    header('Location: menu_comida.php');
    exit();
}
$metodo_pago = $_POST['nombre'] ?? 'Efectivo';
$tipo_entrega = $_POST['tipo_entrega'] ?? 'domicilio';
$texto_entrega = ($tipo_entrega === 'tienda') ? 'Recoger en tienda' : 'A domicilio';
$subtotal = 0;
foreach ($carrito as $item) {
    $subtotal += $item['precio'] * $item['cantidad'];
}
$costo_envio = ($tipo_entrega === 'domicilio') ? 25.00 : 0.00;
$total_pagado = $subtotal + $costo_envio;
$numero_orden = sprintf('%05d', rand(1, 99999));
$productos_comprados = $carrito;
unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Cafetería Cinnamon - Pedido confirmado</title>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="stylesheet" href="../css/confirmacion.css">
</head>

<body>
  <div id="header-placeholder"></div>

  <section class="confirmacion">
    <h2 class="seccion-titulo">¡Gracias por tu pedido!</h2>
    <p1 class="confirmacion-numero">Número de orden: #<?= $numero_orden ?></p1>
    <p>Tu pedido fue recibido y está siendo preparado.</p>
    <?php if (!empty($productos_comprados)): ?>
      <div class="confirmacion-productos" style="max-width: 400px; margin: 20px auto; text-align: left;">
        <h3 style="font-size: 1.1rem; border-bottom: 1px solid #ccc; padding-bottom: 5px;">Detalle del pedido:</h3>
        <ul style="list-style: none; padding: 0;">
          <?php foreach ($productos_comprados as $item): ?>
            <li style="display: flex; justify-content: space-between; margin-bottom: 5px;">
              <span><strong><?= $item['cantidad'] ?>x</strong> <?= htmlspecialchars($item['nombre']) ?></span>
              <span>$<?= number_format($item['precio'] * $item['cantidad'], 2) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

  

    <br>
    <a href="historial.php" class="btn-primario">Ver mis pedidos</a>
    <a href="menu_comida.php" class="btn-secundario">Volver al menú</a>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
</body>

</html>