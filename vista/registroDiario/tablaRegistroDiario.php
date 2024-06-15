<?php require("../librerias/headeradmin1.php"); ?>
<?php $RegistroDiario=$_SERVER["REQUEST_URI"];
$_SESSION["diario"] = $RegistroDiario;?>
<style media="screen">
  #co{
    color:gray;
    font-size: 17px
  }
</style>
<div class="container mt-5">
  <?php
  echo "<div id='color1'><a href='$RegistroDiario'id='co'>Registro Diario</a>></div>"; ?>
  <div class="row" >
     <div class="col-12">
       <hr>
     </div>
   </div>
   <div class="row">
     <div class="col-auto mb-2" style="color:gray">
         <h5>Registro Diario de Pacientes</h5>
     </div>
     <div class="col-3 mb-1">
       <!-- espacio vacío para mantener el diseño intacto -->
     </div>
     <div class="col-auto mb-2">
       <input type="date" name="fecha" id="fecha" value="" onchange="BuscarRegistrosDiarios(1)" class="form-control">
     </div>

     <div class="col-auto mb-2" title="Registro Diario">
       <button type="button" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="visualizarRegistrodiario()">
         <img src='../imagenes/paciente.ico' style='height: 25px;width: 25px;'> Nuevo Registro
       </button>
     </div>
     <div class="col-auto mb-2" title="Reporte">
       <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#ModalReportePorFecha">
         <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'> Reporte Diario
       </button>
     </div>
   </div>
   <div class="row" >
      <div class="col-12">
        <hr>
      </div>
    </div>

  <div class="row align-items-center">
    <label for="selectPage" class="form-label col-auto mb-2">Listar</label>
    <div class="col-auto mb-2">
      <select class="form-select" id="selectList" onchange="BuscarRegistrosDiarios(1)" name="selectList">
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
    <div class="col-4 mb-4">
      <!-- espacio vacío para mantener el diseño intacto -->
    </div>

    <div class="col mb-2">
      <input type="text" class="form-control" placeholder="Buscar..." id='buscaru' onkeyup="BuscarRegistrosDiarios(1)">
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
              <th>Hora</th>
              <th>Nombre y Apellidos</th>
              <th>Fecha de Nacimiento</th>
              <th>Edad</th>
              <th>Dirección</th>
              <th>Servicio</th>
              <th>Signos y Sintomas</th>
              <th>Personal que Brinda la atencion</th>
              <th>Hist. clinica</th>
              <th>Resp. Admision</th>
              <th>Fecha de retorno de la Historia</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
      <?php
      if ($resul && count($resul) > 0) {
          $i = 0;
        foreach ($resul as $fi){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['fecha_rd']."</td>";
              echo "<td>".$fi['hora_rd']."</td>";
              echo "<td>".$fi['nombre_usuario']." ".$fi['ap_usuario']." ".$fi['am_usuario']."</td>";
              echo "<td>".$fi['fecha_nac_usuario']."</td>";
              echo "<td>".$fi['edad_usuario']."</td>";
              echo "<td>".$fi['direccion_usuario']."</td>";
              echo "<td>".$fi['servicio_rd']."</td>";
              echo "<td>".$fi['signo_sintomas_rd']."</td>";
              echo "<td>".$fi['medico_nombre']."</td>";
              echo "<td>";
              if(isset($fi['historial_clinico_rd']) && $fi['historial_clinico_rd'] == "no"){

                    echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                      echo "<button type='button' class='btn btn-dark' title='Sin historial' style='font-size:10px' onclick='accionHitorialVer(".$fi["paciente_rd"].",".$fi["cod_rd"].")'>Sin historial</button>";
                    echo "</div>";

              }else{
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-success' title='Hay historiales del paciente' style='font-size:10px'
                  onclick='accionHitorialVer(".$fi["paciente_rd"].",".$fi["cod_rd"].")'><img src='../imagenes/evaluacion.ico' style='height: 25px;width: 25px;'> His.</button>";

                echo "</div>";
              }
              echo "</td>";

              echo "<td>".$fi['admision_nombre']."</td>";
              echo "<td>".$fi['fecha_retorno_historia_rd']."</td>";
              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-info' title='Editar' onclick = 'editarpaciente(".$fi["cod_rd"].",".$fi["paciente_rd"].",\"".$buscar."\",".$pagina.",".$listarDeCuanto.",\"".$fecha."\")'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                    //echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";

                echo "</div>";
              echo "</td>";


            echo "</tr>";
            $i++;
          }
        }else{
          $resul = 'No se encontro resultados';
          echo $resul;
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
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarRegistrosDiarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarRegistrosDiarios(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarRegistrosDiarios($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarRegistrosDiarios(1)\">1</a></li>";
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
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarRegistrosDiarios(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarRegistrosDiarios(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarRegistrosDiarios($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarRegistrosDiarios($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarRegistrosDiarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";

  }
   ?>
 </div>
 <!-- modal de seleccion de fechas-->


<script type="text/javascript">
function BuscarRegistrosDiarios(page){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscaru").value;
    var fecha = document.getElementById("fecha").value;
    ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha);
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('buscar', buscar);
    datos.append('page', page);
    datos.append('listarDeCuanto',listarDeCuanto);
    datos.append('fecha',fecha);
      $.ajax({
        url: "../controlador/registroDiario.controlador.php?accion=brd",
        type: "POST",
        data: datos,
        contentType: false, // Deshabilitar la codificación de tipo MIME
        processData: false, // Deshabilitar la codificación de datos
        success: function(data) {
      //alert(data+"dasdas");
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

  function visualizarRegistrodiario(){
     location.href="../controlador/registroDiario.controlador.php?accion=vrd";
   }

   function error(){
  	 Swal.fire({
  		icon: 'error',
  		title: '¡Error!',
  		text: '¡No se pudo realizar la acción !',
  		showConfirmButton: false,
  		timer: 1500
  	});
   }
   //funcion para ingresar los datos al formulario modal para poder realizar luego el submit
   function   ponerFechactualAlModalDeReporte(listarDeCuanto,buscar,page,fecha){
      if(fecha != ""){
        document.getElementById("fecha1").value=fecha;
        document.getElementById("fecha2").value=fecha;
      }
      document.getElementById("pagina1").value=page;

   }
   function GenerarReporte(){
     var fecha1 = document.getElementById("fecha1").value;
     var fecha2 = document.getElementById("fecha2").value;
     var buscar = document.getElementById("buscaru").value;
     var pagina = document.getElementById("pagina1").value
     if(pagina == ""){pagina = 1;}
     var obt_lis = document.getElementById("selectList").value;
     var listarDeCuanto = verificarList(obt_lis);
     var form = document.createElement('form');
      form.method = 'post';
      form.action = '../controlador/registroDiario.controlador.php?accion=gr'; // Coloca la URL de destino correcta
      // Agregar campos ocultos para cada dato
      var datos = {
        fechai:fecha1,
        fechaf:fecha2,
        buscar:buscar,
        paginas:pagina,
        listarDeCuantos:listarDeCuanto
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
   //funcion para ver el historial del paciente
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
   function editarpaciente(cod_rd,paciente,buscar,pagina,listarDeCuanto,fecha){
     var form = document.createElement('form');
      form.method = 'post';
      form.action = '../controlador/registroDiario.controlador.php?accion=fa'; // Coloca la URL de destino correcta
      // Agregar campos ocultos para cada dato
      var datos = {
          cod_rd:cod_rd,
          paciente_rd:paciente,
          buscar:buscar,
          pagina:pagina,
          listarDeCuanto:listarDeCuanto,
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
</script>
<?php require("../librerias/footeruni.php"); ?>
