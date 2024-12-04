<?php require("../librerias/headeradmin1.php");
include("../librerias/globales.php");
?>
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

  /*fin del codigo reporte consulta*/
</style>
<style>
.imagen-tamano-carta {
          width: 100%;  /* Tamaño de hoja carta en pantallas grandes */
          height: auto; /* Tamaño de hoja carta en pantallas grandes */
          object-fit: cover; /* Ajustar la imagen para cubrir todo el contenedor */
      }

      /* Media query para hacer que la imagen sea más pequeña en pantallas medianas */
      @media (max-width: 992px) { /* Para dispositivos medianos (tabletas, pantallas más pequeñas) */
          .imagen-tamano-carta {
              width: 70%; /* Ajusta el ancho al 70% del contenedor */
              height: auto; /* Mantiene la proporción */
          }
      }

      /* Media query para hacer que la imagen se ajuste a pantallas pequeñas */
      @media (max-width: 576px) { /* Para dispositivos pequeños (teléfonos móviles) */
          .imagen-tamano-carta {
              width: 100%; /* Ocupa todo el ancho del contenedor */
              height: auto; /* Mantiene la proporción */
          }
      }
  #subRayar {
    text-decoration: underline; /* Subraya el texto */
    text-decoration-color: #000; /* Color de la línea (opcional) */
    text-decoration-thickness: 2px;
  }
  #cuadro{
    border: 1px solid #000; /* Agrega un borde negro de 2 píxeles a los cuatro lados */
  }
  #subtitulos{
    font-size: 12px;
    background-color: lightgray;
    font-weight: bold;
  }
  #datos{
    font-size: 11px;
  }

  tr, td {
      border: 1px solid black; /* Borde de 1px de color negro */
      text-align: left; /* Alineación del texto */
  }
  th {
      background-color: white; /* Color de fondo para los encabezados */
  }

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
<div class="container main-content">
  <div class="container p-2">
  <input type="hidden" name="hoja1" id='hoja1' value="<?php $m = (isset($hoja1) && is_numeric($hoja1))?$hoja1:'';echo $m; ?>">
  <input type="hidden" name="hoja2" id='hoja2' value="<?php $m = (isset($hoja2) && is_numeric($hoja2))?$hoja2:'';echo $m; ?>">
  <input type="hidden" name="paciente_rd" id='paciente_rd' value="<?php $m = (isset($paciente_rd) && ($paciente_rd)!='')?$paciente_rd:'';echo $m; ?>">
  <input type="hidden" name="cod_rd" id='cod_rd' value="<?php $m = (isset($cod_rd) && ($cod_rd)!='')?$cod_rd:'';echo $m; ?>">
  <input type="hidden" name="cod_historial_repor" id='cod_historial_repor' value="<?php $m = (isset($cod_his) && ($cod_his)!='')?$cod_his:'';echo $m; ?>">
  <input type="hidden" name="tipoDato" id='tipoDato' value="<?php $m = (isset($tipoDato) && ($tipoDato)!='')?$tipoDato:'';echo $m; ?>">
  <input type="hidden" id='cod_his_original' name="cod_his_original" value="<?php $m = (isset($cod_his_original) && is_numeric($cod_his_original))?$cod_his_original:'';echo $m; ?>">

  <br>
  <div class="row">
    <div class="col-12">
      <input type="button" style="padding:3px;margin:3px"name="" value="Generar Reporte" class="btn btn-warning" onclick="GenerarNuevoReporte()">
    </div>
  </div>
  <div class="table-responsive">
  <table style="border:2px solid black" class="table table-bordered">
    <tr>
        <td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde">
        </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde"></td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde">
        </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde"></td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde">
        </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde"></td>
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
    <td colspan="6">
    <table class="table">
      <tr>
        <td colspan="6">
          <h5 align='right'>Zona <?php $m = (isset($fi['zona_his']) && $fi['zona_his']!='')?$fi['zona_his']:'';echo $m; ?> </h5>
          <h6 style='font-size:9px' align='rigth'>SERVICIO DEPARTAMENTAL DE SALUD POTOSI</h6>
          <h6 style='font-size:9px' align='rigth'>RED DE SERVICIOS DE SALUD MUNICIPAL UNCIA</h6>
          <h5 align='center' id='subRayar'>HISTORIA CLINICA</h5>
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
  <?php
}else if($tipoDocumento == 2){?>
  <?php
    $descripcion = $fi["descripcion"];
    $ruta = $fi["ruta_imagen"];
    $nombre_imagen = $fi["nombre_imagen"];

  ?>
  <tr>
    <td colspan="6" style="border:1px solid black">
      <table style="border:1px solid black;width:100%">
        <tr style="border:1px solid black">
          <td >
            <h5 align='center'><?php echo $descripcion; ?></h5>
            <img src="<?php echo $ruta.$nombre_imagen; ?>" alt="Descripción de la imagen" class="img-fluid d-block mx-auto imagen-tamano-carta">
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
    <tr style="border:2px solid black">
    <td colspan="6">
        <table class="table table-bordered" style="border: 1px solid black;">
              <thead class="">
                <tr>
                  <td colspan="6">
                    <div style="width:35%" id='saltoLinea'>
                      <div style='font-size:11px;' align='center'>MINISTERIO DE SALUD</div>
                      <div style='font-size:11px' align='center'>DEPARTAMENTAL DE SALUD DE POTOSI</div>
                      <div style='font-size:11px' align='center'>SERVICIO DE SALUD MUNICIPAL DE UNCIA</div>
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
  </div>
</div>
</div>
<style media="screen">
#resultado12{
position: absolute;
z-index: 999;
color: black;
overflow-y: auto;
width: 30%;
transform: translateY(-5px);
}
</style>

