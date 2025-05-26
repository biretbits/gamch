<?php
/**
 *
 */

class Usuario
{

  public $con;  // Declarar la propiedad antes de usarla

  function __construct()
  {
      require_once("conexion.php");

      // Llamando al método Conectaras de la clase Conexion para realizar los métodos de insert, update, delete
      $co = new Conexion();
      $this->con = $co->Conectaras();  // Asignando la conexión
  }

  public function SelectPorBusqueda($buscar="",$inicioList=false,$listarDeCuanto=false) {
    // Convertir $buscar a minúsculas si está definido
      $buscar = strtolower(trim($buscar));
      // Base SQL
      $sql = "SELECT * FROM roles";
      // Parámetros dinámicos
      $tipos = '';         // Tipos para bind_param (s: string, i: integer)
      $parametros = [];    // Valores a enlazar
      if ($buscar !== "") {
        $sql .= " WHERE LOWER(nombre) LIKE ?";
        $tipos .= 's';
        $parametros[] = '%' . $buscar . '%';
      }
      $sql .= " ORDER BY id DESC";

      if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
        $sql .= " LIMIT ? OFFSET ?";
        $tipos .= 'ii';
        $parametros[] = (int)$listarDeCuanto;
        $parametros[] = (int)$inicioList;
      }
      // Preparar la consulta
      $stmt = $this->con->prepare($sql);
      // Verifica si la preparación fue exitosa
      if ($stmt === false) {
        die("Error al preparar la consulta: " . $this->con->error);
      }
      // Enlazar parámetros si existen
      if (!empty($parametros)) {
        $stmt->bind_param($tipos, ...$parametros);
      }

