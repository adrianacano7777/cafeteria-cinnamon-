<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'] ?? '';
    $precio = (float)($_POST['precio'] ?? 0);
    $cantidad = (int)($_POST['cantidad'] ?? 1);

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
    } else {
       
        $_SESSION['carrito'][$id] = [
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad
        ];
    }

   
    header('Location: carrito.php');
    exit();
}


if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    unset($_SESSION['carrito'][$id_eliminar]);
    header('Location: carrito.php');
    exit();
}

$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

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

    <?php if (empty($carrito)): ?>
      <p style="text-align: center; margin: 40px 0;">Tu carrito está vacío por el momento.</p>
    <?php else: ?>
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
          <?php foreach ($carrito as $id => $item): 
              $subtotal = $item['precio'] * $item['cantidad'];
              $total += $subtotal;
          ?>
            <tr>
              <td><?= htmlspecialchars($item['nombre']) ?></td>
              <td>$<?= number_format($item['precio'], 2) ?></td>
              <td><?= $item['cantidad'] ?></td>
              <td>$<?= number_format($subtotal, 2) ?></td>
              <td>
                <a href="carrito.php?eliminar=<?= $id ?>" class="btn-eliminar" onclick="return confirm('¿Deseas quitar este producto?');">&times;</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    
    <div class="carrito-resumen">
      <p class="carrito-total">Total: <span>$<?= number_format($total, 2) ?></span></p>
      <a href="menu_comida.php" class="btn-secundario">Seguir viendo el menú</a>
      
      <?php if (!empty($carrito)): ?>
        <a href="checkout.php" class="btn-primario">Continuar con mi pedido</a>
      <?php endif; ?>
    </div>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
</body>

</html>