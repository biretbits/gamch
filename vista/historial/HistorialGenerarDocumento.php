<?php require("../librerias/headeradmin1.php");
?>
<style media="screen">

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
    <br>
    <div class="row">
      <div class="col-12">
        <input type="button" style="padding:3px;margin:3px"name="" value="Generar Reporte" class="btn btn-warning" onclick="GenerarNuevoReporte()">
      </div>
    </div>
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
      }
      ?>
      <div class="table-responsive">
      <table style="border:2px solid black;width:100%" class="table table-bordered">
        <tr>
            <td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde">
            </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde"></td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde">
            </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde"></td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde">
            </td><td style="width:16%;padding:0" class="abajoBorde derechoBorde izquierdoBorde"></td>
        </tr>
        <tr>
          <td colspan="6" style="border:1px solid black">
            <table style="border:1px solid black;width:100%">
              <tr style="border:1px solid black">
                <td >
                  <h5 align='center'><?php echo $descripcion; ?></h5>
                  <img src="<?php echo $ruta.$nombre_imagen; ?>" alt="No se encontro la imagen" class="img-fluid d-block mx-auto imagen-tamano-carta">
                </td>
              </tr>
            </table>
          </td>
        </tr>

      </table>
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
