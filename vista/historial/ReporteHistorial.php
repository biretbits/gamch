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
.inlinea{
    display: inline-block
    float:left;
  }
#enLineaPoner{
  float: left;
}
#subRayar {
  text-decoration: underline; /* Subraya el texto */
  text-decoration-color: #000; /* Color de la línea (opcional) */
  text-decoration-thickness: 2px;
}
#cuadro{
  border: 1px solid #000; /* Agrega un borde negro de 2 píxeles a los cuatro lados */
  height: 81%;
}
#linea{
  border-bottom: 1px solid black;
}
#linea2{
  border-top: 1px solid black;
}
#subtitulos{
  font-size: 12px;
  background-color: lightgray;
  font-weight: bold;
}
#datos{
  font-size: 10px;
}
table {
    border-collapse: collapse; /* Elimina los espacios entre bordes */
}
th, td {
    border: 1px solid black; /* Borde de 1px de color negro */
    text-align: left; /* Alineación del texto */
}
th {
    background-color: white; /* Color de fondo para los encabezados */
}

#table1 {
    width: 100%;
    margin-top: 15px;
    margin-left: 25px;
    margin-bottom: 30px;
}
#tabla2 {
    margin-left: 60px;
    width:50%;
    margin-top: 33%;
}
#saltoLinea{
  line-height: 0.1;
}

