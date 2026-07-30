<?php
require "verificar_admin.php";
require "conexion.php";

date_default_timezone_set('America/Mexico_City');

$fecha_filtro = $_GET['fecha'] ?? $_POST['fecha'] ?? date('Y-m-d');

if (isset($_POST['actualizar_estado'])) {
    $sql = "UPDATE pedidos SET estado = :estado WHERE id_pedido = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':estado' => $_POST['estado'],
        ':id' => $_POST['id_pedido']
    ]);
    
    header("Location: admin_pedidos.php?fecha=" . urlencode($fecha_filtro));
    exit;
}

$sql_pedidos = "SELECT p.id_pedido, u.nombre AS cliente, p.fecha, p.total, p.tipo_entrega, p.estado, m.nombre AS metodo_pago
        FROM pedidos p
        JOIN usuarios u ON p.id_usuario = u.id_usuario
        JOIN metodo_pago m ON p.id_metodo_pago = m.id_metodo_pago
        WHERE DATE(p.fecha) = :fecha
        ORDER BY p.id_pedido DESC";
$stmt_pedidos = $conexion->prepare($sql_pedidos);
$stmt_pedidos->execute([':fecha' => $fecha_filtro]);
$pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);

$sql_hoy = "SELECT SUM(total) AS total_dia FROM pedidos WHERE LOWER(estado) = 'entregado' AND DATE(fecha) = :fecha";
$stmt_hoy = $conexion->prepare($sql_hoy);
$stmt_hoy->execute([':fecha' => $fecha_filtro]);
$total_dia = $stmt_hoy->fetchColumn() ?: 0.00;

$sql_semanas = "SELECT 
                    WEEK(fecha, 1) AS numero_semana, 
                    YEAR(fecha) AS anio,
                    SUM(total) AS total_semana 
                FROM pedidos 
                WHERE LOWER(estado) = 'entregado'
                GROUP BY YEAR(fecha), WEEK(fecha, 1) 
                ORDER BY anio DESC, numero_semana DESC 
                LIMIT 4";
$ventas_semanas = $conexion->query($sql_semanas)->fetchAll(PDO::FETCH_ASSOC);

$sql_meses = "SELECT 
                MONTHNAME(fecha) AS mes_nombre,
                MONTH(fecha) AS numero_mes, 
                YEAR(fecha) AS anio,
                SUM(total) AS total_mes 
              FROM pedidos 
              WHERE LOWER(estado) = 'entregado'
              GROUP BY YEAR(fecha), MONTH(fecha) 
              ORDER BY anio DESC, numero_mes DESC 
              LIMIT 6";
$ventas_meses = $conexion->query($sql_meses)->fetchAll(PDO::FETCH_ASSOC);

$sql_top_productos = "SELECT 
                        pr.nombre AS producto, 
                        SUM(dp.cantidad) AS total_unidades 
                      FROM detalle_pedidos dp 
                      JOIN productos pr ON dp.id_producto = pr.id_producto 
                      JOIN pedidos p ON dp.id_pedido = p.id_pedido
                      WHERE LOWER(p.estado) = 'entregado'
                      GROUP BY dp.id_producto 
                      ORDER BY total_unidades DESC 
                      LIMIT 5";
try {
    $top_productos = $conexion->query($sql_top_productos)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
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
    <h2 class="seccion-titulo">Pedidos del Día</h2>

    <div style="margin-bottom: 20px; text-align: center;">
  <form method="get" action="admin_pedidos.php" id="form-fecha-filtro">
    <label for="fecha" style="font-weight: bold; margin-right: 10px; display: inline-block;">Seleccionar Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha_filtro); ?>" style="padding: 6px 12px; font-size: 1rem; max-width: 220px; display: inline-block;">
    <button type="submit" class="btn-filtrar-fecha">Filtrar</button>
  </form>
</div>

    <div class="buscador">
      <input type="text" data-buscar-tabla="tabla-pedidos" placeholder="Buscar pedido por cliente, no. de orden o estado...">
    </div>

    <table class="admin-tabla" id="tabla-pedidos">
      <thead>
        <tr>
          <th>No. de orden</th>
          <th>Cliente</th>
          <th>Fecha / Hora</th>
          <th>Total</th>
          <th>Entrega</th>
          <th>Pago</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($pedidos)): ?>
          <?php foreach ($pedidos as $ped): ?>
          <tr>
            <td>#<?php echo str_pad($ped['id_pedido'], 5, '0', STR_PAD_LEFT); ?></td>
            <td><?php echo htmlspecialchars($ped['cliente']); ?></td>
            <td><?php echo date('d/m/Y H:i', strtotime($ped['fecha'])); ?></td>
            <td>$<?php echo number_format($ped['total'], 2); ?></td>
            <td><?php echo $ped['tipo_entrega'] === 'domicilio' ? 'A domicilio' : 'Recoger en tienda'; ?></td>
            <td><?php echo htmlspecialchars($ped['metodo_pago']); ?></td>
            <td>
                <form action="admin_pedidos.php" method="post">
                  <input type="hidden" name="id_pedido" value="<?php echo $ped['id_pedido']; ?>">
                  <input type="hidden" name="fecha" value="<?php echo htmlspecialchars($fecha_filtro); ?>">
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
        <?php else: ?>
          <tr>
            <td colspan="7" style="text-align: center;">No hay pedidos registrados para el día <?php echo date('d/m/Y', strtotime($fecha_filtro)); ?>.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>

  <section class="admin-main">
    <h2 class="seccion-titulo">Resumen de Ventas</h2>

    <div class="reporte-bloque" style="background-color: #ebdcb9; padding: 15px; border-radius: 8px; margin-bottom: 25px; text-align: center;">
      <h3 style="margin: 0; color: #3e2723;">Ventas Totales del Día: (<?php echo date('d/m/Y', strtotime($fecha_filtro)); ?>): 
        <span style="color: #28a745; font-size: 1.5rem;">$<?php echo number_format($total_dia, 2); ?></span>
      </h3>
    </div>

    <div class="reporte-bloque">
      <h3>Ventas por Semana</h3>
      <table class="admin-tabla">
        <thead>
          <tr>
            <th>Año</th>
            <th>Semana No.</th>
            <th>Monto Total Reagrupado</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($ventas_semanas)): ?>
            <?php foreach ($ventas_semanas as $vs): ?>
            <tr>
              <td><?php echo $vs['anio']; ?></td>
              <td>Semana <?php echo $vs['numero_semana']; ?></td>
              <td>$<?php echo number_format($vs['total_semana'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No hay ventas entregadas registradas aún por semana.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="reporte-bloque" style="margin-top: 25px;">
      <h3>Ventas por Mes</h3>
      <table class="admin-tabla">
        <thead>
          <tr>
            <th>Año</th>
            <th>Mes</th>
            <th>Monto Total Reagrupado</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($ventas_meses)): ?>
            <?php foreach ($ventas_meses as $vm): ?>
            <tr>
              <td><?php echo $vm['anio']; ?></td>
              <td>Mes <?php echo $vm['numero_mes']; ?></td>
              <td>$<?php echo number_format($vm['total_mes'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3">No hay ventas entregadas registradas aún por mes.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="reporte-bloque" style="margin-top: 25px;">
      <h3>Productos más Vendidos</h3>
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
              <td colspan="2">No hay registro de productos entregados en el historial.</td>
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