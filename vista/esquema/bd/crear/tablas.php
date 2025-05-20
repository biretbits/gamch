<?php
 // Cambia esto al nombre de tu base de datos
crearDataBase();
function crearDataBase(){
  $servername = "localhost"; // Cambia esto si tu servidor MySQL está en otro lugar
  $username = "root"; // Cambia esto a tu nombre de usuario de MySQL
  $password = "1234"; // Cambia esto a tu contraseña de MySQL
  $dbname = "gamch";
  $con1 = mysqli_connect($servername,$username,$password);
  if($con1){
    echo"Conexion establecido con mysql \n";
    $con1->set_charset("utf8mb4");
  }else{
    echo $con1->error;
  }
  echo "<br>";
  $sql_drop = "DROP DATABASE IF EXISTS $dbname";
  if ($con1->query($sql_drop) === TRUE) {
      echo "Base de datos eliminada correctamente o no existía.<br>";
  } else {
      echo "Error al eliminar la base de datos: " . $con1->error . "<br>";
  }
  echo "<br>";

  $sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
  if ($con1->query($sql) === TRUE) {
    echo "Base de datos creada correctamente o ya existe.<br>";
  }else{
    echo "Ocurrio un error al crear la base de datos".$con1->error."<br>";
  }
  $conn = mysqli_connect($servername,$username,$password,$dbname);
  if($conn){
    echo"Conexion correcta con la base de datos ".$dbname;
    $conn->set_charset("utf8mb4");
  }else{
    echo $conn->error;
  }
  echo "<br>Creando las tablas<br>";
  crearTablaNiveles($conn);
  crearTablaCargos($conn);
  crearTablaEmpleados($conn);
  crearTablaUsuario($conn);
  crearTablasPermisos($conn);
  crearTablaPermisosUsuario($conn);
  crearTablaDocumentos($conn);
  crearTablaNormativas($conn);
  crearTablaGestionTransparente($conn);
  crearTablaDocumentos($conn);
  crearTablaNuevasPaginas($conn);
  crearTablaBorradores($conn);
  crearTablaRoles($conn);
  crearTablaRol_Usuario($conn);
  crearTablaPermisoRol($conn);
  crearTablaClases($conn);
  crearTablaSalcats($conn);
  crearTablaSalarios($conn);
  crearTablaTurismo($conn);
  crearTableCultura($conn);
  crearTablaConsultas($conn);

echo "Se completo las acciones correctamente, se creo todo";
  // Cerrar conexión
  $conn->close();
}

function crearTablaNiveles($conn){
    $sql = "
        DROP TABLE IF EXISTS `niveles`;
        CREATE TABLE niveles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nivel_empleado VARCHAR(255) NOT NULL,
            creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            estado CHAR(10) DEFAULT 'activo'
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    // Ejecutar la creación de tabla con multi_query
    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
            if ($conn->error) {
                echo "Error al ejecutar el SQL: " . $conn->error . "<br>";
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        echo "Error al ejecutar SQL contenidos: " . $conn->error . "<br>";
    }

    // Insertar datos
    $sql = "INSERT INTO `niveles` (id, nivel_empleado, creado_en, actualizado_en) VALUES
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
    "; // ✅ se eliminó la coma final

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.<br>";
    } else {
        echo "Error al insertar datos: " . $conn->error . "<br>";
    }
}


