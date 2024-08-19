<?php
/**
 *
 */

class Farmacia
{

  function __construct()
	{
		require_once("conexion.php");

			//llamando al metodo Conectaras de la clase Conexion para realizar los metodos de insert update delete
			$co=new Conexion();
			$this->con= $co->Conectaras();
	}

  public function SeleccionarNombreGenerico($inicioList=false,$listarDeCuanto=false,$buscar='',$codNombreGenerico=false){
    $sql = "select p.cod_generico,p.codigo,p.nombre,p.enfermedad,p.vitrina,p.stockmin,p.stockmax,p.cod_forma,p.cod_conc,p.cod_usuario,
    p.stock_producto,p.cantidad_total,p.estado,f.cod_forma,f.nombre_forma,c.cod_conc,c.concentracion,u.cod_usuario,u.nombre_usuario,u.ap_usuario,u.am_usuario
     from producto as p inner join forma_presentacion as f on p.cod_forma=f.cod_forma inner join conc_uni_med as c on p.cod_conc=c.cod_conc inner join usuario as u on p.cod_usuario = u.cod_usuario ";
    if($buscar != ''){
       $sql.=" where LOWER(p.nombre) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY p.cod_generico DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    mysqli_close($this->con);
  }

  public function SeleccionarConcentracion($inicioList=false,$listarDeCuanto=false,$buscar=''){
    $sql = "select *from conc_uni_med";
    if($buscar != ''){
       $sql.=" where LOWER(concentracion) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_conc DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarPresentacion($inicioList=false,$listarDeCuanto=false,$buscar=''){
    $sql = "select *from forma_presentacion";
    if($buscar != ''){
       $sql.=" where LOWER(nombre_forma) LIKE '%".$buscar."%' ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY cod_forma DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }


  public function InsertarActualizarPresentacion($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update forma_presentacion set nombre_forma='".$generico."' where cod_forma = $cod_generico";
    }else{//insertar
      $sql = "insert into forma_presentacion(nombre_forma)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function InsertarActualizarNombreGenerico($generico,$cod_generico,$enfermedad,$vitrina,$stockmin,$stockmax,$cod_forma,$cod_conc,$usuario){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update producto set nombre='".$generico."',enfermedad='".$enfermedad."',vitrina='".$vitrina."',stockmin=$stockmin,";
      $sql.="stockmax=$stockmax,cod_forma=$cod_forma,cod_conc=$cod_conc where cod_generico = $cod_generico";
    }else{//insertar
      $sql = "insert into producto(nombre,enfermedad,vitrina,stockmin,stockmax,cod_forma,cod_conc,cod_usuario,estado)values";
      $sql.="('".$generico."','".$enfermedad."','".$vitrina."',$stockmin,$stockmax,$cod_forma,$cod_conc,$usuario,'activo');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function InsertarActualizarConcentracion($generico,$cod_generico){
    $sql = '';
    if(is_numeric($cod_generico)){//actualizar
      $sql = "update conc_uni_med set concentracion='".$generico."' where cod_conc = $cod_generico";
    }else{//insertar
      $sql = "insert into conc_uni_med(concentracion)values('".$generico."');";
    }
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }


  public function p(){
    $sql = "select *from p";
    $resul = $this->con->query($sql);
    // Retornar el resultado
    return $resul;
    mysqli_close($this->con);
  }

  public function SeleccionarProducto($inicioList=false,$listarDeCuanto=false,$buscar='',$fechai=false,$fechaf=false){
    $sql="select e.cod_entrada,e.cantidad,e.vencimiento,e.fecha,e.cod_usuario,e.cod_generico,e.estado_producto,e.estado,
    p.codigo,p.nombre,p.cod_forma,p.cod_conc,u.cod_usuario,u.nombre_usuario,u.ap_usuario,u.am_usuario
    from entrada as e inner join producto as p on e.cod_generico=p.cod_generico
    inner join usuario as u where e.cod_usuario=u.cod_usuario ";
    if($buscar !=''){
      $sql.=" and p.nombre LIKE '%$buscar%' or p.codigo like '%$buscar%'";
    }
    if($fechai!=false &&$fechaf!=false){
      $sql.=" and (e.fecha >= '$fechai' and e.fecha <= '$fechaf') ";
    }
    if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
      $sql.=" ORDER BY e.cod_entrada DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
    }

    $resul = $this->con->query($sql);
    // Retornar el resultado
    if($resul===false){
      return $this->con->error;
    }else{
      return $resul;
    }
    return $resul;
    mysqli_close($this->con);
 }

 public function seleccionarNG(){
   $sql = "select * from producto as p inner join forma_presentacion as f on p.cod_forma=f.cod_forma inner join conc_uni_med as c on p.cod_conc=c.cod_conc";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarC(){
   $sql = "select *from conc_uni_med";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarP(){
   $sql = "select *from forma_presentacion";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarCID($id){
   $sql = "select *from conc_uni_med where cod_conc = $id";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
 public function seleccionarPID($id){
   $sql = "select *from forma_presentacion where cod_forma = $id";
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }

 public function InsertEntradaProducto($cantidad,$vencimiento,$fechaActual,$cod_producto,$cod_entrada,$usuario){
   $sql = "";
   if(is_numeric($cod_entrada)){//update
      $sql="update entrada set cantidad=$cantidad,vencimiento='$vencimiento',cod_generico=$cod_producto where cod_entrada = $cod_entrada";
   }else{//insert
      $sql="insert into entrada(cantidad,vencimiento,fecha,cod_usuario,cod_generico)values($cantidad,'$vencimiento','$fechaActual',$usuario,$cod_producto)";
   }
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }

 public function buscarProductoFar($nombre_producto){
   $nombre_producto = strtolower($nombre_producto);
   $lis = "select *from producto as p inner join forma_presentacion as f on p.cod_forma=f.cod_forma inner join conc_uni_med as c on p.cod_conc=c.cod_conc WHERE LOWER(p.nombre) LIKE '%$nombre_producto%' LIMIT 5 OFFSET 0;";
   $resul = $this->con->query($lis);
   return $resul;
   mysqli_close($this->con);
 }
//funcion para seleccionar de tabla salida
 public function SeleccionarSalida($inicioList=false,$listarDeCuanto=false,$buscar='',$fechai=false,$fechaf=false){
     $sql="select *from salida as s inner join producto as p on s.cod_generico=p.cod_generico";
     if($buscar !=''){
       $sql.=" and p.nombre LIKE '%$buscar%' or p.codigo LIKE '%$buscar%'";
     }
     if($fechai!=false &&$fechaf!=false){
       $sql.=" and (s.fecha >= $fechai and s.fecha <= $fechaf) ";
     }
     if(is_numeric($inicioList)&&is_numeric($listarDeCuanto)){
       $sql.=" ORDER BY s.cod_salida DESC LIMIT $listarDeCuanto OFFSET $inicioList ";
     }
     //echo $sql;

     $resul = $this->con->query($sql);
     // Retornar el resultado
     return $resul;
     mysqli_close($this->con);

 }

 public function UpdateNG($accion,$cod_generico){
   if($accion == 'activo'){
       $sql = "update producto set estado = 'desactivo' where cod_generico=".$cod_generico;
   }else{
       $sql = "update producto set estado = 'activo' where cod_generico=".$cod_generico;
   }
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }

 public function UpdateEF($accion,$cod_entrada){
   if($accion == 'activo'){
       $sql = "update entrada set estado = 'desactivo' where cod_entrada=".$cod_entrada;
   }else{
       $sql = "update entrada set estado = 'activo' where cod_entrada=".$cod_entrada;
   }
   $resul = $this->con->query($sql);
   // Retornar el resultado
   return $resul;
   mysqli_close($this->con);
 }
}



 ?>
