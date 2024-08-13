<?php require("../librerias/headeradmin1.php");
require_once('sql.php');
$sql = '';





echo "<br><br><br><br>";
while($fila = mysqli_fetch_array($r)){
  $no_ge = selecion(trim($fila['cod_generico']));
  $f = mysqli_fetch_array($no_ge);
  $no_fo = selecion1(trim($fila['cod_forma']));
  $no_uni = selecion2(trim($fila['cod_conc']));
  if(mysqli_num_rows($no_ge)>0&&mysqli_num_rows($no_fo)>0&&mysqli_num_rows($no_uni)>0){

    $f1 = mysqli_fetch_array($no_fo);
    $f2 = mysqli_fetch_array($no_uni);
    $sql.="insert into producto(codigo,cod_generico,cod_forma,cod_conc,enfermedad,estado)values(";
    $sql.="'".$fila['codigo']."',".$f['cod_generico'].",".$f1['cod_forma'].",".$f2['cod_conc'].",'','activo');";
  }

}
echo $sql."no hay nada";
 ?>
