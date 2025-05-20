<?php
/**
 *
 */

class Chatbot
{
  public $con;
  function __construct()
	{
    // ← Declaración adecuada
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}
  public function BuscarRespuesta(){
    $sql = "select *from consultas";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarChat($buscar='',$inicioList=false,$listarDeCuanto=false,){
    $sql = "select *from consultas";
    if($buscar != ''){
      $sql.=" where (lower(consulta) like '%$buscar%' or lower(respuesta_consulta) like '%$buscar%')";
    }
    $sql.= " order by cod_cons desc";
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
  //  echo "<br><br><br><br>".$sql;
    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
  }

  public function InsertarOactualizar($cod_conc,$consulta,$respuesta){
    $sql = '';
    if(is_numeric($cod_conc)){
      $sql="update consultas set consulta = '$consulta', respuesta_consulta = '$respuesta' where cod_cons = $cod_conc";
    }else{
      $sql = "insert into consultas(consulta,respuesta_consulta)values('$consulta','$respuesta')";
    }
    $resul = $this->con->query($sql);
    return $resul;
    mysqli_close($this->con);
  }

  public function EliminarChatSql($cod_conc){
    $sql = "delete from consultas where cod_cons = $cod_conc";
    $resul = $this->con->query($sql);
    return $resul;
  }

}



 ?>
