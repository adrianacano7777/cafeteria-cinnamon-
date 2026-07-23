<?php
require "verificar_admin.php";
require "conexion.php";

if (isset($_POST['guardar_producto'])) {
    $sql = "INSERT INTO productos (nombre, categoria, precio, disponibilidad) VALUES (:nombre, :categoria, :precio, :disponibilidad)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':nombre' => $_POST['nombre_producto'],
        ':categoria' => $_POST['categoria'],
        ':precio' => $_POST['precio'],
        ':disponibilidad' => 1
    ]);
    header("Location: admin_inventario.php");
    exit;
}

if (isset($_POST['actualizar_producto_completo'])) {
    $sql = "UPDATE productos SET nombre = :nombre, categoria = :categoria, precio = :precio, disponibilidad = :disponibilidad WHERE id_producto = :id";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':nombre' => $_POST['nombre'],
        ':categoria' => $_POST['categoria'],
        ':precio' => $_POST['precio'],
        ':disponibilidad' => $_POST['disponibilidad'],
        ':id' => $_POST['id_producto']
    ]);
    header("Location: admin_inventario.php");
    exit;
}

if (isset($_POST['guardar_insumo'])) {
    $sql = "INSERT INTO insumos (nombre, cantidad_disponible, cantidad_minima, unidad_medida) VALUES (:nombre, :cantidad, :minima, :unidad)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':nombre' => $_POST['nombre_insumo'],
        ':cantidad' => $_POST['cantidad_disponible'],
        ':minima' => $_POST['cantidad_minima'],
        ':unidad' => $_POST['unidad_medida']
    ]);
    header("Location: admin_inventario.php");
    exit;
}

$productos = $conexion->query("SELECT * FROM productos ORDER BY id_producto")->fetchAll(PDO::FETCH_ASSOC);
$insumos = $conexion->query("SELECT * FROM insumos ORDER BY id_insumo")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinnamon Admin - Inventario</title>
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" href="../img/icono-pestana.png" type="image/png">
</head>

