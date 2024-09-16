<?php require("../librerias/headeradmin1.php"); ?>
<?php $RegistroDiario=$_SERVER["REQUEST_URI"];
$_SESSION["diario"] = $RegistroDiario;?>
<style media="screen">
  #co{
    color:gray;
    font-size: 17px
  }
</style>
<div class="container main-content">
<div class="container">

   <div class="row">
     <div class="col-auto mb-2" style="color:gray">
       <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" onclick="GenerarReportesServicio()">
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
  <div id="cambiar">
  <h6 align='center'><b>CANTIDAD DE PACIENTES MASCULINOS ATENDIDOS</b>

</h6>
  <?php
      $ser = array();
      while($fi=mysqli_fetch_array($servicios))
      {
        $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
      }
      while($fi=mysqli_fetch_array($regDiario)){
        $ser[$fi['servicio_rd']]['contar']+=1;
      }
   ?>
    <?php
    $suma = 0;
        echo "<div class='row'>
              <div class='col'>
                <div class='table-responsive'>
                  <table class='table'>
                    <thead style='font-size:12px'>
                      <tr>
                        <th>N°</th>
                        <th>Servicio</th>
                        <th>Pacientes</th>
                      </tr>
                    </thead>
                    <tbody>";
                    $k = 1;
                    while($fi=mysqli_fetch_array($servicios1)){
                      echo "<tr>";
                      echo "<td>".$k."</td>";

                      echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                      echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                      $suma+=$ser[$fi['cod_servicio']]['contar'];
                      echo "</tr>";
                      $k+=1;
                    }
                    echo "<tr>";
                    echo "<td align='center' colspan='2'>Total Pacientes</td>";
                      echo "<td >".$suma."</td>";
                    echo "</tr>";
            echo "  </tbody>
              </table>
            </div>
          </div>  </div>";

     ?>


   <h6 align='center'><b>CANTIDAD DE PACIENTES FEMENINOS ATENDIDOS</b>

 </h6>
   <?php
       $ser = array();
       while($fi=mysqli_fetch_array($servicios2))
       {
         $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
       }
       while($fi=mysqli_fetch_array($regDiario1)){
         $ser[$fi['servicio_rd']]['contar']+=1;
       }
    ?>
     <?php
     $suma = 0;
         echo "<div class='row'>
               <div class='col'>
                 <div class='table-responsive'>
                   <table class='table'>
                     <thead style='font-size:12px'>
                       <tr>
                         <th>N°</th>
                         <th>Servicio</th>
                         <th>Pacientes</th>
                       </tr>
                     </thead>
                     <tbody>";
                     $k = 1;
                     while($fi=mysqli_fetch_array($servicios3)){
                       echo "<tr>";
                       echo "<td>".$k."</td>";

                       echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                       echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                       $suma+=$ser[$fi['cod_servicio']]['contar'];
                       echo "</tr>";
                       $k+=1;
                     }
                     echo "<tr>";
                     echo "<td align='center' colspan='2'>Total Pacientes</td>";
                       echo "<td >".$suma."</td>";
                     echo "</tr>";
             echo "  </tbody>
               </table>
             </div>
           </div>  </div>";

      ?>

         <h6 align='center'><b>CANTIDAD DE PACIENTES DE SEXO NO BINARIO ATENDIDOS</b>

       </h6>
      <?php
          $ser = array();
          while($fi=mysqli_fetch_array($servicios4))
          {
            $ser[$fi['cod_servicio']]=array('contar' =>0 ,'nombre_servicio'=> $fi['nombre_servicio']);
          }
          while($fi=mysqli_fetch_array($regDiario2)){
            $ser[$fi['servicio_rd']]['contar']+=1;
          }
       ?>
        <?php
        $suma = 0;
            echo "<div class='row'>
                  <div class='col'>
                    <div class='table-responsive'>
                      <table class='table'>
                        <thead style='font-size:12px'>
                          <tr>
                            <th>N°</th>
                            <th>Servicio</th>
                            <th>Pacientes</th>
                          </tr>
                        </thead>
                        <tbody>";
                        $k = 1;
                        while($fi=mysqli_fetch_array($servicios5)){
                          echo "<tr>";
                          echo "<td>".$k."</td>";

                          echo "<td>".$ser[$fi['cod_servicio']]['nombre_servicio']."</td>";
                          echo "<td>".$ser[$fi['cod_servicio']]['contar']."</td>";
                          $suma+=$ser[$fi['cod_servicio']]['contar'];
                          echo "</tr>";
                          $k+=1;
                        }
                        echo "<tr>";
                        echo "<td align='center' colspan='2'>Total Pacientes</td>";
                          echo "<td >".$suma."</td>";
                        echo "</tr>";
                echo "  </tbody>
                  </table>
                </div>
              </div>  </div>";

         ?>
    </div><!--sd-->
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
        url: "../controlador/servicio.controlador.php?accion=bfsx",
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

  function GenerarReportesServicio(){
    var fechai = document.getElementById("fechai").value;
    var fechaf = document.getElementById("fechaf").value;
    var form = document.createElement('form');
     form.method = 'post';
     form.action = '../controlador/servicio.controlador.php?accion=gfrsx'; // Coloca la URL de destino correcta
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
