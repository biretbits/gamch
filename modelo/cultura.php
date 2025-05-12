<?php
/**
 *
 */

class Cultura
{
  public $con;
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SeleccionarCultura($buscar = "", $inicioList = false, $listarDeCuanto = false) {
    $buscar = strtolower(trim($buscar));

    // Base SQL
    $sql = "SELECT * FROM cultura";
    $tipos = '';
    $parametros = [];

    if ($buscar !== "") {
        $sql .= " WHERE LOWER(nombre_actividad) LIKE ?";
        $tipos .= 's';
        $parametros[] = '%' . $buscar . '%';
    }

    $sql .= " ORDER BY id DESC";

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

  public function insertarDatosCultura($a, $rutaImagen) {
      $id = $a["id"];

      if ($id != "") {
          // ACTUALIZAR
          $sql = "UPDATE cultura SET
              nombre_actividad = '".$a["nombre_actividad"]."',
              descripcion = '".$a["descripcion"]."',
              tipo_actividad = '".$a["tipo_actividad"]."',
              fecha_inicio = '".$a["fecha_inicio"]."',
              fecha_fin = '".$a["fecha_fin"]."',
              ubicacion = '".$a["ubicacion"]."',
              contacto = '".$a["contacto"]."',
              enlace_web = '".$a["enlace_web"]."'";

          // Solo actualizar imagen si se subió una nueva
          if ($rutaImagen != '') {
              // Obtener imagen actual
              $s = "SELECT imagen_url FROM cultura WHERE id = $id";
              $r = $this->con->query($s);
              if ($f = mysqli_fetch_array($r)) {
                  $imagen = $f["imagen_url"];

                  // Verificar si la imagen actual existe y eliminarla si es necesario
                  if (!empty($imagen) && file_exists($imagen)) {
                      unlink($imagen); // Elimina el archivo de imagen del servidor
                  }
              }

              // Actualizar imagen
              $sql .= ", imagen_url = '".$rutaImagen."'";
          }

          // Fecha de actualización
          $sql .= ", actualizado_en = NOW() WHERE id = $id";

          $resul = $this->con->query($sql);
          return $resul;

      } else {
          // INSERTAR NUEVO
          $sql = "INSERT INTO cultura (
              nombre_actividad, descripcion, tipo_actividad, fecha_inicio, fecha_fin,
              ubicacion, contacto, enlace_web, imagen_url, creado_en, actualizado_en
          ) VALUES (
              '".$a["nombre_actividad"]."', '".$a["descripcion"]."', '".$a["tipo_actividad"]."',
              '".$a["fecha_inicio"]."', '".$a["fecha_fin"]."', '".$a["ubicacion"]."',
              '".$a["contacto"]."', '".$a["enlace_web"]."', '".$rutaImagen."', NOW(), NOW()
          )";

          $resul = $this->con->query($sql);
          return $resul;
      }
    }


}



 ?>
