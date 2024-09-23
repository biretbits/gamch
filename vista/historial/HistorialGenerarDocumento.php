<?php require("../librerias/headeradmin1.php");
?>
<div class="container main-content">
  <div class="container p-2">
    <input type="hidden" name="hoja1" id='hoja1' value="<?php $m = (isset($hoja1) && is_numeric($hoja1))?$hoja1:'';echo $m; ?>">
    <input type="hidden" name="hoja2" id='hoja2' value="<?php $m = (isset($hoja2) && is_numeric($hoja2))?$hoja2:'';echo $m; ?>">
    <input type="hidden" name="paciente_rd" id='paciente_rd' value="<?php $m = (isset($paciente_rd) && ($paciente_rd)!='')?$paciente_rd:'';echo $m; ?>">
    <input type="hidden" name="cod_rd" id='cod_rd' value="<?php $m = (isset($cod_rd) && ($cod_rd)!='')?$cod_rd:'';echo $m; ?>">
    <input type="hidden" name="cod_historial_repor" id='cod_historial_repor' value="<?php $m = (isset($cod_his) && ($cod_his)!='')?$cod_his:'';echo $m; ?>">
    <input type="hidden" name="tipoDato" id='tipoDato' value="<?php $m = (isset($tipoDato) && ($tipoDato)!='')?$tipoDato:'';echo $m; ?>">

    <div class="row" >
      <div class="col-12">
        <hr>
      </div>
    </div>
    <input type="button" name="" value="Generar Reporte" class="btn btn-warning" onclick="GenerarNuevoReporte()">

    <?php
    if ($resul && count($resul) > 0){
        $i = 0;
      $descripcion = "";
      $ruta = "";
      $nombre_imagen = "";
      foreach ($resul as $fi){
        $descripcion = $fi["descripcion"];
        $ruta = $fi["ruta_imagen"];
        $nombre_imagen = $fi["nombre_imagen"];
      }?>
      <div class="row">
        <div class="col-12">
          <h5 align='center'><?php echo $descripcion; ?></h5>
        </div>
        <div class="">
          <img src="<?php echo $ruta.$nombre_imagen; ?>" alt="Descripción de la imagen" class="img-fluid d-block mx-auto">
        </div>
      </div>
    <?php }?>
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
         tipoDato:tipoDato
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