<script type="text/javascript">

function RegistroHistorial(){
//responsable de familia

var Nombre_responsable =document.getElementById("Nombre_responsable").value;
var ap_responsable =document.getElementById("ap_responsable").value;
var am_responsable =document.getElementById("am_responsable").value;
var fecha_nacimiento_responsable =document.getElementById("fecha_nacimiento_responsable").value;
var sexo_responsable =document.getElementById("sexo_responsable").value;
var ocupacion_responsable =document.getElementById("ocupacion_responsable").value;
var direccion_responsable =document.getElementById("direccion_responsable").value;
var telefono_resposable =document.getElementById("telefono_resposable").value;
var comunidad_responsable =document.getElementById("comunidad_responsable").value;
var ci =document.getElementById("ci").value;
var n_seguro =document.getElementById("n_seguro").value;
var n_carp_fam =document.getElementById("n_carp_fam").value;
var zona_his =document.getElementById("zona_his").value;

//identificacion del pacient
var cod_usuario = document.getElementById("cod_usuario").value;
var paciente_rd = document.getElementById("paciente_rd").value;
var cod_rd = document.getElementById("cod_rd").value;
var fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
var sexo = document.getElementById("sexo").value;
var ocupacion = document.getElementById("ocupacion").value;
var fecha_de_consulta = document.getElementById("fecha_de_consulta").value;
var estado_civil = document.getElementById("estado_civil").value;
var escolaridad = document.getElementById("escolaridad").value;

if(Nombre_responsable==""||ap_responsable==""||am_responsable==""||fecha_nacimiento_responsable==""||sexo_responsable==""||ocupacion_responsable==""
||direccion_responsable==""||comunidad_responsable==""||ci==""||fecha_nacimiento==""
||sexo==""||ocupacion==""||fecha_de_consulta==""||estado_civil==""||escolaridad==""){
  ingreseNPdatos();
  return;
}
var datos = new FormData(); // Crear un objeto FormData vacío
datos.append("Nombre_responsable",Nombre_responsable);
datos.append("ap_responsable",ap_responsable);
datos.append("am_responsable",am_responsable);
datos.append("fecha_nacimiento_responsable",fecha_nacimiento_responsable);
datos.append("sexo_responsable",sexo_responsable);
datos.append("ocupacion_responsable",ocupacion_responsable);
datos.append("direccion_responsable",direccion_responsable);
datos.append("telefono_resposable",telefono_resposable);
datos.append("comunidad_responsable",comunidad_responsable);
datos.append("ci",ci);
datos.append("n_seguro",n_seguro);
datos.append("n_carp_fam",n_carp_fam);
datos.append("zona_his",zona_his);

datos.append("cod_usuario",cod_usuario);
datos.append("paciente_rd",paciente_rd);
datos.append("cod_rd",cod_rd);
datos.append("fecha_nacimiento",fecha_nacimiento);
datos.append("sexo",sexo);
datos.append("ocupacion",ocupacion);
datos.append("fecha_de_consulta",fecha_de_consulta);
datos.append("estado_civil",estado_civil);
datos.append("escolaridad",escolaridad);
$.ajax({
  url: "../controlador/historial.controlador.php?accion=rhRyP",
  type: "POST",
  data: datos,
  contentType: false, // Deshabilitar la codificación de tipo MIME
  processData: false, // Deshabilitar la codificación de datos
  success: function(data) {
   alert(data+"dasdas");
    data=$.trim(data);
    if(data == "correcto"){

      //if(accion == 1){
        //  alertCorrectoUp();
          // close(pagina,listarDeCuanto,buscar);
      //}else{
        alertCorrecto();
      //}
      IRalLinkTablaRegistroDiario();
    }else {
      Swal.fire({
       icon: 'error',
       title: '¡Error!',
       text: '¡Ocurrio un problema!',
       showConfirmButton: false,
       timer: 1500
     });
    }
  }
});
}


