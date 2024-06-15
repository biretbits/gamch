<?php require("../librerias/headeradmin1.php"); ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-10 offset-md-1">
      <div class="card">
        <div class="card-header">
          FORMULARIO DE REGISTRO DE SERVICIOS
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
        <div class="card-footer text-muted">
          © 2024 Centro de Salud
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function registroServicio(){
  var servicio = document.getElementById("servicio").value;
  var descripcion = document.getElementById("descripcion").value;
  var datos = new FormData(); // Crear un objeto FormData vacío
  datos.append("servicio",servicio);
  datos.append("descripcion",descripcion);
  $.ajax({
    url: "../controlador/servicio.controlador.php?accion=rse",
    type: "POST",
    data: datos,
    contentType: false, // Deshabilitar la codificación de tipo MIME
    processData: false, // Deshabilitar la codificación de datos
    success: function(data) {
    //  alert(data+"dasdas");
      data=$.trim(data);
      if(data == "correcto"){
        Swal.fire({
         icon: 'success',
         title: '¡Correcto!',
         text: '¡Registro Correcto!',
         showConfirmButton: false,
         timer: 1500
       });
      }else {
        Swal.fire({
         icon: 'error',
         title: '¡Error!',
         text: '¡Ocurrio un problema!',
         showConfirmButton: false,
         timer: 1500
       });
      }
    }
  });
}
</script>
<?php require("../librerias/footeruni.php"); ?>
