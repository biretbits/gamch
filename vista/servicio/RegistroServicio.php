<?php require("../librerias/headeradmin1.php"); ?>

<div class="container main-content">
<div class="container">
  <div class="row">
    REGISTRO, ACTUALIZAR DE SERVICIOS
    <div class="col-md-10 offset-md-1">

<input type="hidden" name="cod_servicio" id='cod_servicio' value="">
        </div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="servicio" class="form-label">Nombre de servicio</label>
                <input type="text" class="form-control" id="servicio" placeholder="Ingrese servicio">
              </div>
              <div class="col-md-6 mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" placeholder="Ingresa descripción">
              </div>
            </div>
          </form>
        </div>
            <button type="button" class="btn btn-primary" onclick="registroServicio()">Registrar</button>
          </form>

    </div>
    <!--tabla-->
    <div class="row" >
       <div class="col-12">
         <hr>
       </div>
     </div>
    <div class="col-auto mb-2" style="color:gray">
      <h5>Servicios</h5>
    </div>
    <input type="hidden" name="paciente_rd" id="paciente_rd" value="<?php $ms = (isset($paciente_rd) && is_numeric($paciente_rd))? $paciente_rd:""; echo $ms; ?>">
    <input type="hidden" name="cod_rd" id= "cod_rd" value="<?php $ms = (isset($cod_rd) && is_numeric($cod_rd))? $cod_rd:""; echo $ms; ?>">
    <input type="hidden" name="paginas" id='paginas' value="">
    <div class="row align-items-center">
      <label for="selectList" class="form-label col-auto mb-2">Listar</label>
      <div class="col-auto mb-2">
        <select class="form-select" id="selectList" name="selectList" onchange="buscar(1)">
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

      </div>
      <label for="id_servicio" class="form-label col-auto mb-2">Servicios</label>
      <div class="col-auto mb-2">
        <select class="form-select" id="id_servicio" name="id_servicio" onchange="buscar(1)">
          <option value=''>Buscar por servicios</option>
          <?php
          while($f = mysqli_fetch_array($serv)){
            echo "<option value='".$f['cod_servicio']."'>".$f['nombre_servicio']."</option>";
          }
           ?>
        </select>
      </div>
      <div class="col-auto mb-2" title="Reporte">
        <button type="button" class="d-sm-inline-block btn btn-sm btn-warning shadow-sm" onclick="GenerarReportesServicio()">
          <img src='../imagenes/reporte.ico' style='height: 25px;width: 25px;'> Reporte
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

    <div class="verDatos" id="verDatos">
      <div class="row">
        <div class="col">
          <div class="table-responsive" style='font-size:12px'>
          <table class="table">
            <thead style="font-size:12px">
              <tr>
                <th>N°</th>
                <th>Nombre servicio</th>
                <th>Descripción</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>

        <?php
        if (mysqli_num_rows($servicios) > 0){
            $i = 0;
          foreach ($servicios as $fi){
              echo "<tr>";
                echo "<td>".($i+1)."</td>";
                echo "<td>".$fi['nombre_servicio']."</td>";
                echo "<td>".$fi['descripcion_servicio']."</td>";

                echo "<td>";
                  echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                    echo "<button type='button' class='btn btn-info' title='Editar' onclick='Actualizar_servicio(".$fi['cod_servicio'].",\"".$fi['nombre_servicio']."\",\"".$fi['descripcion_servicio']."\")'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                    if($fi["estado"]=='activo'){
                      echo "<button type='button' class='btn btn-danger' title='Desactivar Servicio' onclick='accionBtnActivar(\"desactivo\",".$fi["cod_servicio"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";
                    }else{
                      echo "<button type='button' class='btn btn-danger' title='Activar Servicio' onclick='accionBtnActivar(\"activo\",".$fi["cod_servicio"].")'><img src='../imagenes/activar.ico' height='17' width='17' class='rounded-circle'></button>";
                    }
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
          echo "<li class='page-item'><a class='page-link'  onclick=\"buscar(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
        }
        if($pagina==1) {
          echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
        } else if($pagina==2) {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"buscar(1)\" class='page-link'>$anterior</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"buscar($pagina-1)\">$anterior</a></li>";

        }
        // first label
        if($pagina>($adjacents+1)) {
          echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"buscar(1)\">1</a></li>";
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
            echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"buscar(1)\">$i</a></li>";
          }else {
            echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"buscar(".$i.")\" class='page-link'>$i</a></li>";
          }
        }

        // interval

        if($pagina<($TotalPaginas-$adjacents-1)) {
          echo "<li class='page-item'><a class='page-link'>...</a></li>";
        }
        // last

        if($pagina<($TotalPaginas-$adjacents)) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"buscar($TotalPaginas)\">$TotalPaginas</a></li>";
        }
        // next

        if($pagina<$TotalPaginas) {
          echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"buscar($pagina+1)\">$siguiente</a></li>";
        }else {
          echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
        }
        if ($pagina != $TotalPaginas) {
          echo "<li class='page-item'><a class='page-link' onclick=\"buscar($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
        }

        echo "</ul>";
        echo "</div>";

  echo "</div>
      </div>";

    }
     ?>
     <div class="card-footer text-muted">
       © 2024 Centro de Salud
     </div>
  </div>
