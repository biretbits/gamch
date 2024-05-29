
<?php
/**
 *
 */

class Historial
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SelectPorBusquedaHistorial($inicioList=false,$listarDeCuanto=false,$fecha=false,$cod_paciente,$fechai=false,$fechaf=false){
    // Verificar si $buscar tiene contenido
    $sql = " select *from usuario as u inner join registro_diario as rd on u.cod_usuario=rd.paciente_rd inner join historial as h on rd.paciente_rd = h.paciente_rd where h.paciente_rd = $cod_paciente ";

    if($fecha != false){
      //$di=strtotime($fecha);
      //$df=strtotime($fecha) + 86399;
    //	echo $di."       ".$df;
      $sql.=" and (rd.fecha_rd >= '$fecha' and  rd.fecha_rd <= '$fecha')";
   }
   //fecha solo para
   if($fechai != false && $fechaf != false){
    $sql.=" and (rd.fecha_rd >= '$fechai' and  rd.fecha_rd <= '$fechaf') ";
  }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY h.cod_his DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }

    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function selectDatosUsuarios($id){
    $lis = "select nombre_usuario,ap_usuario,am_usuario,fecha_nac_usuario,sexo_usuario,
    direccion_usuario, comunidad_usuario,telefono_usuario from usuario where cod_usuario = $id";
    $resul = $this->con->query($lis);
    $a = [];
    while ($fi = mysqli_fetch_array($resul)) {
      $datos = [
          "nombre_usuario_re" => $fi["nombre_usuario"],
          "ap_usuario_re" => $fi["ap_usuario"],
          "am_usuario_re" => $fi["am_usuario"],
          "fn_usuario_re" => $fi["fecha_nac_usuario"],
          "sexo_usuario_re" => $fi["sexo_usuario"],
          "direccion_usuario_re" => $fi["direccion_usuario"],
          "comunidad_usuario_re" => $fi["comunidad_usuario"],
          "telefono_usuario_re" => $fi["telefono_usuario"]
        ];
        $a[] = $datos;
    }
    return $a;
    mysqli_close($this->con);
  }

  public function selectNombreUsuario($cod_usuario){
    $sql = "select *from usuario where cod_usuario=".$cod_usuario;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }
}



 ?>
