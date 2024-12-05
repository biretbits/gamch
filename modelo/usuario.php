<?php
/**
 *
 */

class Usuario
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function validarBD($usuario) {
    $lis = "select count(*) from usuario where usuario='".$usuario."' and estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }

  public function validarBDTodo($usuario) {
    $lis = "select * from usuario where usuario='".$usuario."' and estado='activo'";
    $resul = $this->con->query($lis);
    return $resul;
    mysqli_close($this->con);
  }


  public function SelectPorBusqueda($buscar="",$inicioList=false,$listarDeCuanto=false) {
      // Verificar si $buscar tiene contenido
      $sql = "SELECT * FROM usuario";
      if ($buscar != "" && $buscar != null) {
          // Convertir $buscar a minúsculas
          $buscar = strtolower($buscar);
          $sql.=" where LOWER(usuario) LIKE '%".$buscar."%' OR LOWER(nombre_usuario) LIKE '%".$buscar."%'
          OR LOWER(ap_usuario) LIKE '%".$buscar."%' OR LOWER(am_usuario) LIKE '%".$buscar."%' ";
      }
    	if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
    		$sql.=" ORDER BY cod_usuario DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    	}

      $resul = $this->con->query($sql);
      // Retornar el resultado
      return $resul;
      mysqli_close($this->con);
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
        $sql = "update usuario set estado = 'desactivo' where cod_usuario=".$cod_usuario;
    }else{
        $sql = "update usuario set estado = 'activo' where cod_usuario=".$cod_usuario;
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
}



 ?>
