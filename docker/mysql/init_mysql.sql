-- Forzar codificación al importar el script
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Eliminar tablas si existen (orden de dependencias)
DROP TABLE IF EXISTS cita_empleados;
DROP TABLE IF EXISTS cita_servicios;
DROP TABLE IF EXISTS cita;
DROP TABLE IF EXISTS vehiculo;
DROP TABLE IF EXISTS servicio;
DROP TABLE IF EXISTS empleado;
DROP TABLE IF EXISTS cliente;

-- Crear tabla cliente
CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    email VARCHAR(255),
    direccion VARCHAR(500),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear tabla empleado
CREATE TABLE empleado (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    cargo VARCHAR(100),
    telefono VARCHAR(50),
    email VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear tabla servicio
CREATE TABLE servicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    duracion_estimada INT, -- en minutos
    costo DECIMAL(10,2),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear tabla vehiculo (añadido campo tipo y claves correctamente)
CREATE TABLE vehiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    tipo ENUM('car', 'motorcycle', 'truck', 'other') NOT NULL,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    anio INT,
    matricula VARCHAR(50),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id) ON DELETE CASCADE
);

-- Crear tabla cita
CREATE TABLE cita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    fecha_cita DATETIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'completada', 'cancelada') NOT NULL DEFAULT 'pendiente',
    observaciones TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id) ON DELETE CASCADE,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculo(id) ON DELETE CASCADE
);

-- Crear tabla intermedia cita_empleados
CREATE TABLE cita_empleados (
    cita_id INT NOT NULL,
    empleado_id INT NOT NULL,
    PRIMARY KEY (cita_id, empleado_id),
    FOREIGN KEY (cita_id) REFERENCES cita(id) ON DELETE CASCADE,
    FOREIGN KEY (empleado_id) REFERENCES empleado(id) ON DELETE CASCADE
);

-- Crear tabla intermedia cita_servicios
CREATE TABLE cita_servicios (
    cita_id INT NOT NULL,
    servicio_id INT NOT NULL,
    tiempo_estimado INT,
    PRIMARY KEY (cita_id, servicio_id),
    FOREIGN KEY (cita_id) REFERENCES cita(id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES servicio(id) ON DELETE CASCADE
);

-- Insertar clientes
INSERT INTO cliente (nombre, telefono, email, direccion) VALUES
('Carlos Pérez', '612345678', 'carlos.perez@gmail.com', 'Calle Mayor 15, Murcia'),
('Laura Gómez', '699112233', 'laura.gomez@yahoo.es', 'Av. Juan Carlos I, 21, Murcia'),
('Pedro Sánchez', '688776655', 'pedro.sanchez@hotmail.com', 'Plaza Circular, 5, Murcia'),
('María Martínez', '633224466', 'maria.martinez@gmail.com', 'Calle Pintor Pedro Flores, 9'),
('Antonio Ruiz', '677889900', 'antonio.ruiz@outlook.com', 'Camino Viejo de Monteagudo, 12');

-- Insertar empleados
INSERT INTO empleado (nombre, cargo, telefono, email) VALUES
('Juan Torres', 'Mecánico', '611223344', 'juan.torres@taller.com'),
('Sofía López', 'Recepcionista', '644556677', 'sofia.lopez@taller.com'),
('Miguel Navarro', 'Jefe de taller', '600112233', 'miguel.navarro@taller.com'),
('Elena Sánchez', 'Electromecánica', '688990011', 'elena.sanchez@taller.com');

-- Insertar servicios
INSERT INTO servicio (nombre, descripcion, duracion_estimada, costo) VALUES
('Cambio de aceite', 'Cambio de aceite y filtro', 30, 45.00),
('Revisión general', 'Chequeo completo del vehículo', 60, 80.00),
('Sustitución de frenos', 'Cambio de pastillas y discos de freno', 90, 120.00),
('Cambio de neumáticos', 'Sustitución y equilibrado de neumáticos', 45, 100.00),
('Diagnóstico electrónico', 'Análisis completo del sistema eléctrico', 50, 60.00);

-- Insertar vehículos (vehículos base)
INSERT INTO vehiculo (cliente_id, tipo, marca, modelo, anio, matricula) VALUES
(1, 'car', 'Toyota', 'Corolla', 2018, '1234ABC'),
(2, 'car', 'Renault', 'Clio', 2020, '5678XYZ'),
(3, 'motorcycle', 'Yamaha', 'MT-07', 2019, '8765KLM'),
(4, 'truck', 'Iveco', 'Daily', 2015, '3456TRP'),
(5, 'car', 'Volkswagen', 'Golf', 2021, '9999ZZZ'),

-- Vehículos extra para cubrir todos los tipos
(1, 'motorcycle', 'Honda', 'CBR500R', 2017, '1111FFF'),
(2, 'truck', 'Mercedes-Benz', 'Actros', 2016, '2222GGG'),
(3, 'car', 'Ford', 'Focus', 2019, '3333HHH'),
(4, 'other', 'Citroën', 'Berlingo', 2020, '4444JJJ');

-- Insertar citas (originales)
INSERT INTO cita (cliente_id, vehiculo_id, fecha_cita, estado, observaciones) VALUES
(1, 1, '2025-04-10 10:00:00', 'confirmada', 'Solicita revisión y cambio de aceite'),
(2, 2, '2025-04-12 09:00:00', 'pendiente', 'Ruido extraño al frenar'),
(3, 3, '2025-04-15 17:00:00', 'confirmada', 'Revisión previa a ITV'),
(4, 4, '2025-04-18 08:30:00', 'pendiente', 'Pierde potencia al acelerar'),
(5, 5, '2025-04-20 11:30:00', 'completada', 'Sustitución de neumáticos traseros'),

-- Nuevas citas para estados y tipos adicionales
(1, 6, '2025-04-25 09:00:00', 'cancelada', 'Cancelada por el cliente al último momento'),
(2, 7, '2025-04-26 11:00:00', 'completada', 'Servicio finalizado sin incidencias'),
(3, 8, '2025-04-27 13:30:00', 'confirmada', 'Confirmada por teléfono esta mañana'),
(4, 9, '2025-04-28 16:00:00', 'pendiente', 'A la espera de diagnóstico general');

-- Insertar relaciones cita_empleados
INSERT INTO cita_empleados (cita_id, empleado_id) VALUES
(1, 1), (1, 3),
(2, 1),
(3, 3),
(4, 1), (4, 4),
(5, 4),
(6, 2),
(7, 1),
(8, 3),
(9, 4);

-- Insertar relaciones cita_servicios
INSERT INTO cita_servicios (cita_id, servicio_id, tiempo_estimado) VALUES
(1, 1, 30),
(1, 2, 60),
(2, 3, 90),
(3, 2, 60),
(4, 5, 50),
(5, 4, 45),
(6, 1, 30),
(7, 3, 90),
(8, 5, 50),
(9, 2, 60);
