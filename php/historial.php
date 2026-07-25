<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$consulta = $conexion->prepare("SELECT * FROM pedidos WHERE id_usuario = :id_usuario ORDER BY fecha DESC");
$consulta->bindParam(':id_usuario', $_SESSION['id_usuario']);
$consulta->execute();
$pedidos = $consulta->fetchAll(PDO::FETCH_ASSOC);

$texto_entrega = [
    'domicilio' => 'A domicilio',
    'tienda'    => 'Recoger en tienda'
];

$texto_estado = [
    'recibido'   => 'Recibido',
    'preparando' => 'Preparando',
    'listo'      => 'Listo',
    'entregado'  => 'Entregado'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <title>Cafetería Cinnamon - Mis pedidos</title>
  <link rel="stylesheet" href="../css/historial.css">
</head>
<body>
  <div id="header-placeholder"></div>
  <section class="historial">    
    <h2 class="seccion-titulo">Mis pedidos</h2>    
    
    <div class="tabla-contenedor">
      <table class="historial-tabla">      
        <thead>        
          <tr>          
            <th>No. de orden</th>          
            <th>Fecha</th>          
            <th>Total</th>          
            <th>Entrega</th>          
            <th>Estado</th>        
          </tr>      
        </thead>      
        <tbody>
          <?php if (count($pedidos) === 0): ?>
          <tr>
            <td colspan="5" style="text-align:center;">Aún no tienes pedidos.</td>
          </tr>
          <?php else: ?>
            <?php foreach ($pedidos as $pedido): ?>
          <tr>          
            <td>#<?php echo str_pad($pedido['id_pedido'], 5, '0', STR_PAD_LEFT); ?></td>          
            <td><?php echo date('d/m/Y', strtotime($pedido['fecha'])); ?></td>          
            <td class="pedido-total">$<?php echo number_format($pedido['total'], 2); ?></td>          
            <td><?php echo $texto_entrega[$pedido['tipo_entrega']]; ?></td>          
            <td><span class="estado estado-<?php echo $pedido['estado']; ?>"><?php echo $texto_estado[$pedido['estado']]; ?></span></td>        
          </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>    
      </table>  
    </div>
  </section>
  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>
</body>
</html>