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
          $sql .= " WHERE (LOWER(nombre_documento) LIKE ? OR LOWER(datos_documento) LIKE ?)";
          $tipos .= 'ss';
          $parametros[] = '%' . strtolower($buscar) . '%';
          $parametros[] = '%' . strtolower($buscar) . '%'; // Este faltaba
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


        public function registrar($a,$ruta,$usuario_id,$archivo){
          $id = $a["id"];
          if($id != ""){
            //actualizar
            $sql = '';
            $sql.= "update documentos set categoria = '".$a["categoria"]."',entidad = '".$a["entidad"]."',descripcion = '".$a["descripcion"]."',fecha_creacion = '".$a["fecha_creacion"]."'";
            if($archivo != ''){//si hay un nuevo archivo lo actualizamos
              $sql.=",archivo = '".$ruta."'";
              echo $a["ruta"];
              if (file_exists($a["ruta"])) {
                unlink($a["ruta"]);//eliminar el anterior archivo
              }
            }
            $sql.=",nombre_documento = '".$a["nombre_documento"]."',datos_documento = '".$a["dato_documento"]."',estado = '".$a["estado"]."',publicar = '".$a["publicar"]."',actualizado_en = NOW()
                  WHERE id = ".$a["id"].";";
            $resul = $this->con->query($sql);
            return $resul;
          }else{
              $sql = "insert into documentos(usuario_id,categoria,cod,entidad,descripcion,fecha_creacion,archivo,nombre_documento,datos_documento,estado,publicar,
              creado_en,actualizado_en)VALUES
              ($usuario_id,'".$a["categoria"]."','".$a["cod"]."','".$a["entidad"]."','".$a["descripcion"]."','".$a["fecha_creacion"]."','$ruta','".$a["nombre_documento"]."',
              '".$a["dato_documento"]."','".$a["estado"]."','".$a["publicar"]."',NOW(),NOW())";
              $resul = $this->con->query($sql);
              return $resul;
          }
        }

        public function SeleccionarDocumentos($ruta){
              $sql = "select *from documentos where categoria = '$ruta'";
              $resul = $this->con->query($sql);
              return $resul;
        }


}



 ?>
