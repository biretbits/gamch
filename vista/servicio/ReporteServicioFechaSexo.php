<?php
ob_end_clean();
// Iniciar el almacenamiento en búfer de salida
ob_start();

// Verificar que no haya salida antes de las cabeceras
// Generar el contenido del PDF aquí

// Ajustar las cabeceras
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="reporte.pdf"');

  include("../librerias/globales.php");
 //echo $fechai."fi   ".$fechaf."ff   ".$buscar."b   ".$pagina."p   ".$listarDeCuanto."ldc" ; ?>
<style media="screen">
table {
    border-collapse: collapse;
    width: 100%;
    font-family: Arial, sans-serif;
    font-size: 14px;
    text-align: left;
  }

  table th {
    border: 1px solid black;
    font-size: 10px;
  }
  table td {
    padding: 1px;
    border: 1px solid black;
    font-size: 11px; /* Ajusta el ancho máximo de la celda según tus necesidades */

  }
  table td:nth-child(1) {
    text-align: center;
    width: 10px;
  }
  table td:nth-child(2) {
    text-align: center;
    width: 40px;
  }
  table td:nth-child(3) {
    width: 90px;
  }
  table td:nth-child(4) {
    width: 125px;
  }
  table td:nth-child(10) {
    width: 80px;
  }
  table td:nth-child(13) {
    width: 65px;
  }

  table th {
    background-color: #f2f2f2;
    font-weight: bold;
    color: #444;
  }

  table tr:hover {
    background-color: #ddd;
  }
  thead {
  page-break-before: always;
  page-break-inside: avoid;
}
th:last-child {
  page-break-after: avoid;
}
td,th{
  text-align: center
}

    .tituloU{
      font-size: 28px;
      font: serif
    }
    .subtitulo{
      font-size: 20px;
    }
    .subtitulo2{
      font-size: 16px;
    }
    .subtitulo3{
      font-size: 15px;
    }
    .subtitulo4{
      font-size: 13px;
    }
    .reciboTitulo{
      font-size: 35px;
    }
    .reciboTitulo b{
       padding-bottom: -40px;
       border-bottom: 1px solid black;
    }
    .fila{
      width:65%;
      height: 15%;
      background-color:red;

    }

     .linea{
       display: inline-block;
     }
</style>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report Box</title>
    <style media="screen">

    </style>
  </head>
  <body>
