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
    $fechai = date('Y-m-d');
    $nombre_apellidos_paciente = '';
    $nombre_apellidos_usuario = '';
    $nombre_receta = '';
    if ($resul &&count($resul) > 0) {
      $i = 1;
      foreach ($resul as $fi){
        $nombre_receta = $fi["nombre_receta"];
        $paciente = $fi['paciente'];
        foreach ($paciente as $pr) {
          $nombre_apellidos_paciente=$pr["nombre_usuario"]." ".$pr["ap_usuario"]." ".$pr["am_usuario"];
        }
        $usuario = $fi['usuario'];
        foreach ($paciente as $pr) {
          $nombre_apellidos_usuario=$pr["nombre_usuario"]." ".$pr["ap_usuario"]." ".$pr["am_usuario"];
        }
      }
    }
    ?>
    <div class="">
          <div   style='width:100%;' align='center'>

            <font class="subtitulo3"><b>Recibo de medicamentos</b></font><br>

            <font class="subtitulo3">Llallagua , <?php
            list($año1, $mes1, $dia1) = explode('-', $fechai);

            echo $dia1." de ".mesEnTexto($mes1)." ".$año1;

            ?>
          </font>
          </div>
          <br>
      </div>
        <div style="clear:both;"></div>
        <div style="width:50%;" class="linea">
          <font class="subtitulo3"><b>Receta:</b> <?php echo $nombre_receta; ?></font>&nbsp;&nbsp;&nbsp;&nbsp;
          <font class="subtitulo3"><b>Paciente:</b>   <?php echo $nombre_apellidos_paciente; ?></font>
        </div>
          <br><br>

        <table>
            <thead style="display: table-row-group;">
              <tr>
                <th>N°</th>
                <th>Codígo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha y hora</th>
                <th>Costo total</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              if ($resul &&count($re) > 0) {
                $i = 1;
                foreach ($re as $fi){
                    echo "<tr>";
                      echo "<td>".($i)."</td>";
                      $codigo = '';
                      $nombre_producto = '';
                      $producto = $fi['productos'];
                      $formaa = "";
                      foreach ($producto as $pr) {
                        $nombre_producto=$pr["nombre"];
                        $codigo = $pr["codigo"];
                      }
                      echo "<td>".($codigo)."</td>";
                      echo "<td>".($nombre_producto)."</td>";
                      echo "<td>".($fi["cantidad_solicitada"])."</td>";
                      echo "<td>".$fi['fechaHora']."</td>";
                      echo "<td style='text-align:right'>".($fi["costoTotal"])."</td>";
                      echo "</tr>";
                      $total = $total + $fi["costoTotal"];
                    $i++;
                  }
                  echo "<tr>";
                  // Deja las primeras 6 columnas vacías pero no las ocultes.
                  // Usa colspan para las dos últimas columnas que mostrarán el valor de $total
                  echo "<td colspan='4' style='border-bottom: solid white;border-left: solid white;border-right:solid white;'></td>"; // Oculta las primeras 6 columnas
                  // Muestra el valor de $total en la penúltima columna
                  echo "<td colspan='1'  style='width: 70px;text-align: right;border-bottom: solid white;'>Total:</td>";
                  // Muestra el valor de $total en la última columna
                  echo "<td colspan='1' style='width: 70px;text-align: right'>".$total."</td>";
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
$dompdf->stream("medicamentos.pdf",array("Attachment"=>$type));


?>
