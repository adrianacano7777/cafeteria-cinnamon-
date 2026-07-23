<?php
require "verificar_admin.php";
require "conexion.php";

if (isset($_POST['actualizar_estado'])) {
    $sql = "UPDATE pedidos SET estado = :estado WHERE id_pedido = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':estado' => $_POST['estado'],
        ':id' => $_POST['id_pedido']
    ]);
    header("Location: admin_pedidos.php");
    exit;
}

// 1. Consulta de Pedidos reales
$sql_pedidos = "SELECT p.id_pedido, u.nombre AS cliente, p.fecha, p.total, p.tipo_entrega, p.estado, m.nombre AS metodo_pago
        FROM pedidos p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        JOIN metodo_pago m ON p.id_metodo_pago = m.id_metodo_pago
        ORDER BY p.id_pedido DESC";
$pedidos = $conexion->query($sql_pedidos)->fetchAll(PDO::FETCH_ASSOC);

// 2. Consulta real de Ventas por Semana (últimas 4 semanas)
$sql_semanas = "SELECT 
                    WEEK(fecha, 1) AS numero_semana, 
                    SUM(total) AS total_semana 
                FROM pedidos 
                GROUP BY WEEK(fecha, 1) 
                ORDER BY numero_semana DESC 
                LIMIT 4";
$ventas_semanas = $conexion->query($sql_semanas)->fetchAll(PDO::FETCH_ASSOC);

// 3. Consulta real de Productos más vendidos
$sql_top_productos = "SELECT 
                        pr.nombre AS producto, 
                        SUM(dp.cantidad) AS total_unidades 
                      FROM detalle_pedidos dp 
                      JOIN productos pr ON dp.id_producto = pr.id_producto 
                      GROUP BY dp.id_producto 
                      ORDER BY total_unidades DESC 
                      LIMIT 5";
try {
    $top_productos = $conexion->query($sql_top_productos)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // En caso de que no exista la tabla detalle_pedidos aún
    $top_productos = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cinnamon Admin - Pedidos</title>
  <link rel="stylesheet" href="../css/principal.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
</head>
<body>

  <div id="header-placeholder" data-tipo="admin"></div>

  <section class="admin-main">
    <h2 class="seccion-titulo">Pedidos</h2>

    <div class="buscador">
      <input type="text" data-buscar-tabla="tabla-pedidos" placeholder="Buscar pedido por cliente, no. de orden o estado...">
    </div>

    <table class="admin-tabla" id="tabla-pedidos">
      <thead>
        <tr>
          <th>No. de orden</th>
          <th>Cliente</th>
          <th>Fecha</th>
          <th>Total</th>
          <th>Entrega</th>
          <th>Pago</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pedidos as $ped): ?>
        <tr>
          <td>#<?php echo str_pad($ped['id_pedido'], 5, '0', STR_PAD_LEFT); ?></td>
          <td><?php echo htmlspecialchars($ped['cliente']); ?></td>
          <td><?php echo date('d/m/Y', strtotime($ped['fecha'])); ?></td>
          <td>$<?php echo number_format($ped['total'], 2); ?></td>
          <td><?php echo $ped['tipo_entrega'] === 'domicilio' ? 'A domicilio' : 'Recoger en tienda'; ?></td>
          <td><?php echo htmlspecialchars($ped['metodo_pago']); ?></td>
          <td>
            <form action="admin_pedidos.php" method="post">
              <input type="hidden" name="id_pedido" value="<?php echo $ped['id_pedido']; ?>">
              <select name="estado" onchange="this.form.submit()" class="select-estado-tabla">
                <option value="recibido" <?php echo $ped['estado'] === 'recibido' ? 'selected' : ''; ?>>Recibido</option>
                <option value="preparando" <?php echo $ped['estado'] === 'preparando' ? 'selected' : ''; ?>>Preparando</option>
                <option value="listo" <?php echo $ped['estado'] === 'listo' ? 'selected' : ''; ?>>Listo</option>
                <option value="entregado" <?php echo $ped['estado'] === 'entregado' ? 'selected' : ''; ?>>Entregado</option>
              </select>
              <input type="hidden" name="actualizar_estado" value="1">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <section class="admin-main">
    <h2 class="seccion-titulo">Resumen de ventas</h2>

    <div class="reporte-bloque">
      <h3>Ventas por semana</h3>
      <table class="admin-tabla">
        <thead>
          <tr>
            <th>Semana No.</th>
            <th>Monto Total Reagrupado</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($ventas_semanas)): ?>
            <?php foreach ($ventas_semanas as $vs): ?>
            <tr>
              <td>Semana <?php echo $vs['numero_semana']; ?></td>
              <td>$<?php echo number_format($vs['total_semana'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2">No hay ventas registradas aún.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="reporte-bloque" style="margin-top: 25px;">
      <h3>Productos más vendidos</h3>
      <table class="admin-tabla">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Unidades Vendidas</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($top_productos)): ?>
            <?php foreach ($top_productos as $tp): ?>
            <tr>
              <td><?php echo htmlspecialchars($tp['producto']); ?></td>
              <td><?php echo $tp['total_unidades']; ?> unidades</td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="2">No hay registro de productos vendidos en el historial.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
  <script src="../JS/admin.js?v=<?php echo time(); ?>"></script>
</body>
</html>