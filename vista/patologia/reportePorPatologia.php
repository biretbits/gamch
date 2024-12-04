<?php require("../librerias/headeradmin1.php"); ?>

<div class="container main-content">
  <div class="container">
    <br>

       <div class="row">
         <div class="col-auto mb-2" style="color:gray">
           <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" onclick="generarReporte()">
             <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'> Reporte
           </button>
         </div>
         <div class="col-4 mb-1">

         </div>
         <?php $fechai=date('Y-m-d'); ?>
         <div class="col-auto mb-2">
           <label for="">Fecha inicio</label>
           <input type="date" name="fechai" id="fechai" value="<?php echo $fechai; ?>" onchange="Buscar()" class="form-control">
         </div>

         <div class="col-auto mb-2">
            <label for="">Fecha final</label>
           <input type="date" name="fechaf" id="fechaf" value="<?php echo $fechai; ?>" onchange="Buscar()" class="form-control">
         </div>
      </div>
    <font><h6 align='center'>PACIENTES POR ENFERMEDAD</h6></font>
      <div class='row'>
        <div class='col'>
          <div class='table-responsive'>
            <div id='cambiar'>
              <div class="table-responsive" style="width: 60%; margin: auto;">
              <table class="table table-bordered" style="font-size: 12px;">
                <thead style="text-align:center">
                  <!--class="table-dark"-->
                  <tr>
                    <th>N°</th>
                    <th>Enfermedad</th>
                    <th>Contar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $k = 1;
                  $suma = 0;
                  while ($fi = mysqli_fetch_array($resul1)) {
                    echo "<tr>";
                    echo "<td>" . $k . "</td>";
                    echo "<td>" . $resultadoTotal[$fi['cod_pat']]['patologias'] . "</td>";
                    echo "<td style='text-align:right'>" . $resultadoTotal[$fi['cod_pat']]['contar'] . "</td>";
                    $suma += $resultadoTotal[$fi['cod_pat']]['contar'];
                    echo "</tr>";
                    $k += 1;
                  }
                  echo "<tr>";
                  echo "<td align='center' colspan='2'>Total</td>";
                  echo "<td style='text-align:right'>" . $suma . "</td>";
                  echo "</tr>";
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function Buscar(){
  var fechai = document.getElementById("fechai").value;
  var fechaf = document.getElementById("fechaf").value;
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('fechai', fechai);
    datos.append('fechaf', fechaf);
      $.ajax({
        url: "../controlador/registroDiario.controlador.php?accion=bpen",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //alert(data+"dasdas");
          $("#cambiar").html(data);
        }
      });
  }
  function generarReporte(){
    //alert(33);
    var fechai = document.getElementById("fechai").value;
    var fechaf = document.getElementById("fechaf").value;
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/registroDiario.controlador.php?accion=grpp'; // Coloca la URL de destino correcta
     // Agregar campos ocultos para cada dato

     var datos = {
       fechai:fechai,
       fechaf:fechaf
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
