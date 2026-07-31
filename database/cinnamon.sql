-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:2207
-- Generation Time: Jul 31, 2026 at 07:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinnamon`
--

-- --------------------------------------------------------

--
-- Table structure for table `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 1, 3, 45.00),
(2, 1, 2, 1, 50.00),
(3, 2, 2, 2, 50.00),
(4, 2, 3, 2, 55.00),
(5, 3, 1, 1, 45.00),
(6, 3, 3, 1, 55.00),
(7, 1, 1, 1, 45.00),
(8, 14, 1, 5, 25.00),
(9, 14, 2, 2, 30.00),
(10, 15, 1, 3, 25.00),
(11, 15, 3, 4, 40.00),
(12, 16, 2, 3, 30.00),
(13, 16, 4, 1, 60.00),
(14, 17, 1, 10, 25.00),
(15, 17, 2, 5, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `insumos`
--

CREATE TABLE `insumos` (
  `id_insumo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad_disponible` decimal(10,2) NOT NULL,
  `cantidad_minima` decimal(10,2) NOT NULL,
  `unidad_medida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insumos`
--

INSERT INTO `insumos` (`id_insumo`, `nombre`, `cantidad_disponible`, `cantidad_minima`, `unidad_medida`) VALUES
(1, 'Café en grano (Etiopía)', 10.00, 5.00, 'kg'),
(2, 'Leche entera', 5.00, 10.00, 'litros'),
(3, 'Canela de Ceylán', 1.20, 1.00, 'kg'),
(4, 'Vasos desechables (grandes)', 60.00, 100.00, 'piezas');

-- --------------------------------------------------------

--
-- Table structure for table `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metodo_pago`
--

INSERT INTO `metodo_pago` (`id_metodo_pago`, `nombre`) VALUES
(1, 'Tarjeta'),
(2, 'Efectivo'),
(3, 'Transferencia'),
(4, 'Efectivo'),
(5, 'Tarjeta de crédito');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_metodo_pago` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `tipo_entrega` enum('domicilio','tienda') NOT NULL,
  `estado` enum('recibido','preparando','listo','entregado') NOT NULL DEFAULT 'recibido'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `id_metodo_pago`, `fecha`, `total`, `tipo_entrega`, `estado`) VALUES
(1, 1, 1, '2026-07-22 14:18:27', 176.00, 'domicilio', 'entregado'),
(2, 3, 2, '2026-07-22 14:18:27', 63.00, 'tienda', 'entregado'),
(3, 5, 3, '2026-07-22 14:18:27', 92.00, 'tienda', 'entregado'),
(7, 2, 1, '2026-07-15 10:30:00', 185.00, 'domicilio', 'entregado'),
(8, 3, 2, '2026-07-20 14:15:00', 210.00, 'tienda', 'entregado'),
(9, 4, 1, '2026-07-22 19:45:15', 135.00, 'tienda', 'entregado'),
(10, 2, 1, '2026-07-15 10:30:00', 185.00, 'domicilio', 'entregado'),
(11, 3, 2, '2026-07-20 14:15:00', 210.00, 'tienda', 'entregado'),
(12, 4, 1, '2026-07-22 19:47:56', 135.00, 'tienda', 'entregado'),
(13, 4, 1, '2026-07-29 12:24:56', 176.00, 'domicilio', 'preparando'),
(14, 1, 1, '2026-07-30 22:21:46', 185.00, 'tienda', 'entregado'),
(15, 1, 1, '2026-07-30 22:21:46', 240.00, 'domicilio', 'entregado'),
(16, 1, 1, '2026-07-30 22:21:46', 150.00, 'tienda', 'entregado'),
(17, NULL, NULL, '2026-07-30 22:24:07', 350.00, 'tienda', 'entregado');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria` enum('Comida','Bebidas','Postres') NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL DEFAULT 1,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) DEFAULT 'default.webp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `categoria`, `precio`, `disponibilidad`, `descripcion`, `imagen`) VALUES
(1, 'Cafe americano', 'Bebidas', 35.00, 1, 'Café de grano etíope preparado en filtro tradicional.', 'americano.webp'),
(2, 'Latte de vainilla de Madagascar', 'Bebidas', 55.00, 1, 'Espresso con leche vaporizada y vainilla auténtica.', 'latte-vainilla.webp'),
(3, 'Capuchino clásico', 'Bebidas', 50.00, 1, 'Espresso con espuma cremosa y un toque de canela de Ceylán.', 'capuchino.webp'),
(4, 'Mocha de chocolate belga', 'Bebidas', 60.00, 1, 'Espresso chocolate belga fundido y leche vaporizada.', 'mocha.webp'),
(5, 'Chai latte', 'Bebidas', 58.00, 1, 'Té chai especiado con leche vaporizada.', 'chai-latte.webp'),
(6, 'Matcha latte', 'Bebidas', 62.00, 1, 'Té matcha ceremonial batido con leche.', 'matcha.webp'),
(7, 'Frappé de caramelo', 'Bebidas', 65.00, 1, 'Café frío licuado con caramelo y crema batida.', 'frappe-caramelo.webp'),
(8, 'Té helado de durazno', 'Bebidas', 45.00, 1, 'Té negro infusionado con durazno natural.', 'cold-brew.webp'),
(9, 'Chocolate caliente belga', 'Bebidas', 58.00, 1, 'Chocolate beiga fundido con leche entera y malvaviscos.', 'chocolate-caliente.webp'),
(10, 'Roles de canela de Ceylán', 'Postres', 48.00, 1, 'Rol horneado con canela auténtica y glaseado cremoso.', 'rolcanela.jpg'),
(11, 'Brownie de chocolate belga', 'Postres', 52.00, 1, 'Brownie húmedo con chocolate belga y nuez.', 'brownie.jpg'),
(12, 'Cheesecake de vainilla', 'Postres', 58.00, 1, 'Cheesecake cremoso con vainilla de Madagascar.', 'quesocake.webp'),
(13, 'Tarta de fresa', 'Postres', 55.00, 1, 'Base de galleta con crema pastelera y fresas frescas.', 'tartafresa.webp'),
(14, 'Muffin de arandanos', 'Postres', 40.00, 1, 'Muffin esponjoso con arándanos naturales.', 'muffin.jpg'),
(15, 'Cookies de chocolate belga', 'Postres', 35.00, 1, 'Galletas horneadas con chispas de chocolate belga.', 'galleta.jpg'),
(16, 'Flan napolitano', 'Postres', 45.00, 1, 'Flan tradicional bañado en caramelo.', 'flan.jpg'),
(17, 'Crossiant de almendra', 'Postres', 50.00, 1, 'Croissant relleno de crema de almendra.', 'croasant.webp'),
(18, 'Pay de queso con cajeta', 'Postres', 50.00, 1, 'Pay cremoso bañado con cajeta artesanal.', 'pay.webp'),
(19, 'Panque de vainilla y canela', 'Postres', 42.00, 1, 'Panqué casero con vainilla de Madagascar y canela.', 'panque.jpeg'),
(20, 'Sandwich club de pollo', 'Comida', 85.00, 1, 'Pan artesanal con pollo, tocino, lechuga y aguacate.', 'sandwich-club.webp'),
(21, 'Bagel con salmón ahumado', 'Comida', 95.00, 1, 'Bagel tostado con queso crema, salmón y alcaparras.', 'bagel-salmon.webp'),
(22, 'Croissant jamón y queso', 'Comida', 65.00, 1, 'Croissant horneado relleno de jamón y queso gouda.', 'croissant-jamon.webp'),
(23, 'Ensalada césar con pollo', 'Comida', 90.00, 1, 'Lechuga romana, pollo a la parrilla y aderezo césar.', 'ensalada-cesar.webp'),
(24, 'Quesadilla de flor de calabaza', 'Comida', 70.00, 1, 'Tortilla de harina con flor de calabaza y queso oaxaca.', 'quesadilla-calabaza.webp'),
(25, 'Panini caprese', 'Comida', 80.00, 1, 'Pan ciabatta con tomate, mozzarella y pesto.', 'panini-caprese.webp'),
(26, 'Omelette de espinaca y champiñones', 'Comida', 75.00, 1, 'Omelette esponjoso con espinaca fresca y champiñones.', 'omelette-espianca.webp'),
(27, 'Wrap de atún', 'Comida', 78.00, 1, 'Tortilla integral con atún, apio y mayonesa ligera.', 'wrap-atun.webp'),
(28, 'Torta de tamal', 'Comida', 80.00, 1, 'Tamal oaxaqueño servido en bolillo con crema.', 'torta-tamal.webp'),
(29, 'Molletes con pico de gallo', 'Comida', 65.00, 1, 'Bolillo horneado con frijoles, queso grantinado y pico de gallo.', 'molletes.webp');

-- --------------------------------------------------------

--
-- Table structure for table `resenas`
--

CREATE TABLE `resenas` (
  `id_resena` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `calificacion` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resenas`
--

INSERT INTO `resenas` (`id_resena`, `id_usuario`, `calificacion`, `comentario`, `fecha`) VALUES
(1, 2, 5, '¡Los mejores roles de canela y brownies que he probado! Se nota muchísimo la calidad del chocolate belga en su repostería.', '2026-07-22 20:18:27'),
(2, 3, 5, 'Soy súper exigente con el café y el latte de aquí con granos de Etiopía es una joya.', '2026-07-22 20:18:27'),
(3, 4, 5, 'Cinnamon se convirtió en mi parada obligatoria de todas las tardes.', '2026-07-22 20:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('cliente','admin') NOT NULL DEFAULT 'cliente',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contrasena`, `rol`, `activo`) VALUES
(1, 'Adriana', 'adriana@cinnamon.com', '$2y$10$bmTnIs1u6u3PFsPGxgL3f.8Slaut5Ekr.Pq80BPjW3XtZR1Nkdm9S', 'admin', 1),
(2, 'Angelica Rosas', 'angelica@gmail.com', '$2y$10$AZgnnxsmzr0Bo0y44E1wk.aNBxVmK7Ux6JYFjdxJY9cqIY9HmNw0q', 'cliente', 1),
(3, 'Manuel Tapia', 'manuel@gmail.com', '$2y$10$N0PQPUOXNxQxRmBGT9I3juFYxOBkqxPbxb4FJeKoB0xzGBSAvu.Z.', 'cliente', 1),
(4, 'Denisse Nava', 'denisse@gmail.com', '$2y$10$l9ZZbgkWydpWzHQQrD35Xu8nIuhqrmZauj7eVE4z6FcB9rF65lXSu', 'cliente', 1),
(5, 'Grecia Tapia', 'grecia@gmail.com', '$2y$10$X8QenYIZCbLaEID08ABR8eFxHqKgVLktJNI9Q891RdOnMz4u.rAUO', 'cliente', 1),
(7, 'Daisy', 'daisy@gmail.com', '$2y$10$eUjUSJUuNNZvf2Zl6phK5OPg98CsDzJNJ.ntBdVTo7Eyc5YtpHn0O', 'cliente', 1),
(8, 'Evelyn', 'evelyn@gmail.com', '$2y$10$WTkS98f2TNbdAn1QV23tEeX0Q09M4p.uZ4LmynsqtqR6roy94eOKO', 'cliente', 1),
(10, 'Ana Martínez', 'anamartinez@gmail.com', '$2y$10$Gd4YXP1Au5FNAwIFSWwXt.Vw8x/9Ohe5IcorE0pmjlwWiMw9K0..i', 'cliente', 1),
(11, 'Valeria Lopez', 'valeria@gmail.com', '$2y$10$xrFVTmRS.xEtlPnLVFt/U.uaoGGzGxsVngaYUyElQMrW8uKqRxMoO', 'cliente', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indexes for table `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_metodo_pago` (`id_metodo_pago`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id_resena`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id_insumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id_resena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalles_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id_metodo_pago`);

--
-- Constraints for table `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `resenas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
