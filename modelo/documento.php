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
            $sql = "select *from documentos where categoria = '$ruta' order by id desc";
            $resul = $this->con->query($sql);
            return $resul;
        }

        public function BuscarDocumentoFiltrar($buscar="") {
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
          public function SeleccionarNoticias($buscar = "", $inicioList = false, $listarDeCuanto = false) {
              $buscar = strtolower(trim($buscar));

              // Base SQL con JOINs
              $sql = "
                  SELECT
                      np.id AS id,
                      np.usuario_id AS usuario_id,
                      np.titulo AS titulo,
                      np.contenido AS contenido,
                      np.foto AS foto,
                      np.fecha AS fecha,
                      np.creado_en AS creado_en,
                      np.actualizado_en AS actualizado_en,

                      u.usuario AS usuario_usuario,
                      u.estado AS usuario_estado,
                      u.creado_en AS usuario_creado_en,
                      u.actualizado_en AS usuario_actualizado_en,

                      e.id AS empleado_id,
                      e.nombre AS empleado_nombre,
                      e.apellido_p AS empleado_apellido_p,
                      e.apellido_m AS empleado_apellido_m,
                      e.sexo AS empleado_sexo,
                      e.direccion AS empleado_direccion,
                      e.telefono AS empleado_telefono,
                      e.correo_electronico AS empleado_correo_electronico,
                      e.foto AS empleado_foto,
                      e.creado_en AS empleado_creado_en,
                      e.actualizado_en AS empleado_actualizado_en,
                      e.estado AS empleado_estado
                  FROM nuevas_paginas np
                  INNER JOIN usuarios u ON np.usuario_id = u.id
                  INNER JOIN empleados e ON u.empleado_id = e.id
              ";

              $tipos = '';
              $parametros = [];

              if ($buscar !== "") {
                  $sql .= " WHERE (LOWER(np.titulo) LIKE ? OR LOWER(np.contenido) LIKE ?)";
                  $tipos .= 'ss';
                  $parametros[] = '%' . $buscar . '%';
                  $parametros[] = '%' . $buscar . '%';
              }

              $sql .= " ORDER BY np.id DESC";

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
              return $stmt->get_result();
          }


          public function registrarNoticia($a,$ruta,$usuario_id,$archivo){
            $id = $a["id"];
            if($id != ""){
              //actualizar
              $sql = '';
              $sql.= "update nuevas_paginas set titulo = '".$a["titulo"]."',contenido = '".$a["contenido"]."'";
              if($archivo != ''){//si hay un nuevo archivo lo actualizamos
                $sql.=",foto = '".$ruta."'";
                //echo $a["ruta"];
                if (file_exists($a["ruta"])) {
                  unlink($a["ruta"]);//eliminar el anterior archivo
                }
              }
              $sql.=",fecha = '".$a["fecha"]."',actualizado_en = NOW()
                    WHERE id = ".$a["id"].";";
              $resul = $this->con->query($sql);
              return $resul;
            }else{
                $sql = "insert into nuevas_paginas(usuario_id,titulo,contenido,foto,fecha,creado_en,actualizado_en)VALUES
                ($usuario_id,'".$a["titulo"]."','".$a["contenido"]."','$ruta','".$a["fecha"]."',NOW(),NOW())";
                $resul = $this->con->query($sql);
                return $resul;
            }
          }
          public function SeleccionarNoticiasNuevas($inicioList = false, $listarDeCuanto = false) {
              if (is_numeric($inicioList) && is_numeric($listarDeCuanto)) {
                  $sql = "SELECT * FROM nuevas_paginas ORDER BY id DESC LIMIT ? OFFSET ?";
                  $stmt = $this->con->prepare($sql);
                  $stmt->bind_param("ii", $listarDeCuanto, $inicioList);
                  $stmt->execute();
                  $resul = $stmt->get_result();
                  return $resul;
              } else {
                  // Si no hay paginación, traer todo
                  $sql = "SELECT * FROM nuevas_paginas ORDER BY id DESC";
                  return $this->con->query($sql);
              }
          }


          public function SeleccionarNoticiasNuevasID($id){
            $sql = "select *from nuevas_paginas where id=$id";
            $resul = $this->con->query($sql);
            return $resul;
          }

          public function EliminarDocGaceta($id){
            $sql2 = "select *from documentos where id = $id";
            $resul2 = $this->con->query($sql2);
            if ($resul2 && $fila = mysqli_fetch_array($resul2)) {
              $archivo = $fila["archivo"];
              if (file_exists($archivo)) {
                  if (unlink($archivo)) {
                    //archivo eliminado
                  }
                }
            }
            $sql= "delete from documentos where id = $id";
            $resul = $this->con->query($sql);
            return $resul;
          }

          public function SeleccionarNoticiasDeDosDias($limite) {
              // Calcular la fecha de hace 5 días (el rango inferior)
              $fechaLimite5Dias = date('Y-m-d H:i:s', strtotime('-5 days'));

              // Calcular la fecha de hace 1 día (el rango superior)
              $fechaLimite1Dia = date('Y-m-d H:i:s', strtotime('-2 days'));

              // Consulta SQL para obtener noticias entre hace 5 días y hace 1 día
              $consulta = "SELECT * FROM nuevas_paginas WHERE creado_en BETWEEN '$fechaLimite5Dias' AND '$fechaLimite1Dia' ORDER BY id DESC LIMIT $limite";

              // Ejecutar la consulta y devolver el resultado
              return $this->con->query($consulta);
          }


}



 ?>
