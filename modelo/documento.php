<?php
/**
 *
 */

class Documento
{
  public $con;  // Declarar la propiedad antes de usarla

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

    public function SelectPorBusqueda($buscar="",$inicioList=false,$listarDeCuanto=false) {
      // Convertir $buscar a minúsculas si está definido
        $buscar = strtolower(trim($buscar));
        // Base SQL
        $sql = "SELECT * FROM documentos";
        // Parámetros dinámicos
        $tipos = '';         // Tipos para bind_param (s: string, i: integer)
        $parametros = [];    // Valores a enlazar
        if ($buscar !== "") {
          $sql .= " WHERE LOWER(nombre_documento) LIKE ?";
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


}



 ?>
