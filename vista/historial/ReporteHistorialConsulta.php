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
.clear {
  clear: both;
}
.once{
  font-size: 11px;
}
.doce{
  font-size: 12px;
}
.trece{
  font-size: 13px;
}
.catorce{
  font-size: 14px
}
.quince{
  font-size: 15px
}
.grey{
  color:grey
}
  </style>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    td {
      border: 1px solid black;
    }

    /* Personalizar el tamaño de las celdas de la segunda fila */
    tr:nth-child(2) td:nth-child(1){

    }

    /* Asignar ancho a las columnas */
    .col1 { width: 17%; }
    .col2 { width: 17%; }
    .col3 { width: 17%; }
    .col4 { width: 20%; }
    .col5 { width: 15%; }
    .col6 { width: 15%; }
.centrar{
    text-align: center;
}
.left{
  text-align: left;
}
.cuadro {
  height: 28px;
  position: relative;
  padding: 1px
}
.estudiante {
  position: absolute;
  bottom: 5px; /* Ajusta la posición vertical */
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
        $fecha_nac_paciente = '';$sexo_paciente = '';$ocupacion_paciente='';
        $estado_civil_paciente = '';$escolaridad_paciente = '';$nombre_usuario = '';$ap_usuario='';$am_usuario='';
        $edad_usuario = '';$telefono_paciente = '';$direccion_paciente = '';
        $fecha_actual_consulta = '';$hora_consulta='';$talla_usuario = '';$peso_usuario='';
        $fc_usuario = '';$fr_usuario='';$imc_usuario='';$pa_usuario = '';$temp_usuario = '';
        $motivo_consulta = '';$objetivo = '';$subjetivo='';$analisis='';$tratamiento='';$evaluacion_seguimiento='';
        if ($resul && count($resul) > 0){
            $i = 0;
          $tipoDocumento = '';
          $descripcion = "";
          $ruta = "";
          $nombre_imagen = "";
          foreach ($resul as $fi){
            $datospaciente = $fi['paciente_rd_nombre'];
            foreach ($datospaciente as $datos) {
              $fecha_nac_paciente=$datos["fn_usuario_re"];
              $sexo_paciente=$datos["sexo_usuario"];$ocupacion_paciente=$datos["ocupacion_usuario"];
              $estado_civil_paciente=$datos["estado_civil_usuario"];$escolaridad_paciente=$datos["escolaridad_usuario"];
              $nombre_usuario=$datos["nombre_usuario_re"];$ap_usuario=$datos["ap_usuario_re"];$am_usuario=$datos["am_usuario_re"];
              $edad_usuario = $datos["edad_usuario"];
              $telefono_paciente = $datos["telefono_usuario_re"];
              $direccion_paciente = $datos["direccion_usuario_re"];
              $talla_usuario = $datos["talla_usuario"];$peso_usuario=$datos["peso_usuario"];
            }
            $motivo_consulta = '';
            $patologia = '';$cod_patologia='';
            foreach ($fi["motivo_consulta"] as $da2) {
              $motivo_consulta = $da2["nombre"];
              $cod_patologia = $da2["cod_pat"];
            }
            $objetivo=$fi["objetivo"];$subjetivo=$fi["subjetivo"];
            $analisis=$fi["analisis"];$tratamiento=$fi["tratamiento"];$evaluacion_seguimiento = $fi["evaluacion_de_seguimiento"];
            $fecha_actual_consulta = $fi["fecha"];
            $hora_consulta=$fi["hora"];$fc_usuario=$fi["fc"];$fr_usuario=$fi["fr"];$imc_usuario=$fi["imc"];$pa_usuario=$fi["pa"];
            $temp_usuario=$fi["temp"];
          }
        }
         ?>
         <div style="width:35%" id='saltoLinea'>
           <div style='font-size:11px;' align='center'>MINISTERIO DE SALUD</div>
           <div style='font-size:11px' align='center'>DEPARTAMENTAL DE SALUD DE POTOSI</div>
           <div style='font-size:11px' align='center'>SERVICIO DE SALUD MUNICIPAL DE UNCIA</div>
         </div>
         <div style="width:100%;padding:8px">
           <div align='center' style="font-size:18px">CONSULTA EN URGENCIAS / EMERGENCIAS</div>
         </div>
         <table >
           <!-- Primera fila: 5 columnas -->
           <tr>
             <td class="col1 doce centrar">AP PATERNO</td>
             <td class="col2 doce centrar">AP MATERNO</td>
             <td class="col3 doce centrar">NOMBRES</td>
             <td class="col4 doce centrar">FECHA DE NACIMIENTO</td>
             <td class="col5 doce centrar">EDAD</td>
             <td class="col6 doce centrar">N° NCL</td>
           </tr>

           <!-- Segunda fila: la altura se personaliza con el selector nth-child  colspan-->
           <tr>
             <td class="col1 doce centrar"><?php echo convertirMayus($ap_usuario); ?></td>
             <td class="col2 doce centrar"><?php echo convertirMayus($am_usuario); ?></td>
             <td class="col3 doce centrar"><?php echo convertirMayus($nombre_usuario); ?></td>
             <td class="col4 doce centrar"><?php echo $fecha_nac_paciente; ?></td>
             <td class="col5 doce centrar"><?php echo $edad_usuario; ?></td>
             <td class="col6 doce centrar"></div>
           </tr>
           <tr>
             <td class="doce cuadro" colspan="2">
                 <span class="ocupacion">Ocupación:&nbsp;&nbsp;</span>
                 <span class="estudiante"><?php echo $ocupacion_paciente; ?></span>
             </td>
             <td class="doce cuadro" colspan="2">
               <span class="ocupacion">Estado civil:&nbsp;&nbsp;</span>
               <span class="estudiante"><?php echo $estado_civil_paciente; ?></span>
             </td>
             <td class="doce cuadro" colspan="2">
               <span class="ocupacion">Telefono:&nbsp;&nbsp;</span>
               <span class="estudiante"><?php if($telefono_paciente==0){echo '';}elseif(is_numeric($telefono_paciente)){echo $telefono_paciente;}?></span>
             </td>
           </tr>
           <tr>
             <td class="cuadro doce" colspan="3">
               <span class="ocupacion">Dirección:&nbsp;&nbsp;</span>
               <span class="estudiante"><?php echo $direccion_paciente; ?></span>
             </td>
             <td class="cuadro doce" colspan="3">
               <span class="ocupacion">Escolaridad:&nbsp;&nbsp;</span>
               <span class="estudiante"><?php echo $escolaridad_paciente; ?></span>
             </td>
           </tr>
           <tr>
             <td colspan='6' class='trece centrar'>INSTRUCTIVO LLENADO: Historial Clinico en el Orden siguiente SOAP</td>
           </tr>
           <tr>
             <td colspan="1" style="vertical-align: top;padding:0;">
               <table style="width:100%;border:1px solid white">
                 <!-- 18 filas en la tabla anidada -->
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho arribaQuitar">FECHA</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $fecha_actual_consulta; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">HORA</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $hora_consulta; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">EDAD</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $edad_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">TALLA</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"> <?php echo $talla_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">PESO</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $peso_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">IMC</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"> <?php echo $imc_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">TEMP</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $temp_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">F.C.</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $fc_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">P.A.</td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $pa_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">F.R.</td></tr>
                 <tr> <td class="centrar doce quitarBordeIzquierdoDerecho"><?php echo $fr_usuario; ?></td></tr>
                 <tr><td class="centrar doce quitarBordeIzquierdoDerecho">FIRMA SELLO</td></tr>
               </table>
             </td>
             <td colspan="5" style="vertical-align: top;">
               <div class="doce left">MOTIVO DE CONSULTA</div>
               <div class='doce centrar'><?php echo mayuscula($motivo_consulta);  ?></div>
               <div style="color:grey"><hr></div>
               <br>
               <div class="doce left">SUBJETIVO</div>
               <?php
               if($subjetivo != ''){
                 echo "<div class='line-text1'><span class='centrar'>".$subjetivo."</span></div>";
              }else{
                  echo "<div>
                  <span class='grey'><hr></span>
                  <span class='grey'><hr></span>
                  <span class='grey'><hr></span>
                  <span class='grey'><hr></span>
                  <span class='grey'><hr></span></div>";
               }
                ?>
              <div class="doce left">OBJETIVO</div>
              <?php
              if($objetivo != ''){
                echo "<div class='line-text2'><span class='centrar'>".$objetivo."<span></div>";
              }else{
                echo "<div>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span></div>";
              }
               ?>
               <div class="doce left">ANALISIS</div>
               <div class="once left">Impresión Diagnostica  CIE 10</div>
               <?php
               if($analisis != ''){
                 echo "<div class='line-text3'><span class='centrar'>".$analisis."<span></div>";
               }else{
                 echo "<div>
                 <span class='grey'><hr></span>
                 <span class='grey'><hr></span>
                 <span class='grey'><hr></span>
                 <span class='grey'><hr></span></div>";
               }
                ?>
              <div class="doce left">PLAN DE ACCIÓN (TRATAMIENTO)</div>
              <?php
              if($tratamiento != ''){
                echo "<div class='line-text2'><span class='centrar'>".$tratamiento."<span></div>";
              }else{
                echo "<div>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span></div>";
              }
              ?>
              <div class="centrar doce">
                Responsable médico
              </div>
              <div class="centrar doce">
                Firma y Sello
              </div>

              <div class="doce left">EVALUACIÓN DE SEGUIMIENTO</div>
              <?php
              if($evaluacion_seguimiento != ''){
                echo "<div class='line-text3'><span class='centrar'>".$evaluacion_seguimiento."<span></div>";
              }else{
                echo "<div>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span>
                <span class='grey'><hr></span></div>";
              }
               ?>
               <div class="doce" align='right'>
                 FIRMA Y SELLO
               </div>
            </td>
           </tr>
        </table>


  </body>
</html>
<style media="screen">
.line-text1 {
    position: relative;
    width: 96%;
    min-height: 120px; /* Puedes ajustar la altura mínima */
    line-height: 25px; /* Ajusta la altura de cada línea */
    padding-left: 10px;
    padding-right: 10px;
    background:
      linear-gradient(to bottom, white 1px, transparent 1px) repeat-y;
}

.line-text1 span {
    position: relative;
    background: white;
}

.line-text2 {
    position: relative;
    width: 96%;
    min-height: 130px; /* Puedes ajustar la altura mínima */
    line-height: 25px; /* Ajusta la altura de cada línea */
    padding-left: 10px;
    padding-right: 10px;
    background:
      linear-gradient(to bottom, white 1px, transparent 1px) repeat-y;
}

.line-text2 span {
    position: relative;
    background: white;
}

.line-text3 {
    position: relative;
    width: 96%;
    min-height: 90px; /* Puedes ajustar la altura mínima */
    line-height: 25px; /* Ajusta la altura de cada línea */
    padding-left: 10px;
    padding-right: 10px;
    background:
      linear-gradient(to bottom, white 1px, transparent 1px) repeat-y;
}

.line-text3 span {
    position: relative;
    background: white;
}
.quitarBordeIzquierdoDerecho{
  border-left: 1px solid white;
  border-right: 1px solid white;
}
.arribaQuitar{
  border-top: 1px solid white;
}
</style>
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