function crearTablaCargos($conn){
  $sql = "
    DROP TABLE IF EXISTS `cargos`;
    CREATE TABLE cargos (
        id INT AUTO_INCREMENT PRIMARY KEY, -- ID del cargo
        nivel_id INT NOT NULL, -- Relación con la tabla niveles
        cargo_empleado VARCHAR(255) NOT NULL, -- Nombre o título del cargo
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
        estado CHAR(15) DEFAULT 'activo',
        FOREIGN KEY (nivel_id) REFERENCES niveles(id) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";

  // Ejecutar la creación de la tabla
  if ($conn->multi_query($sql)) {
      do {
          if ($result = $conn->store_result()) {
              $result->free();
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al crear la tabla cargos: " . $conn->error;
  }

  // Insertar un cargo
  $sql_insert = "INSERT INTO `cargos` (nivel_id, cargo_empleado, creado_en, actualizado_en)
               VALUES
               (6, 'TECNICO DE SISTEMAS Y MANTENIMIENTO', NOW(), NOW()),
               (6, 'RESPONSABLE DE CULTURA Y TURISMO', NOW(), NOW()),
               (6, 'ENCARGADO CANAL DE TELEVISIÓN MUNICIPAL', NOW(), NOW())";


  if ($conn->query($sql_insert) === TRUE) {
      echo "Datos insertados correctamente en cargos.\n";
  } else {
      echo "Error al insertar datos en cargos: " . $conn->error;
  }
}
function crearTablaEmpleados($conn) {
    // SQL para eliminar la tabla si existe
    $sql_drop = "DROP TABLE IF EXISTS `empleados`;";

    // Ejecutar consulta de eliminación de tabla
    if ($conn->query($sql_drop) === TRUE) {
        echo "Tabla 'empleados' eliminada si existía.\n";
    } else {
        echo "Error al eliminar tabla: " . $conn->error . "\n";
    }

    // SQL para crear la nueva tabla
    $sql_create = "
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
            telefono VARCHAR(20) NOT NULL, -- Cambié a VARCHAR para el teléfono
            correo_electronico VARCHAR(255) NOT NULL UNIQUE,
            foto VARCHAR(255) DEFAULT 'default.jpg',
            creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            estado CHAR(15) DEFAULT 'activo', -- Mantengo la columna 'estado' con valor por defecto
            FOREIGN KEY (nivel_id) REFERENCES niveles(id),
            FOREIGN KEY (cargo_id) REFERENCES cargos(id)
        );
    ";

    // Ejecutar consulta de creación de tabla
    if ($conn->query($sql_create) === TRUE) {
        echo "Tabla 'empleados' creada correctamente.\n";
    } else {
        echo "Error al crear tabla: " . $conn->error . "\n";
    }

    // SQL para insertar datos en la tabla empleados
    $sql_insert = "
        INSERT INTO empleados (nivel_id, cargo_id, tipo_empleado, nombre, apellido_p, apellido_m, sexo, direccion, telefono, correo_electronico, foto, creado_en, actualizado_en)
        VALUES
        (6, 1, 'normal', 'Limbert', 'Lipiri', 'Villca', 'Masculino', 'Calle La Paz entre Linarez', '63260832', 'lipiri12345678xp@gmail.com', 'default.jpg', NOW(), NOW());
    ";

    // Ejecutar la consulta de inserción
    if ($conn->query($sql_insert) === TRUE) {
        echo "Datos insertados correctamente.\n";
    } else {
        echo "Error al insertar datos: " . $conn->error . "\n";
    }
}


function crearTablaUsuario($conn){
  $sql = "DROP TABLE IF EXISTS usuarios;
    CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        empleado_id INT NOT NULL,
        usuario VARCHAR(255) NOT NULL,
        contrasena VARCHAR(255) NOT NULL,
        estado CHAR(15) DEFAULT 'activo',  -- Definido como CHAR(15) y no VARCHAR
        token_recordar VARCHAR(100) DEFAULT NULL,
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (empleado_id) REFERENCES empleados(id) ON DELETE CASCADE
    )";
  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error ta: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL contenidos: " . $conn->error;
  }
  $encoded_password1 = $conn->real_escape_string('$2y$10$HcDmz5/npUWmiwxbW0QK8.fp2fvu0xcbAU8McwvvJDRBf29TvuroS');
    // Insertar datos en la tabla
    $sql = "INSERT INTO `usuarios` (empleado_id,usuario,contrasena,creado_en,actualizado_en) VALUES
    (1,'admin','$encoded_password1',NOW(),NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.\n";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}
function crearTablasPermisos($conn){
  // SQL para crear la tabla
  $sql = "
  DROP TABLE IF EXISTS permisos;

  CREATE TABLE permisos (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(255) NOT NULL,
      slug VARCHAR(255) NOT NULL UNIQUE,
      descripcion TEXT,
      creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  );
  ";

  // Ejecutar la consulta para crear la tabla
  if ($conn->multi_query($sql)) {
      do {
          if ($result = $conn->store_result()) {
              $result->free();
          }
      } while ($conn->more_results() && $conn->next_result());

      echo "Tabla creada correctamente.<br>";
  } else {
      echo "Error al crear la tabla: " . $conn->error . "<br>";
  }

  $permissions = [
      ['Crear', 'users.create', 'Crea Usuarios para la administracion del sistema'],
      ['Navegar', 'users.index', 'Lista y navega por todos los usuarios del sistema'],
      ['detalle', 'users.show', 'muestra en detalle cada usuario del sistema'],
      ['Editar', 'users.edit', 'Edita cualquier dato de un usuario del sistema'],
      ['Eliminar', 'users.destroy', 'Eliminina cualquier usuario de sistema'],
      ['Crear', 'roles.create', 'Crea un rol del sistema'],
      ['Navegar', 'roles.index', 'Lista y navega por todos los roles del sistema'],
      ['detalle', 'roles.show', 'muestra en detalle cada rol del sistema'],
      ['Editar', 'roles.edit', 'Edita cualquier dato de un rol del sistema'],
      ['Eliminar', 'roles.destroy', 'Eliminina cualquier rol de sistema'],
      ['Crear', 'doc.create', 'Crea un document del sistema'],
      ['Navegar', 'doc.index', 'Lista y navega por todos los documents del sistema'],
      ['detalle', 'doc.show', 'muestra en detalle cada document del sistema'],
      ['Editar', 'doc.edit', 'Edita cualquier dato de un document del sistema'],
      ['Eliminar', 'doc.destroy', 'Eliminina cualquier document de sistema'],
      ['Crear', 'employees.create', 'Crea un Empleados del sistema'],
      ['Navegar', 'employees.index', 'Lista y navega por todos los Empleados del sistema'],
      ['detalle', 'employees.show', 'muestra en detalle cada Empleados del sistema'],
      ['Editar', 'employees.edit', 'Edita cualquier dato de un Empleados del sistema'],
      ['Eliminar', 'employees.destroy', 'Eliminina cualquier Empleados de sistema'],
      ['Crear', 'salaries.create', 'Crea un Salarios del sistema'],
      ['Navegar', 'salaries.index', 'Lista y navega por todos los Salarios del sistema'],
      ['detalle', 'salaries.show', 'muestra en detalle cada Salarios del sistema'],
      ['Editar', 'salaries.edit', 'Edita cualquier dato de un Salarios del sistema'],
      ['Eliminar', 'salaries.destroy', 'Eliminina cualquier Salarios de sistema'],
      ['Crear', 'newpages.create', 'Crea un Noticias del sistema'],
      ['Navegar', 'newpages.index', 'Lista y navega por todos los Noticias del sistema'],
      ['detalle', 'newpages.show', 'muestra en detalle cada Noticias del sistema'],
      ['Editar', 'newpages.edit', 'Edita cualquier dato de un Noticias del sistema'],
      ['Eliminar', 'newpages.destroy', 'Eliminina cualquier Noticias de sistema'],
      ['Crear', 'projects.create', 'Crea un Niveles del sistema'],
      ['Navegar', 'projects.index', 'Lista y navega por todos los Niveles del sistema'],
      ['detalle', 'projects.show', 'muestra en detalle cada Niveles del sistema'],
      ['Editar', 'projects.edit', 'Edita cualquier dato de un Niveles del sistema'],
      ['Eliminar', 'projects.destroy', 'Eliminina cualquier Niveles de sistema'],
      ['Todo', 'todo.*', 'control del sistema'],
  ];

  foreach ($permissions as $permission) {
      $sql = "INSERT INTO `permisos` (nombre, slug, descripcion, creado_en, actualizado_en) VALUES
              ('{$permission[0]}', '{$permission[1]}', '{$permission[2]}', NOW(), NOW())";

      if ($conn->query($sql) === TRUE) {
          echo "Permiso '{$permission[0]}' insertado correctamente.<br>";
      } else {
          echo "Error al insertar el permiso '{$permission[0]}': " . $conn->error . "<br>";
      }
  }
}



function crearTablaPermisosUsuario($conn){
  // Eliminar la tabla si ya existe
  $sql = "CREATE TABLE IF NOT EXISTS `permiso_usuario` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `permiso_id` INT NOT NULL,
    `usuario_id` INT NOT NULL,
    `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`permiso_id`) REFERENCES `permisos`(`id`),
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
 ) ENGINE=InnoDB;";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }
}

function crearTablaDocumentos($conn){
  // Eliminar la tabla si ya existe
  $sql = "CREATE TABLE IF NOT EXISTS `documentos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT NOT NULL,
    `categoria` VARCHAR(255),
    `cod` VARCHAR(255) UNIQUE,
    `entidad` VARCHAR(255),
    `descripcion` MEDIUMTEXT,
    `fecha_creacion` DATE,
    `archivo` VARCHAR(255),
    `nombre_documento` VARCHAR(255),
    `datos_documento` VARCHAR(255),
    `estado` VARCHAR(255),
    `publicar` VARCHAR(255),
    `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
  ) ENGINE=InnoDB;";if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

}


function crearTablaNormativas($conn){
  // Eliminar la tabla si ya existe
  $sql = "CREATE TABLE IF NOT EXISTS `normas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT NOT NULL,
    `categoria` VARCHAR(255),
    `cod` VARCHAR(255) UNIQUE,
    `descripcion` MEDIUMTEXT,
    `fecha_creacion` DATE,
    `archivo` VARCHAR(255),
    `nombre_documento` VARCHAR(255),
    `estado` VARCHAR(255),
    `publicar` VARCHAR(255),
    `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
  ) ENGINE=InnoDB;";if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }
}


function crearTablaGestionTransparente($conn){
  // Eliminar la tabla si ya existe
  $sql = "CREATE TABLE IF NOT EXISTS `gestionTransparente` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT NOT NULL,
    `categoria` VARCHAR(255),
    `cod` VARCHAR(255) UNIQUE,
    `descripcion` MEDIUMTEXT,
    `fecha_creacion` DATE,
    `archivo` VARCHAR(255),
    `nombre_documento` VARCHAR(255),
    `estado` VARCHAR(255),
    `publicar` VARCHAR(255),
    `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
  ) ENGINE=InnoDB;";if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }
}

function crearTablaNuevasPaginas($conn){
  // Eliminar la tabla si ya existe
  $sql = "CREATE TABLE IF NOT EXISTS `nuevas_paginas` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `usuario_id` INT NOT NULL,
      `titulo` VARCHAR(255) NOT NULL,
      `contenido` MEDIUMTEXT NOT NULL,
      `foto` VARCHAR(255) NOT NULL,
      `fecha` DATE NOT NULL,
      `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
  ) ENGINE=InnoDB;";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

}

function crearTablaBorradores($conn){
  // Eliminar la tabla si ya existe

  $sql = "CREATE TABLE IF NOT EXISTS `borradores` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `usuario_id` INT NOT NULL,
      `nombre` VARCHAR(255) NOT NULL,
      `lugar` VARCHAR(255) NOT NULL,
      `tipo` VARCHAR(255) NOT NULL,
      `foto` VARCHAR(255) NOT NULL,
      `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      `actualizado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`)
  ) ENGINE=InnoDB;";

  if (!$conn->query($sql)) {
      die("Error al crear la tabla: " . $conn->error);
  }

}

