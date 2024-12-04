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

.salto-pagina {
   page-break-after: always;
 }
.image {
    width: 105%;
    height: 95%;
  }
  .image-container {
    text-align: center;
  }
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
#cuadro2{
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

<style media="screen">
  /*codigo de css del reporte de consulta*/
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
  width: 76%;
  min-height: 110px; /* Puedes ajustar la altura mínima */
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
  width: 76%;
  min-height: 70px; /* Puedes ajustar la altura mínima */
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

/*fin del codigo reporte consulta*/

.izquierdoBorde{
  border-left: 1px solid white;
}
.derechoBorde{
  border-right: 1px solid white;
}
.arribaBorde{
  border-top: 1px solid white;
}
.abajoBorde{
  border-bottom: 1px solid white;
}
.espacio{
  padding: 0;
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
     <table style="border:2px solid white;width:100%">
     <tr>
       <td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde  arribaBorde">
       </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde arribaBorde"></td>
       <td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde arribaBorde">
       </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde arribaBorde"></td>
       <td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde arribaBorde">
       </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde arribaBorde"></td>
    </tr>
     <?php
         if ($resul && count($resul) > 0){
         $i = 0;
         $tipoDocumento = '';
         $descripcion = "";
         $ruta = "";
         $nombre_imagen = "";
         $fecha_nac_paciente = '';$sexo_paciente = '';$ocupacion_paciente='';
         $estado_civil_paciente = '';$escolaridad_paciente = '';$nombre_usuario = '';$ap_usuario='';$am_usuario='';
         $edad_usuario = '';$telefono_paciente = '';$direccion_paciente = '';
         $fecha_actual_consulta = '';$hora_consulta='';$talla_usuario = '';$peso_usuario='';
         $fc_usuario = '';$fr_usuario='';$imc_usuario='';$pa_usuario = '';$temp_usuario = '';
         $motivo_consulta = '';$objetivo = '';$subjetivo='';$analisis='';$tratamiento='';$evaluacion_seguimiento='';

         foreach ($resul as $fi){
             $tipoDocumento = $fi['tipoDato'];
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

             if($tipoDocumento == 1){
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
       ?>
       <tr>
        <td colspan="6" style="border:1px solid white" class="arribaBorde">
        <table>
         <tr>
           <td colspan="6"class="derechoBorde izquierdoBorde arribaBorde">
             <div align='right'>Zona <?php $m = (isset($fi['zona_his']) && $fi['zona_his']!='')?$fi['zona_his']:'';echo $m; ?> </div>
             <div style='font-size:9px' align='rigth'>SERVICIO DEPARTAMENTAL DE SALUD POTOSI</div>
             <div style='font-size:9px' align='rigth'>RED DE SERVICIOS DE SALUD MUNICIPAL UNCIA</div>
             <div style="width:100%">
               <h4 align='center' id='subRayar'>HISTORIA CLINICA</h4>
             </div>
           </td>
         </tr>
         <tr class="abajoBorde">
           <td colspan="6"  style="padding:0"><div align='center'id='subtitulos'>A.  DATOS ADMINISTRATIVOS</div></td>
         </tr>
         <tr>
           <td colspan="4" style="vertical-align: top;padding:15px;" class='derechoBorde'>
             <table style="width:65%;border:1px solid white;">
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
           </td>
           <td colspan="2" style="vertical-align: top;">
             <table style="border:1px solid white;margin-top:35%;">
              <thead>
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
              </thead>
             </table>
           </td>
         </tr>
         <tr class='abajoBorde'>
           <td colspan="6" style='padding:0'><div align='center' id='subtitulos'>B.  IDENTIFICACIÓN DEL PACIENTE / USUARIO</div></td>
         </tr>
         <tr>
           <td colspan="2" class="derechoBorde" style="padding: 0;width:33%">
             <div id='datos'>Apellido Paterno:&nbsp;&nbsp;&nbsp;<?php $m = (isset($ap_usuario) && is_string($ap_usuario))?$ap_usuario:'';echo $m; ?></div>
           </td>
           <td colspan="2" class="derechoBorde" style="padding: 0;width:33%">
             <div id='datos'>Apellido Materno:&nbsp;&nbsp;&nbsp;<?php $m = (isset($am_usuario) && is_string($am_usuario))?$am_usuario:'';echo $m; ?></div>
           </td>
           <td colspan="2" style="padding: 0;width:33%">
             <div id='datos'>Nombres:&nbsp;&nbsp;&nbsp;<?php $m = (isset($nombre_usuario) && is_string($nombre_usuario))?$nombre_usuario:'';echo $m; ?></div>
           </td>
         </tr>
         <tr>
           <td colspan="2" class="derechoBorde" style="padding: 0;">
             <div id='datos'>Fecha de Nacimiento:&nbsp;&nbsp;&nbsp;<?php $m = (isset($fecha_nac_paciente) && is_string($fecha_nac_paciente))?$fecha_nac_paciente:'';echo $m; ?></div>
           </td>
           <td colspan="2" class="derechoBorde" style="padding: 0;">
             <div id='datos'>Sexo:&nbsp;&nbsp;&nbsp;<?php $m = (isset($sexo_paciente) && is_string($sexo_paciente))?$sexo_paciente:'';echo $m; ?></div>
           </td>
           <td colspan="1" class="derechoBorde" style="padding: 0;">
             <div id='datos'>Ocupación:&nbsp;&nbsp;&nbsp;<?php $m = (isset($ocupacion_paciente) && is_string($ocupacion_paciente))?$ocupacion_paciente:'';echo $m; ?></div>
           </td>
           <td colspan="1" style="padding: 0;">
             <div id='datos'>Fecha de consulta:&nbsp;&nbsp;&nbsp;<?php $m = (isset($fi['fecha_rd']) && is_string($fi['fecha_rd']))?$fi['fecha_rd']:'';echo $m; ?></div>
           </td>
         </tr>
         <tr>
             <td colspan="3" class="derechoBorde" style="padding: 0;">
               <div id='datos'>Estado civil:&nbsp;&nbsp;&nbsp;<?php $m = (isset($estado_civil_paciente) && is_string($estado_civil_paciente))?$estado_civil_paciente:'';echo $m; ?></div>
             </td>

             <?php $are=array('No Primaria' =>'Educación Primaria sin concluir',
                             'Primaria'=> 'Educación Primaria concluido',
                             'No Secundaria'=>'Educación Secundaria sin concluir',
                             'Secundaria'=>'Educación Secundaria concluido',
                             'Superior'=>'Educación Superior');
                   ?>
             <td colspan="3" style="padding: 0;">
               <div id='datos'>Escolaridad:&nbsp;&nbsp;&nbsp;<?php $m = (isset($escolaridad_paciente) && is_string($escolaridad_paciente))?$are[$escolaridad_paciente]:'';echo $m; ?></div>
             </td>
         </tr>
         <tr>
           <td class="derechoBorde" colspan="3"style="padding: 0;">
             <div id='datos'>Idioma</div>
           </td>
           <td colspan="3"style="padding: 0;">
             <div id='datos'>Idiomas hablados</div>
           </td>
         </tr>
         <tr class="abajoBorde">
           <td colspan="2"  style="padding:0" class='derechoBorde'><div align='center'id='subtitulos'>C.  ANTECEDENTES PEDIATRICOS</div></td>
           <td colspan="4" style="padding:0"><div align='center'id='subtitulos'>D.  ANTECEDENTES GINECO - OBSTETRICOS</div></td>
         </tr>
         <tr>
           <td colspan="6" style="padding:0">
             <table style="border:1px solid white;width:100%">
               <tr><!--17 columnas-->
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:13%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:2.8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:2.8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:2.8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:2.8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:2.8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:5%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:6%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:5%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:5%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:6%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:5%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:6%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:10%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:9%"></td>
               </tr>
               <tr>
                 <td colspan="1" class='once derechoBorde izquierdoBorde arribaBorde' style="padding:0">Peso RN</td>
                 <td colspan="5" class='once izquierdoBorde arribaBorde' style="padding:0">Parto</td>
                 <td colspan="7" class='once izquierdoBorde arribaBorde' style="padding:0;text-align:center">Embarazos G__P__A__C__</td>
                 <td colspan="2" class='once izquierdoBorde arribaBorde' style="padding:0;text-align:center">PAP</td>
                 <td colspan="2" class='once izquierdoBorde arribaBorde derechoBorde' style="padding:0;text-align:center">Anticoncepción</td>
               </tr>
               <!-- uniendo esta los dos tr-->
               <tr>
                 <td class="once arribaBorde izquierdoBorde" style="padding:0;" colspan="6">Obs. Perinatal</td>
                 <td class="once arribaBorde " style="padding:0;text-align:center" rowspan="2">Año</td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" rowspan="2">Duración meses</td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" colspan="2">Tipo de parto</td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" colspan="2">Nro</td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" rowspan="2"></td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" colspan="1">Fecha</td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" colspan="1">Resultado</td>
                 <td class="once arribaBorde" style="padding:0;text-align:center" colspan="1">Inicio</td>
                 <td class="once arribaBorde derechoBorde" style="padding:0;text-align:center" colspan="1">Método</td>
               </tr>
               <tr>
                 <td class="once arribaBorde izquierdoBorde" style="padding:0;" colspan="6">Lactancia Exclusiva Prolongada</td>
                 <td class="once arribaBorde" style="padding:0" colspan="1">s</td>
                 <td class="once arribaBorde" style="padding:0" colspan="1">s</td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde derechoBorde" style="padding:0;" colspan="1"></td>
               </tr>
               <!--fin del tr-->
               <tr>
                 <td class="once arribaBorde izquierdoBorde" style="padding:0;" colspan="6"><div align='center'id='subtitulos'>E. VACUNAS</div></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde derechoBorde" style="padding:0;" colspan="1"></td>
               </tr>
               <tr>
                 <td style="padding:0;text-align:center"  class='izquierdoBorde  once' ></td>
                 <td style="padding:0;text-align:center"  class=' once'>1</td>
                 <td style="padding:0;text-align:center"  class=' once'>2</td>
                 <td style="padding:0;text-align:center"  class=' once'>3</td>
                 <td style="padding:0;text-align:center"  class=' once'>4</td>
                 <td style="padding:0;text-align:center"  class='once'>5</td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde" style="padding:0" colspan="1"></td>
                 <td class="once arribaBorde derechoBorde" style="padding:0;" colspan="1"></td>
               </tr>
               <?php
               $nu = array(0 => 'RTC',1 => 'RTC',2 => 'RTC',3 => 'RTC',4 => 'RTC',5 => 'RTC',6 => 'RTC',7 => 'RTC',8 => 'RTC',
             9 => 'RTC',10 => 'R');
                 for($i = 0;$i<11;$i++){
                   echo "<tr>";
                   echo "<td style='padding:0;'  class='izquierdoBorde  once' >".$nu[$i]."</td>";
                   echo "<td style='padding:0;text-align:center'  class=' once'></td>";
                   echo "<td style='padding:0;text-align:center'  class=' once'></td>";
                   echo "<td style='padding:0;text-align:center'  class=' once'></td>";
                   echo "<td style='padding:0;text-align:center'  class=' once'></td>";
                   echo "<td style='padding:0;text-align:center'  class='once'></td>";

                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";

                   echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";

                   if($i==2){
                     $textoPrincipal="<div align='center'id='subtitulos'>F. FACTORES DE RIESGO PERSONAL</div>";
                     echo "<td class='once  derechoBorde derechoBorde'  colspan='4'>".$textoPrincipal."</td>";
                   }
                   if($i<2){
                     echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                     echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                     echo "<td class='once arribaBorde' style='padding:0' colspan='1'></td>";
                     echo "<td class='once arribaBorde derechoBorde' style='padding:0;' colspan='1'></td>";
                   }else if($i>2){
                       if($i == 3){
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='4'>Alergias</td>";
                       }
                       if($i == 4){
                         echo "<td class='once arribaBorde' style='padding:0' colspan='2'>Grupo Sanguineo</td>";
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='2'>Rh</td>";
                       }
                       if($i == 5){
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='4'>Transfusiones</td>";
                       }
                       if($i == 6){
                         echo "<td class='once arribaBorde ' style='padding:0' colspan='2'>Alcoholismo</td>";
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='2'>Tabaquismo</td>";
                       }

                       if($i == 7){
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='4'>Drogas o Medicamentos</td>";
                       }
                       if($i == 8){
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='4'>Tipo de vivienda</td>";
                       }
                       if($i == 9){
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='4'>Alimentación</td>";
                       }
                       if($i == 10){
                         echo "<td class='once arribaBorde derechoBorde' style='padding:0' colspan='4'>Otrosw</td>";
                       }
                   }
                   echo "</tr>";
                 }
               ?>
             </table>
           </td>
         </tr>
         <tr>
           <td colspan="6" style="padding:0;border:1px solid black">
             <table style="width:100%;border:1px solid white">
               <tr style="padding:0">
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:13%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:6%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:8%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:6%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:13%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:13%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:5%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:16%"></td>
                 <td class="once arribaBorde derechoBorde abajoBorde" style="padding:0;width:10%"></td>
                 <td class="once arribaBorde abajoBorde" style="padding:0;width:10%"></td>
               </tr>
               <tr>
                 <td class="once arribaBorde derechoBorde  izquierdoBorde" style="padding:0;" colspan="2"><div align='center'id='subtitulos'>J. ANTECEDENTES DE HOSPITALIZACIÓN</div></td>
                 <td class="once arribaBorde derechoBorde " style="padding:0;background-color: lightgray;text-align: center;vertical-align: top;" colspan="5"><div id='subtitulos'>H. MEDICAMENTOS EN ENFERMEDADES CRONICAS</div></td>
                 <td class="once arribaBorde derechoBorde " style="padding:0;" colspan="1"><div id='subtitulos' style="padding:1px">I. ANTECEDENTES PATOLOGICOS</div></td>
                 <td class="once arribaBorde derechoBorde " style="padding:0;background-color:lightgray" colspan="1"><div id='subtitulos' style="padding:1px">PERSONALES</div></td>
                 <td class="once arribaBorde derechoBorde " style="padding:0;background-color:lightgray" colspan="1"><div id='subtitulos' style="padding:1px">FAMILIARES</div></td>
               </tr>
               <tr>
                 <td class="once izquierdoBorde" style="padding:0;text-align:center" colspan="1">Hospitalizaciones</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1">Año</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1">Evolución</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1">Inicio</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1">Medicamentos</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1">Dosificación</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1">Final</td>
                 <td class="once " style="padding:0;" colspan="1">Hipertencion Arterial</td>
                 <td class="once " style="padding:0;text-align:center" colspan="1"></td>
                 <td class="once arribaBorde derechoBorde" style="padding:0;text-align:center" colspan="1"></td>
               </tr>
               <?php
                 $enfer = array(0 => 'Diabetes Mellitus',1=>'Hepatopatias',2=>'Cardiopatia',3=>'Nefropatia',4=>'Enfermedad de Chagas',5=>'Tumores Genitales',
                                 6=>'Patologia Mamaria',7=>'Tubercolosis',8=>'ITS',9=>'Transtornos del SNC',10=>'Obesidad',11=>'Desnutrición');
                 for($i = 0;$i<12;$i++){
                 echo "<tr>";
                   if($i<7){
                     echo  "<td class='once izquierdoBorde' style='padding:0;text-align:center' colspan='1'></td>";
                     echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                     echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                     echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                     echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                     echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                     echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                   }else {
                   if($i == 7){
                       echo  "<td class='once izquierdoBorde' style='padding:0;text-align:center' colspan='4'><div align='center'id='subtitulos'>J. FACTORES DE RIESGO SOCIAL</div></td>";
                       echo "<td class='once' style='padding:0;text-align:center' colspan='3'><div align='center'id='subtitulos'>K. OBSERVACIONES</div></td>";
                     }else{
                       echo  "<td class='once izquierdoBorde' style='padding:0;text-align:center' colspan='4'></td>";
                       echo "<td class='once' style='padding:0;text-align:center' colspan='3'></td>";
                     }
                   }
                   echo "<td class='once' style='padding:0;' colspan='1'>".$enfer[$i]."</td>";
                   echo "<td class='once' style='padding:0;text-align:center' colspan='1'></td>";
                   echo "<td class='once arribaBorde derechoBorde' style='padding:0;text-align:center' colspan='1'></td>";
                 echo "</tr>";
                 }
               ?>
               <tr>
                 <td class='once izquierdoBorde abajoBorde' style='padding:0;margin:2px' colspan='4'>Otros</td>
                 <td class='once abajoBorde' style='padding:0;' colspan='3'></td>
                 <td class='once abajoBorde derechoBorde' style='padding:0;margin:2px' colspan='4'>Otros</td>
               </tr>
             </table>
           </td>
         </tr>

       </table>
      </td>
      </tr>
     <?php
     }else if($tipoDocumento == 2){?>
     <?php
     $descripcion = $fi["descripcion"];
     $ruta = $fi["ruta_imagen"];
     $nombre_imagen = $fi["nombre_imagen"];

     ?>
     <tr>
       <td colspan="6"  class='arribaBorde abajoBorde derechoBorde izquierdoBorde'>
         <table style="border:1px solid black;width:100%">
           <tr style="border:1px solid black">
             <td class="derechoBorde izquierdoBorde abajoBorde arribaBorde">
               <!--<div class="salto-pagina"></div>-->

                   <h5 align='center'><?php echo $descripcion; ?></h5>
                 </div>
                 <div class="image-container">
                   <?php
                   $cdir = $ruta . $nombre_imagen;
                   //echo "Esto es ".$cdir." <br><br><br><br><br> ";
                    // Obtener la información de tipo MIME del archivo
                    $image_info = getimagesize($cdir);
                    $mime_type = $image_info['mime'];  // Devuelve algo como 'image/jpeg' o 'image/png'
                    // Codificar la imagen en base64
                    $c = "data:" . $mime_type . ";base64," . base64_encode(file_get_contents($cdir));
                   ?>
                   <img src="<?php echo $c; ?>" alt="No se encontro Imagen"  class="image">

             </td>
           </tr>
         </table>
       </td>
     </tr>

     <?php
     }else if($tipoDocumento==3){
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
       $temp_usuario=$fi["temp"];?>
       <tr>
       <td colspan="6" class="arribaBorde abajoBorde">
           <table class="table table-bordered" style="border: 1px solid black;width:100%">
                 <thead>
                   <tr>
                     <td colspan="6" class="derechoBorde izquierdoBorde arribaBorde">
                       <div style="width:35%" id='saltoLinea'>
                         <p style='font-size:11px;' align='center'>MINISTERIO DE SALUD</p>
                         <p style='font-size:11px' align='center'>DEPARTAMENTAL DE SALUD DE POTOSI</p>
                         <p style='font-size:11px' align='center'>SERVICIO DE SALUD MUNICIPAL DE UNCIA</p>
                       </div>
                         <h6 align='center'>CONSULTA DE EMERGENCIAS/ URGENCIAS</h6>
                     </td>
                   </tr>
                   <tr>
                     <td class="col1 doce centrar">AP PATERNO</td>
                     <td class="col2 doce centrar">AP MATERNO</td>
                     <td class="col3 doce centrar">NOMBRES</td>
                     <td class="col4 doce centrar">FECHA DE NACIMIENTO</td>
                     <td class="col5 doce centrar">EDAD</td>
                     <td class="col6 doce centrar">N° NCL</td>
                   </tr>
                   <tr>
                     <td class="col1 doce centrar"><?php echo convertirMayus($ap_usuario); ?></td>
                     <td class="col2 doce centrar"><?php echo convertirMayus($am_usuario); ?></td>
                     <td class="col3 doce centrar"><?php echo convertirMayus($nombre_usuario); ?></td>
                     <td class="col4 doce centrar"><?php echo $fecha_nac_paciente; ?></td>
                     <td class="col5 doce centrar"><?php echo $edad_usuario; ?></td>
                     <td class="col6 doce centrar"></td>
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
                 </thead>
             </table>

       </td>
       </tr>
       <?php
       }
       }
       }?>
       </table>



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
