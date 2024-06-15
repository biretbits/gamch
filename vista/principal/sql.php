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
	$select="select *from registro_diario";
	$da=$cnmysql->query($select);
	//$numf=mysqli_num_rows($da);
  mysqli_close($cnmysql);
	return $da;
}

 ?>