<?php
if($fechai > $fechaf){
  $aux = $fechai;
  $fechai=$fechaf;
  $fechaf = $aux;
}
 ?>
    <div class="">
          <div   style='width:100%;' align='center'>

            <font class="subtitulo"><b>PACIENTES ATENDIDOS POR SEXO</b></font><br>

            <font class="subtitulo3">Llallagua , <?php
            list($año1, $mes1, $dia1) = explode('-', $fechai);
            list($año2, $mes2, $dia2) = explode('-', $fechaf);

            if($fechai == $fechaf){
              echo $dia1." de ".mesEnTexto($mes1)." ".$año1;
            }else{
              echo "".$dia1." de ".mesEnTexto($mes1)." ".$año1." al ".$dia2." de ".mesEnTexto($mes2)." ".$año2;
            }
            ?>
          </font>
          </div>
          <br>
      </div>
        <div style="clear:both;"></div>

        <div align='center'>

          <font align='center'><b>CANTIDAD DE PACIENTES MASCULINOS ATENDIDOS</b></font><br>
        </div>

        <table>
            <thead style="display: table-row-group;">
              <tr>
                <th>N°</th>
                <th>Servicio</th>
                <th>Pacientes</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ser = array();
              while($fi=mysqli_fetch_array($servicios))
              {
                $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
              }
              while($fi=mysqli_fetch_array($regDiario)){
                $ser[$fi['servicio_rd']]['contar']+=1;
              }
              $suma = 0;
              if (mysqli_num_rows($servicios) > 0) {
                  $k = 1;
                  while($fi=mysqli_fetch_array($servicios1)){
                    echo "<tr>";
                    echo "<td>".$k."</td>";

                    echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                    echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                    $suma+=$ser[$fi['cod_servicio']]['contar'];
                    echo "</tr>";
                    $k+=1;
                  }
                  echo "<tr>";
                 echo "<td align='center' colspan='2'>Total Pacientes</td>"; // Asegúrate de que el número de columnas coincida con la tabla
                 echo "<td>".$suma."</td>";
                 echo "</tr>";
                }else{
                  echo "<tr>";
                  echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                  echo "</tr>";
                }
                 ?>
            </tbody>
        </table>
        <div style="clear:both;"></div>

        <div align='center'>
            <br>
          <font align='center'><b>CANTIDAD DE PACIENTES FEMENINOS ATENDIDOS</b></font>
          <br>
        </div>
        <table>
            <thead style="display: table-row-group;">
              <tr>
                <th>N°</th>
                <th>Servicio</th>
                <th>Pacientes</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ser = array();
              while($fi=mysqli_fetch_array($servicios2))
              {
                $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
              }
              while($fi=mysqli_fetch_array($regDiario1)){
                $ser[$fi['servicio_rd']]['contar']+=1;
              }
              $suma = 0;
              if (mysqli_num_rows($servicios3) > 0) {
                  $k = 1;
                  while($fi=mysqli_fetch_array($servicios3)){
                    echo "<tr>";
                    echo "<td>".$k."</td>";

                    echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                    echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                    $suma+=$ser[$fi['cod_servicio']]['contar'];
                    echo "</tr>";
                    $k+=1;
                  }
                  echo "<tr>";
                 echo "<td align='center' colspan='2'>Total Pacientes</td>"; // Asegúrate de que el número de columnas coincida con la tabla
                 echo "<td>".$suma."</td>";
                 echo "</tr>";
                }else{
                  echo "<tr>";
                  echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                  echo "</tr>";
                }
                 ?>
            </tbody>
        </table>
        <div align='center'>
            <br>
          <font align='center'><b>CANTIDAD DE PACIENTES DE SEXO NO BINARIO ATENDIDOS</b></font>
          <br>
        </div>
        <table>
            <thead>
              <tr>
                <th>N°</th>
                <th>Servicio</th>
                <th>Pacientes</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ser = array();
              while($fi=mysqli_fetch_array($servicios5))
              {
                $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
              }
              while($fi=mysqli_fetch_array($regDiario2)){
                $ser[$fi['servicio_rd']]['contar']+=1;
              }
              $suma = 0;
              if (mysqli_num_rows($servicios4) > 0) {
                  $k = 1;
                  while($fi=mysqli_fetch_array($servicios4)){
                    echo "<tr>";
                    echo "<td>".$k."</td>";

                    echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                    echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                    $suma+=$ser[$fi['cod_servicio']]['contar'];
                    echo "</tr>";
                    $k+=1;
                  }
                  echo "<tr>";
                 echo "<td align='center' colspan='2'>Total Pacientes</td>"; // Asegúrate de que el número de columnas coincida con la tabla
                 echo "<td>".$suma."</td>";
                 echo "</tr>";
                }else{
                  echo "<tr>";
                  echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
                  echo "</tr>";
                }
                 ?>
            </tbody>
        </table>
  <style media="screen">
    /*eliminando borde izquierdo dercho y de abajo*/
    #bor{
      border-bottom: none;border-right: none; border-left: none;
    }
  </style>




  </body>

</html>

<?php
//https://parzibyte.me/blog/2019/12/25/generar-pdf-php-dompdf/ 9:00pm a 11:30pm
//https://programmerclick.com/article/89841075890/
$html=ob_get_clean();
//$html = '<img src="data:image/svg+xml;base64,' . base64_encode($svg) . '" ...>';
//$html = file_get_contents(__DIR__ . '/hoja.php');
//echo $html;
//sudo apt-get install php7.0-mbstring
//apt-get install php7.2-xml

//require '../vendor/autoload.php';
require_once '../librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

//use Dompdf\Options;//nueva
//$options=new Options();
//$options->setchroot(__DIR__);
//$options->set('isRemoteEnebled',TRUE);

$dompdf=new Dompdf();

//https://noviello.it/es/como-instalar-composer-en-ubuntu-20-04-lts/
$options=$dompdf->getOptions();
$options->set(array('isRemoteEnebled'=>true));
$dompdf->setOptions($options);
$options->setIsHtml5ParserEnabled(true);
//$dompdf->loadHtml($html);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');

$dompdf->render();
$type=false;
if(!isset($_GET["id"]))
  $type=false;
$dompdf->stream("archivo_.pdf",array("Attachment"=>$type));


?>