      // Ejecutar y obtener resultados
      $stmt->execute();
      $resul = $stmt->get_result();
      // Retornar el resultado
      return $resul;

    }


  public function validarBD($usuario) {
    $lis = "select count(*) from usuario where usuario='".$usuario."' and estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function validarBDTodo($usuario) {
    $lis = "select * from usuarios where usuario='".$usuario."' and estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function DatosEmpleado($id) {
    $lis = "select * from empleados where id = $id";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function rolePermisos($id) {
    $lis = "SELECT *
        FROM usuarios u
        JOIN rol_usuario ru ON u.id = ru.usuario_id
        JOIN roles r ON ru.rol_id = r.id
        WHERE u.id = $id";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function registrarRole($a){
    $id_usuario = $a["id"];
    if($id_usuario != ""){
      //actualizar
      $sql= "update roles set nombre='".$a["nombre"]."',slug = '".$a["slug"]."',descripcion='".$a["descripcion"]."',actualizado_en=NOW(),especial='".$a["especial"]."' where id = $id_usuario";
      $resul = $this->con->query($sql);
      return $resul;
    }else{
        //insertar datos
        $sql = "insert into roles(nombre,slug,descripcion,creado_en,actualizado_en,especial)VALUES
        ('".$a["nombre"]."','".$a["slug"]."','".$a["descripcion"]."',NOW(),NOW(),'".$a["especial"]."')";
        $resul = $this->con->query($sql);
        return $resul;
    }
  }
  public function SelectPorBusquedaU($buscar = "", $inicioList = false, $listarDeCuanto = false) {
      // Limpiar y convertir el término de búsqueda
      $buscar = strtolower(trim($buscar));

      // Base SQL
      $sql = "SELECT
          empleados.id AS empleado_id,
          empleados.nombre,
          empleados.apellido_p,
          empleados.apellido_m,
          empleados.sexo,
          empleados.direccion,
          empleados.telefono,
          empleados.correo_electronico,
          usuarios.usuario,
          usuarios.estado AS estado_usuario,
          roles.nombre AS rol_nombre,
          roles.descripcion AS rol_descripcion,
          roles.especial,
          rol_usuario.creado_en AS rol_asignado_en,
          rol_usuario.actualizado_en AS rol_actualizado_en,
          rol_usuario.id,
          rol_usuario.rol_id,
          rol_usuario.usuario_id
          FROM empleados
          INNER JOIN usuarios ON empleados.id = usuarios.empleado_id
          INNER JOIN rol_usuario ON usuarios.id = rol_usuario.usuario_id
          INNER JOIN roles ON rol_usuario.rol_id = roles.id";

      $tipos = '';         // Tipos para bind_param (s: string, i: integer)
      $parametros = [];    // Valores a enlazar

      // Filtro por búsqueda si se proporciona
      if (!empty($buscar)) {
          $sql .= " WHERE CONCAT(empleados.nombre, ' ', empleados.apellido_p, ' ', empleados.apellido_m, roles.nombre) LIKE ?";
          $tipos .= 's';
          $parametros[] = '%' . $buscar . '%';
      }

      // Ordenamiento por ID de empleado
      $sql .= " ORDER BY rol_usuario.id DESC";

      // Paginación si es válida
      if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
          $sql .= " LIMIT ? OFFSET ?";
          $tipos .= 'ii';
          $parametros[] = (int)$listarDeCuanto;
          $parametros[] = (int)$inicioList;
      }

      // Preparar la consulta
      $stmt = $this->con->prepare($sql);

      // Verifica si la preparación fue exitosa
      if ($stmt === false) {
          die("Error al preparar la consulta: " . $this->con->error);
      }

      // Enlazar parámetros si existen
      if (!empty($parametros)) {
          $stmt->bind_param($tipos, ...$parametros);
      }

      // Ejecutar y obtener resultados
      $stmt->execute();
      $resul = $stmt->get_result();

      // Retornar el resultado
      return $resul;
  }










  public function seleccionarCargos(){
    $sql = "SELECT * FROM cargo";
    $resul = $this->con->query($sql);
    return $resul;
  }
  public function seleccionarTipoUsuariosNew(){
    $sql = "SELECT * FROM tipoUsuario";
    $resul = $this->con->query($sql);
    return $resul;
  }
  public function seleccionarCargo($id_cargo){
    $sql = "SELECT * FROM cargo where id_cargo = $id_cargo";
    $resul = $this->con->query($sql);
    $re = mysqli_fetch_array($resul);
    return $re["tipo_cargo"];
  }

  public function insertarUsuario($a){
    $id_usuario = $a["id_usuario"];
    if($id_usuario != ""){

      //actualizar
      $sql='';
      $sql.= "update usuarios set usuario_nombre='".$a["nombre_usuario"]."',nombres = '".$a["nombre"]."',ap_usuario='".$a["ap"]."',
      am_usuario='".$a["am"]."',telefono_usuario='".$a["telefono"]."',direccion_usuario='".$a["direccion"]."'";
      $contrasena = $a["contrasena"];
      if($contrasena != '' || $contrasena != null){
        $contrasena=password_hash($a["contrasena"], PASSWORD_DEFAULT);
        $sql.=",contrasena='$contrasena'";
      }
      $sql.=",tipo_usuario='".$a["tipo_usuario"]."',id_cargo=".$a["cargo"]." where id_usuario = $id_usuario";
      $resul = $this->con->query($sql);
      return $resul;
    }else{
      $contrasena = $a["contrasena"];
      if($contrasena == ''){

      }else if($contrasena != ''){
        $contrasena=password_hash($a["contrasena"], PASSWORD_DEFAULT);
      }
			  //insertar datos
        $sql = "insert into usuarios(usuario_nombre,nombres,ap_usuario,am_usuario,telefono_usuario,direccion_usuario,contrasena,tipo_usuario,id_cargo)VALUES
        ('".$a["nombre_usuario"]."','".$a["nombre"]."','".$a["ap"]."','".$a["am"]."','".$a["telefono"]."','".$a["direccion"]."','$contrasena'
        ,'".$a["tipo_usuario"]."',".$a["cargo"].")";
        $resul = $this->con->query($sql);
        return $resul;
    }
  }

    public function seleccionarTipoUsuario($id_usuario){
      $sql = "SELECT * FROM tipoUsuario where id_tipo = $id_usuario";
      $resul = $this->con->query($sql);
      $re = mysqli_fetch_array($resul);
      return $re["tipo_usuario"];
    }

  public function insertarUpdateUsuarios($usuario,$nombre_usuario,$ap_usuario,$am_usuario,$telefono_usuario,$direccion_usuario,$profesion_usuario,
  $especialidad_usuario,$tipo_usuario,$contraseña_usuario,$ci,$cod_usuario,$accion){
    if($accion == 1){

      $sql = "update usuario set ci_usuario = $ci,usuario='$usuario',nombre_usuario='$nombre_usuario',ap_usuario='$ap_usuario',
      am_usuario='$am_usuario',telefono_usuario=$telefono_usuario,direccion_usuario='$direccion_usuario',profesion_usuario='$profesion_usuario',
      especialidad_usuario='$especialidad_usuario',tipo_usuario='$tipo_usuario'";
      if($contraseña_usuario != ""){
        $contraseña_usuario=password_hash($contraseña_usuario, PASSWORD_DEFAULT);
        $sql.=",contrasena_usuario='$contraseña_usuario'";
      }
      $sql.= " where cod_usuario = $cod_usuario";
    }else{
      $contraseña_usuario=password_hash($contraseña_usuario, PASSWORD_DEFAULT);
      $sql = "insert into usuario(ci_usuario,usuario,nombre_usuario,ap_usuario,am_usuario,fecha_nac_usuario,edad_usuario,telefono_usuario,direccion_usuario,profesion_usuario,
      especialidad_usuario,tipo_usuario,contrasena_usuario,cod_cds,estado)values($ci,'$usuario','$nombre_usuario','$ap_usuario'
      ,'$am_usuario','',0,$telefono_usuario,'$direccion_usuario','$profesion_usuario',
      '$especialidad_usuario','$tipo_usuario','$contraseña_usuario',1,'activo')";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function desactivarUsuario($cod_usuario,$accion){
    //echo $accion."      ".$cod_usuario;
    if($accion == 'activo'){
        $sql = "update usuarios set estado = 'desactivo' where id_usuario=".$cod_usuario;
    }else{
        $sql = "update usuarios set estado = 'activo' where id_usuario=".$cod_usuario;
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function selectDatosUsuario($cod_usuario){
    $sql = "select *from usuario where cod_usuario=".$cod_usuario;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
  public function selectDatosUsuario12($cod_usuario){
    $sql = "select *from usuario where cod_usuario=".$cod_usuario;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    $a = [];
    while ($fi = mysqli_fetch_array($resul)) {
      $datos = [
        "cod_usuario" => $fi["cod_usuario"],
        "nombre_usuario" => $fi["nombre_usuario"],
        "ap_usuario" => $fi["ap_usuario"],
        "am_usuario" => $fi["am_usuario"],
        "cod_usuario" => $fi["cod_usuario"],
        "edad_usuario"=>$fi["edad_usuario"]
      ];
      $a[] = $datos;
    }
    return $a;

    mysqli_close($this->con);
  }

  public function showTables(){
    $tables = array();
    $result = $this->con->query("SHOW TABLES");
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
    return $tables;

    mysqli_close($this->con);
  }

  public function seleccionarTablas($tabla){
    $sql = "select *from $tabla";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    //mysqli_close($this->con);
  }
  public function CrearTabla($table){
    $sql = "SHOW CREATE TABLE $table";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
  }


  public function ImportarYcrearBd($ruta) {
      // Obtiene la información de la base de datos
      $conn=new Conexion();
      $dBD = $conn->getDatabase();
      $database = $dBD['database'];

      // Crear la base de datos si no existe
      $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS `$database`";
      if ($this->con->query($sqlCreateDb) === TRUE) {
          // Selecciona la base de datos recién creada
          $this->con->select_db($database);

          // Verifica si el archivo existe y es legible
          if (file_exists($ruta) && is_readable($ruta)) {
              // Lee el contenido del archivo SQL
              $sql = file_get_contents($ruta);

              // Ejecuta el archivo SQL
              if ($this->con->multi_query($sql)) {
                  do {
                      // Almacena resultados para evitar errores de lectura
                      if ($result = $this->con->store_result()) {
                          $result->free();
                      }
                  } while ($this->con->more_results() && $this->con->next_result());

                  echo "correcto";
              } else {
                  echo "Error en la importación: " . $this->con->error;
              }
          } else {
              echo "El archivo no se encuentra o no es legible.";
          }
      } else {
          echo "Error al crear la base de datos: " . $this->con->error;
      }
  }

  public function seleccionarAdminInicioSesion(){
    $sql = "select *from usuario where tipo_usuario='admin'";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
  }

  public function seleccionarSessionesTabla(){
    $sql = "select COUNT(*) as contar from sessiones";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
  }

  public function CambiarEstadoAdminAcceso($activo){
    $sql = "update usuario set control_acceso='$activo' where tipo_usuario='admin'";
    $resul = $this->con->query($sql);
    // Retornar el resultado
  }

  public function insertarDatosSession($session_id,$session_start,$cod_usuario,$usuario,
  $nombre_usuario,$ap_usuario,$am_usuario,$tipo_usuario,$session_end){

    // Construir la consulta
    $sql = '';
    $sql = "INSERT INTO sessiones (
            session_id, cod_usuario, usuario, nombre_usuario, ap_usuario, am_usuario, tipo_usuario, session_start, session_end
        ) VALUES (
            '$session_id', $cod_usuario, '$usuario', '$nombre_usuario', '$ap_usuario', '$am_usuario', '$tipo_usuario', NOW(), '$session_end'
        )
        ON DUPLICATE KEY UPDATE
            cod_usuario = $cod_usuario,
            usuario = '$usuario',
            nombre_usuario = '$nombre_usuario',
            ap_usuario = '$ap_usuario',
            am_usuario = '$am_usuario',
            tipo_usuario = '$tipo_usuario',
            session_start = NOW(),
            session_end = '$session_end'";


    $resul = $this->con->query($sql);
    // Retornar el resultado
  }

  public function seleccionarSessiones(){
    $sql = "select *from sessiones";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
  }

  public function eliminarSession($session_id){
    $sql = "update sessiones set session_end = 'cerrar' where session_id='$session_id'";
    $resul = $this->con->query($sql);
  }

  public function seleccionarSessionID($cod_usuario,$usuario,$session_id){
    $sql = "select *from sessiones where cod_usuario=$cod_usuario and usuario='$usuario' and session_id='$session_id'";
    $resul = $this->con->query($sql);
    return $resul;
  }

  public function CambiarElControlAcceso($control){
    $sql = "update usuario set configControlAcceso='$control',control_acceso='desactivo',notificacionEjecutar='si' where tipo_usuario = 'admin'";
    if($control == 'si'){//si el admin pone si entoces se tiene que cerrar todas las sessiones e ingresar de nuevo
      $sql2="update sessiones set session_end='cerrar'";
      $this->con->query($sql2);
    }
    $resul = $this->con->query($sql);
  }

  public function cambiaraNoLaNotificacion($si){
    $sql = "update usuario set notificacionEjecutar='$si' where tipo_usuario = 'admin'";
    $resul = $this->con->query($sql);
  }


    public function SelectPorBusquedaPer($buscar="",$inicioList=false,$listarDeCuanto=false) {
      // Convertir $buscar a minúsculas si está definido
        $buscar = strtolower(trim($buscar));
        // Base SQL
        $sql = "SELECT * FROM permisos";
        // Parámetros dinámicos
        $tipos = '';         // Tipos para bind_param (s: string, i: integer)
        $parametros = [];    // Valores a enlazar
        if ($buscar !== "") {
          $sql .= " WHERE LOWER(nombre) LIKE ?";
          $tipos .= 's';
          $parametros[] = '%' . $buscar . '%';
        }
        $sql .= " ORDER BY id DESC";

        if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
          $sql .= " LIMIT ? OFFSET ?";
          $tipos .= 'ii';
          $parametros[] = (int)$listarDeCuanto;
          $parametros[] = (int)$inicioList;
        }
        // Preparar la consulta
        $stmt = $this->con->prepare($sql);
        // Verifica si la preparación fue exitosa
        if ($stmt === false) {
          die("Error al preparar la consulta: " . $this->con->error);
        }
        // Enlazar parámetros si existen
        if (!empty($parametros)) {
          $stmt->bind_param($tipos, ...$parametros);
        }

        // Ejecutar y obtener resultados
        $stmt->execute();
        $resul = $stmt->get_result();
        // Retornar el resultado
        return $resul;

      }

      public function registrarPermisos($a){
        $id_usuario = $a["id"];
        if($id_usuario != ""){
          //actualizar
          $sql= "update permisos set nombre='".$a["nombre"]."',slug = '".$a["slug"]."',descripcion='".$a["descripcion"]."',actualizado_en=NOW() where id = $id_usuario";
          $resul = $this->con->query($sql);
          return $resul;
        }else{
            //insertar datos
            $sql = "insert into permisos(nombre,slug,descripcion,creado_en,actualizado_en)VALUES
            ('".$a["nombre"]."','".$a["slug"]."','".$a["descripcion"]."',NOW(),NOW())";
            $resul = $this->con->query($sql);
            return $resul;
        }
      }
      public function SelectPorBusquedaPerUser($buscar = "", $inicioList = false, $listarDeCuanto = false) {
          $buscar = strtolower(trim($buscar));

          // Base SQL con INNER JOIN
          $sql = "SELECT
                    permiso_usuario.*,
                    permisos.nombre AS permiso_nombre,
                    permisos.slug,
                    permisos.descripcion,
                    empleados.nombre AS usuario_nombre,
                    empleados.apellido_p,
                    empleados.apellido_m,
                    usuarios.usuario
                  FROM permiso_usuario
                  INNER JOIN permisos ON permiso_usuario.permiso_id = permisos.id
                  INNER JOIN usuarios ON permiso_usuario.usuario_id = usuarios.id
                  INNER JOIN empleados ON usuarios.empleado_id = empleados.id";

          // Parámetros dinámicos
          $tipos = '';
          $parametros = [];

          if ($buscar !== "") {
              $sql .= " WHERE LOWER(empleados.nombre) LIKE ?
                        OR LOWER(empleados.apellido_p) LIKE ?
                        OR LOWER(empleados.apellido_m) LIKE ?";
              $tipos .= 'sss';  // Tres parámetros de tipo string
              $parametros[] = '%' . $buscar . '%';
              $parametros[] = '%' . $buscar . '%';
              $parametros[] = '%' . $buscar . '%';
          }

          $sql .= " ORDER BY permiso_usuario.id DESC";

          // Paginación
          if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
              $sql .= " LIMIT ? OFFSET ?";
              $tipos .= 'ii';  // Dos parámetros de tipo integer para paginación
              $parametros[] = (int)$listarDeCuanto;
              $parametros[] = (int)$inicioList;
          }

          // Preparar la consulta
          $stmt = $this->con->prepare($sql);

          if ($stmt === false) {
              die("Error al preparar la consulta: " . $this->con->error);
          }

          if (!empty($parametros)) {
              $stmt->bind_param($tipos, ...$parametros);  // Enlazar los parámetros
          }

          $stmt->execute();
          $resul = $stmt->get_result();

          return $resul;
      }

    public function buscarInformacion($buscar) {
      // Convierte la búsqueda a minúsculas
      $min = strtolower($buscar);

      // SQL con INNER JOIN entre usuarios y empleados, solo seleccionando los campos requeridos
      $sql = "SELECT
                  u.id AS usuario_id,
                  u.usuario,
                  e.id AS empleado_id,
                  CONCAT(e.nombre, ' ', e.apellido_p, ' ', e.apellido_m) AS usuario_nombre_completo
              FROM usuarios AS u
              INNER JOIN empleados AS e ON u.empleado_id = e.id
              WHERE u.estado = 'activo'
              AND (
                  LOWER(e.nombre) LIKE '%$min%'
                  OR LOWER(e.apellido_p) LIKE '%$min%'
                  OR LOWER(e.apellido_m) LIKE '%$min%'
                  OR LOWER(u.usuario) LIKE '%$min%'
              )
              LIMIT 5 OFFSET 0";  // Puedes ajustar el OFFSET si lo necesitas

      // Ejecutar la consulta
      $resul = $this->con->query($sql);

      return $resul;
  }


      public function buscarInformacionPermisos($buscar) {
        // Convierte la búsqueda a minúsculas
        $min = strtolower($buscar);

        // SQL con INNER JOIN entre usuarios y empleados, solo seleccionando los campos requeridos
        $sql = "SELECT
                *
                FROM permisos
                WHERE  (
                    LOWER(nombre) LIKE '%$min%'
                    OR LOWER(slug) LIKE '%$min%'
                )
                LIMIT 5 OFFSET 0";  // Puedes ajustar el OFFSET si lo necesitas

        // Ejecutar la consulta
        $resul = $this->con->query($sql);

        return $resul;
    }


          public function registrarPermisosUsuarios($a){
            $id_usuario = $a["id"];
            if($id_usuario != ""){
              //actualizar
              $sql= "update permiso_usuario set permiso_id='".$a["id_permiso"]."',usuario_id = '".$a["id_usuario"]."',actualizado_en=NOW() where id = $id_usuario";
              $resul = $this->con->query($sql);
              return $resul;
            }else{
                //insertar datos
                $sql = "insert into permiso_usuario(permiso_id,usuario_id,creado_en,actualizado_en)VALUES
                ('".$a["id_permiso"]."','".$a["id_usuario"]."',NOW(),NOW())";
                $resul = $this->con->query($sql);
                return $resul;
            }
          }

          public function SelectPorBusquedaListarUsuario($buscar = "", $inicioList = false, $listarDeCuanto = false) {
              $buscar = strtolower(trim($buscar));

              $sql = "SELECT
              usuarios.id AS usuario_id,
           usuarios.usuario,
           usuarios.contrasena,
           usuarios.estado AS usuario_estado,
           usuarios.token_recordar,
           usuarios.creado_en AS usuario_creado,
           usuarios.actualizado_en AS usuario_actualizado,
           usuarios.empleado_id,

           empleados.id AS empleado_id,
           empleados.nombre,
           empleados.apellido_p,
           empleados.apellido_m,
           empleados.tipo_empleado,
           empleados.sexo,
           empleados.direccion,
           empleados.telefono,
           empleados.correo_electronico,
           empleados.foto,
           empleados.estado AS empleado_estado,
           empleados.creado_en AS empleado_creado,
           empleados.actualizado_en AS empleado_actualizado
                      FROM usuarios
                      INNER JOIN empleados ON usuarios.empleado_id = empleados.id";

              $tipos = '';
              $parametros = [];

              if ($buscar !== "") {
                  $sql .= " WHERE LOWER(usuarios.usuario) LIKE ?
                            OR LOWER(empleados.nombre) LIKE ?
                            OR LOWER(empleados.apellido_p) LIKE ?
                            OR LOWER(empleados.apellido_m) LIKE ?";
                  $tipos .= 'ssss';
                  $parametros[] = '%' . $buscar . '%';
                  $parametros[] = '%' . $buscar . '%';
                  $parametros[] = '%' . $buscar . '%';
                  $parametros[] = '%' . $buscar . '%';
              }

              $sql .= " ORDER BY usuarios.id DESC";

              if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
                  $sql .= " LIMIT ? OFFSET ?";
                  $tipos .= 'ii';
                  $parametros[] = (int)$listarDeCuanto;
                  $parametros[] = (int)$inicioList;
              }

              $stmt = $this->con->prepare($sql);
              if ($stmt === false) {
                  die("Error al preparar la consulta: " . $this->con->error);
              }

              if (!empty($parametros)) {
                  $stmt->bind_param($tipos, ...$parametros);
              }

              $stmt->execute();
              $resul = $stmt->get_result();
              return $resul;
          }

          public function buscarEmpleadoNuevo($buscar){
            $min = strtolower($buscar);

            // SQL con INNER JOIN entre usuarios y empleados, solo seleccionando los campos requeridos
            $sql = "SELECT * from empleados
                    LIMIT 5 OFFSET 0";  // Puedes ajustar el OFFSET si lo necesitas

            // Ejecutar la consulta
            $resul = $this->con->query($sql);

            return $resul;
          }

          public function registrarUsuario($a){
            $id_usuario = $a["id"];
            if($id_usuario != ""){
              //actualizar
              $contrasena=password_hash($a["contrasena"], PASSWORD_DEFAULT);
              $sql= "update  usuarios set empleado_id=".$a["id_empleado"].",usuario='".$a["usuario"]."',contrasena = '".$contrasena."',actualizado_en=NOW() where id = $id_usuario";
              $resul = $this->con->query($sql);
              return $resul;
            }else{
                //insertar datos
                $contrasena=password_hash($a["contrasena"], PASSWORD_DEFAULT);
                $sql = "insert into usuarios(empleado_id,usuario,contrasena,estado,token_recordar,creado_en,actualizado_en)VALUES
                ('".$a["id_empleado"]."','".$a["usuario"]."','".$contrasena."','activo','',NOW(),NOW())";
                $resul = $this->con->query($sql);
                return $resul;
            }
          }

          public function buscarInformacionRolUsuario($buscar) {
    $min = '%' . strtolower($buscar) . '%'; // Añadir comodines aquí para usar en el LIKE

    // Preparar la consulta con parámetros
    $sql = "SELECT * FROM roles
            WHERE (LOWER(nombre) LIKE ? OR LOWER(slug) LIKE ?)
            LIMIT 5 OFFSET 0";

    $stmt = $this->con->prepare($sql);

    if ($stmt) {
        // Asignar los parámetros (2 veces el mismo porque se usa 2 veces)
        $stmt->bind_param("ss", $min, $min);

        $stmt->execute();

        // Obtener el resultado
        $resul = $stmt->get_result();

        return $resul;
    } else {
        // Manejo de error en caso de fallo al preparar
        return false;
    }
}


public function registrarRolesUsuarios($a){
  $id_usuario = $a["id"];
  if($id_usuario != ""){
    //actualizar
    $sql= "update rol_usuario set rol_id='".$a["id_rol"]."',usuario_id = '".$a["usuario_id"]."',actualizado_en=NOW() where id = $id_usuario";
    $resul = $this->con->query($sql);
    return $resul;
  }else{
      //insertar datos
      $sql = "insert into rol_usuario(rol_id,usuario_id,creado_en,actualizado_en)VALUES
      ('".$a["id_rol"]."','".$a["usuario_id"]."',NOW(),NOW())";
      $resul = $this->con->query($sql);
      return $resul;
  }
  }

  public function desactivarUsuarioTodo($id,$estado){
    $sql= "update usuarios set estado = '$estado' where id = $id";
    $resul = $this->con->query($sql);
    return $resul;
  }
  public function EliminarRolesUsuario($id){
    $sql= "delete from rol_usuario where id = $id";
    $resul = $this->con->query($sql);
    return $resul;
  }

  public function EliminarRolesNu($id){
    $sql= "delete from roles where id = $id";
    $resul = $this->con->query($sql);
    return $resul;
  }


}



 ?>
