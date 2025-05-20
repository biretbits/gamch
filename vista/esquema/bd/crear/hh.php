
en tablas de tantos cambiar contraseña de DocumentRoot
en modelo/conexion.php
farmacia/sql.php
registroDiario/sql.php


DROP TABLE IF EXISTS `niveles`;
CREATE TABLE niveles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel_empleado VARCHAR(255) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    estado CHAR(10) DEFAULT 'activo'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `niveles` (id, nivel_empleado, creado_en, actualizado_en) VALUES
(1,'SECRETARIA MUNICIPAL DE ADMINISTRACIÓN Y FINANZAS',NOW(),NOW()),
(2,'EJECUTIVO',NOW(),NOW()),
(3,'SECRETARIA MUNICIPAL DE DESARROLLO PRODUCTIVO',NOW(),NOW()),
(4,'UNIDAD DE ORDENAMIENTO TERRITORIAL Y CATASTRO',NOW(),NOW()),
(5,'SECRETARIA MUNICIPAL DE OBRAS PUBLICAS',NOW(),NOW()),
(6,'SECRETARIA MUNICIPAL DE DESARROLLO HUMANO Y SOCIAL',NOW(),NOW()),
(7,'SUB ALCALDIA CHALLAPATA',NOW(),NOW()),
(8,'SUB ALCALDIA QAQACHACA',NOW(),NOW()),
(9,'SUB ALCALDIA AGUAS CALIENTES',NOW(),NOW()),
(10,'SUB ALCALDIA HUANCANE',NOW(),NOW()),
(11,'SUB ALCALDIA TOLAPALCA',NOW(),NOW()),
(12,'SUB ALCALDIA NORTE CONDO ARRIBA',NOW(),NOW()),
(13,'SUB ALCALDIA NORTE CONDO ABAJO',NOW(),NOW()),
(14,'SUB ALCALDIA CULTA',NOW(),NOW()),
(15,'SUB ALCALDIA ANCACATO',NOW(),NOW()),
(16,'ALIMENTACION COMPLEMENTARIA',NOW(),NOW()),
(17,'APOYO AL DESARROLLO DEPORTIVO',NOW(),NOW()),
(18,'APOYO A LA CULTURA',NOW(),NOW()),
(19,'APOYO AL TURISMO',NOW(),NOW()),
(20,'APOYO DE SERVICIO LEGAL INTEGRAL MUNICIPAL (SLIM)',NOW(),NOW()),
(21,'EQUIDAD DE GENERO LEY 348',NOW(),NOW()),
(22,'UMAPEDIS',NOW(),NOW()),
(23,'FUNCIONAMIENTO CASA INTEGRAL DE ACOGIDA',NOW(),NOW()),
(24,'RECURSO PARA ADULTOS MAYORES (LEY 548)',NOW(),NOW()),
(25,'DEFENSORIA DE LA NIÑEZ Y LA ADOLESCENCIA',NOW(),NOW()),
(26,'SEGURIDAD CIUDADANA',NOW(),NOW()),
(27,'LIMITES TERRITORIALES',NOW(),NOW()),
(28,'FUNCIONAMIENTO CANAL MUNICIPAL',NOW(),NOW()),
(29,'UNIDAD DE DESARROLLO PRODUCTIVO AGROPECUARIO',NOW(),NOW()),
(30,'UNIDAD DE INSEMINACION ARTIFICIAL CHALLAPATA',NOW(),NOW()),
(31,'UNIDAD DE APOYO AL FUNCIONAMIENTO ZOONOSIS',NOW(),NOW()),
(32,'UNIDAD IMPLEMENTACION Y MANTENIMIENTO DE AREAS VERDES',NOW(),NOW()),
(33,'UNIDAD DE APOYO MEDIO AMBIENTE MUNICIPIO CHALLAPATA',NOW(),NOW()),
(34,'UNIDAD DE ASEO URBANO',NOW(),NOW()),
(35,'UNIDAD DE INHUMACION CEMENTERIO',NOW(),NOW()),
(36,'UNIDAD DE UGR C. A.P.',NOW(),NOW()),
(37,'UNIDAD DE PREVISION DE RECURSOS PARA GESTION DE RIESGOS',NOW(),NOW()),
(38,'RESPONSABLE DE RECURSOS HUMANOS',NOW(),NOW()),
(39,'RESPONSABLE DE CONTRATACIONES',NOW(),NOW());