function ingreseNPdatos(){
  Swal.fire({
   icon: 'error',
   title: '¡Error!',
   text: '¡Ingrese los Datos!',
   showConfirmButton: false,
   timer: 1500
 });
}
function vaciarDESPUESdeUNtiempo(){
  setTimeout(() => {
    $('#resultado12').html("");
  }, 5000);
}

//funcion para buscar si existe el Paciente
  function buscarExitepaciente(){
    vaciarDESPUESdeUNtiempo();
    var nombre = document.getElementById("Nombre_responsable").value;
    if(nombre != ""){
    //  alert(nombre);
      $.ajax({
    		url: "../controlador/historial.controlador.php?accion=rbph",
    		type: "POST",
    		data: {nombre:nombre},
    		dataType: "json",
        success: function(data) {

          console.log(data);
          if(data!=""){
            var unir="";
            for (let i = 0; i < data.length; i++) {
              var usuario = data[i];
              unir+="<div><div id='u' style=' display: inline-block;'>"+Convertir(data[i].nombre_usuario)+"</div> ";
              unir+="<div id='ap' style=' display: inline-block;'> "+Convertir(data[i].ap_usuario)+"</div> ";
              unir+="<div id='am' style=' display: inline-block;'> "+Convertir(data[i].am_usuario)+"</div> ";
              unir+="<div id='fn' style=' display: inline-block;'> "+data[i].fecha_nac_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].direccion_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].sexo_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].ocupacion_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].telefono_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].comunidad_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].ci_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].nro_seguro_usuario+"</div>";
              unir+="<div id='d' style=' display: inline-block;display:none;'>"+data[i].nro_car_form_usuario+"</div>";
              unir+="<div id='c' style=' display: inline-block;display:none;'>"+data[i].cod_usuario+"</div></div>";
            }
            visualizarUser(unir);
            $('#resultado12 div').on('click', function() {
                    //obtenemos los datos del usuario div resultado12
              var nombre = $(this).children().eq(0).text();
              var ap = $(this).children().eq(1).text();
              var am = $(this).children().eq(2).text();
              var fn = $(this).children().eq(3).text();
              var d = $(this).children().eq(4).text();
              var sexo = $(this).children().eq(5).text();

              var ocu = $(this).children().eq(6).text();
              var tele = $(this).children().eq(7).text();
              var comuni = $(this).children().eq(8).text();
              var ci = $(this).children().eq(9).text();
              var nro_seg = $(this).children().eq(10).text();
              var nro_car = $(this).children().eq(11).text();
              var cd_u = $(this).children().eq(12).text();
                //dentro de los id de la vista mostramos los datos que estan en el div resultado12
                if(nombre != ""){
                  var r1 = (nombre) ? true : false;
                  document.getElementById("Nombre_responsable").disabled = r1;
                  document.getElementById("Nombre_responsable").value = nombre;
                  r1 = (ap) ? true : false;
                  document.getElementById("ap_responsable").disabled = r1;
                  document.getElementById("ap_responsable").value = ap;
                  r1 = (am) ? true : false;
                  document.getElementById("am_responsable").disabled = r1;
                  document.getElementById("am_responsable").value = am;
                  r1 = (fn) ? true : false;
                  document.getElementById("fecha_nacimiento_responsable").disabled = r1;
                  var fecha = new Date(fn); // Puedes modificar esta fecha según tus necesidades

                  // Formatear la fecha como una cadena para asignarla al campo de tipo date
                  var fechaFormateada = fecha.toISOString().split('T')[0];
                  document.getElementById("fecha_nacimiento_responsable").value = fechaFormateada;
                  r1 = (sexo) ? true : false;
                  document.getElementById("sexo_responsable").disabled = r1;
                  document.getElementById("sexo_responsable").value = sexo;
                  r1 = (d) ? true : false;
                  document.getElementById("direccion_responsable").disabled = r1;
                  document.getElementById("direccion_responsable").value = d;
                  r1 = (ocu) ? true : false;
                  document.getElementById("ocupacion_responsable").disabled = r1;
                  document.getElementById("ocupacion_responsable").value = ocu;
                  r1 = (tele && tele != 0) ? true : false;
                  document.getElementById("telefono_resposable").disabled = r1;
                  document.getElementById("telefono_resposable").value = tele;
                  r1 = (comuni) ? true : false;
                  document.getElementById("comunidad_responsable").disabled = r1;
                  document.getElementById("comunidad_responsable").value = comuni;
                  r1 = (ci && ci != 0) ? true : false;
                  document.getElementById("ci").disabled = r1;
                  document.getElementById("ci").value = ci;
                  r1 = (nro_seg && nro_seg !=0) ? true : false;
                  document.getElementById("n_seguro").disabled = r1;
                  document.getElementById("n_seguro").value = nro_seg;
                  r1 = (nro_car && nro_car != 0) ? true : false;
                  document.getElementById("n_carp_fam").disabled = r1;
                  document.getElementById("n_carp_fam").value = nro_car;
                  r1 = (cd_u) ? true : false;
                  document.getElementById("cod_usuario").disabled = r1;
                  document.getElementById("cod_usuario").value = cd_u;
                  $('#resultado12').html(""); //para vaciar
                }
            });
        }else{
          $('#resultado12').html("<div class='alert alert-light' role='alert'>No se encontro resultado12s</div>");
        }
  		}
  	});
  }else{
    $('#resultado12').html("");
  }
}

function Convertir(t){
  let palabras = t.split(" ");
  let nombreConInicialesMayusculas = "";
   for (let i = 0; i < palabras.length; i++) {
     nombreConInicialesMayusculas += palabras[i].charAt(0).toUpperCase() + palabras[i].slice(1) + " ";
    }
     return nombreConInicialesMayusculas.trim();
 }

  function visualizarUser(unir){

  $('#resultado12').html(unir);
  //colocamos un color de css
  $('#resultado12').css({
   'cursor': 'pointer',
   'font-size':'15px'
   });
   // Obtener el elemento div con el id "results"
  /* const divResults = document.getElementById('results');   // Cambiar la clase del div
  divResults.setAttribute('class', 'alert alert-primary mb-0 py-0 border-0');
*/
}
function accionHitorialVer(paciente_rd,cod_rd){
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/historial.controlador.php?accion=vht'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato
     var datos = {
         paciente_rd:paciente_rd,
         cod_rd:cod_rd
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
     form.action = '../controlador/historial.controlador.php?accion=grnthtt'; // Coloca la URL de destino correcta
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