function crearTablaRoles($conn){
  $sql = "
      DROP TABLE IF EXISTS roles;
      CREATE TABLE roles (
          id INT AUTO_INCREMENT PRIMARY KEY,              -- ID del rol
          nombre VARCHAR(255) NOT NULL UNIQUE,            -- Nombre del rol, único
          slug VARCHAR(255) NOT NULL UNIQUE,              -- Slug único del rol
          descripcion TEXT,                              -- Descripción del rol
          creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Fecha de creación
          actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Fecha de actualización
          especial ENUM('acceso-total', 'sin-acceso') DEFAULT 'sin-acceso'  -- Rol con acceso total o sin acceso
      );
  ";

  // Ejecutar consulta de creación de tabla
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error al ejecutar SQL: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }

  // Insertar datos en la tabla
  $sql = "INSERT INTO roles (nombre, slug, descripcion, creado_en, actualizado_en, especial)
        VALUES
        ('Admin', 'admin', 'encargado del sistema', NOW(), NOW(), 'acceso-total'),
        ('Documentos', 'documentos', 'sube documentos', NOW(), NOW(), 'sin-acceso')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.\n";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

function crearTablaRol_Usuario($conn){

  $sql = "
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
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error ta: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL contenidos: " . $conn->error;
  }  // Insertar datos en la tabla
  $sql = "INSERT INTO rol_usuario (rol_id, usuario_id, creado_en, actualizado_en)
        VALUES
        (1, 1, NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.\n";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

function crearTablaPermisoRol($conn){
  $sql = "
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
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error ta: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL contenidos: " . $conn->error;
  }  // Insertar datos en la tabla
  $sql = "INSERT INTO permiso_rol(permiso_id, rol_id, creado_en, actualizado_en)
        VALUES
        (36, 1, NOW(), NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.\n";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

function crearTablaClases($conn){
  // SQL para crear la tabla clases
  $sql = "
      DROP TABLE IF EXISTS clases;

      CREATE TABLE clases (
          id INT AUTO_INCREMENT PRIMARY KEY,  -- ID de la clase
          nombre_clase VARCHAR(255) NOT NULL, -- Nombre de la clase
          creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
          actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
      );
  ";

  // Ejecutar la consulta para crear la tabla
  if ($conn->multi_query($sql)) {
      do {
          if ($result = $conn->store_result()) {
              $result->free();
          }
          if ($conn->error) {
              echo "Error al crear la tabla clases: " . $conn->error . "<br>";
          }
      } while ($conn->more_results() && $conn->next_result());

      echo "Tabla 'clases' creada correctamente.<br>";
  } else {
      echo "Error al crear la tabla clases: " . $conn->error . "<br>";
  }

  // Insertar datos en la tabla clases
  $insertSQL = "
    INSERT INTO clases (id, nombre_clase, creado_en, actualizado_en) VALUES
    (1, 'ELECTOS', NOW(), NOW()),
    (2, 'LIBRE NOMBRAMIENTOS', NOW(), NOW()),
    (3, 'S/N', NOW(), NOW());
  ";

  // Ejecutar la inserción de datos
  if ($conn->query($insertSQL) === TRUE) {
      echo "Datos insertados correctamente en la tabla clases.<br>";
  } else {
      echo "Error al insertar datos en la tabla clases: " . $conn->error . "<br>";
  }
}

function crearTablaSalcats($conn){
  // SQL para crear la tabla salcatsf
  $sql = "
      DROP TABLE IF EXISTS salcats;

      CREATE TABLE salcats (
          id INT AUTO_INCREMENT PRIMARY KEY,  -- ID de la categoría salarial
          categoria VARCHAR(255) NOT NULL,    -- Nombre de la categoría salarial
          creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
          actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
      );
  ";

  // Ejecutar la consulta para crear la tabla
  if ($conn->multi_query($sql)) {
      do {
          if ($result = $conn->store_result()) {
              $result->free();
          }
          if ($conn->error) {
              echo "Error al crear la tabla salcats: " . $conn->error . "<br>";
          }
      } while ($conn->more_results() && $conn->next_result());

      echo "Tabla 'salcats' creada correctamente.<br>";
  } else {
      echo "Error al crear la tabla salcats: " . $conn->error . "<br>";
  }

  // Insertar datos en la tabla salcats
  $insertSQL = "
    INSERT INTO salcats (id, categoria, creado_en, actualizado_en) VALUES
    (1, 'SUPERIOR', NOW(), NOW()),
    (2, 'EJECUTIVA', NOW(), NOW()),
    (3, 'OPERATIVO', NOW(), NOW());
  ";

  // Ejecutar la inserción de datos
  if ($conn->query($insertSQL) === TRUE) {
      echo "Datos insertados correctamente en la tabla salcats.<br>";
  } else {
      echo "Error al insertar datos en la tabla salcats: " . $conn->error . "<br>";
  }
}
function crearTablaSalarios($conn) {
    // Crear la tabla de salarios
    $sql = "
        DROP TABLE IF EXISTS salarios;

        CREATE TABLE salarios (
            id INT AUTO_INCREMENT PRIMARY KEY,            -- ID del salario
            salcat_id INT NOT NULL,                       -- ID de la categoría de salario
            clase_id INT NOT NULL,                        -- ID de la clase
            nivel_sueldo VARCHAR(255) NOT NULL,           -- Nivel de salario
            denominacion VARCHAR(255) NOT NULL,           -- Denominación del salario
            nro_item INT NOT NULL,                        -- Número de ítem
            sueldo_mensual DOUBLE NOT NULL,               -- Sueldo mensual
            sueldo_total DOUBLE NOT NULL,                 -- Sueldo total
            creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
            actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Fecha de actualización
            FOREIGN KEY (salcat_id) REFERENCES salcats(id) ON DELETE CASCADE,  -- Relación con la tabla de categorías de salario
            FOREIGN KEY (clase_id) REFERENCES clases(id) ON DELETE CASCADE   -- Relación con la tabla de clases
        );

        -- Crear índices para las claves foráneas, para mejorar el rendimiento de las consultas.
        CREATE INDEX idx_salcat_id ON salarios(salcat_id);
        CREATE INDEX idx_clase_id ON salarios(clase_id);
    ";

    // Ejecutar la consulta para crear la tabla
    if ($conn->multi_query($sql)) {
        do {
            // Almacenar resultados si hay alguno
            if ($result = $conn->store_result()) {
                $result->free();
            }
            // Imprimir errores si los hay
            if ($conn->error) {
                echo "Error: " . $conn->error;
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        echo "Error al ejecutar el SQL: " . $conn->error;
    }
}

function crearTablaTurismo($conn){
  $sql = "
      DROP TABLE IF EXISTS turismo;

      CREATE TABLE turismo (
          id INT AUTO_INCREMENT PRIMARY KEY,            -- ID del destino turístico
          nombre_destino VARCHAR(255) NOT NULL,          -- Nombre del destino
          descripcion TEXT NOT NULL,                     -- Descripción del destino
          tipo_destino VARCHAR(255) NOT NULL,            -- Tipo de destino (ej. playa, montaña)
          actividades_disponibles TEXT NOT NULL,         -- Actividades disponibles en el destino
          ubicacion VARCHAR(255) NOT NULL,               -- Ubicación del destino
          contacto VARCHAR(255),                         -- Información de contacto
          enlace_web VARCHAR(255),                       -- URL del sitio web del destino
          imagen_url VARCHAR(255),                       -- URL de la imagen representativa del destino
          creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
          actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
      );

      -- Crear índice para mejorar el rendimiento de las consultas por tipo_destino.
      CREATE INDEX idx_tipo_destino ON turismo(tipo_destino);
  ";

  if ($conn->multi_query($sql)) {
      do {
          if ($result = $conn->store_result()) {
              $result->free();
          }
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar el SQL: " . $conn->error;
  }

}

function crearTableCultura($conn){
  $sql = "
    DROP TABLE IF EXISTS cultura;

    CREATE TABLE cultura (
        id INT AUTO_INCREMENT PRIMARY KEY,            -- ID de la actividad cultural
        nombre_actividad VARCHAR(255) NOT NULL,        -- Nombre de la actividad
        descripcion TEXT NOT NULL,                     -- Descripción de la actividad
        tipo_actividad VARCHAR(255) NOT NULL,          -- Tipo de actividad (ej. festival, exposición)
        fecha_inicio DATE NOT NULL,                    -- Fecha de inicio de la actividad
        fecha_fin DATE,                                -- Fecha de fin de la actividad
        ubicacion VARCHAR(255) NOT NULL,               -- Ubicación donde se realiza
        contacto VARCHAR(255),                         -- Información de contacto
        enlace_web VARCHAR(255),                       -- URL del sitio web relacionado con la actividad
        imagen_url VARCHAR(255),                       -- URL de la imagen representativa de la actividad
        creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Fecha de creación
        actualizado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Fecha de actualización
    );

    -- Crear índice para mejorar el rendimiento de las consultas por tipo_actividad.
    CREATE INDEX idx_tipo_actividad ON cultura(tipo_actividad);
";

if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
        if ($conn->error) {
            echo "Error: " . $conn->error;
        }
    } while ($conn->more_results() && $conn->next_result());
} else {
    echo "Error al ejecutar el SQL: " . $conn->error;
}

}


function crearTablaConsultas($conn){
  $sql = "
  DROP TABLE IF EXISTS `consultas`;
  CREATE TABLE `consultas` (
    `cod_cons` int(11) NOT NULL AUTO_INCREMENT,
    `consulta` text DEFAULT NULL,
    `respuesta_consulta` text DEFAULT NULL,
    PRIMARY KEY (`cod_cons`)
  ) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  ";

  // Ejecutar consulta
  if ($conn->multi_query($sql)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }

  // SQL para insertar datos en la tabla `consultas`
  $sql_inserts = "
  LOCK TABLES `consultas` WRITE;
  /*!40000 ALTER TABLE `consultas` DISABLE KEYS */;
  INSERT INTO `consultas` VALUES(1, 'hola', 'hola, en que puedo ayudarte');
  INSERT INTO `consultas` VALUES(2, 'como estas', 'estoy bien y tu');
  INSERT INTO `consultas` VALUES(3, 'yo estoy bien', 'que bien me alegra escuchar que estes bien');
  INSERT INTO `consultas` VALUES(4, 'cual es tu nombre', 'mi nombre es chatbot GAMCH');
  INSERT INTO `consultas` VALUES(5, '', 'en que mas podria ayudarte');
  INSERT INTO `consultas` VALUES(6, 'Elije una de las opciones en las que te podria ayudar', '');
  INSERT INTO `consultas` VALUES(7, 'quisiera mas informacion sobre el centro de salud', 'le pido que especifique su consulta');
  INSERT INTO `consultas` VALUES(8, 'como te llamas', 'me llamo chatbot GAMCH');
  INSERT INTO `consultas` VALUES(9, 'cual es tu nombre', 'me llamo chatbot cala cala');
  INSERT INTO `consultas` VALUES(10, 'me podrias dar los horarios de atencion', 'los horarios de atencion son por la mañana desde las 8:00 a 12:00 y por la tarde de 14:00 a 18:00');
  INSERT INTO `consultas` VALUES(11, 'como te encuentras', 'yo estoy bien');
  INSERT INTO `consultas` VALUES(12, 'en que lugar se encuentra la ciudad de challapata', 'la ubicacion esta en Challapata');
  INSERT INTO `consultas` VALUES(13, 'cuantos años tienes', 'No se sabe mi edad porque soy un chatbot');
  INSERT INTO `consultas` VALUES(14, 'en donde vives', 'soy parte de la alcaldia de challapata');
  INSERT INTO `consultas` VALUES(15, 'eres persona', 'soy una ia');
  INSERT INTO `consultas` VALUES(16, 'quien te creo', 'fui creado en la alcaldia de challapata');
  INSERT INTO `consultas` VALUES(17, 'tiene mujer o esposa', 'no tengo respuesta para esa pregunta');
  INSERT INTO `consultas` VALUES(18, 'donde te encuentras', 'estoy ubicado en la alcaldia de challapata');
  INSERT INTO `consultas` VALUES(19, 'que tecnologias se uso para tu creacion', 'no tengo una respuesta para esa pregunta');

  INSERT INTO `consultas` VALUES(20, 'que servicios brindan en la alcandia', 'tenemos los servicios de pagos de impuestos inmubiliarios, pago de vehiculos, compra de terreno en el cementerio, para mas informacion preguntar directamente en la alcaldia de challapata');
  INSERT INTO `consultas` VALUES(21, 'cuantas secretarias se tiene en la alcaldia', 'se tiene 4 secretarias, de finanzas, de desarrollo productivo, obras publicas, y de desarrollo humano y social');
  INSERT INTO `consultas` VALUES(22, 'cual es tu sexo', 'no tengo sexo soy una ia chatbot');
  INSERT INTO `consultas` VALUES(23, 'donde esta ubicado la alcaldia', 'Alcaldía de Challapata, Plaza Eduardo Avaroa, Esquina Av. Mariano Baptista');
  INSERT INTO `consultas` VALUES(24, 'en que departamento se encuentra challapata', 'en oruro');
  INSERT INTO `consultas` VALUES(25, 'cuantas sub alcaldias se tiene', 'se cuenta con 9 sub alcaldias');
  /*!40000 ALTER TABLE `consultas` ENABLE KEYS */;
  UNLOCK TABLES;
  ";

  // Ejecutar inserciones
  if ($conn->multi_query($sql_inserts)) {
      do {
          // almacenar resultados si hay alguno
          if ($result = $conn->store_result()) {
              $result->free();
          }
          // imprimir errores
          if ($conn->error) {
              echo "Error: " . $conn->error;
          }
      } while ($conn->more_results() && $conn->next_result());
  } else {
      echo "Error al ejecutar SQL: " . $conn->error;
  }

}

?>
