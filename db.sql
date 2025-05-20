-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda_zapatos;
USE tienda_zapatos;

-- Tabla de categorías
CREATE TABLE IF NOT EXISTS categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    imagen VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    direccion TEXT,
    telefono VARCHAR(20),
    rol ENUM('cliente', 'admin') DEFAULT 'cliente',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de carrito (opcional)
CREATE TABLE IF NOT EXISTS carrito (
    id_carrito INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    id_producto INT,
    cantidad INT DEFAULT 1,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

-- Tabla de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    total DECIMAL(10,2) NOT NULL,
    estado ENUM('pendiente', 'completado', 'cancelado') DEFAULT 'pendiente',
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- Detalles del pedido
CREATE TABLE IF NOT EXISTS detalles_pedido (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

-- Tabla de logs para auditoría
CREATE TABLE IF NOT EXISTS logs (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    accion VARCHAR(255) NOT NULL,
    tabla_afectada VARCHAR(50) NOT NULL,
    id_registro INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Trigger: Registrar eliminación de producto
DELIMITER //
CREATE TRIGGER trg_eliminar_producto
AFTER DELETE ON productos
FOR EACH ROW
BEGIN
    INSERT INTO logs (accion, tabla_afectada, id_registro)
    VALUES ('Producto eliminado', 'productos', OLD.id_producto);
END;
//
DELIMITER ;

-- Trigger: Registrar creación de usuario
DELIMITER //
CREATE TRIGGER trg_crear_usuario
AFTER INSERT ON usuarios
FOR EACH ROW
BEGIN
    INSERT INTO logs (accion, tabla_afectada, id_registro)
    VALUES (CONCAT('Usuario creado: ', NEW.nombre), 'usuarios', NEW.id_usuario);
END;
//
DELIMITER ;

-- Trigger: Actualizar stock al crear un pedido
DELIMITER //
CREATE TRIGGER trg_restar_stock
AFTER INSERT ON detalles_pedido
FOR EACH ROW
BEGIN
    UPDATE productos
    SET stock = stock - NEW.cantidad
    WHERE id_producto = NEW.id_producto;
END;
//
DELIMITER ;

-- Insertar categorías iniciales
INSERT INTO categorias (nombre_categoria) VALUES
('Zapatillas'),
('Botas'),
('Sandalias'),
('Zapatos Formales');

-- Insertar productos de ejemplo
INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, imagen) VALUES
(1, 'Zapatillas Nike Air', 'Zapatillas deportivas cómodas y resistentes.', 129.99, 20, 'nike_air.jpg'),
(1, 'Zapatillas Adidas Ultraboost', 'Amortiguación avanzada y estilo moderno.', 180.00, 15, 'adidas_ultra.jpg'),
(2, 'Botas Timberland Clásicas', 'Botas resistentes al agua y duraderas.', 149.99, 10, 'timberland.jpg'),
(3, 'Sandalias Columbia', 'Ligeras y perfectas para verano.', 49.99, 30, 'columbia_sandals.jpg'),
(4, 'Zapatos Gucci Formales', 'Elegantes zapatos para ocasiones especiales.', 299.99, 5, 'gucci_shoes.jpg');

-- Insertar usuarios de ejemplo (contraseñas en texto plano por simplicidad)
INSERT INTO usuarios (nombre, correo, contrasena, direccion, telefono, rol) VALUES
('Admin Principal', 'admin@example.com', '$2y$10$Kb3OzJpYRqVZtT7vXfQk.eFj6mMhHrWuP0aXeUwIzGzB7Dd', 'Calle Admin 123', '1234567890', 'admin'),
('Cliente Ejemplo', 'cliente@example.com', '$2y$10$Kb3OzJpYRqVZtT7vXfQk.eFj6mMhHrWuP0aXeUwIzGzB7Dd', 'Calle Cliente 456', '0987654321', 'cliente');

USE tienda_zapatos;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('cliente', 'admin') DEFAULT 'cliente',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);