</div>
<script type="text/javascript">
function registroServicio(){
  var cod_servicio=document.getElementById("cod_servicio").value;
  var servicio = document.getElementById("servicio").value;
  var descripcion = document.getElementById("descripcion").value;
  var datos = new FormData(); // Crear un objeto FormData vacío
  datos.append("servicio",servicio);
  datos.append("descripcion",descripcion);
  datos.append("cod_servicio",cod_servicio);
  if(servicio == ''){
    alertError();
    return;
  }
  $.ajax({
    url: "../controlador/servicio.controlador.php?accion=rse",
    type: "POST",
    data: datos,
    contentType: false, // Deshabilitar la codificación de tipo MIME
    processData: false, // Deshabilitar la codificación de datos
    success: function(data) {
    //alert(data+"dasdas");
      data=$.trim(data);
      if(data == "correcto"){
        Swal.fire({
         icon: 'success',
         title: '¡Correcto!',
         text: '¡Registro Correcto!',
         showConfirmButton: false,
         timer: 2000
       });
       setTimeout(() => {
          redireccionar();
      }, 1500);
      }else {
        Swal.fire({
         icon: 'error',
         title: '¡Error!',
         text: '¡Ocurrio un problema!',
         showConfirmButton: false,
         timer: 2000
       });
      }
    }
  });
}
function redireccionar(){
  window.location.href = "../controlador/servicio.controlador.php?accion=rsr";

}
function alertError(){
  Swal.fire({
   icon: 'error',
   title: '¡Error!',
   text: '¡Campo vacio!',
   showConfirmButton: false,
   timer: 1500
 });
}

function buscar(paginacion){
  var obt_lis = document.getElementById("selectList").value;
  var listarDeCuanto = verificarList(obt_lis);
  var id_servicio = document.getElementById("id_servicio").value;
  pagina = document.getElementById("paginas").value=paginacion;

  var datos = new FormData(); // Crear un objeto FormData vacío
  datos.append("paginacion",paginacion);
  datos.append("listarDeCuanto",listarDeCuanto);
  datos.append("id_servicio",id_servicio);
  //alert(id_servicio);
  $.ajax({
    url: "../controlador/servicio.controlador.php?accion=bs",
    type: "POST",
    data: datos,
    contentType: false, // Deshabilitar la codificación de tipo MIME
    processData: false, // Deshabilitar la codificación de datos
    success: function(data) {
    //  alert(data+"dasdas");
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

function Actualizar_servicio(cod_servicio,servicio,descripcion){
  document.getElementById("cod_servicio").value=cod_servicio;
  document.getElementById("servicio").value=servicio;
  document.getElementById("descripcion").value=descripcion;
}

function GenerarReportesServicio(){
  var id_servicio = document.getElementById("id_servicio").value;
  var form = document.createElement('form');
   form.method = 'post';
   form.action = '../controlador/servicio.controlador.php?accion=grser'; // Coloca la URL de destino correcta
   // Agregar campos ocultos para cada dato

   var datos = {
     id_servicio:id_servicio
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
function accionBtnActivar(accion,cod_servicio){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var id_servicio = document.getElementById("id_servicio").value;
    var pagina = document.getElementById("paginas").value;
    if(pagina == ''){
      pagina=1;
    }
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append("accion",accion);
    datos.append("cod_servicio",cod_servicio);
    datos.append("listarDeCuanto",listarDeCuanto);
    datos.append("id_servicio",id_servicio);
    datos.append("pagina",pagina);
     //alert(id_servicio);
     $.ajax({
       url: "../controlador/servicio.controlador.php?accion=acser",
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
</script>
<?php require("../librerias/footeruni.php"); ?>
