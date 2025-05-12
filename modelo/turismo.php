<?php
/**
 *
 */

class Turismo
{
  public $con;
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SeleccionarTurismo($buscar = "", $inicioList = false, $listarDeCuanto = false) {
    $buscar = strtolower(trim($buscar));

    // Base SQL
    $sql = "SELECT * FROM turismo";
    $tipos = '';
    $parametros = [];

    if ($buscar !== "") {
        $sql .= " WHERE LOWER(nombre_destino) LIKE ?";
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

  public function insertarDatosTurismo($a,$rutaImagen){
    $id = $a["id"]; // puede veni
    if ($id != "") {
        // ACTUALIZAR
        $sql = "UPDATE turismo SET
            nombre_destino = '".$a["nombre_destino"]."',
            descripcion = '".$a["descripcion"]."',
            tipo_destino = '".$a["tipo_destino"]."',
            actividades_disponibles = '".$a["actividades_disponibles"]."',
            ubicacion = '".$a["ubicacion"]."',
            contacto = '".$a["contacto"]."',
            enlace_web = '".$a["enlace_web"]."'";

        // Solo actualizar imagen si se subió una nueva
        if ($rutaImagen != '') {
          $s = "SELECT imagen_url FROM turismo WHERE id = $id";
          $r = $this->con->query($s);
            if ($f = mysqli_fetch_array($r)) {
              $imagen = $f["imagen_url"];

              // Verificamos que la ruta no esté vacía y que el archivo exista físicamente
              if (!empty($imagen) && file_exists($imagen)) {
                  unlink($imagen); // Elimina el archivo del servidor
              } else {
                  //echo "La imagen no existe o la ruta está vacía.";
              }
          } else {
              //echo "No se encontró el registro con ID $id.";
          }
        $sql .= ", imagen_url = '".$rutaImagen."'";
      }

        $sql .= ", actualizado_en = NOW() WHERE id = $id";

        $resul = $this->con->query($sql);
        return $resul;

    } else {
        // INSERTAR
        $sql = "INSERT INTO turismo (
            nombre_destino, descripcion, tipo_destino, actividades_disponibles,
            ubicacion, contacto, enlace_web, imagen_url, creado_en, actualizado_en
        ) VALUES (
            '".$a["nombre_destino"]."', '".$a["descripcion"]."', '".$a["tipo_destino"]."',
            '".$a["actividades_disponibles"]."', '".$a["ubicacion"]."', '".$a["contacto"]."',
            '".$a["enlace_web"]."', '".$rutaImagen."', NOW(), NOW()
        )";

        $resul = $this->con->query($sql);
        return $resul;
    }

  }


}



 ?>
