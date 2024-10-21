<?php require("../librerias/headeradmin1.php");
include("../librerias/globales.php");
?>
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

<div class="container main-content">
  <div class="container p-2">
    <input type="hidden" name="hoja1" id='hoja1' value="<?php $m = (isset($hoja1) && is_numeric($hoja1))?$hoja1:'';echo $m; ?>">
    <input type="hidden" name="hoja2" id='hoja2' value="<?php $m = (isset($hoja2) && is_numeric($hoja2))?$hoja2:'';echo $m; ?>">
    <input type="hidden" name="paciente_rd" id='paciente_rd' value="<?php $m = (isset($paciente_rd) && ($paciente_rd)!='')?$paciente_rd:'';echo $m; ?>">
    <input type="hidden" name="cod_rd" id='cod_rd' value="<?php $m = (isset($cod_rd) && ($cod_rd)!='')?$cod_rd:'';echo $m; ?>">
    <input type="hidden" name="cod_historial_repor" id='cod_historial_repor' value="<?php $m = (isset($cod_his) && ($cod_his)!='')?$cod_his:'';echo $m; ?>">
    <input type="hidden" name="tipoDato" id='tipoDato' value="<?php $m = (isset($tipoDato) && ($tipoDato)!='')?$tipoDato:'';echo $m; ?>">
    <input type="hidden" name="cod_his_original" id='cod_his_original' value="<?php $m = (isset($cod_his_original) && is_numeric($cod_his_original))?$cod_his_original:'';echo $m; ?>">

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
        $motivo_consulta=$fi["motivo_consulta"];$objetivo=$fi["objetivo"];$subjetivo=$fi["subjetivo"];
        $analisis=$fi["analisis"];$tratamiento=$fi["tratamiento"];$evaluacion_seguimiento = $fi["evaluacion_de_seguimiento"];
        $fecha_actual_consulta = $fi["fecha"];
        $hora_consulta=$fi["hora"];$fc_usuario=$fi["fc"];$fr_usuario=$fi["fr"];$imc_usuario=$fi["imc"];$pa_usuario=$fi["pa"];
        $temp_usuario=$fi["temp"];
      }
    }
     ?>
     <br>
     <div class="row">
       <div class="col-12">
         <input type="button" style="padding:3px;margin:3px"name="" value="Generar Reporte" class="btn btn-warning" onclick="GenerarNuevoReporte()">
       </div>
     </div>
    <div style="width:35%" id='saltoLinea'>
      <div style='font-size:11px;' align='center'>MINISTERIO DE SALUD</div>
      <div style='font-size:11px' align='center'>DEPARTAMENTAL DE SALUD DE POTOSI</div>
      <div style='font-size:11px' align='center'>SERVICIO DE SALUD MUNICIPAL DE UNCIA</div>
    </div>
    <div class="row">
      <h4 align='center'>CONSULTA DE EMERGENCIAS/ URGENCIAS</h4>
    </div>
    <table class="table table-bordered" style="border: 1px solid black;">
          <thead class="">
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
          </thead>
      </table>
  </div>
</div>
<script type="text/javascript">
function GenerarNuevoReporte(){
  var hoja1=document.getElementById("hoja1").value;
  var hoja2=document.getElementById("hoja2").value;
  var paciente_rd=document.getElementById("paciente_rd").value;
  var cod_rd=document.getElementById("cod_rd").value;
  var cod_his = document.getElementById("cod_historial_repor").value;
  var tipoDato = document.getElementById("tipoDato").value;
  var cod_his_original = document.getElementById("cod_his_original").value;
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=grnth'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         hoja1:hoja1,
         hoja2:hoja2,
         paciente_rd:paciente_rd,
         cod_historial:cod_his,
         cod_rd:cod_rd,
         tipoDato:tipoDato,
         cod_his_original:cod_his_original
     };
     for (var key in datos) {
         if (datos.hasOwnProperty(key)) {
             var input = document.createElement('input');
             input.type = 'hidden';
             input.name = key;
             input.value = datos[key];
             form.appendChild(input);
         }
     }
   // Agregar el formulario al cuerpo del documento y enviarlo
   document.body.appendChild(form);
   form.submit();
}

</script>

<?php require("../librerias/footeruni.php"); ?>
