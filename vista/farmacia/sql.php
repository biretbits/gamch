<?php
function conec(){
  $cnmysql = mysqli_connect("localhost","root","","cds");
  if($cnmysql){
  	//echo"correcto";
    $cnmysql->set_charset("utf8mb4");
  }
  return $cnmysql;
}


function select_datos_usuario($id){
	if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from usuario where cod_usuario=$id";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}

function seleccionarIDSalida(){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select max(cod_salida)from salida";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
  
}
function seleccionarIDproductoObtenido(){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from usuario where cod_usuario=$id";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;

}

 ?>
