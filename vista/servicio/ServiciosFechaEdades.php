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
          <!-- Columna para cada gráfico -->
    <hr>
    <div class="row">
     <div class="col-2" style="color:gray">
       <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" onclick="GenerarReportesServicio()">
         <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'> Reporte
       </button>
     </div>

     <div class="col-2">
     </div>
     <div class="col-2">
       <label for="">Edad inicio</label>
       <input type="number" name="" id='edadi' value="0" min='0' max='140' onchange="Buscar()" class="form-control"placeholder="Edad final">
       <br>
     </div>

     <div class="col-2">
       <label for="">edad final</label>
       <br>
       <input type="number" name="" id='edadf' value="0" min='0' max='140' onchange="Buscar()" class="form-control" placeholder="Edad final">
    </div>
     <?php $fechai=date('Y-m-d'); ?>
     <div class="col-2">
       <label for="">Fecha inicio</label>
       <input type="date" name="fechai" id="fechai" value="<?php echo $fechai; ?>" onchange="Buscar()" class="form-control">
     </div>

     <div class="col-2">
       <label for="">Fecha final</label>
       <input type="date" name="fechaf" id="fechaf" value="<?php echo $fechai; ?>" onchange="Buscar()" class="form-control">
     </div>
  </div>
  <br>
  <h5 align='center'><b>Cantidad de pacientes atendidos por edades</b></h5>

<div id="cambiar">


<div class="row">

  <?php
  if(mysqli_num_rows($regDiario)>0){
    foreach($edades as $e){
        echo "<textarea  name='graficosI".$e."' id='graficosI".$e."' hidden></textarea >";
    }

        function generateRandomColor() {
          $r = rand(0, 255);
          $g = rand(0, 255);
          $b = rand(0, 255);
          return rgbToHex($r, $g, $b);
      }

      function rgbToHex($r, $g, $b) {
          return sprintf("#%02x%02x%02x", $r, $g, $b);
      }
      $c= 0;
      foreach($edades as $e){
        echo "<div class='col-12 col-sm-6 col-lg-6 mb-6'>";
        echo "<center><b>CANTIDAD DE PACIENTES DE $e AÑOS ATENDIDOS</b>";
        echo "<canvas id='grafica".$e."'></canvas>";
        echo "</center>
        </div>";
      }
      $labeles = '';
      $labeles.="var labels = [";
      mysqli_data_seek($servicios, 0);
      $filass = mysqli_num_rows($servicios);
      $i = 0;
      mysqli_data_seek($servicios, 0);
      while($f = mysqli_fetch_array($servicios)){
        if($filass-1 == $i){
          $labeles.="'".$f["nombre_servicio"]."'";
      }else{
          $labeles.="'".$f["nombre_servicio"]."',";
        }
        $i=$i+1;
      }
      $labeles.="];";
      echo "<script>";
      echo $labeles;

      foreach($edades as $e)
      {
        $numColors = $filass;
        $colors = [];
        for ($i = 0; $i < $numColors; $i++) {
            $colors[] = generateRandomColor();
        }
        echo "var colors = [";
        $i = 0;
        foreach ($colors as $color) {
            if($filass-1 == $i){
              echo "'$color'";
            }else {
              echo "'$color',";
            }
            $i=$i+1;
        }
        echo "];"; // Asegúrate de que los colores coincidan con los datasets
        echo "
        var data = {
            labels: labels,
            datasets: [{
                label: 'Cantidad de pacientes por servicio',
                data: [";
                mysqli_data_seek($servicios, 0);
                $i = 0;
                while($fii =mysqli_fetch_array($servicios)){
                  if($filass-1 == $i){
                    echo $re[$e][$fii["cod_servicio"]];
                  }else{
                    echo $re[$e][$fii["cod_servicio"]].",";
                  }
                  $i=$i+1;
                }
                echo "],
                backgroundColor: colors
            }]
        };";
        echo "
        var Options = {
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
            responsive: true
        };";
        echo "var pieChartCanvas = document.getElementById('grafica".$e."').getContext('2d');
        var pieChart = new Chart(pieChartCanvas, {
            type: 'bar',
            data: data,
            options: Options,
        });";
      }
      echo "</script>";
    }else{
      echo "<center>No se encontro resultados</center>";
    }
     ?>
 </div>
   </div>
   </div>
</div>
<script type="text/javascript">
function Buscar(){
  var edadi = document.getElementById("edadi").value;
  var edadf = document.getElementById("edadf").value;
  var fechai = document.getElementById("fechai").value;
  var fechaf = document.getElementById("fechaf").value;
  var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('fechai', fechai);
    datos.append('fechaf', fechaf);
    datos.append("edadi",edadi);
    datos.append("edadf",edadf);
      $.ajax({
        url: "../controlador/servicio.controlador.php?accion=bfep",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
        //  alert(data+"dasdas");
          $("#cambiar").html(data);
          setTimeout(generatechart, 700);
        }
      });
  }

  function GenerarReportesServicio(){
    var fechai = document.getElementById("fechai").value;
    var fechaf = document.getElementById("fechaf").value;
    var form = document.createElement('form');
    form.method = 'post';
    form.action = '../controlador/servicio.controlador.php?accion=gfred'; // Coloca la URL de destino correcta
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
     // Recorrer los elementos con IDs dinámicos y agregarlos al formulario
   for (var i = 0; i <= 120; i++) {
       var elem = document.getElementById("graficosI" + i);
       if (elem != null) { // Verificar si el elemento con ese ID existe
           var inputImage = document.createElement('input');
           inputImage.type = 'hidden';
           inputImage.name = 'imagen' + i; // Nombre del campo que contendrá la imagen
           inputImage.value = elem.value;
           form.appendChild(inputImage);
       }
   }
   for (var i = 0; i <= 120; i++) {
       var elem = document.getElementById("graficosI" + i);
       if (elem != null) { // Verificar si el elemento con ese ID existe
           var inputNew = document.createElement('input');
           inputNew.type = 'hidden';
           inputNew.name =  i; // Nombre del campo que contendrá la imagen
           inputNew.value = i;
           form.appendChild(inputNew);
       }
   }
   // Agregar el formulario al cuerpo del documento y enviarlo
   document.body.appendChild(form);
   form.submit();
  }


setTimeout(generatechart, 700);
function generatechart(){
    var edadfinal = 120;
    // Obtén una referencia al elemento canvas
    var ctx = null;
    var image = null;
    for(var i = 0;i<=edadfinal;i++){
      ctx = document.getElementById("grafica"+i);
      if(ctx!=null){//si existe el id creado del canvas
        // Captura la imagen como un formato base64 (por defecto, 'image/png')
        image = ctx.toDataURL('image/png');
        // Asigna la imagen en base64 al campo de texto con ID "base64"
        document.getElementById('graficosI'+i).value = image;
      }
    }
}
</script>

<?php require("../librerias/footeruni.php"); ?>
