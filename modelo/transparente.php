<?php
/**
 *
 */

class Transparente
{
  public $con = '';
  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function SelectPorBusquedaTransparente($buscar="",$inicioList=false,$listarDeCuanto=false,$categoria=false) {
    // Convertir $buscar a minúsculas si está definido
      $buscar = strtolower(trim($buscar));
      // Base SQL
      $sql = "SELECT * FROM gestionTransparente";

      // Parámetros dinámicos
      $tipos = '';         // Tipos para bind_param (s: string, i: integer)
      $parametros = [];    // Valores a enlazar
      $existe = 'no';
      if ($buscar !== "") {
          $sql .= " WHERE LOWER(nombre_documento) LIKE ?";
          $tipos .= 's';
          $parametros[] = '%' . strtolower($buscar) . '%';
          $existe='si';
    }

    if($categoria != '' && $existe == 'si'){
      $sql.=" and categoria = '$categoria' ";
    }else if($categoria != '' && $existe == 'no'){
      $sql.=" where categoria = '$categoria' ";
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

  public function registrar($a,$usuario_id,$r){
    $id = $a["id"];
    if ($id != "") {
        // ACTUALIZAR
          $sql = "UPDATE gestionTransparente SET
            categoria = '".$a["categoria"]."',
            cod = '".$a["cod"]."',
            descripcion = '".$a["descripcion"]."',
            fecha_creacion = '".$a["fecha_creacion"]."',
            nombre_documento = '".$a["nombre_documento"]."',
            estado = '".$a["estado"]."',
            publicar = '".$a["publicar"]."'";

        // Solo actualizar archivo si se subió uno nuevo
        if ($r != '') {
            // Obtener archivo actual
            $s = "SELECT archivo FROM gestionTransparente WHERE id = $id";
            $res = $this->con->query($s);
            if ($f = mysqli_fetch_array($res)) {
                $archivoAnterior = $f["archivo"];
                // Eliminar el archivo anterior si existe
                if (!empty($archivoAnterior) && file_exists($archivoAnterior)) {
                    unlink($archivoAnterior);
                }
            }
            // Actualizar campo archivo
            $sql .= ", archivo = '".$r."'";
        }
        // Fecha de actualización
        $sql .= ", actualizado_en = NOW() WHERE id = $id";
        $resul = $this->con->query($sql);
        return $resul;
    } else {
        // INSERTAR NUEVO
        $sql = "INSERT INTO gestionTransparente (
            usuario_id, categoria, cod, descripcion, fecha_creacion,
            archivo, nombre_documento, estado, publicar, creado_en, actualizado_en
        ) VALUES (
            '".$usuario_id."', '".$a["categoria"]."', '".$a["cod"]."',
            '".$a["descripcion"]."', '".$a["fecha_creacion"]."', '".$r."',
            '".$a["nombre_documento"]."', '".$a["estado"]."', '".$a["publicar"]."',
            NOW(), NOW()
        )";
        $resul = $this->con->query($sql);
        return $resul;
    }

  }

  public function ultimaNoticia(){
    $sql = "SELECT * FROM nuevas_paginas
    ORDER BY id DESC
    LIMIT 2;
    ";
    $resul = $this->con->query($sql);
    return $resul;
  }

  public function EliminarDocTransaparente($id){
    $sql2 = "select *from gestiontransparente where id = $id";
    $resul2 = $this->con->query($sql2);
    if ($resul2 && $fila = mysqli_fetch_array($resul2)) {
      $archivo = $fila["archivo"];
      if (file_exists($archivo)) {
          if (unlink($archivo)) {
            //archivo eliminado
          }
        }
    }
    $sql= "delete from gestiontransparente where id = $id";
    $resul = $this->con->query($sql);
    return $resul;
  }

}



 ?>