-- Tabla: cargos
DROP TABLE IF EXISTS `cargos`;
CREATE TABLE cargos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel_id INT NOT NULL,
    cargo_empleado VARCHAR(255) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    estado CHAR(15) DEFAULT 'activo',
    FOREIGN KEY (nivel_id) REFERENCES niveles(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cargos` (nivel_id, cargo_empleado, creado_en, actualizado_en) VALUES
(6, 'TECNICO DE SISTEMAS Y MANTENIMIENTO', NOW(), NOW()),
(6, 'RESPONSABLE DE CULTURA Y TURISMO', NOW(), NOW()),
(6, 'ENCARGADO CANAL DE TELEVISIÓN MUNICIPAL', NOW(), NOW());

-- Tabla: empleados
DROP TABLE IF EXISTS `empleados`;
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nivel_id INT NOT NULL,
    cargo_id INT NOT NULL,
    tipo_empleado VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellido_p VARCHAR(255) NOT NULL,
    apellido_m VARCHAR(255) NOT NULL,
    sexo VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL UNIQUE,
    foto VARCHAR(255) DEFAULT 'default.jpg',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    estado CHAR(15) DEFAULT 'activo',
    FOREIGN KEY (nivel_id) REFERENCES niveles(id),
    FOREIGN KEY (cargo_id) REFERENCES cargos(id)
);

INSERT INTO empleados (
    nivel_id, cargo_id, tipo_empleado, nombre, apellido_p, apellido_m, sexo,
    direccion, telefono, correo_electronico, foto, creado_en, actualizado_en
) VALUES
(6, 1, 'normal', 'Limbert', 'Lipiri', 'Villca', 'Masculino',
 'Calle La Paz entre Linarez', '63260832', 'lipiri12345678xp@gmail.com',
 'default.jpg', NOW(), NOW());

-- Tabla: usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empleado_id INT NOT NULL,
    usuario VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    estado CHAR(15) DEFAULT 'activo',
    token_recordar VARCHAR(100) DEFAULT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
);

INSERT INTO usuarios (empleado_id, usuario, contrasena, creado_en, actualizado_en) VALUES
(1, 'admin', '$2y$10$HcDmz5/npUWmiwxbW0QK8.fp2fvu0xcbAU8McwvvJDRBf29TvuroS', NOW(), NOW());






DROP TABLE IF EXISTS `permisos`;

CREATE TABLE `permisos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `descripcion` TEXT,
    `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `permisos` (`nombre`, `slug`, `descripcion`, `creado_en`, `actualizado_en`) VALUES
('Crear', 'users.create', 'Crea Usuarios para la administracion del sistema', NOW(), NOW()),
('Navegar', 'users.index', 'Lista y navega por todos los usuarios del sistema', NOW(), NOW()),
('detalle', 'users.show', 'muestra en detalle cada usuario del sistema', NOW(), NOW()),
('Editar', 'users.edit', 'Edita cualquier dato de un usuario del sistema', NOW(), NOW()),
('Eliminar', 'users.destroy', 'Eliminina cualquier usuario de sistema', NOW(), NOW()),
('Crear', 'roles.create', 'Crea un rol del sistema', NOW(), NOW()),
('Navegar', 'roles.index', 'Lista y navega por todos los roles del sistema', NOW(), NOW()),
('detalle', 'roles.show', 'muestra en detalle cada rol del sistema', NOW(), NOW()),
('Editar', 'roles.edit', 'Edita cualquier dato de un rol del sistema', NOW(), NOW()),
('Eliminar', 'roles.destroy', 'Eliminina cualquier rol de sistema', NOW(), NOW()),
('Crear', 'doc.create', 'Crea un document del sistema', NOW(), NOW()),
('Navegar', 'doc.index', 'Lista y navega por todos los documents del sistema', NOW(), NOW()),
('detalle', 'doc.show', 'muestra en detalle cada document del sistema', NOW(), NOW()),
('Editar', 'doc.edit', 'Edita cualquier dato de un document del sistema', NOW(), NOW()),
('Eliminar', 'doc.destroy', 'Eliminina cualquier document de sistema', NOW(), NOW()),
('Crear', 'employees.create', 'Crea un Empleados del sistema', NOW(), NOW()),
('Navegar', 'employees.index', 'Lista y navega por todos los Empleados del sistema', NOW(), NOW()),
('detalle', 'employees.show', 'muestra en detalle cada Empleados del sistema', NOW(), NOW()),
('Editar', 'employees.edit', 'Edita cualquier dato de un Empleados del sistema', NOW(), NOW()),
('Eliminar', 'employees.destroy', 'Eliminina cualquier Empleados de sistema', NOW(), NOW()),
('Crear', 'salaries.create', 'Crea un Salarios del sistema', NOW(), NOW()),
('Navegar', 'salaries.index', 'Lista y navega por todos los Salarios del sistema', NOW(), NOW()),
('detalle', 'salaries.show', 'muestra en detalle cada Salarios del sistema', NOW(), NOW()),
('Editar', 'salaries.edit', 'Edita cualquier dato de un Salarios del sistema', NOW(), NOW()),
('Eliminar', 'salaries.destroy', 'Eliminina cualquier Salarios de sistema', NOW(), NOW()),
('Crear', 'newpages.create', 'Crea un Noticias del sistema', NOW(), NOW()),
('Navegar', 'newpages.index', 'Lista y navega por todos los Noticias del sistema', NOW(), NOW()),
('detalle', 'newpages.show', 'muestra en detalle cada Noticias del sistema', NOW(), NOW()),
('Editar', 'newpages.edit', 'Edita cualquier dato de un Noticias del sistema', NOW(), NOW()),
('Eliminar', 'newpages.destroy', 'Eliminina cualquier Noticias de sistema', NOW(), NOW()),
('Crear', 'projects.create', 'Crea un Niveles del sistema', NOW(), NOW()),
('Navegar', 'projects.index', 'Lista y navega por todos los Niveles del sistema', NOW(), NOW()),
('detalle', 'projects.show', 'muestra en detalle cada Niveles del sistema', NOW(), NOW()),
('Editar', 'projects.edit', 'Edita cualquier dato de un Niveles del sistema', NOW(), NOW()),
('Eliminar', 'projects.destroy', 'Eliminina cualquier Niveles de sistema', NOW(), NOW()),
('Todo', 'todo.*', 'control del sistema', NOW(), NOW());


-- Asegurar motor y charset en permisos
ALTER TABLE permisos ENGINE=InnoDB;
ALTER TABLE permisos CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Asegurar motor y charset en usuarios
ALTER TABLE usuarios ENGINE=InnoDB;
ALTER TABLE usuarios CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Eliminar tabla permiso_usuario si existe
DROP TABLE IF EXISTS permiso_usuario;

-- Crear tabla permiso_usuario sin claves foráneas
CREATE TABLE permiso_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    permiso_id INT NOT NULL,
    usuario_id INT NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Agregar clave foránea permiso_id
ALTER TABLE permiso_usuario
    ADD CONSTRAINT fk_permiso FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON DELETE CASCADE ON UPDATE CASCADE;

-- Agregar clave foránea usuario_id
ALTER TABLE permiso_usuario
    ADD CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE;



    CREATE TABLE IF NOT EXISTS documentos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        categoria VARCHAR(255),
        cod VARCHAR(255) UNIQUE,
        entidad VARCHAR(255),
        descripcion MEDIUMTEXT,
        fecha_creacion DATE,
        archivo VARCHAR(255),
        nombre_documento VARCHAR(255),
        datos_documento VARCHAR(255),
        estado VARCHAR(255),
        publicar VARCHAR(255),
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS normas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        categoria VARCHAR(255),
        cod VARCHAR(255) UNIQUE,
        descripcion MEDIUMTEXT,
        fecha_creacion DATE,
        archivo VARCHAR(255),
        nombre_documento VARCHAR(255),
        estado VARCHAR(255),
        publicar VARCHAR(255),
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


    CREATE TABLE IF NOT EXISTS gestionTransparente (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        categoria VARCHAR(255),
        cod VARCHAR(255) UNIQUE,
        descripcion MEDIUMTEXT,
        fecha_creacion DATE,
        archivo VARCHAR(255),
        nombre_documento VARCHAR(255),
        estado VARCHAR(255),
        publicar VARCHAR(255),
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS nuevas_paginas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        titulo VARCHAR(255) NOT NULL,
        contenido MEDIUMTEXT NOT NULL,
        foto VARCHAR(255) NOT NULL,
        fecha DATE NOT NULL,
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS borradores (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_id INT NOT NULL,
        nombre VARCHAR(255) NOT NULL,
        lugar VARCHAR(255) NOT NULL,
        tipo VARCHAR(255) NOT NULL,
        foto VARCHAR(255) NOT NULL,
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


    -- Tabla roles
    DROP TABLE IF EXISTS roles;
    CREATE TABLE roles (
        id INT AUTO_INCREMENT PRIMARY KEY,              -- ID del rol
        nombre VARCHAR(255) NOT NULL UNIQUE,            -- Nombre del rol, único
        slug VARCHAR(255) NOT NULL UNIQUE,              -- Slug único del rol
        descripcion TEXT,                                -- Descripción del rol
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de actualización
        especial ENUM('acceso-total', 'sin-acceso') DEFAULT 'sin-acceso'  -- Rol con acceso total o sin acceso
    );

    INSERT INTO roles (nombre, slug, descripcion, creado_en, actualizado_en, especial)
    VALUES
    ('Admin', 'admin', 'encargado del sistema', NOW(), NOW(), 'acceso-total'),
    ('Documentos', 'documentos', 'sube documentos', NOW(), NOW(), 'sin-acceso');


    -- Tabla rol_usuario
    DROP TABLE IF EXISTS rol_usuario;
    CREATE TABLE rol_usuario (
        id INT AUTO_INCREMENT PRIMARY KEY,            -- ID del rol-usuario
        rol_id INT NOT NULL,                          -- ID del rol
        usuario_id INT NOT NULL,                      -- ID del usuario
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
        FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE,   -- Relación con la tabla roles
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE   -- Relación con la tabla usuarios
    );

    INSERT INTO rol_usuario (rol_id, usuario_id, creado_en, actualizado_en)
    VALUES
    (1, 1, NOW(), NOW());


    -- Tabla permiso_rol
    DROP TABLE IF EXISTS permiso_rol;
    CREATE TABLE permiso_rol (
        id INT AUTO_INCREMENT PRIMARY KEY,            -- ID del permiso-rol
        permiso_id INT NOT NULL,                      -- ID del permiso
        rol_id INT NOT NULL,                          -- ID del rol
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
        FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON DELETE CASCADE,   -- Relación con la tabla permisos
        FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE   -- Relación con la tabla roles
    );

    INSERT INTO permiso_rol (permiso_id, rol_id, creado_en, actualizado_en)
    VALUES
    (36, 1, NOW(), NOW());


    -- Tabla clases
    DROP TABLE IF EXISTS clases;
    CREATE TABLE clases (
        id INT AUTO_INCREMENT PRIMARY KEY,  -- ID de la clase
        nombre_clase VARCHAR(255) NOT NULL, -- Nombre de la clase
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
    );

    INSERT INTO clases (id, nombre_clase, creado_en, actualizado_en) VALUES
    (1, 'ELECTOS', NOW(), NOW()),
    (2, 'LIBRE NOMBRAMIENTOS', NOW(), NOW()),
    (3, 'S/N', NOW(), NOW());



    -- Tabla salcats
    DROP TABLE IF EXISTS salcats;

    CREATE TABLE salcats (
        id INT AUTO_INCREMENT PRIMARY KEY,
        categoria VARCHAR(255) NOT NULL,
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    INSERT INTO salcats (id, categoria, creado_en, actualizado_en) VALUES
    (1, 'SUPERIOR', NOW(), NOW()),
    (2, 'EJECUTIVA', NOW(), NOW()),
    (3, 'OPERATIVO', NOW(), NOW());



    -- Tabla clases (necesaria para la tabla salarios, crea esta tabla o ajusta según tu base)
    DROP TABLE IF EXISTS clases;

    CREATE TABLE clases (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_clase VARCHAR(255) NOT NULL,
        descripcion TEXT
    );

    -- Aquí puedes insertar algunas clases ejemplo si quieres:
    INSERT INTO clases (nombre_clase, descripcion) VALUES
    ('Clase A', 'Descripción de clase A'),
    ('Clase B', 'Descripción de clase B');



    -- Tabla salarios
    DROP TABLE IF EXISTS salarios;

    CREATE TABLE salarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        salcat_id INT NOT NULL,
        clase_id INT NOT NULL,
        nivel_sueldo VARCHAR(255) NOT NULL,
        denominacion VARCHAR(255) NOT NULL,
        nro_item INT NOT NULL,
        sueldo_mensual DOUBLE NOT NULL,
        sueldo_total DOUBLE NOT NULL,
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (salcat_id) REFERENCES salcats(id) ON DELETE CASCADE,
        FOREIGN KEY (clase_id) REFERENCES clases(id) ON DELETE CASCADE
    );

    CREATE INDEX idx_salcat_id ON salarios(salcat_id);
    CREATE INDEX idx_clase_id ON salarios(clase_id);



    -- Tabla turismo
    DROP TABLE IF EXISTS turismo;

    CREATE TABLE turismo (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_destino VARCHAR(255) NOT NULL,
        descripcion TEXT NOT NULL,
        tipo_destino VARCHAR(255) NOT NULL,
        actividades_disponibles TEXT NOT NULL,
        ubicacion VARCHAR(255) NOT NULL,
        contacto VARCHAR(255),
        enlace_web VARCHAR(255),
        imagen_url VARCHAR(255),
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE INDEX idx_tipo_destino ON turismo(tipo_destino);



    -- Tabla cultura
    DROP TABLE IF EXISTS cultura;

    CREATE TABLE cultura (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre_actividad VARCHAR(255) NOT NULL,
        descripcion TEXT NOT NULL,
        tipo_actividad VARCHAR(255) NOT NULL,
        fecha_inicio DATE NOT NULL,
        fecha_fin DATE,
        ubicacion VARCHAR(255) NOT NULL,
        contacto VARCHAR(255),
        enlace_web VARCHAR(255),
        imagen_url VARCHAR(255),
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE INDEX idx_tipo_actividad ON cultura(tipo_actividad);



    -- Tabla consultas
    DROP TABLE IF EXISTS consultas;

    CREATE TABLE consultas (
        cod_cons INT(11) NOT NULL AUTO_INCREMENT,
        consulta TEXT DEFAULT NULL,
        respuesta_consulta TEXT DEFAULT NULL,
        PRIMARY KEY (cod_cons)
    ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    LOCK TABLES consultas WRITE;
    INSERT INTO consultas VALUES
    (1, 'hola', 'hola, en que puedo ayudarte'),
    (2, 'como estas', 'estoy bien y tu'),
    (3, 'yo estoy bien', 'que bien me alegra escuchar que estes bien'),
    (4, 'cual es tu nombre', 'mi nombre es chatbot GAMCH'),
    (5, '', 'en que mas podria ayudarte'),
    (6, 'Elije una de las opciones en las que te podria ayudar', ''),
    (7, 'quisiera mas informacion sobre el centro de salud', 'le pido que especifique su consulta'),
    (8, 'como te llamas', 'me llamo chatbot GAMCH'),
    (9, 'cual es tu nombre', 'me llamo chatbot cala cala'),
    (10, 'me podrias dar los horarios de atencion', 'los horarios de atencion son por la mañana desde las 8:00 a 12:00 y por la tarde de 14:00 a 18:00'),
    (11, 'como te encuentras', 'yo estoy bien'),
    (12, 'en que lugar se encuentra la ciudad de challapata', 'la ubicacion esta en Challapata'),
    (13, 'cuantos años tienes', 'No se sabe mi edad porque soy un chatbot'),
    (14, 'en donde vives', 'soy parte de la alcaldia de challapata'),
    (15, 'eres persona', 'soy una ia'),
    (16, 'quien te creo', 'fui creado en la alcaldia de challapata'),
    (17, 'tiene mujer o esposa', 'no tengo respuesta para esa pregunta'),
    (18, 'donde te encuentras', 'estoy ubicado en la alcaldia de challapata'),
    (19, 'que tecnologias se uso para tu creacion', 'no tengo una respuesta para esa pregunta'),
    (20, 'que servicios brindan en la alcandia', 'tenemos los servicios de pagos de impuestos inmubiliarios, pago de vehiculos, compra de terreno en el cementerio, para mas informacion preguntar directamente en la alcaldia de challapata'),
    (21, 'cuantas secretarias se tiene en la alcaldia', 'se tiene 4 secretarias, de finanzas, de desarrollo productivo, obras publicas, y de desarrollo humano y social'),
    (22, 'cual es tu sexo', 'no tengo sexo soy una ia chatbot'),
    (23, 'donde esta ubicado la alcaldia', 'Alcaldía de Challapata, Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista'),
    (24, 'en que departamento se encuentra challapata', 'en oruro'),
    (25, 'cuantas sub alcaldias se tiene', 'se cuenta con 9 sub alcaldias');
    UNLOCK TABLES;
