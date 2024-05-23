<?php require("../librerias/headeradmin1.php"); ?>
<div class="container mt-5">
  <h2>Registro Diario de Pacientes</h2>
  <div class="row">
      <label for="selectPage" class="form-label">Page</label>
      <div class="col-2">
        <select class="form-select" id="selectList" onchange="BuscarUsuarios(1)" name="selectList">
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
      <div class="col-2" title="Registro Diario">
        <button type="button" class="form-control btn btn-primary" onclick="visforUsuario()"><img src='../imagenes/paciente.ico'style='height: 25px;width: 25px;'></button>
      </div>
      <div class="col-3">

      </div>
      <div class="col-5">
        <input type="text" class="form-control mb-3" placeholder="Buscar..." id='buscaru' onkeyup="BuscarUsuarios(1)">
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
                      echo "<button type='button' class='btn btn-dark' title='Sin historial' style='font-size:10px'>Sin historial</button>";
                    echo "</div>";

              }else{
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-success' title='Sin historial' style='font-size:10px'>Sin historial</button>";
                echo "</div>";
              }
              echo "</td>";

              echo "<td>".$fi['admision_nombre']."</td>";
              echo "<td>".$fi['fecha_retorno_historia_rd']."</td>";
              echo "<td>";
                echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";
                  echo "<button type='button' class='btn btn-info' title='Editar' onclick='accionBtnEditar(".$pagina.",".$listarDeCuanto.",\"".$fi["cod_usuario"]."\")'><img src='../imagenes/edit.ico' height='17' width='17' class='rounded-circle'></button>";
                    echo "<button type='button' class='btn btn-danger' title='Desactivar Usuario' onclick='accionBtnActivar(\"activo\",".$pagina.",".$listarDeCuanto.",".$fi["cod_usuario"].")'><img src='../imagenes/drop.ico' height='17' width='17' class='rounded-circle'></button>";

                echo "</div>";
              echo "</td>";


            echo "</tr>";
            $i++;
          }
        }else{
          $resul = 'No se encontro resultados';
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
        echo "<li class='page-item'><a class='page-link'  onclick=\"BuscarUsuarios(1)\"><span aria-hidden='true'>&laquo;</span></a></li>";
      }
      if($pagina==1) {
        echo "<li class='page-item'><a class='page-link text-muted'>$anterior</a></li>";
      } else if($pagina==2) {
        echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(1)\" class='page-link'>$anterior</a></li>";
      }else {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina-1)\">$anterior</a></li>";

      }
      // first label
      if($pagina>($adjacents+1)) {
        echo "<li class='page-item'><a href='javascript:void(0);' class='page-link' onclick=\"BuscarUsuarios(1)\">1</a></li>";
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
          echo"<li class='page-item'><a href='javascript:void(0);' class='page-link'onclick=\"BuscarUsuarios(1)\">$i</a></li>";
        }else {
          echo "<li class='page-item'><a href='javascript:void(0);' onclick=\"BuscarUsuarios(".$i.")\" class='page-link'>$i</a></li>";
        }
      }

      // interval

      if($pagina<($TotalPaginas-$adjacents-1)) {
        echo "<li class='page-item'><a class='page-link'>...</a></li>";
      }
      // last

      if($pagina<($TotalPaginas-$adjacents)) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link ' onclick=\"BuscarUsuarios($TotalPaginas)\">$TotalPaginas</a></li>";
      }
      // next

      if($pagina<$TotalPaginas) {
        echo "<li class='page-item'><a href='javascript:void(0);'class='page-link' onclick=\"BuscarUsuarios($pagina+1)\">$siguiente</a></li>";
      }else {
        echo "<li class='page-item'><a class='page-link text-muted'>$siguiente</a></li>";
      }
      if ($pagina != $TotalPaginas) {
        echo "<li class='page-item'><a class='page-link' onclick=\"BuscarUsuarios($TotalPaginas)\"><span aria-hidden='true'>&raquo;</span></a></li>";
      }

      echo "</ul>";
      echo "</div>";

echo "</div>
    </div>";

  }
   ?>
 </div>


<script type="text/javascript">
function BuscarUsuarios(page){
    var obt_lis = document.getElementById("selectList").value;
    var listarDeCuanto = verificarList(obt_lis);
    var buscar = document.getElementById("buscaru").value;
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('buscar', buscar);
    datos.append('page', page);
    datos.append('listarDeCuanto',listarDeCuanto);
      $.ajax({
        url: "../controlador/registroDiario.controlador.php?accion=brd",
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

  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }

  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }
   //$pagina,$listarDeCuanto
   //funcion para activar o desactivar el usuario o dar de baja
   function accionBtnActivar(accion,pagina,listarDeCuanto,cod_usuario){
     var buscar = document.getElementById("buscaru").value;
     var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append('accion', accion);
     datos.append("pagina",pagina);
     datos.append("listarDeCuanto",listarDeCuanto);
     datos.append("buscar",buscar);
     datos.append("cod_usuario",cod_usuario);
     $.ajax({
       url: "../controlador/usuario.controlador.php?accion=del",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
     //  alert(data+"dasdas");
     	   data=$.trim(data);
         if(data == "error"){
           error();
         }else{
           $("#verDatos").html(data);
         }
       }
     });
   }

   //funcion para verificar si el usuario existe o no y despues poder editar sus datos
   function accionBtnEditar(pagina,listarDeCuanto,cod_usuario){
     var buscar = document.getElementById("buscaru").value;
     var datos = new FormData(); // Crear un objeto FormData vacío
     datos.append("cod_usuario",cod_usuario);
     $.ajax({
       url: "../controlador/usuario.controlador.php?accion=ed",
       type: "POST",
       data: datos,
       contentType: false, // Deshabilitar la codificación de tipo MIME
       processData: false, // Deshabilitar la codificación de datos
       success: function(data) {
     //  alert(data+"dasdas");
     	   data=$.trim(data);
         if(data == "error"){
           error();//no debe existir el codigo de usuario
         }else{
           //creamos un formulario para enviar los datos y abrimos el fomulario
           formularioSubmit(pagina,listarDeCuanto,cod_usuario,buscar);
         }
       }
     });
   }

   function formularioSubmit(pagina,listarDeCuanto,cod_usuario,buscar){
     var form = document.createElement('form');
      form.method = 'post';
      form.action = '../controlador/usuario.controlador.php?accion=fm'; // Coloca la URL de destino correcta
      // Agregar campos ocultos para cada dato
      var datos = {
          pagina: pagina,
          listarDeCuanto: listarDeCuanto,
          cod_usuario: cod_usuario,
          buscar: buscar
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

   function error(){
  	 Swal.fire({
  		icon: 'error',
  		title: '¡Error!',
  		text: '¡No se pudo realizar la acción !',
  		showConfirmButton: false,
  		timer: 1500
  	});
   }
</script>
<?php require("../librerias/footeruni.php"); ?>
