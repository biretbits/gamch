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
    width: 20px;
  }
  table td:nth-child(2) {
    text-align: center;
    width: 50px;
  }
  table td:nth-child(3) {
    width: 90px;
  }
  table td:nth-child(4) {
    width: 90px;
  }

  table td:nth-child(5) {
    width: 90px;
  }

  table td:nth-child(6) {
    width: 90px;
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
    ?>
    <div class="">
          <div   style='width:100%;' align='center'>

            <font class="subtitulo3"><b>Salida de Medicamentos</b></font><br>

            <font class="subtitulo3">Llallagua , <?php
            list($año1, $mes1, $dia1) = explode('-', $fechai);

            echo $dia1." de ".mesEnTexto($mes1)." ".$año1;

            ?>
          </font>
          </div>
          <br>
      </div>
        <div style="clear:both;"></div>

        <table>
            <thead style="display: table-row-group;">
              <tr>
                <th>N°</th>
                <th>Nombre Receta</th>
                <th>Paciente</th>
                <th>Encargado Farmacia</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($resul && count($resul) > 0) {
                  $i = 0;
                  foreach ($resul as $fi){
                      echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        echo "<td>".$fi['nombre_receta']."</td>";

                        $paciente = $fi['cod_paciente'];
                        $cod_paciente = '';
                        echo "<td>";
                        foreach ($paciente as $form) {
                          $datos_paciente = $form["nombre_usuario"]." ".$form["ap_usuario"]." ".$form["am_usuario"];
                          echo convertirMayus($form["nombre_usuario"])." ".convertirMayus($form["ap_usuario"])." ".convertirMayus($form["am_usuario"]);
                          $cod_paciente=$form["cod_usuario"];
                        }
                        echo "</td>";
                        $Encargado = $fi['cod_usuario'];
                        $cod_usuario = "";
                        echo "<td>";
                        foreach ($Encargado as $conc) {
                          echo convertirMayus($conc["nombre_usuario"])." ".convertirMayus($conc["ap_usuario"])." ".convertirMayus($conc["am_usuario"]);
                          $cod_usuario =$conc['cod_usuario'];
                        }
                        echo "</td>";
                        $bloquear = '';
                        if($fi['fechaHora'] == null){
                          echo "<td style='color:black'>Falta entregar</td>";
                        }else{
                          echo "<td>".$fi['fechaHora']."</td>";
                        }
                        if($fi["entregado"] == 'si'){
                          echo "<td  style='text-align:center'>Entregado</td>";
                          $bloquear = 'disabled';
                        }else{
                          echo "<td  style='text-align:center'>No entregado</td>";
                          $bloquear = 'enabled';
                        }
                      echo "</tr>";
                      $i++;
                    }
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
