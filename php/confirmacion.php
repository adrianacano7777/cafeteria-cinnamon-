<?php
session_start();

$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito) && !isset($_POST['id_metodo_pago'])) {
    header('Location: menu_comida.php');
    exit();
}

// 1. Obtener datos enviados desde checkout
$id_metodo_pago = (int)($_POST['id_metodo_pago'] ?? 2);
$tipo_entrega = $_POST['tipo_entrega'] ?? 'domicilio';
$id_usuario = $_SESSION['id_usuario'] ?? 2; 

// 2. Calcular importes
$subtotal = 0;
foreach ($carrito as $item) {
    $subtotal += $item['precio'] * $item['cantidad'];
}
$costo_envio = ($tipo_entrega === 'domicilio') ? 25.00 : 0.00;
$total_final = $subtotal + $costo_envio;


$conexion = mysqli_connect("localhost:2207", "root", "", "cinnamon");

$id_pedido_creado = 0;
if ($conexion) {
    $query_pedido = "INSERT INTO pedidos (id_usuario, id_metodo_pago, total, tipo_entrega, estado) 
                    VALUES ('$id_usuario', '$id_metodo_pago', '$total_final', '$tipo_entrega', 'recibido')";
    
    if (mysqli_query($conexion, $query_pedido)) {
        $id_pedido_creado = mysqli_insert_id($conexion);
      
        foreach ($carrito as $item) {
            $nombre_producto = mysqli_real_escape_string($conexion, $item['nombre']);
            $cantidad = (int)$item['cantidad'];
            $precio_unitario = (float)$item['precio'];

            $query_buscar = "SELECT id_producto FROM productos WHERE nombre = '$nombre_producto' LIMIT 1";
            $res_buscar = mysqli_query($conexion, $query_buscar);

            if ($res_buscar && $row = mysqli_fetch_assoc($res_buscar)) {
                $id_producto = $row['id_producto'];

                $query_detalle = "INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) 
                                  VALUES ('$id_pedido_creado', '$id_producto', '$cantidad', '$precio_unitario')";
                mysqli_query($conexion, $query_detalle);
            }
        }
    }
}

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
    <p1 class="confirmacion-numero">Número de orden: #<?= sprintf('%05d', $id_pedido_creado) ?></p1>
    <p>Tu pedido fue recibido y está siendo preparado.</p>

    <div class="confirmacion-resumen">
      <p1><strong>Entrega:</strong> <?= ucfirst($tipo_entrega) ?></p1><br>
      <p1 class="total-final">Total pagado: $<?= number_format($total_final, 2) ?></p1>
    </div>

    <br>
    <a href="historial.php" class="btn-primario">Ver mis pedidos</a>
    <a href="menu_comida.php" class="btn-secundario">Volver al menú</a>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
</body>

</html>