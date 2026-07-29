<?php
require "conexion.php";

if (isset($_POST['guardar_producto'])) {
    $nombreImagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreImagen = time() . '_' . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../img/" . $nombreImagen);
    }

    $sql = "INSERT INTO productos (nombre, categoria, precio, disponibilidad, descripcion, imagen)
            VALUES (:nombre, :categoria, :precio, :disponibilidad, :descripcion, :imagen)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([
        ':nombre' => $_POST['nombre_producto'],
        ':categoria' => $_POST['categoria'],
        ':precio' => $_POST['precio'],
        ':disponibilidad' => 1,
        ':descripcion' => $_POST['descripcion'],
        ':imagen' => $nombreImagen
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
            <form action="admin_inventario.php" method="post" enctype="multipart/form-data">
                <label for="nuevo-nombre">Nombre</label>
                <input type="text" id="nuevo-nombre" name="nombre_producto" required>

                <label for="nuevo-descripcion">Descripción</label>
                <textarea id="nuevo-descripcion" name="descripcion" rows="3"></textarea>

                <label for="nuevo-precio">Precio</label>
                <input type="number" step="0.01" id="nuevo-precio" name="precio" required>

                <label for="nuevo-categoria">Categoría</label>
                <select id="nuevo-categoria" name="categoria">
                    <option value="Comida">Comida</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Postres">Postres</option>
                </select>

                <label for="nuevo-imagen">Imagen</label>
                <input type="file" id="nuevo-imagen" name="imagen" accept="image/*">

                <button type="submit" name="guardar_producto" class="btn-primario">Guardar producto</button>
            </form>
        </details>

        <div class="buscador">
            <input type="text" data-buscar-tabla="tabla-productos" placeholder="Buscar producto por nombre o categoría...">
        </div>

        <table class="admin-tabla" id="tabla-productos">
            <thead>
                <tr>
                    <th>Foto</th>
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
                    <td><img src="../img/<?php echo htmlspecialchars($prod['imagen'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($prod['nombre']); ?>" style="width:50px; height:50px; object-fit:cover; border-radius:6px;"></td>
                    <td><?php echo htmlspecialchars($prod['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($prod['categoria']); ?></td>
                    <td>$<?php echo number_format($prod['precio'], 2); ?></td>
                    <td class="<?php echo $prod['disponibilidad'] ? '' : 'stock-bajo'; ?>">
                        <?php echo $prod['disponibilidad'] ? 'Disponible' : 'Agotado'; ?>
                    </td>
                    <td>
                        <a href="#" class="btn-editar">Editar</a>
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
                        <form action="actualizar_insumo.php" method="post" class="form-actualizar-cantidad">
                            <input type="hidden" name="id_insumo" value="<?php echo $ins['id_insumo']; ?>">
                            <input type="number" step="0.01" name="cantidad_disponible" value="<?php echo $ins['cantidad_disponible']; ?>">
                            <span class="unidad"><?php echo htmlspecialchars($ins['unidad_medida']); ?></span>
                            <button type="submit" class="btn-editar">Actualizar</button>
                        </form>
                    </td>
                    <td><?php echo $ins['cantidad_minima']; ?> <?php echo htmlspecialchars($ins['unidad_medida']); ?></td>
                    <td class="stock-<?php echo $nivel; ?>"><?php echo $etiqueta; ?></td>
                    <td>
                        <a href="eliminar_insumo.php?id=<?php echo $ins['id_insumo']; ?>" class="btn-eliminar">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <div id="footer-placeholder"></div>
    <script src="../JS/header-footer.js"></script>
    <script src="../JS/admin.js"></script>
</body>

</html>