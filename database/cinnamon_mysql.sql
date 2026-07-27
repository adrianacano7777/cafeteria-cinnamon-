CREATE DATABASE cinnamon;
USE DATABASE cinnamon;
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente'
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    categoria ENUM('Comida', 'Bebidas', 'Postres') NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    disponibilidad BOOLEAN NOT NULL DEFAULT TRUE
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

INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES
('Adriana', 'adriana@cinnamon.com', 'admin2026', 'admin'),
('Angelica Rosas', 'angelica@gmail.com', 'clave123', 'cliente'),
('Manuel Tapia', 'manuel@gmail.com', 'clave123', 'cliente'),
('Denisse Nava', 'denisse@gmail.com', 'clave123', 'cliente'),
('Grecia Tapia', 'grecia@gmail.com', 'clave123', 'cliente');

INSERT INTO productos (nombre, categoria, precio, disponibilidad, descripcion) VALUES
('Latte de vainilla de Madagascar', 'Bebidas', 55.00, TRUE),


('Roles de canela de Ceylán', 'Postres', 48.00, TRUE, 'Rol horneado con canela auténtica y glaseado cremoso.'),
('Brownie de chocolate belga', 'Postres', 52.00, TRUE, 'Brownie húmedo con chocolate belga y nuez.'),
('Cheesecake de vainilla', 'Postres', 58.00, TRUE, 'Cheesecake cremoso con vainilla de Madagascar.'),
('Tarta de fresa', 'Postres', 55.00, TRUE, 'Base de galleta con crema pastelera y fresas frescas.'),
('Muffin de arandanos', 'Postres', 40.00, TRUE, 'Muffin esponjoso con arándanos naturales.'),
('Cookies de chocolate belga', 'Postres', 35.00, TRUE, 'Galletas horneadas con chispas de chocolate belga.'),
('Flan napolitano', 'Postres', 45.00, TRUE, 'Flan tradicional bañado en caramelo.'),
('Pay de queso con cajeta', 'Postres', 50.00, TRUE, 'Pay cremoso bañado con cajeta artesanal.'),
('Panque de vainilla y canela', 'Postres', 42.00, TRUE, 'Panqué casero con vainilla de Madagascar y canela..'),


('Sandwich club de pollo', 'Comida', 85.00, TRUE);

INSERT INTO insumos (nombre, cantidad_disponible, cantidad_minima, unidad_medida) VALUES
('Café en grano (Etiopía)', 8.5, 5, 'kg'),
('Leche entera', 3, 10, 'litros'),
('Canela de Ceylán', 1.2, 1, 'kg'),
('Vasos desechables (grandes)', 60, 100, 'piezas');

INSERT INTO metodo_pago (nombre) VALUESs
('Tarjeta'),
('Efectivo'),
('Transferencia');

INSERT INTO pedidos (id_usuario, id_metodo_pago, total, tipo_entrega, estado) VALUES
((SELECT id_usuario FROM usuarios WHERE correo = 'adriana@cinnamon.com'), (SELECT id_metodo_pago FROM metodo_pago WHERE nombre = 'Tarjeta'), 176.00, 'domicilio', 'preparando'),
((SELECT id_usuario FROM usuarios WHERE correo = 'manuel@gmail.com'), (SELECT id_metodo_pago FROM metodo_pago WHERE nombre = 'Efectivo'), 63.00, 'tienda', 'recibido'),
((SELECT id_usuario FROM usuarios WHERE correo = 'grecia@gmail.com'), (SELECT id_metodo_pago FROM metodo_pago WHERE nombre = 'Transferencia'), 92.00, 'tienda', 'entregado');

INSERT INTO resenas (id_usuario, calificacion, comentario) VALUES
((SELECT id_usuario FROM usuarios WHERE correo = 'angelica@gmail.com'), 5, '¡Los mejores roles de canela y brownies que he probado! Se nota muchísimo la calidad del chocolate belga en su repostería.'),
((SELECT id_usuario FROM usuarios WHERE correo = 'manuel@gmail.com'), 5, 'Soy súper exigente con el café y el latte de aquí con granos de Etiopía es una joya.'),
((SELECT id_usuario FROM usuarios WHERE correo = 'denisse@gmail.com'), 5, 'Cinnamon se convirtió en mi parada obligatoria de todas las tardes.');
