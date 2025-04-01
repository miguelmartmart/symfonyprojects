
-- Script de creación de base de datos para el sistema de gestión de taller

-- Eliminar tablas si existen para evitar conflictos
DROP TABLE IF EXISTS cita_empleados;
DROP TABLE IF EXISTS cita_servicios;
DROP TABLE IF EXISTS citas;
DROP TABLE IF EXISTS vehiculos;
DROP TABLE IF EXISTS servicios;
DROP TABLE IF EXISTS empleados;
DROP TABLE IF EXISTS clientes;

-- Crear tabla de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    email VARCHAR(255),
    direccion VARCHAR(500),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de empleados
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    cargo VARCHAR(100),
    telefono VARCHAR(50),
    email VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    duracion_estimada INT,
    costo DECIMAL(10, 2),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de vehículos
CREATE TABLE vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    tipo ENUM('car', 'motorcycle', 'truck') NOT NULL,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    anio INT,
    matricula VARCHAR(50),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de citas
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    fecha_cita DATETIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'completada', 'cancelada') NOT NULL DEFAULT 'pendiente',
    observaciones TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla intermedia cita_empleados
CREATE TABLE cita_empleados (
    cita_id INT NOT NULL,
    empleado_id INT NOT NULL,
    PRIMARY KEY (cita_id, empleado_id),
    FOREIGN KEY (cita_id) REFERENCES citas(id) ON DELETE CASCADE,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla intermedia cita_servicios
CREATE TABLE cita_servicios (
    cita_id INT NOT NULL,
    servicio_id INT NOT NULL,
    tiempo_estimado INT,
    PRIMARY KEY (cita_id, servicio_id),
    FOREIGN KEY (cita_id) REFERENCES citas(id) ON DELETE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES servicios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar clientes
INSERT INTO clientes (nombre, telefono, email, direccion) VALUES
('Juan Pérez', '555-1234', 'juan@example.com', 'Calle Falsa 123'),
('María García', '555-5678', 'maria@example.com', 'Avenida Siempre Viva 742');

-- Insertar empleados
INSERT INTO empleados (nombre, cargo, telefono, email) VALUES
('Carlos López', 'Mecánico Senior', '555-1111', 'carlos@example.com'),
('Ana Martínez', 'Técnica', '555-2222', 'ana@example.com');

-- Insertar servicios
INSERT INTO servicios (nombre, descripcion, duracion_estimada, costo) VALUES
('Cambio de Aceite', 'Reemplazo del aceite del motor y filtro', 30, 50.00),
('Revisión de Frenos', 'Inspección y ajuste de frenos', 45, 70.00),
('Diagnóstico', 'Análisis completo del vehículo', 60, 90.00);

-- Insertar vehículos
INSERT INTO vehiculos (cliente_id, tipo, marca, modelo, anio, matricula) VALUES
(1, 'car', 'Toyota', 'Corolla', 2018, 'ABC-123'),
(1, 'motorcycle', 'Honda', 'CB500', 2020, 'XYZ-987'),
(2, 'car', 'BMW', 'Serie 3', 2019, 'DEF-456');

-- Insertar citas
INSERT INTO citas (cliente_id, vehiculo_id, fecha_cita, estado, observaciones) VALUES
(1, 1, '2025-04-01 09:30:00', 'confirmada', 'Cambio de aceite y revisión general'),
(1, 2, '2025-04-02 10:00:00', 'pendiente', 'Revisión de frenos'),
(2, 3, '2025-04-03 11:15:00', 'confirmada', 'Diagnóstico completo');

-- Insertar relaciones cita_empleados
INSERT INTO cita_empleados (cita_id, empleado_id) VALUES
(1, 1),
(2, 2),
(3, 2);

-- Insertar relaciones cita_servicios
INSERT INTO cita_servicios (cita_id, servicio_id, tiempo_estimado) VALUES
(1, 1, 30),
(1, 2, 45),
(2, 2, 45),
(3, 3, 60);