<body>

    <div id="header-placeholder" data-tipo="admin"></div>

    <section class="admin-main">
        <h2 class="seccion-titulo">Inventario de productos</h2>

        <details>
            <summary>+ Agregar nuevo producto</summary>
            <form action="admin_inventario.php" method="post">
                <label for="nuevo-nombre">Nombre</label>
                <input type="text" id="nuevo-nombre" name="nombre_producto" required>

                <label for="nuevo-precio">Precio</label>
                <input type="number" step="0.01" id="nuevo-precio" name="precio" required>

                <label for="nuevo-categoria">Categoría</label>
                <select id="nuevo-categoria" name="categoria">
                    <option value="Comida">Comida</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Postres">Postres</option>
                </select>

                <button type="submit" name="guardar_producto" class="btn-primario">Guardar producto</button>
            </form>
        </details>

        <div class="buscador">
            <input type="text" data-buscar-tabla="tabla-productos" placeholder="Buscar producto por nombre o categoría...">
        </div>

        <table class="admin-tabla" id="tabla-productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $prod): ?>
                <tr>
                    <td class="prod-nombre"><?php echo htmlspecialchars($prod['nombre']); ?></td>
                    <td class="prod-categoria"><?php echo htmlspecialchars($prod['categoria']); ?></td>
                    <td>$<span class="prod-precio"><?php echo number_format($prod['precio'], 2, '.', ''); ?></span></td>
                    <td class="prod-estado <?php echo $prod['disponibilidad'] ? '' : 'stock-bajo'; ?>" data-dispo="<?php echo $prod['disponibilidad']; ?>">
                        <?php echo $prod['disponibilidad'] ? 'Disponible' : 'Agotado'; ?>
                    </td>
                    <td>
                        <form action="admin_inventario.php" method="post" style="display: inline;" class="form-actualizar-producto-todo">
                            <input type="hidden" name="id_producto" value="<?php echo $prod['id_producto']; ?>">
                            <input type="hidden" name="nombre" class="input-edit-nombre" value="<?php echo htmlspecialchars($prod['nombre']); ?>">
                            <input type="hidden" name="categoria" class="input-edit-categoria" value="<?php echo htmlspecialchars($prod['categoria']); ?>">
                            <input type="hidden" name="precio" class="input-edit-precio" value="<?php echo $prod['precio']; ?>">
                            <input type="hidden" name="disponibilidad" class="input-edit-dispo" value="<?php echo $prod['disponibilidad']; ?>">
                            <button type="submit" name="actualizar_producto_completo" class="btn-editar">Editar</button>
                        </form>
                        <a href="eliminar_producto.php?id=<?php echo $prod['id_producto']; ?>" class="btn-eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section class="admin-main">
        <h2 class="seccion-titulo">Insumos y suministros</h2>
        <p style="margin-bottom: 20px;">Ingredientes y materiales usados en la preparación (café, leche, vasos, etc.).
            Actualiza la cantidad manualmente cuando llegue o se use algo.</p>

        <details>
            <summary>+ Agregar nuevo insumo</summary>
            <form action="admin_inventario.php" method="post">
                <label for="nuevo-insumo-nombre">Nombre del insumo</label>
                <input type="text" id="nuevo-insumo-nombre" name="nombre_insumo" required>

                <label for="nuevo-insumo-cantidad">Cantidad disponible</label>
                <input type="number" step="0.01" id="nuevo-insumo-cantidad" name="cantidad_disponible" required>

                <label for="nuevo-insumo-unidad">Unidad de medida</label>
                <select id="nuevo-insumo-unidad" name="unidad_medida">
                    <option value="kg">Kilogramos</option>
                    <option value="litros">Litros</option>
                    <option value="piezas">Piezas</option>
                </select>

                <label for="nuevo-insumo-minimo">Cantidad mínima (para avisar bajo stock)</label>
                <input type="number" step="0.01" id="nuevo-insumo-minimo" name="cantidad_minima" required>

                <button type="submit" name="guardar_insumo" class="btn-primario">Guardar insumo</button>
            </form>
        </details>

        <div class="buscador">
            <input type="text" data-buscar-tabla="tabla-insumos" placeholder="Buscar insumo por nombre...">
        </div>

        <table class="admin-tabla" id="tabla-insumos">
            <thead>
                <tr>
                    <th>Insumo</th>
                    <th>Cantidad disponible</th>
                    <th>Cantidad mínima</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($insumos as $ins): ?>
                <?php
                    if ($ins['cantidad_disponible'] < $ins['cantidad_minima']) {
                        $nivel = 'bajo';
                        $etiqueta = 'Bajo stock';
                    } elseif ($ins['cantidad_disponible'] < $ins['cantidad_minima'] * 1.5) {
                        $nivel = 'medio';
                        $etiqueta = 'Nivel medio';
                    } else {
                        $nivel = 'suficiente';
                        $etiqueta = 'Suficiente';
                    }
                ?>
                <tr class="fila-<?php echo $nivel; ?>">
                    <td><?php echo htmlspecialchars($ins['nombre']); ?></td>
                    <td>
                        <span class="cantidad-val"><?php echo $ins['cantidad_disponible']; ?></span> 
                        <span class="unidad"><?php echo htmlspecialchars($ins['unidad_medida']); ?></span>
                    </td>
                    <td><?php echo $ins['cantidad_minima']; ?> <?php echo htmlspecialchars($ins['unidad_medida']); ?></td>
                    <td class="stock-<?php echo $nivel; ?>"><?php echo $etiqueta; ?></td>
                    <td>
                        <form action="actualizar_insumo.php" method="post" style="display: inline;" class="form-actualizar-modal">
                            <input type="hidden" name="id_insumo" value="<?php echo $ins['id_insumo']; ?>">
                            <input type="hidden" name="cantidad_disponible" class="input-hidden-cantidad" value="<?php echo $ins['cantidad_disponible']; ?>">
                            <button type="submit" class="btn-editar btn-actualizar-insumo">Actualizar</button>
                        </form>
                        <a href="eliminar_insumo.php?id=<?php echo $ins['id_insumo']; ?>" class="btn-eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <div id="footer-placeholder"></div>
    <script src="../JS/header-footer.js"></script>
    <script src="../JS/admin.js?v=<?php echo time(); ?>"></script>
</body>

</html>