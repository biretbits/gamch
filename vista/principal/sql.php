<?php
function conec(){
  $cnmysql = mysqli_connect("localhost","root","","cds");
  if($cnmysql){
  	//echo"correcto";
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

 ?>