#saltoLinea2{
  line-height: 0.5;
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

        <div style="clear:both;"></div>
        <?php
          if ($resul && count($resul) > 0){
              $i = 0;
            foreach ($resul as $fi)
                  $datosResponsable = $fi['datos_responsable_familia'];
                  $nombre_resp= "";$ap_resp = '';$am_resp = '';$cod_resp='';$fecha_nac = '';$sexo_resp = '';$ocupacion_resp='';
                  $direccion_responsable  = '';$telefono_resposable='';$comunidad_responsable='';
                  $ci_resp = '';$nro_seguro_resp='';$nro_car_form_resp='';
                  foreach ($datosResponsable as $resFamiliar) {
                    $cod_resp=$resFamiliar["cod_usuario"];
                    $nombre_resp = $resFamiliar["nombre_usuario_re"];
                    $ap_resp = $resFamiliar["ap_usuario_re"];
                    $am_resp = $resFamiliar["am_usuario_re"];
                    $fecha_nac = $resFamiliar["fn_usuario_re"];
                    $sexo_resp = $resFamiliar["sexo_usuario"];
                    $ocupacion_resp=$resFamiliar["ocupacion_usuario"];$direccion_responsable=$resFamiliar['direccion_usuario_re'];
                    $telefono_resposable=$resFamiliar["telefono_usuario_re"];$comunidad_responsable=$resFamiliar["comunidad_usuario_re"];
                    $ci_resp = $resFamiliar['ci_usuario'];$nro_seguro_resp= $resFamiliar['nro_seguro_usuario'];
                    $nro_car_form_resp= $resFamiliar['nro_car_form_usuario'];
                  }
                  $datospaciente = $fi['paciente_rd_nombre'];
                  $fecha_nac_paciente = '';$sexo_paciente = '';$ocupacion_paciente='';
                  $estado_civil_paciente = '';$escolaridad_paciente = '';$nombre_usuario = '';$ap_usuario='';$am_usuario='';
                  foreach ($datospaciente as $datos) {
                    $fecha_nac_paciente=$datos["fn_usuario_re"];
                    $sexo_paciente=$datos["sexo_usuario"];$ocupacion_paciente=$datos["ocupacion_usuario"];
                    $estado_civil_paciente=$datos["estado_civil_usuario"];$escolaridad_paciente=$datos["escolaridad_usuario"];
                    $nombre_usuario=$datos["nombre_usuario_re"];$ap_usuario=$datos["ap_usuario_re"];$am_usuario=$datos["am_usuario_re"];
                  }
          ?>

          <div class="row">
            <div class="col-12" align='right'>
              <h5>Zona <?php $m = (isset($fi['zona_his']) && $fi['zona_his']!='')?$fi['zona_his']:'';echo $m; ?> </h5>
            </div>
          </div>
          <div style="width:100%" id='saltoLinea'>
            <p style='font-size:9px;' align='rigth'>SERVICIO DEPARTAMENTAL DE SALUD POTOSI</p>
            <p style='font-size:9px' align='rigth'>RED DE SERVICIOS DE SALUD MUNICIPAL UNCIA</p>
          </div>
          <div style="width:100%">
            <h5 align='center' id='subRayar'>HISTORIA CLINICA</h5>
          </div>
          <div id='cuadro'>
            <h1 align='center' id='subtitulos'>A.  DATOS ADMINISTRATIVOS</h1>
            <div class="">

            <div style="width:50%" id='enLineaPoner'>
              <table id='table1'>
               <thead>
                   <tr>
                      <th id='subtitulos'>RESPONSABLE DE FAMILIA</th>
                   </tr>
               </thead>
               <tbody>
                  <tr>
                    <td id='datos'>Apellido Paterno: &nbsp;&nbsp;&nbsp;<?php $m = (isset($ap_resp) && is_string($ap_resp))?$ap_resp:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Apellido Materno:&nbsp;&nbsp;&nbsp;<?php $m = (isset($am_resp) && is_string($am_resp))?$am_resp:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Nombres:&nbsp;&nbsp;&nbsp;<?php $m = (isset($nombre_resp) && is_string($nombre_resp))?$nombre_resp:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Fecha de Nacimiento:&nbsp;&nbsp;&nbsp;<?php $m = (isset($fecha_nac) && is_string($fecha_nac))?$fecha_nac:'';echo $m; ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sexo:
                      &nbsp;&nbsp;&nbsp;<?php $m = (isset($sexo_resp) && is_string($sexo_resp))?$sexo_resp:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Ocupación:&nbsp;&nbsp;&nbsp;<?php $m = (isset($ocupacion_resp) && is_string($ocupacion_resp))?$ocupacion_resp:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Dirección:&nbsp;&nbsp;&nbsp;<?php $m = (isset($direccion_responsable) && is_string($direccion_responsable))?$direccion_responsable:'';echo $m; ?>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono:&nbsp;&nbsp;&nbsp;<?php $m = (isset($telefono_resposable) && is_string($telefono_resposable))?$telefono_resposable:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Comunidad:&nbsp;&nbsp;&nbsp;<?php $m = (isset($comunidad_responsable) && is_string($comunidad_responsable))?$comunidad_responsable:'';echo $m; ?></td>
                  </tr>
                  <tr>
                    <td id='datos'>Municipio Uncia Provincia</td>
                  </tr>
                  <tr>
                    <td id='datos'>Centro de Salud</td>
                  </tr>
               </tbody>
             </table>
            </div>
            <div style="width:50%;" id='enLineaPoner'>
              <table id='tabla2'>
               <tbody>
                    <tr>
                      <td id='datos' style='width: 50%;'>Apellido Paterno</td>
                      <td id='datos' style='width: 50%;'><?php $m = (isset($ap_resp) && is_string($ap_resp))?$ap_resp:'';echo $m; ?></td>
                    </tr>
                    <tr>
                      <td id='datos'>Apellido Materno</td>
                      <td id='datos'><?php $m = (isset($am_resp) && is_string($am_resp))?$am_resp:'';echo $m; ?></td>
                    </tr>
                    <tr>
                      <td id='datos'>Nombres</td>
                      <td id='datos'><?php $m = (isset($nombre_resp) && is_string($nombre_resp))?$nombre_resp:'';echo $m; ?></td>
                    </tr>
               </tbody>
              </table>
            </div>
            </div>
            <div style="clear:both;"></div>
            <div class="">
            <h1 align='center' id='subtitulos'>B.  IDENTIFICACIÓN DEL PACIENTE / USUARIO</h1>
            <div style="width:100%" id='saltoLinea2'>
              <div style="width:33%"id='enLineaPoner'>
                <h1 id='datos'>Apellido Paterno:&nbsp;&nbsp;&nbsp;<?php $m = (isset($ap_usuario) && is_string($ap_usuario))?$ap_usuario:'';echo $m; ?></h1>
              </div>
              <div style="width:33%"id='enLineaPoner'>
                <h1 id='datos'>Apellido Materno:&nbsp;&nbsp;&nbsp;<?php $m = (isset($am_usuario) && is_string($am_usuario))?$am_usuario:'';echo $m; ?></h1>
              </div>
              <div style="width:33%"id='enLineaPoner'>
                <h1 id='datos'>Nombres:&nbsp;&nbsp;&nbsp;<?php $m = (isset($nombre_usuario) && is_string($nombre_usuario))?$nombre_usuario:'';echo $m; ?></h1>
              </div>
            </div>
            <div style="clear:both;"></div>
            <div style="width:100%" id='linea saltoLinea2'>
              <div style="width:25%"id='enLineaPoner'>
                <h1 id='datos'>Fecha de Nacimiento:&nbsp;&nbsp;&nbsp;<?php $m = (isset($fecha_nac_paciente) && is_string($fecha_nac_paciente))?$fecha_nac_paciente:'';echo $m; ?></h1>
              </div>
              <div style="width:25%"id='enLineaPoner'>
                <h1 id='datos'>Sexo:&nbsp;&nbsp;&nbsp;<?php $m = (isset($sexo_paciente) && is_string($sexo_paciente))?$sexo_paciente:'';echo $m; ?></h1>
              </div>
              <div style="width:25%"id='enLineaPoner'>
                <h1 id='datos'>Ocupación:&nbsp;&nbsp;&nbsp;<?php $m = (isset($ocupacion_paciente) && is_string($ocupacion_paciente))?$ocupacion_paciente:'';echo $m; ?></h1>
              </div>
              <div style="width:25%"id='enLineaPoner'>
                <h1 id='datos'>Fecha de consulta:&nbsp;&nbsp;&nbsp;<?php $m = (isset($fi['fecha_rd']) && is_string($fi['fecha_rd']))?$fi['fecha_rd']:'';echo $m; ?></h1>
              </div>
            </div>
            <div style="clear:both;"></div>
            <div style="width:100%" id='linea saltoLinea2'>
              <div style="width:50%"id='enLineaPoner'>
                <h1 id='datos'>Estado civil:&nbsp;&nbsp;&nbsp;<?php $m = (isset($estado_civil_paciente) && is_string($estado_civil_paciente))?$estado_civil_paciente:'';echo $m; ?></h1>
              </div>
              <?php $are=array('No Primaria' =>'Educación Primaria sin concluir',
                              'Primaria'=> 'Educación Primaria concluido',
                              'No Secundaria'=>'Educación Secundaria sin concluir',
                              'Secundaria'=>'Educación Secundaria concluido',
                              'Superior'=>'Educación Superior');
                    ?>
              <div style="width:50%"id='enLineaPoner'>
                <h1 id='datos'>Escolaridad:&nbsp;&nbsp;&nbsp;<?php $m = (isset($escolaridad_paciente) && is_string($escolaridad_paciente))?$are[$escolaridad_paciente]:'';echo $m; ?></h1>
              </div>
            </div>
            <div style="clear:both;"></div>
            <div style="width:100%" id='linea saltoLinea2'>
              <div style="width:50%"id='enLineaPoner'>
                <h1 id='datos'>Idioma</h1>
              </div>
              <div style="width:50%"id='enLineaPoner'>
                <h1 id='datos'>Idiomas hablados</h1>
              </div>
            </div>
          </div><!--fin cuadro-->

          </div><!--fin del row-->
          <div class="row" id='cuadro'>

          </div><!--fin del segundo row-->
          <?php } ?>


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
