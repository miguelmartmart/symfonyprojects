-- Eliminar la base de datos si ya existe (con precaución en entornos de producción)
DROP DATABASE IF EXISTS workshop_db;

-- Crear la base de datos con un cotejamiento adecuado para Unicode
CREATE DATABASE workshop_db 
  CHARACTER SET utf8mb4 
  COLLATE utf8mb4_unicode_ci;

-- Seleccionar la base de datos
USE workshop_db;

-- Tabla: Clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(50),
    email VARCHAR(255),
    direccion VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: Vehículos
CREATE TABLE vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    tipo ENUM('car', 'motorcycle', 'other') NOT NULL,
    marca VARCHAR(100) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    anio YEAR,
    matricula VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
      ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabla: Empleados
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    cargo VARCHAR(100),
    telefono VARCHAR(50),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: Citas
CREATE TABLE citas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    vehiculo_id INT NOT NULL,
    empleado_id INT, -- Opcional, puede ser NULL
    fecha_cita DATETIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'completada', 'cancelada') DEFAULT 'pendiente',
    observaciones TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id)
      ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabla: Servicios
CREATE TABLE servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    duracion_estimada INT,  -- en minutos
    costo DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla: Cita_Servicios (tabla intermedia para relación muchos a muchos)
CREATE TABLE cita_servicios (
    cita_id INT NOT NULL,
    servicio_id INT NOT NULL,
    tiempo_estimado INT,  -- tiempo en minutos para el servicio en esa cita
    PRIMARY KEY (cita_id, servicio_id),
    FOREIGN KEY (cita_id) REFERENCES citas(id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (servicio_id) REFERENCES servicios(id)
      ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Inserción de datos de ejemplo

-- Insertar clientes
INSERT INTO clientes (nombre, telefono, email, direccion) VALUES
('Juan Pérez', '555-1234', 'juan@example.com', 'Calle Falsa 123'),
('María García', '555-5678', 'maria@example.com', 'Avenida Siempre Viva 742');

-- Insertar vehículos
INSERT INTO vehiculos (cliente_id, tipo, marca, modelo, anio, matricula) VALUES
(1, 'car', 'Toyota', 'Corolla', 2018, 'ABC-123'),
(1, 'motorcycle', 'Honda', 'CB500', 2020, 'XYZ-987'),
(2, 'car', 'BMW', 'Serie 3', 2019, 'DEF-456');

-- Insertar empleados
INSERT INTO empleados (nombre, cargo, telefono, email) VALUES
('Carlos López', 'Mecánico Senior', '555-1111', 'carlos@example.com'),
('Ana Martínez', 'Técnica', '555-2222', 'ana@example.com');

-- Insertar citas
INSERT INTO citas (cliente_id, vehiculo_id, empleado_id, fecha_cita, estado, observaciones) VALUES
(1, 1, 1, '2023-09-01 09:30:00', 'confirmada', 'Cambio de aceite y revisión general'),
(1, 2, NULL, '2023-09-02 10:00:00', 'pendiente', 'Revisión de frenos'),
(2, 3, 2, '2023-09-03 11:15:00', 'confirmada', 'Diagnóstico completo');

-- Insertar servicios
INSERT INTO servicios (nombre, descripcion, duracion_estimada, costo) VALUES
('Cambio de Aceite', 'Reemplazo del aceite del motor y filtro', 30, 50.00),
('Revisión de Frenos', 'Inspección y ajuste de frenos', 45, 70.00),
('Diagnóstico', 'Análisis completo del vehículo', 60, 90.00);

-- Asociar servicios a citas (tabla intermedia)
INSERT INTO cita_servicios (cita_id, servicio_id, tiempo_estimado) VALUES
(1, 1, 30),
(1, 2, 45),
(2, 2, 45),
(3, 3, 60);
