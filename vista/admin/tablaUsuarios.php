<?php require("../librerias/headeradmin1.php"); ?>

<div class="container mt-5">
  <h2>Usuarios</h2>
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
      <div class="col-2" title="Registro de nuevo usuario">
        <button type="button" class="form-control btn btn-primary" onclick="visforUsuario()"><img src='../imagenes/iconos/nuevo_student.png'style='height: 25px;width: 25px;'></button>
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
          <thead>
            <tr>
              <th>N°</th>
              <th>C.I.</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Apellido P.</th>
              <th>Apellido M.</th>
              <th>Telefono</th>
              <th>Dirección</th>
              <th>Profesión</th>
              <th>Especialidad</th>
              <th>Tipo</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
      <?php
      if ($resul && $resul->num_rows > 0) {
          $i = 0;
          while($fi=mysqli_fetch_array($resul)){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['ci_usuario']."</td>";
              echo "<td>".$fi['usuario']."</td>";
              echo "<td>".$fi['nombre_usuario']."</td>";
              echo "<td>".$fi['ap_usuario']."</td>";
              echo "<td>".$fi['am_usuario']."</td>";
              echo "<td>".$fi['telefono_usuario']."</td>";
              echo "<td>".$fi['direccion_usuario']."</td>";
              echo "<td>".$fi['profesion_usuario']."</td>";
              echo "<td>".$fi['especialidad_usuario']."</td>";
              echo "<td>".$fi['tipo_usuario']."</td>";
              echo "<td>";
                echo "<div class='btn-group'>";
                  echo "<button type='button' class='btn btn-success mb-1'><img src='../imagenes/iconos/edit.png' height='30' width='30' class='rounded-circle'></button>";
                  echo "<button type='button' class='btn btn-danger'><img src='../imagenes/iconos/eli.png' height='30' width='30' class='rounded-circle'></button>";
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
        url: "../controlador/usuario.controlador.php?accion=bus",
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
</script>
<?php require("../librerias/footeruni.php"); ?>
