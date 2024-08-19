<?php //require("../librerias/headeradmin1.php");
require_once('sql.php');
$sql = '';


echo "<br><br><br><br>";
$pala = selecioness();

while($fila = mysqli_fetch_array($pala)){
  $no_fo = selecion1(trim($fila['cod_forma']));
  $no_uni = selecion2(trim($fila['cod_conc']));
  if(mysqli_num_rows($no_fo)>0&&mysqli_num_rows($no_uni)>0){
    $f1 = mysqli_fetch_array($no_fo);
    $f2 = mysqli_fetch_array($no_uni);
    $sql.="insert into producto(codigo,nombre,enfermedad,vitrina,stockmin,stockmax,cod_forma,cod_conc,estado)values(";
    $sql.="'".$fila['codigo']."','".$fila['cod_generico']."','','',0,0,".$f1['cod_forma'].",".$f2['cod_conc'].",'activo');";
  }

}
echo $sql."no hay nada";
 ?>
