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
function selecion($nombre){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from nombre_generico where nombre='".$nombre."'";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}
function selecion1($nombre){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from forma_presentacion where nombre_forma='".$nombre."'";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}


function selecion2($nombre){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from conc_uni_med where concentracion='".$nombre."'";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}

function selecioness(){
  if(!isset($_SESSION)){
		session_start();
	}
  $cnmysql=conec();
	mysqli_set_charset($cnmysql,"utf8");
	$select="select *from p";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}
 ?>
