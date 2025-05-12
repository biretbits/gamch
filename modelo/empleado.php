<?php
/**
 *
 */

class Empleado
{
  public $con;  // Declarar la propiedad antes de usarla

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SeleccionarEmpleado($buscar="",$inicioList=false,$listarDeCuanto=false) {
    // Convertir $buscar a minúsculas si está definido
    $buscar = strtolower(trim($buscar));

    // Base SQL
    $sql = "SELECT
              e.*,
              c.cargo_empleado,
              n.nivel_empleado
            FROM empleados e
            JOIN cargos c ON e.cargo_id = c.id
            JOIN niveles n ON e.nivel_id = n.id";

    // Parámetros dinámicos
    $tipos = '';         // Tipos para bind_param (s: string, i: integer)
    $parametros = [];

    if ($buscar !== "") {
      $sql .= " WHERE
                  LOWER(e.nombre) LIKE ? OR
                  LOWER(e.apellido_p) LIKE ? OR
                  LOWER(e.apellido_m) LIKE ? OR
                  LOWER(c.cargo_empleado) LIKE ? OR
                  LOWER(n.nivel_empleado) LIKE ?";
      $tipos .= 'sssss';
      $buscarLike = '%' . $buscar . '%';
      $parametros = array_fill(0, 5, $buscarLike);
    }

    $sql .= " ORDER BY e.id DESC";

    // Paginación
    if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
      $sql .= " LIMIT ? OFFSET ?";
      $tipos .= 'ii';
      $parametros[] = (int)$listarDeCuanto;
      $parametros[] = (int)$inicioList;
    }

    // Preparar la consulta
    $stmt = $this->con->prepare($sql);

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
    return $resul;
  }

  public function RegistrarNuevosDatosEmpleado($a,$rutaImagen){
    $id_usuario = $a["id"];
    if($id_usuario != ""){
      //actualizar
      $sql = '';
      $sql.= "update empleados set nivel_id = '".$a["id_nivel"]."',cargo_id='".$a["id_cargo"]."', tipo_empleado = '".$a["empleado"]."',nombre='".$a["nombre"]."',
      apellido_p = '".$a["apellido_p"]."',apellido_m='".$a["apellido_m"]."',sexo = '".$a["sexo"]."',direccion = '".$a["direccion"]."',telefono = '".$a["telefono"]."',
      correo_electronico = '".$a["gmail"]."',";
      if($rutaImagen!=''){
        $sql.="foto = '".$rutaImagen."',";
      }
      $sql.="actualizado_en=NOW() where id = $id_usuario";
      $resul = $this->con->query($sql);
      return $resul;
    }else{
        //insertar datos
        $sql = "insert into empleados(nivel_id,cargo_id,tipo_empleado,nombre,apellido_p,apellido_m,sexo,direccion,
        telefono,correo_electronico,foto,creado_en,actualizado_en,estado)VALUES
        ('".$a["id_nivel"]."','".$a["id_cargo"]."','".$a["empleado"]."','".$a["nombre"]."','".$a["apellido_p"]."','".$a["apellido_m"]."',
        '".$a["sexo"]."','".$a["direccion"]."','".$a["telefono"]."','".$a["gmail"]."','".$rutaImagen."',NOW(),NOW(),'activo')";
        $resul = $this->con->query($sql);
        return $resul;
    }
  }


        public function buscarcARGOEmpleado($buscar) {
          // Convierte la búsqueda a minúsculas
          $min = strtolower($buscar);

          // SQL con INNER JOIN entre usuarios y empleados, solo seleccionando los campos requeridos
          $sql = "SELECT
            cargos.id AS id_cargo,
            cargos.nivel_id,
            cargos.cargo_empleado,
            cargos.creado_en AS cargo_creado,
            cargos.actualizado_en AS cargo_actualizado,
            cargos.estado AS cargo_estado,
            niveles.id AS id_nivel,
            niveles.nivel_empleado,
            niveles.creado_en AS nivel_creado,
            niveles.actualizado_en AS nivel_actualizado,
            niveles.estado AS nivel_estado
        FROM cargos
        INNER JOIN niveles ON cargos.nivel_id = niveles.id
        WHERE cargos.cargo_empleado LIKE '%$min%'
        LIMIT 5 OFFSET 0;
        ";  // Puedes ajustar el OFFSET si lo necesitas

          // Ejecutar la consulta
          $resul = $this->con->query($sql);

          return $resul;
      }
}
