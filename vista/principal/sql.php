<?php
function conec(){
  $cnmysql = mysqli_connect("localhost","root","1234","cds");
  if($cnmysql){
  	//echo"correcto";
    $cnmysql->set_charset("utf8mb4");
  }
  return $cnmysql;
}

function select_registro_diario(){
	if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
  $fecha_actual = date('Y-m-d');
	$select="select *from registro_diario where fecha_rd>='".$fecha_actual."' and  fecha_rd<='".$fecha_actual."'";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}
//funcion para seleccionar los sericios que se date_default_timezone_get
function selecionarServicios(){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from servicio";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}
//funcion de actualizacion de entradas si esta en stock o ya vencio
function ActualizarEntrada(){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
  $fechaActual = date('Y-m-d');
  $select="select *from entrada where estado = 'activo'";
	$da=$cnmysql->query($select);
  $fecha1_time = strtotime($fechaActual);
  while($fi=mysqli_fetch_array($da)){
    $fechaVencimiento = $fi['vencimiento'];
    $fecha2_time = strtotime($fechaVencimiento);
    if($fecha1_time>=$fecha2_time){
    //  echo $fecha1_time.">=".$fecha2_time." vencido";
      $sql2 = "update entrada set estado_producto='vencido' where cod_entrada=".$fi['cod_entrada']."";
    	$cnmysql->query($sql2);
    }
  }
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}

function ActualizarCantidad(){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
  $fechaActual = date('Y-m-d');
  $select="select *from producto where estado='activo'";
	$da=$cnmysql->query($select);
  $new = array();
  while($fila = mysqli_fetch_array($da)){
    $new[$fila["cod_generico"]]=array("total" => 0);
  }
  $selectw="select *from entrada where estado='activo'";
	$da1=$cnmysql->query($selectw);
  $fecha2_time = strtotime($fechaActual);
  while($fi=mysqli_fetch_array($da1)){
    $fecha1_time = strtotime($fi['vencimiento']);
    if($fecha1_time>$fecha2_time){
      $new[$fi["cod_generico"]]["total"]=$new[$fi["cod_generico"]]["total"]+$fi['cantidad'];
      //echo "aaaa".$new[$fi["cod_generico"]]["total"]."<br>";
    }
  }

  $select2="select *from producto where estado='activo'";
	$da2=$cnmysql->query($select2);
  while($fil = mysqli_fetch_array($da2)){
    $sql = '';
    if($new[$fil['cod_generico']]['total']<=$fil["stockmin"]){
        $sql= "update producto set stock_producto='si', cantidad_total=".$new[$fil['cod_generico']]['total']." where cod_generico=".$fil["cod_generico"]."";
        $r=$cnmysql->query($sql);
    }else{
      //echo "aaaaaallwgoa".$fil['cod_generico']."   ".$fil['nombre']."<br>";
      $sql= "update producto set stock_producto='no',cantidad_total=".$new[$fil['cod_generico']]['total']." where cod_generico=".$fil["cod_generico"]."";
      $r=$cnmysql->query($sql);
    }
  }
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}

 ?>
