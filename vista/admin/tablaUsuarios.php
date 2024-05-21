<?php require("../librerias/headeradmin1.php"); ?>

<div class="container mt-5">
  <h2>Usuarios</h2>
  <div class="row">
      <label for="selectPage" class="form-label">Page</label>
      <div class="col-2">
        <select class="form-select" id="selectPage" onchange="PatientDerivative(1)" name="selectPage">
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
        <table class="table">
          <thead>
            <tr>
              <th>N°</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Apellido P.</th>
              <th>Apellido M.</th>
            </tr>
          </thead>
          <tbody>
      <?php
      if ($resultodoUsuarios && $resultodoUsuarios->num_rows > 0) {
          $i = 0;
          while($fi=mysqli_fetch_array($resultodoUsuarios)){
            echo "<tr>";
              echo "<td>".($i+1)."</td>";
              echo "<td>".$fi['usuario']."</td>";
              echo "<td>".$fi['usuario']."</td>";
            echo "</tr>";
            $i++;
          }
        }else{
          $resultodoUsuarios = 'No se encontro resultados';
        }
         ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-end">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Siguiente</a>
        </li>
      </ul>
    </nav>
  </div>
  </div>
</div>
<script type="text/javascript">
function BuscarUsuarios(page){
    var buscar = document.getElementById("buscaru").value;
    var datos = new FormData(); // Crear un objeto FormData vacío
    datos.append('buscar', buscar);
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
  function visforUsuario(){
     location.href="../controlador/usuario.controlador.php?accion=vfu" ;
   }
</script>
<?php require("../librerias/footeruni.php"); ?>
