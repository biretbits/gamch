<?php require("../librerias/headeradmin1.php"); ?>
<?php $tablahis=$_SERVER["REQUEST_URI"];
      $diario = $_SESSION["diario"];
      $_SESSION['this']=$tablahis;
?>

<div class="container main-content">
<div class="container">
  <?php
  echo "<div id='color1'><a href='$diario'id='co'>Registro Diario</a>><a href='#'
   onclick='accionHitorialVer($paciente_rd,$cod_rd)'
   id='co'>Historial</a>></div>"; ?>
  <div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
  <h4>Historial Clinico</h4>
  <input type="hidden" name="paciente_rd" id="paciente_rd" value="<?php $ms = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd:""; echo $ms; ?>">
  <input type="hidden" name="cod_rd" id= "cod_rd" value="<?php $ms = (isset($cod_rd) && is_numeric($cod_rd))? $cod_rd:""; echo $ms; ?>">
  <div class="row align-items-center">
    <label for="selectPage" class="form-label col-auto mb-2">Page</label>
    <div class="col-auto mb-2">
      <select class="form-select" id="selectList" name="selectList" onchange="BuscarRegistrosHistorial(1)">
        <option>--</option>
        <option>5</option>
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
        <option>250</option>
        <option>500</option>
        <option>1000</option>
      </select>
    </div>
    <div class="col-auto mb-2" title="Registro de nuevo hisorial">
      <button type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="RegistroHistorial(<?php echo $paciente_rd;?>,<?php echo $cod_rd; ?>) ">
        <img src='../imagenes/historialClinico.ico' style='height: 25px;width: 25px;'>
      </button>
    </div>
    <div class="col-auto mb-2">
      <input type="date" name="fecha" id="fecha" value="" class="form-control" onchange="BuscarRegistrosHistorial(1)">
    </div>
    <div class="col-auto mb-2" title="Reporte">
      <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalReportePorFecha">
        <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'>
      </button>
    </div>
    <div class="col-auto mb-2">
      <!-- espacio vacío para mantener el diseño intacto -->
    </div>
    <div class="col mb-2">
      </div>
  </div>
  </div>
  <!-- modal para generar fechas desde seleccionar fechas -->
  <?php
  // Obtener la fecha actual en formato YYYY-MM-DD
    $fechaActual = date('Y-m-d');
  ?>
  <div class="modal fade" id="ModalReportePorFecha" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="miModalLabel">Selección de fechas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Contenido del modal -->
        <div class="modal-body">
          <form class="form-inline" >
            <input type="hidden" name="pagina1" id='pagina1' value="">
            <div class="row mb-3">
              <label for="fecha1" class="form-label">Fecha inicio</label>
              <div class="input-group">
                <input type="date" id="fecha1" name="fecha1" value="<?php echo $fechaActual; ?>" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <label for="fecha1" class="form-label">Fecha final</label>
              <div class="input-group">
                <input type="date" id="fecha2" name="fecha2" value="<?php echo $fechaActual; ?>" class="form-control">
              </div>
            </div>
            <div class="for-control alert alert-light">
              Nota:
              Seleccione de que fecha a que fecha quiere generar reporte
            </div>
          </form>
        </div>
        <!-- Pie de página del modal -->
        <div class="modal-footer">
          <button type="button"  class="btn btn-success" title = 'Generar reporte' onclick="GenerarReporte()"><img src='../imagenes/aceptar.ico' style='height: 25px;width: 25px;'> Generar</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><img src='../imagenes/drop.ico' style='height: 25px;width: 25px;'></button>
        </div>

      </div>
    </div>
  </div>

  <div class="verDatos" id="verDatos">
    <div class="row">
      <div class="col">
        <div class="table-responsive">
        <table class="table">
          <thead style="font-size:12px">
            <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Zona</th>
              <th>Responsable Familiar</th>
              <th>Paciente</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>

      <?php
      if ($resul && count($resul) > 0){
          $i = 0;
        foreach ($resul as $fi){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['fecha']."</td>";
              echo "<td>".$fi['zona_his']."</td>";
              $datosResponsable = $fi['datos_responsable_familia'];
              echo "<td>";
              foreach ($datosResponsable as $resFamiliar) {
                echo $resFamiliar["nombre_usuario_re"]." ".$resFamiliar["ap_usuario_re"]." ".$resFamiliar["am_usuario_re"];
              }
              echo "</td>";

              $datospaciente = $fi['paciente_rd_nombre'];
              echo "<td>";
              foreach ($datospaciente as $datos) {
                echo $datos["nombre_usuario_re"]." ".$datos["ap_usuario_re"]." ".$datos["am_usuario_re"];
              }
              echo "</td>";

              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-info' title='Editar' onclick='ActualizarHistorial(".$fi['cod_his'].",".$fi['cod_rd'].",".$fi['paciente_rd'].",".$listarDeCuanto.",".$pagina.",\"".$fecha."\")'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                    //echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
                echo "</div>";
              echo "</td>";

            echo "</tr>";
            $i++;
          }
        }else{
          echo "<tr>";
          echo "<td colspan='15' align='center'>No se encontraron resultados</td>";
          echo "</tr>";
        }
         ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
  <?php
  if($TotalPaginas!=0){
    $adjacents=1;
    $anterior = "&lsaquo; Anterior";
    $siguiente = "Siguiente &rsaquo;";
echo "<div class='row'>
      <div class='col'>";

    echo "<div class='d-flex flex-wrap flex-sm-row justify-content-between'>";
      echo '<ul class="pagination">';
        echo "pagina &nbsp;".$pagina."&nbsp;con&nbsp;";
          $total=$inicioList+$pagina;
          if($TotalPaginas > $num_filas_total){
            $TotalPaginas = $num_filas_total;
          }
        echo '<li class="page-item active"><a class=" href="#"> '.($TotalPaginas).' </a></li> ';
        echo " &nbsp;de&nbsp;".$num_filas_total." registros";
      echo '</ul>';

      echo '<ul class="pagination d-flex flex-wrap">';

      // previous label
      if ($pagina != 1) {
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarRegistrosHistorial(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarRegistrosHistorial(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarRegistrosHistorial($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarRegistrosHistorial(1)\">1</a></li>";
      }
      // interval
      if($pagina>($adjacents+2)) {
        echo"<li class='page-item'><a class='page-link'>...</a></li>";
      }

      // pages

      $pmin = ($pagina>$adjacents) ? ($pagina-$adjacents) : 1;
      $pmax = ($pagina<($TotalPaginas-$adjacents)) ? ($pagina+$adjacents) : $TotalPaginas;
      for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$pagina) {
          echo "<li class='page-item active'><a class='page-link'>$i</a></li>";
        }else if($i==1) {
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarRegistrosHistorial(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarRegistrosHistorial(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarRegistrosHistorial($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarRegistrosHistorial($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarRegistrosHistorial($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";

  }
   ?>
 </div>
 </div>
 <!-- modal de seleccion de fechas-->
<script type="text/javascript">
function BuscarRegistrosHistorial(page){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var fecha = document.getElementById("fecha").value;
    var paciente_rd = document.getElementById("paciente_rd").value;
    var cod_rd = document.getElementById("cod_rd").value;
    //ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('pagina', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append('fecha',fecha);
    datos.append("paciente_rd",paciente_rd);
    datos.append("cod_rd",cod_rd);
      $.ajax({
        url: "../controlador/historial.controlador.php?accion=bht",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
  //    alert(data+"dasdas");
          $("#verDatos").html(data);
        }
      });
  }

  function verificarList(valor){
    if(valor != "" && valor != "--"){
      return valor;
    }else{
      return 5;
    }
  }
function RegistroHistorial(paciente_rd,cod_rd){

  var form = document.createElement('form');
   form.method = 'post';
   form.action = "../controlador/historial.controlador.php?accion=visFH"; // Coloca la URL de destino correcta
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

function ActualizarHistorial(cod_his,cod_rd,paciente_rd,listarDeCuanto,pagina,fecha){
  var selectList = document.getElementsByName("selectList").value;
    var fecha = document.getElementsByName("fecha").value;
  var form = document.createElement('form');
   form.method = 'post';
   form.action = '../controlador/historial.controlador.php?accion=aht'; // Coloca la URL de destino correcta
   // Agregar campos ocultos para cada dato
   var datos = {
       paciente_rd:paciente_rd,
       cod_rd:cod_rd,
       cod_his:cod_his,
       listarDeCuanto:listarDeCuanto,
       pagina:pagina,
       fecha:fecha
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
</script>
<?php require("../librerias/footeruni.php"); ?>
