CREATE DATABASE cinnamon;
USE DATABASE cinnamon;
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente',
    activo TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria ENUM('Comida', 'Bebidas', 'Postres') NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    disponibilidad BOOLEAN NOT NULL DEFAULT TRUE,
    descripcion TEXT,
    imagen VARCHAR(255) DEFAULT 'default.jpg'
);

CREATE TABLE insumos (
    id_insumo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    cantidad_disponible DECIMAL(10,2) NOT NULL,
    cantidad_minima DECIMAL(10,2) NOT NULL,
    unidad_medida VARCHAR(20) NOT NULL
);

CREATE TABLE metodo_pago (
    id_metodo_pago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_metodo_pago INT,
    fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    tipo_entrega ENUM('domicilio', 'tienda') NOT NULL,
    estado ENUM('recibido', 'preparando', 'listo', 'entregado') NOT NULL DEFAULT 'recibido',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_metodo_pago) REFERENCES metodo_pago(id_metodo_pago)
);

CREATE TABLE detalles_pedido (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

CREATE TABLE resenas (
    id_resena INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    calificacion INT NOT NULL,
    comentario TEXT NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

INSERT INTO usuarios (nombre, correo, contrasena, rol, activo) VALUES
('Adriana', 'adriana@cinnamon.com', 'admin2026', 'admin', 1),
('Angelica Rosas', 'angelica@gmail.com', 'clave123', 'cliente', 1),
('Manuel Tapia', 'manuel@gmail.com', 'clave123', 'cliente', 1),
('Denisse Nava', 'denisse@gmail.com', 'clave123', 'cliente', 1),
('Grecia Tapia', 'grecia@gmail.com', 'clave123', 'cliente', 1);

INSERT INTO productos (nombre, categoria, precio, disponibilidad, descripcion, imagen) VALUES
('Cafe americano', 'Bebidas', 35.00, TRUE, 'Café de grano etíope preparado en filtro tradicional.', 'americano.webp'),
('Latte de vainilla de Madagascar', 'Bebidas', 55.00, TRUE, 'Espresso con leche vaporizada y vainilla auténtica.', 'latte-vainilla.webp'),
('Capuchino clásico', 'Bebidas', 50.00, TRUE, 'Espresso con espuma cremosa y un toque de canela de Ceylán.', 'capuchino.webp'),
('Mocha de chocolate belga', 'Bebidas', 60.00, TRUE, 'Espresso chocolate belga fundido y leche vaporizada.', 'mocha.webp'),
('Chai latte', 'Bebidas', 58.00, TRUE, 'Té chai especiado con leche vaporizada.', 'chai-latte.webp'),
('Matcha latte', 'Bebidas', 62.00, TRUE, 'Té matcha ceremonial batido con leche.', 'matcha.webp'),
('Frappé de caramelo', 'Bebidas', 65.00, TRUE, 'Café frío licuado con caramelo y crema batida.', 'frappe-caramelo.webp'),
('Té helado de durazno', 'Bebidas', 45.00, TRUE, 'Té negro infusionado con durazno natural.', 'cold-brew.webp'),
('Chocolate caliente belga', 'Bebidas', 58.00, TRUE, 'Chocolate beiga fundido con leche entera y malvaviscos.', 'chocolate-caliente.webp'),

('Roles de canela de Ceylán', 'Postres', 48.00, TRUE, 'Rol horneado con canela auténtica y glaseado cremoso.', 'rolcanela.jpg'),
('Brownie de chocolate belga', 'Postres', 52.00, TRUE, 'Brownie húmedo con chocolate belga y nuez.', 'brownie.jpg'),
('Cheesecake de vainilla', 'Postres', 58.00, TRUE, 'Cheesecake cremoso con vainilla de Madagascar.', 'quesocake.webp'),
('Tarta de fresa', 'Postres', 55.00, TRUE, 'Base de galleta con crema pastelera y fresas frescas.', 'tartafresa.webp'),
('Muffin de arandanos', 'Postres', 40.00, TRUE, 'Muffin esponjoso con arándanos naturales.', 'muffin.jpg'),
('Cookies de chocolate belga', 'Postres', 35.00, TRUE, 'Galletas horneadas con chispas de chocolate belga.', 'galleta.jpg'),
('Flan napolitano', 'Postres', 45.00, TRUE, 'Flan tradicional bañado en caramelo.', 'flan.jpg'),
('Crossiant de almendra', 'Postres', 50.00, TRUE, 'Croissant relleno de crema de almendra.', 'croasant.webp'),
('Pay de queso con cajeta', 'Postres', 50.00, TRUE, 'Pay cremoso bañado con cajeta artesanal.', 'pay.webp'),
('Panque de vainilla y canela', 'Postres', 42.00, TRUE, 'Panqué casero con vainilla de Madagascar y canela.', 'panque.jpeg'),

('Sandwich club de pollo', 'Comida', 85.00, TRUE, 'Pan artesanal con pollo, tocino, lechuga y aguacate.', 'sandwich-club.webp'),
('Bagel con salmón ahumado', 'Comida', 95.00, TRUE, 'Bagel tostado con queso crema, salmón y alcaparras.', 'bagel-salmon.webp'),
('Croissant jamón y queso', 'Comida', 65.00, TRUE, 'Croissant horneado relleno de jamón y queso gouda.', 'croissant-jamon.webp'),
('Ensalada césar con pollo', 'Comida', 90.00, TRUE, 'Lechuga romana, pollo a la parrilla y aderezo césar.', 'ensalada-cesar.webp'),
('Quesadilla de flor de calabaza', 'Comida', 70.00, TRUE, 'Tortilla de harina con flor de calabaza y queso oaxaca.', 'quesadilla-calabaza.webp'),
('Panini caprese', 'Comida', 80.00, TRUE, 'Pan ciabatta con tomate, mozzarella y pesto.', 'panini-caprese.webp'),
('Omelette de espinaca y champiñones', 'Comida', 75.00, TRUE, 'Omelette esponjoso con espinaca fresca y champiñones.', 'omelette-espianca.webp'),
('Wrap de atún', 'Comida', 78.00, TRUE, 'Tortilla integral con atún, apio y mayonesa ligera.', 'wrap-atun.webp'),
('Torta de tamal', 'Comida', 80.00, TRUE, 'Tamal oaxaqueño servido en bolillo con crema.', 'torta-tamal.webp'),
('Molletes con pico de gallo', 'Comida', 65.00, TRUE, 'Bolillo horneado con frijoles, queso grantinado y pico de gallo.', 'molletes.webp');

INSERT INTO insumos (nombre, cantidad_disponible, cantidad_minima, unidad_medida) VALUES
('Café en grano (Etiopía)', 8.5, 5, 'kg'),
('Leche entera', 3, 10, 'litros'),
('Canela de Ceylán', 1.2, 1, 'kg'),
('Vasos desechables (grandes)', 60, 100, 'piezas');

INSERT INTO metodo_pago (nombre) VALUES
('Tarjeta'),
('Efectivo'),
('Transferencia');

INSERT INTO pedidos (id_usuario, id_metodo_pago, total, tipo_entrega, estado) VALUES
((SELECT id_usuario FROM usuarios WHERE correo = 'adriana@cinnamon.com'), (SELECT id_metodo_pago FROM metodo_pago WHERE nombre = 'Tarjeta'), 176.00, 'domicilio', 'preparando'),
((SELECT id_usuario FROM usuarios WHERE correo = 'manuel@gmail.com'), (SELECT id_metodo_pago FROM metodo_pago WHERE nombre = 'Efectivo'), 63.00, 'tienda', 'recibido'),
((SELECT id_usuario FROM usuarios WHERE correo = 'grecia@gmail.com'), (SELECT id_metodo_pago FROM metodo_pago WHERE nombre = 'Transferencia'), 92.00, 'tienda', 'entregado');

INSERT INTO detalles_pedido (id_detalle, id_pedido, id_producto, cantidad, precio_unitario) VALUES
(1, 1, 1, 3, 45.00), 
(2, 1, 2, 1, 50.00), 
(3, 2, 2, 2, 50.00), 
(4, 2, 3, 2, 55.00), 
(5, 3, 1, 1, 45.00), 
(6, 3, 3, 1, 55.00);

INSERT INTO resenas (id_usuario, calificacion, comentario) VALUES
((SELECT id_usuario FROM usuarios WHERE correo = 'angelica@gmail.com'), 5, '¡Los mejores roles de canela y brownies que he probado! Se nota muchísimo la calidad del chocolate belga en su repostería.'),
((SELECT id_usuario FROM usuarios WHERE correo = 'manuel@gmail.com'), 5, 'Soy súper exigente con el café y el latte de aquí con granos de Etiopía es una joya.'),
((SELECT id_usuario FROM usuarios WHERE correo = 'denisse@gmail.com'), 5, 'Cinnamon se convirtió en mi parada obligatoria de todas las tardes.');


//para ver en accion la de productos más vendidos
INSERT INTO pedidos (id_usuario, id_metodo_pago, total, tipo_entrega, estado) VALUES
(1, 1, 185.00, 'tienda', 'entregado'),
(1, 1, 240.00, 'domicilio', 'entregado'),
(1, 1, 150.00, 'tienda', 'entregado');

INSERT INTO detalles_pedido (id_pedido, id_producto, cantidad, precio_unitario) VALUES
((SELECT MAX(id_pedido) - 2 FROM pedidos), 1, 5, 25.00),
((SELECT MAX(id_pedido) - 2 FROM pedidos), 2, 2, 30.00),
((SELECT MAX(id_pedido) - 1 FROM pedidos), 1, 3, 25.00),
((SELECT MAX(id_pedido) - 1 FROM pedidos), 3, 4, 40.00),
((SELECT MAX(id_pedido) FROM pedidos), 2, 3, 30.00),
((SELECT MAX(id_pedido) FROM pedidos), 4, 1, 60.00);
